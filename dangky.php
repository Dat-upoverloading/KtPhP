<?php
session_start(); // Đảm bảo session được khởi tạo
$server = "localhost";
$username = "root";
$password = "";
$database = "Test1";

$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu sinh viên chưa đăng nhập
if (!isset($_SESSION["MaSV"])) {
    echo "Bạn cần đăng nhập trước.";
    exit();
}

$maSV = $_SESSION["MaSV"];

if (isset($_GET["MaHP"])) {
    $maHP = $_GET["MaHP"];
    
    // Bước 1: Lấy MaDK từ bảng DangKy dựa trên MaSV
    $sqlDK = "SELECT MaDK FROM DangKy WHERE MaSV='$maSV' LIMIT 1";
    $resultDK = $conn->query($sqlDK);
    
    if ($resultDK->num_rows > 0) {
        $rowDK = $resultDK->fetch_assoc();
        $maDK = $rowDK['MaDK'];
    } else {
        // Nếu chưa có bản ghi DangKy cho sinh viên, tạo mới
        $today = date("Y-m-d");
        $insertDK = "INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$today', '$maSV')";
        if ($conn->query($insertDK) === TRUE) {
            $maDK = $conn->insert_id;
        } else {
            echo "Lỗi tạo đăng ký: " . $conn->error;
            exit();
        }
    }
    
    // Bước 2: Kiểm tra trong ChiTietDangKy với MaDK và MaHP
    $check_sql = "SELECT * FROM ChiTietDangKy WHERE MaDK='$maDK' AND MaHP='$maHP'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "Bạn đã đăng ký học phần này rồi.";
    } else {
        $insert_sql = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$maDK', '$maHP')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Đăng ký thành công!";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
} else {
    echo "Không có học phần được chọn.";
}

$conn->close();
?>
