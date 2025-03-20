<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database = "Test1";

$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (!isset($_SESSION["MaSV"])) {
    echo "Bạn cần đăng nhập trước.";
    exit();
}

$maSV = $_SESSION["MaSV"];

if (isset($_GET["MaHP"])) {
    $maHP = $_GET["MaHP"];
    $sqlDK = "SELECT MaDK FROM DangKy WHERE MaSV='$maSV' LIMIT 1";
    $resultDK = $conn->query($sqlDK);
    
    if ($resultDK->num_rows > 0) {
        $rowDK = $resultDK->fetch_assoc();
        $maDK = $rowDK['MaDK'];
    } else {
        $today = date("Y-m-d");
        $insertDK = "INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$today', '$maSV')";
        if ($conn->query($insertDK) === TRUE) {
            $maDK = $conn->insert_id;
        } else {
            echo "Lỗi tạo đăng ký: " . $conn->error;
            exit();
        }
    }
    $check_sql = "SELECT * FROM ChiTietDangKy WHERE MaDK='$maDK' AND MaHP='$maHP'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "Bạn đã đăng ký học phần này rồi.";
        ?>
            <a href="hienthihocphan.php">Trở về</a>
            <?php
    } else {
        $insert_sql = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$maDK', '$maHP')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Đăng ký thành công!";
            ?>
            <a href="hienthihocphan.php">Trở về</a>
            <?php
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
} else {
    echo "Không có học phần được chọn.";
}

$conn->close();
?>
