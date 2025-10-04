@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Quản lý lớp: {{ $classroom->class_name }} ({{ $classroom->class_code }})</h2>

    <hr>

    <h4>Danh sách học viên</h4>
    <a href="{{ route('classrooms.students', $classroom) }}" class="btn btn-primary">Quản lý học viên</a>

    <h4 class="mt-4">Danh sách môn học</h4>
    <a href="{{ route('classrooms.subjects', $classroom) }}" class="btn btn-success">Quản lý môn học</a>

    <h4 class="mt-4">Điểm</h4>
    <a href="{{ route('classrooms.scores', $classroom) }}" class="btn btn-warning">Nhập/Xem điểm</a>
</div>
@endsection
