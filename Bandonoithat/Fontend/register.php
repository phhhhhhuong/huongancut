<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'ketnoi.php'; // Kết nối tới cơ sở dữ liệu

    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'] ?? null; // Mặc định là null nếu không nhập
    $address = $_POST['address'] ?? null; // Mặc định là null nếu không nhập
    $role = 'customer'; // Giá trị mặc định cho role
    $status = 1; // Giá trị mặc định cho status

    // Kiểm tra xem tên người dùng hoặc email có tồn tại không
    $sql_check = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "Tên đăng nhập hoặc email đã tồn tại. Vui lòng chọn tên đăng nhập hoặc email khác.";
    } else {
        // Thêm người dùng mới vào cơ sở dữ liệu
        $sql = "INSERT INTO users (username, email, password, full_name, phone_number, address, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $username, $email, $password, $full_name, $phone_number, $address, $role, $status);

        if ($stmt->execute()) {
            echo "Đăng ký thành công! <a href='login.php'>Đăng Nhập</a>";
        } else {
            echo "Đã xảy ra lỗi: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Đăng Ký Tài Khoản</h2>
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="username">Tên Đăng Nhập:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật Khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="full_name">Họ Tên:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Số Điện Thoại:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
        </div>
        <div class="form-group">
            <label for="address">Địa Chỉ:</label>
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>
        <p class="mt-3">Đã có tài khoản? <a href="login.php">Đăng Nhập</a></p>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
