<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Sửa thông tin học sinh
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow p-6 rounded">
            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block">Mã học sinh</label>
                    <input type="text" name="student_code" value="{{ $student->student_code }}" 
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block">Tài khoản (User)</label>
                    <select name="user_id" class="w-full border rounded px-3 py-2">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" 
                                @if($student->user_id == $user->id) selected @endif>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Lớp học</label>
                    <select name="class_id" class="w-full border rounded px-3 py-2">
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" 
                                @if($student->class_id == $class->id) selected @endif>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Ngày sinh</label>
                    <input type="date" name="birth_date" value="{{ $student->birth_date }}" 
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block">Giới tính</label>
                    <select name="gender" class="w-full border rounded px-3 py-2">
                        <option value="male" @if($student->gender == 'male') selected @endif>Nam</option>
                        <option value="female" @if($student->gender == 'female') selected @endif>Nữ</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Quê quán</label>
                    <input type="text" name="hometown" value="{{ $student->hometown }}" 
                           class="w-full border rounded px-3 py-2">
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Cập nhật</button>
            </form>
        </div>
    </div>
</x-app-layout>
