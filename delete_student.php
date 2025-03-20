<?php
include 'db_connect.php';
$MaSV = $_GET["MaSV"];
$sql = "DELETE FROM SinhVien WHERE MaSV='$MaSV'";
if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Lỗi: " . $conn->error;
}
?>
