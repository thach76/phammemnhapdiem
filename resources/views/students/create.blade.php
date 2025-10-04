<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Thêm học sinh mới
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow p-6 rounded">
            <form method="POST" action="{{ route('students.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block">Mã học sinh</label>
                    <input type="text" name="student_code" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block">Tài khoản (User)</label>
                    <select name="user_id" class="w-full border rounded px-3 py-2">
                        @foreach($users as $user)
                            @if(!$user->student)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Lớp học</label>
                    <select name="class_id" class="w-full border rounded px-3 py-2">
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Ngày sinh</label>
                    <input type="date" name="birth_date" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block">Giới tính</label>
                    <select name="gender" class="w-full border rounded px-3 py-2">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Quê quán</label>
                    <input type="text" name="hometown" class="w-full border rounded px-3 py-2">
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Lưu</button>
            </form>
        </div>
    </div>
</x-app-layout>
