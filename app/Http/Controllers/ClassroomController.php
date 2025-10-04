<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Score;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with(['students', 'subjects'])->paginate(10);
        return view('classrooms.index', compact('classrooms'));
    }

    public function show(Classroom $classroom)
    {
        $classroom->load(['students', 'subjects', 'scores']);
        return view('classrooms.show', compact('classroom'));
    }

    // ===================== STUDENTS =======================
    public function students(Classroom $classroom)
    {
        $students = $classroom->students()->paginate(10);
        return view('classrooms.students', compact('classroom', 'students'));
    }

    public function storeStudent(Request $request, Classroom $classroom)
    {
        $request->validate([
            'student_name' => 'required',
            'dob' => 'required|date',
        ]);

        $classroom->students()->create([
            'student_code' => "H" . $classroom->year . strtoupper(substr($classroom->class_name, 0, 3)) . rand(100, 999),
            'student_name' => $request->student_name,
            'dob' => $request->dob,
            'address' => $request->address ?? '',
        ]);

        return back()->with('success', 'Thêm học viên thành công');
    }

    public function destroyStudent(Classroom $classroom, Student $student)
    {
        $student->delete();
        return back()->with('success', 'Xóa học viên thành công');
    }

    // ===================== SUBJECTS =======================
    public function subjects(Classroom $classroom)
    {
        $allSubjects = Subject::all();
        $subjects = $classroom->subjects;
        return view('classrooms.subjects', compact('classroom', 'subjects', 'allSubjects'));
    }

    public function storeSubject(Request $request, Classroom $classroom)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $classroom->subjects()->syncWithoutDetaching([$request->subject_id]);

        return back()->with('success', 'Thêm môn học vào lớp thành công');
    }

    public function destroySubject(Classroom $classroom, Subject $subject)
    {
        $classroom->subjects()->detach($subject->id);
        return back()->with('success', 'Xóa môn khỏi lớp thành công');
    }

    // ===================== SCORES =======================
    public function scores(Classroom $classroom)
    {
        $scores = Score::whereIn('student_id', $classroom->students->pluck('id'))->get();
        return view('classrooms.scores', compact('classroom', 'scores'));
    }

    public function storeScore(Request $request, Classroom $classroom)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|numeric|min:0|max:10',
        ]);

        Score::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'score' => $request->score,
            'status' => 'pending', // giảng viên nhập → pending
        ]);

        return back()->with('success', 'Nhập điểm thành công (chờ duyệt)');
    }
}
