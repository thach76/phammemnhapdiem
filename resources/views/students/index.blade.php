<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Danh sách học sinh
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('students.create') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded">+ Thêm học sinh</a>

                <!-- Dropdown lọc lớp -->
                <form method="GET" action="{{ route('students.index') }}">
                    <select name="class_id" onchange="this.form.submit()" class="border rounded px-2 py-1">
                        <option value="">Tất cả lớp</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" 
                                {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Mã HS</th>
                            <th class="px-4 py-2">Tên tài khoản</th>
                            <th class="px-4 py-2">Lớp</th>
                            <th class="px-4 py-2">Ngày sinh</th>
                            <th class="px-4 py-2">Giới tính</th>
                            <th class="px-4 py-2">Quê quán</th>
                            <th class="px-4 py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $student->student_code }}</td>
                            <td class="px-4 py-2">{{ $student->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $student->class->class_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $student->birth_date }}</td>
                            <td class="px-4 py-2">{{ $student->gender }}</td>
                            <td class="px-4 py-2">{{ $student->hometown }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('students.edit', $student) }}" 
                                   class="px-2 py-1 bg-yellow-500 text-white rounded">Sửa</a>
                                <form method="POST" action="{{ route('students.destroy', $student) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        onclick="return confirm('Xóa học sinh này?')" 
                                        class="px-2 py-1 bg-red-600 text-white rounded">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center">Không có học sinh nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Phân trang -->
                <div class="mt-4">
                    {{ $students->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
