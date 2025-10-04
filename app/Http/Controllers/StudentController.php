<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Nếu muốn lọc theo lớp (chọn từ dropdown)
        if ($request->has('class_id') && $request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        // Nếu là giảng viên, chỉ hiện các lớp họ quản lý
        if (auth()->user()->hasRole('teacher')) {
            $allowedClasses = auth()->user()->classes->pluck('id')->toArray();
            $query->whereIn('class_id', $allowedClasses);
        }

        $students = $query->paginate(10); // phân trang

        $classes = ClassModel::all();

        return view('students.index', compact('students', 'classes'));
    }


    public function create()
    {
        $users = \App\Models\User::all();
        $classes = \App\Models\ClassModel::all();

        return view('students.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Thêm học sinh thành công');
    }

    public function edit(Student $student)
    {
        $users = \App\Models\User::all();
        $classes = \App\Models\ClassModel::all();
        return view('students.edit', compact('users','classes', 'student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_code' => 'required|string|max:50',
            'user_id'      => 'required|exists:users,id',
            'class_id'     => 'required|exists:classes,id',
            'birth_date'   => 'nullable|date',
            'gender'       => 'required',   // tuỳ kiểu dữ liệu trong DB
            'hometown'     => 'nullable|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Cập nhật thành công');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Xoá thành công');
    }
}
