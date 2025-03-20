<?php
session_start();
include 'db_connect.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST["MaSV"];
    $sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["MaSV"] = $MaSV;
        header("Location: index.php");
        exit();
    } else {
        $error = "❌ Mã sinh viên không tồn tại!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập Sinh Viên</title>
    <style>
        .login-container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #d32f2f;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>🔑 Đăng Nhập Sinh Viên</h2>
        <?php if ($error): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="MaSV">Mã Sinh Viên:</label>
            <input type="text" name="MaSV" id="MaSV" required>
            <button type="submit">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>
