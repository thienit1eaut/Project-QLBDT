<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
</head>
<body>
    <h2>Đăng ký tài khoản</h2>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <label>Họ tên:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Username:</label><br>
        <input type="text" name="username" value="{{ old('username') }}"><br><br>

        <label>Mật khẩu:</label><br>
        <input type="password" name="password"><br><br>

        <label>Nhập lại mật khẩu:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
</body>
</html>
