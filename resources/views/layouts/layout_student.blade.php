<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sinh viên')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f4f7fb;
        }
        .student-sidebar {
            min-height: 100vh;
            background: #1d2636;
            color: #cbd5e1;
        }
        .student-sidebar h5 {
            color: #ffffff;
            margin-bottom: 1rem;
        }
        .student-sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            transition: background 0.2s ease;
        }
        .student-sidebar a:hover {
            background: #2f4058;
            color: #ffffff;
        }
        .student-header {
            background: #2f80ed;
            color: white;
            padding: 1rem 1.5rem;
        }
        .student-main {
            padding: 1.5rem;
        }
        .student-footer {
            background: #e2e8f0;
            padding: 1rem 1.5rem;
            color: #475569;
            text-align: center;
        }
        @media (max-width: 991px) {
            .student-sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col-lg-2 student-sidebar p-4">
                <h5>Thư viện</h5>
                <a href="{{ route('student.borrow') }}">Trang chủ</a>
                <a href="{{ route('student.profile') }}">Thông tin cá nhân</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('student-logout-form').submit();">Đăng xuất</a>
                <form id="student-logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <div class="col-lg-10">
                <header class="student-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">@yield('title', 'Sinh viên')</h4>
                    </div>
                    <div class="text-white opacity-75">
                        {{ auth('student')->user()->name ?? 'Sinh viên' }}
                    </div>
                </header>

                <main class="student-main">
                    @yield('content')
                </main>

                <footer class="student-footer">
                    © {{ date('Y') }} Quản lý thư viện
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
