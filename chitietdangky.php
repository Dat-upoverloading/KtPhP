<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION["MaSV"])) {
    echo "Bạn cần đăng nhập để xem học phần đã đăng ký.";
    exit();
}

$MaSV = $_SESSION["MaSV"];
$sql = "SELECT SV.HoTen, HP.MaHP, HP.TenHP, HP.SoTinChi, DK.NgayDK 
        FROM ChiTietDangKy CTDK
        JOIN DangKy DK ON CTDK.MaDK = DK.MaDK
        JOIN HocPhan HP ON CTDK.MaHP = HP.MaHP
        JOIN SinhVien SV ON DK.MaSV = SV.MaSV
        WHERE DK.MaSV = '$MaSV'";
$result = $conn->query($sql);
$tenSV = "";
$hocPhanList = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tenSV = $row['HoTen'];
        $hocPhanList[] = $row;
    }
}
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
            background-color: black;
            color: white;
        }
        .btn-delete, .btn-pay {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            color: white;
        }
        .btn-delete { background-color: red; }
        .btn-pay { background-color: green; }
        .payment-form {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: left;
        }
    </style>
    <script>
        function showPaymentForm() {
            document.getElementById("paymentForm").style.display = "block";
        }
    </script>
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
                <th>Hành động</th>
            </tr>
            <?php if(count($hocPhanList) > 0): ?>
                <?php foreach ($hocPhanList as $row): ?>
                    <tr>
                        <td><?= $row["MaHP"] ?></td>
                        <td><?= $row["TenHP"] ?></td>
                        <td><?= $row["SoTinChi"] ?></td>
                        <td><?= $row["NgayDK"] ?></td>
                        <td>
                            <form method="POST" action="delete_hocphan.php">
                                <input type="hidden" name="MaHP" value="<?= $row['MaHP'] ?>">
                                <button type="submit" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa học phần này?');">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Không có học phần nào được đăng ký.</td>
                </tr>
            <?php endif; ?>
        </table>
        <?php if(count($hocPhanList) > 0): ?>
            <button class="btn-pay" onclick="showPaymentForm()">Thanh toán</button>
        <?php endif; ?>

        <div id="paymentForm" class="payment-form">
            <h3>Thông Tin Thanh Toán</h3>
            <p><strong>Mã Sinh Viên:</strong> <?= $MaSV ?></p>
            <p><strong>Tên Sinh Viên:</strong> <?= $tenSV ?></p>
            <table>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Ngày Đăng Ký</th>
                </tr>
                <?php foreach ($hocPhanList as $row): ?>
                    <tr>
                        <td><?= $row["MaHP"] ?></td>
                        <td><?= $row["TenHP"] ?></td>
                        <td><?= $row["SoTinChi"] ?></td>
                        <td><?= $row["NgayDK"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
