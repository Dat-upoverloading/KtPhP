<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu">
        <a href="hienthihocphan.php">Đăng ký học phần</a>
        <a href="add_student.php">Thêm Sinh Viên</a>
        <a href="chitietdangky.php">Học phần đã đăng ký</a>
        <?php if (!isset($_SESSION["MaSV"])): ?>
            <a href="login.php">Đăng nhập</a>
        <?php else: ?>
            <span>Xin chào, <?= $_SESSION["MaSV"] ?></span>
            <a href="logout.php">Đăng xuất</a>
        <?php endif; ?>
    </div>

    <h2>Danh Sách Sinh Viên</h2>

    <?php
    $sql = "SELECT * FROM SinhVien";
    $result = $conn->query($sql);
    ?>
    
    <table border="1">
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["MaSV"] ?></td>
            <td><?= $row["HoTen"] ?></td>
            <td><?= $row["GioiTinh"] ?></td>
            <td><?= $row["NgaySinh"] ?></td>
            <td><img src="<?= $row["Hinh"] ?>" width="100"></td>
            <td><?= $row["MaNganh"] ?></td>
            <td>
                <a href="edit_student.php?MaSV=<?= $row["MaSV"] ?>">Sửa</a> |
                <a href="student_detail.php?MaSV=<?= $row["MaSV"] ?>">Chi tiết</a> |
                <a href="delete_student.php?MaSV=<?= $row["MaSV"] ?>" onclick="return confirm('Xóa sinh viên này?')">Xóa</a> |
                
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
