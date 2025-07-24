<!DOCTYPE html>
<html>
<head>
    <title>Quản lý quyền</title>
</head>
<body>
    <h2>Thêm quyền</h2>

    <form method="POST" action="{{ route('role.create') }}">
        @csrf

        <label>Tên quyền:</label><br>
        <input type="text" name="name" value=""></br></br>
        <label>Mã quyền:</label><br>
        <input type="text" name="code" value=""></br></br>
        <label>Ghi chú:</label><br>
        <input type="text" name="note" value=""></br></br>

        <button type="submit">Thêm</button>
    </form>
</body>
</html>
