<?php
include 'db_connect.php';

$MaSV = $_GET["MaSV"];
$sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST["HoTen"];
    $GioiTinh = $_POST["GioiTinh"];
    $NgaySinh = $_POST["NgaySinh"];
    $Hinh = $_POST["Hinh"];
    $MaNganh = $_POST["MaNganh"];

    $sql = "UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$Hinh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";
    
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
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Sinh Viên</title>
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
            place-items: center;
            justify-items: center;
        }
        .profile-pic {
            text-align: center;
        }
        .profile-pic img {
            width: 100px;
            border-radius: 50%;
        }</style>
</head>
<body>
    <div class="container">
        <a href="index.php">Trở về</a>
        <h2>Chỉnh Sửa Thông Tin Sinh Viên</h2>
        <div class="profile-pic">
            <img src="<?= $row["Hinh"] ?>" alt="Ảnh Sinh Viên">
        </div>
        <form method="post">
            <label for="HoTen">Họ Tên:</label>
            <input type="text" name="HoTen" id="HoTen" value="<?= $row["HoTen"] ?>" required>

            <label for="GioiTinh">Giới Tính:</label>
            <select name="GioiTinh" id="GioiTinh">
                <option value="Nam" <?= $row["GioiTinh"] == "Nam" ? "selected" : "" ?>>Nam</option>
                <option value="Nữ" <?= $row["GioiTinh"] == "Nữ" ? "selected" : "" ?>>Nữ</option>
            </select>

            <label for="NgaySinh">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" id="NgaySinh" value="<?= $row["NgaySinh"] ?>" required>

            <label for="Hinh">Hình (URL):</label>
            <input type="text" name="Hinh" id="Hinh" value="<?= $row["Hinh"] ?>">

            <select name="MaNganh" id="MaNganh">
                <option value="">-- Chọn ngành học --</option>
                <option value="CNTT">Công nghệ thông tin</option>
                <option value="QTKD">Quản Trị Kinh Doanh</option>
            </select>

            <button type="submit">Cập Nhật</button>
        </form>
    </div>
</body>
</html>

