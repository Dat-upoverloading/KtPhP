<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "Test1";
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f3f3f3;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
        }</style>
</head>
<body>
    <h2>Danh Sách Học Phần</h2>
    <a href="index.php">Quay lại</a>
    <table border="1">
        <tr>
            <th>Mã HP</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Hành động</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["MaHP"] . "</td>";
                echo "<td>" . $row["TenHP"] . "</td>";
                echo "<td>" . $row["SoTinChi"] . "</td>";
                echo "<td><a href='dangky.php?MaHP=" . $row["MaHP"] . "'>Đăng Ký</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Không có học phần nào.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
