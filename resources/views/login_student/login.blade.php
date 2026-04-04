@extends('layouts.auth')

@section('content')

    <h2>Student Login</h2>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('student.login.post') }}">
        @csrf

        Email: <input type="email" name="email" class="form-control"><br><br>
        Password: <input type="password" name="password" class="form-control"><br><br>

        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>

    </form>

@endsection