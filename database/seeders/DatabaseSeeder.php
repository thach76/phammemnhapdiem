<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Department;
use App\Models\Group;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Score;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Xóa dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        DB::table('scores')->truncate();
        DB::table('class_subject')->truncate();
        DB::table('students')->truncate();
        DB::table('teachers')->truncate();
        DB::table('subjects')->truncate();
        DB::table('classrooms')->truncate();
        DB::table('groups')->truncate();
        DB::table('departments')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Tạo Department (khoa)
        $faculties = [
            ['code'=>'BCHT','short'=>'HT'],
            ['code'=>'BC','short'=>'BC'],
            ['code'=>'KHXHNV','short'=>'XH'],
            ['code'=>'QSĐP','short'=>'QS'],
            ['code'=>'CMKT','short'=>'CM']
        ];
        $departments = collect();
        foreach ($faculties as $f) {
            $departments->push(
                Department::create([
                    'department_code' => $f['short'],
                    'department_name' => $f['code']
                ])
            );
        }

        // 3. Tạo Group (3 tổ mỗi khoa)
        $groups = collect();
        foreach ($departments as $dep) {
            for ($i=1; $i<=3; $i++) {
                $groups->push(
                    Group::create([
                        'group_code' => $dep->department_code . $i,
                        'group_name' => "Tổ $i",
                        'department_id' => $dep->id
                    ])
                );
            }
        }

        // 4. Tạo Classroom (ví dụ 4 lớp)
        $classes = collect();
        $years = [2025];
        $majors = ['TVTD','QSTT','CNTT','CTXH'];
        $classOrder = 1;
        foreach ($years as $year) {
            foreach ($majors as $major) {
                $classes->push(
                    Classroom::create([
                        'class_code' => 'L' . substr($year,2) . $major . str_pad($classOrder++,2,'0',STR_PAD_LEFT),
                        'class_name' => "Lớp $major",
                        'year' => $year,
                        'major' => $major // Nếu có cột này trong migration
                    ])
                );
            }
        }

        // 5. Tạo Users + Roles
        $this->call(\Database\Seeders\UserSeeder::class);

        // 6. Tạo Teacher gắn User
        $teacherUsers = User::role('teacher')->get();
        $teacherOrder = 1;
        foreach ($teacherUsers as $user) {
            $faculty = $faculties[array_rand($faculties)];
            $group = Group::where('department_id',$faculty['short'])->inRandomOrder()->first();
            Teacher::create([
                'teacher_code' => 'GV' . $faculty['short'] . rand(1,3) . str_pad($teacherOrder++,2,'0',STR_PAD_LEFT),
                'name' => $user->name,
                'dob' => now()->subYears(rand(25,50))->format('Y-m-d'),
                'hometown' => 'City ' . $teacherOrder,
                'user_id' => $user->id,
                'department_id' => $group?->department_id ?? $departments->first()->id,
                'group_id' => $group?->id ?? $groups->first()->id,
            ]);
        }

        // 7. Tạo Student gắn User
        $studentUsers = User::role('student')->get();
        $studentOrder = 1;
        foreach ($studentUsers as $user) {
            $classroom = $classes->random();
            Student::create([
                'student_code' => 'H' . substr($classroom->year,2) . substr($classroom->class_code,1,4) . str_pad($studentOrder++,3,'0',STR_PAD_LEFT),
                'name' => $user->name,
                'dob' => now()->subYears(rand(18,25))->format('Y-m-d'),
                'hometown' => 'Town ' . $studentOrder,
                'user_id' => $user->id,
                'classroom_id' => $classroom->id
            ]);
        }

        // 8. Tạo Subject
        $subjects = collect();
        $subjectOrder = 1;
        foreach ($departments as $dep) {
            for ($g=1; $g<=3; $g++) { // 3 môn mỗi khoa
                $subjects->push(
                    Subject::create([
                        'subject_code' => substr($dep->department_code,0,1) . $g . str_pad($subjectOrder++,2,'0',STR_PAD_LEFT),
                        'subject_name' => "Môn $g " . $dep->name,
                        'department_id' => $dep->id,
                        'group_id' => Group::where('department_id',$dep->id)->skip($g-1)->first()->id ?? $groups->first()->id
                    ])
                );
            }
        }

        // 9. Gắn Subject vào Class (pivot)
        foreach ($classes as $class) {
            $randomSubjects = $subjects->random(rand(1,3))->pluck('id')->toArray();
            $class->subjects()->sync($randomSubjects);
        }
        
        // 10. Tạo Scores (Dựa trên cấu trúc Migration đã được sửa: student_id, class_subject_id, teacher_id, score, approved)
        foreach (Student::all() as $student) {
            // Lấy các bản ghi TỪ BẢNG PIVOT (class_subject) mà lớp học của sinh viên này tham gia.
            // Lệnh này trả về các đối tượng Subject, nhưng chúng ta cần lấy pivot ID.
            $classSubjects = $student->classroom->subjects; 
            
            // Lặp qua từng môn học đã được gán cho lớp của sinh viên
            foreach ($classSubjects as $subject) {
                // Lấy ID từ bảng Pivot (để dùng cho class_subject_id)
                $classSubjectPivotId = DB::table('class_subject')
                    ->where('classroom_id', $student->classroom_id)
                    ->where('subject_id', $subject->id)
                    ->value('id'); // Lấy id (Primary Key) của bảng pivot
                
                // Đảm bảo có ID pivot (vì bạn có foreignId('class_subject_id') trong scores)
                if ($classSubjectPivotId) {
                    $teacher = Teacher::inRandomOrder()->first();
                    Score::create([
                        'student_id' => $student->id,
                        
                        // ✅ THAY THẾ 'subject_id' BẰNG 'class_subject_id'
                        'class_subject_id' => $classSubjectPivotId, 
                        
                        'teacher_id' => $teacher?->id,
                        'score' => rand(0,100)/10,
                        
                        // ✅ THAY THẾ 'status'/'approved_by' BẰNG 'approved' (boolean)
                        'approved' => rand(0, 1), // 0 là false (pending), 1 là true (approved)
                        
                        // Xóa các cột 'status' và 'approved_by'
                    ]);
                }
            }
        }
    }
}
