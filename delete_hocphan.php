<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION["MaSV"])) {
    echo "Bạn cần đăng nhập để thực hiện thao tác này.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MaHP"])) {
    $MaSV = $_SESSION["MaSV"];
    $MaHP = $_POST["MaHP"];
    $sql = "SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $MaDK = $row["MaDK"];
        $sqlDelete = "DELETE FROM ChiTietDangKy WHERE MaDK = '$MaDK' AND MaHP = '$MaHP'";
        if ($conn->query($sqlDelete) === TRUE) {
            echo "<script>alert('Xóa học phần thành công!'); window.location.href='chitietdangky.php';</script>";
        } else {
            echo "Lỗi khi xóa: " . $conn->error;
        }
    } else {
        echo "Không tìm thấy đăng ký học phần.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}

$conn->close();
?>
