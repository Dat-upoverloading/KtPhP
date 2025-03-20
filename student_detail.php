<?php
session_start();
include 'db_connect.php';

if (!isset($_GET["MaSV"])) {
    echo "Không tìm thấy sinh viên.";
    exit();
}

$MaSV = $_GET["MaSV"];
$sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Sinh viên không tồn tại.";
    exit();
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Sinh Viên</title>
    <style>
        .container {
            width: 50%;
            margin: 0 auto;
        }
        img {
            width: 200px;
        }</style>
</head>
<body>
    <div class="container">
        <h2>Thông Tin Chi Tiết Sinh Viên</h2>
        <p><strong>Mã SV:</strong> <?= $row["MaSV"] ?></p>
        <p><strong>Họ Tên:</strong> <?= $row["HoTen"] ?></p>
        <p><strong>Giới Tính:</strong> <?= $row["GioiTinh"] ?></p>
        <p><strong>Ngày Sinh:</strong> <?= $row["NgaySinh"] ?></p>
        <p><strong>Ngành:</strong> <?= $row["MaNganh"] ?></p>
        <p><strong>Hình:</strong></p>
        <img src="<?= $row["Hinh"] ?>" alt="Ảnh Sinh Viên" width="200">
        <br><br>
        <a href="index.php">Quay lại danh sách</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>
