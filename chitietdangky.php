<?php
session_start();

include 'db_connect.php';
if (!isset($_SESSION["MaSV"])) {
    echo "Bạn cần đăng nhập để xem học phần đã đăng ký.";
    exit();
}

$MaSV = $_SESSION["MaSV"];
$sql = "SELECT HP.MaHP, HP.TenHP, HP.SoTinChi, DK.NgayDK 
        FROM ChiTietDangKy CTDK
        JOIN DangKy DK ON CTDK.MaDK = DK.MaDK
        JOIN HocPhan HP ON CTDK.MaHP = HP.MaHP
        WHERE DK.MaSV = '$MaSV'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Học Phần Đã Đăng Ký</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color:black;
        }
        a[href="index.php"] {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 Học Phần Đã Đăng Ký</h2>
        <a href="index.php">Quay lại</a>
        <table>
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Ngày Đăng Ký</th>
            </tr>
            <?php if($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["MaHP"] ?></td>
                        <td><?= $row["TenHP"] ?></td>
                        <td><?= $row["SoTinChi"] ?></td>
                        <td><?= $row["NgayDK"] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Không có học phần nào được đăng ký.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
