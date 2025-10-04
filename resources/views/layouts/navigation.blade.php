<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Quản lý đào tạo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classrooms.index') }}">Lớp học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classrooms.index') }}">Học viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classrooms.index') }}">Môn học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classrooms.index') }}">Điểm</a>
                    </li>
                    @role('Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Người dùng</a>
                        </li>
                    @endrole
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="nav-link">Xin chào, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Đăng xuất</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
