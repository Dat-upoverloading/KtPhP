<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST["MaSV"];
    $HoTen = $_POST["HoTen"];
    $GioiTinh = $_POST["GioiTinh"];
    $NgaySinh = $_POST["NgaySinh"];
    $Hinh = $_POST["Hinh"];
    $MaNganh = $_POST["MaNganh"];

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <a href="index.php">Trở về</a>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
    <style>
        .container {
            width: 50%;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 5px;
        }
        button {
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }</style>
</head>
<body>
    <div class="container">
        <h2>Thêm Sinh Viên</h2>
        <form method="post">
            <label for="MaSV">Mã SV:</label>
            <input type="text" name="MaSV" id="MaSV" required>

            <label for="HoTen">Họ Tên:</label>
            <input type="text" name="HoTen" id="HoTen" required>

            <label for="GioiTinh">Giới Tính:</label>
            <select name="GioiTinh" id="GioiTinh">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>

            <label for="NgaySinh">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" id="NgaySinh" required>

            <label for="Hinh">Hình (URL):</label>
            <input type="text" name="Hinh" id="Hinh" placeholder="Nhập URL hình ảnh">

            <label for="MaNganh">Ngành:</label>
            <select name="MaNganh" id="MaNganh">
                <option value="">-- Chọn ngành học --</option>
                <option value="CNTT">Công nghệ thông tin</option>
                <option value="QTKD">Quản Trị Kinh Doanh</option>
            </select>

            <button type="submit">Thêm Sinh Viên</button>
        </form>
    </div>
</body>
</html>
