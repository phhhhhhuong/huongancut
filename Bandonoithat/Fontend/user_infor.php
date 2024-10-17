<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Chuyển hướng về trang index nếu chưa đăng nhập
    exit();
}

// Kết nối đến cơ sở dữ liệu
include 'ketnoi.php'; // Kết nối đến cơ sở dữ liệu

$username = $_SESSION['username'];

// Truy xuất thông tin người dùng từ cơ sở dữ liệu
$query = "SELECT full_name, email, phone_number, address, password FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_info = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_info'])) {
    // Lấy thông tin từ biểu mẫu
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $update_query = "UPDATE users SET full_name = ?, email = ?, phone_number = ?, address = ? WHERE username = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssss", $full_name, $email, $phone_number, $address, $username);

    if ($update_stmt->execute()) {
        echo "<script>alert('Cập nhật thông tin thành công!');</script>";
        // Cập nhật lại thông tin trong session
        $_SESSION['full_name'] = $full_name; // Cập nhật nếu bạn lưu tên đầy đủ trong session
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<script>alert('Cập nhật không thành công!');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu hiện tại
    if (password_verify($current_password, $user_info['password'])) {
        if ($new_password === $confirm_password) {
            // Mã hóa mật khẩu mới
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Cập nhật mật khẩu trong cơ sở dữ liệu
            $update_password_query = "UPDATE users SET password = ? WHERE username = ?";
            $update_password_stmt = $conn->prepare($update_password_query);
            $update_password_stmt->bind_param("ss", $hashed_password, $username);

            if ($update_password_stmt->execute()) {
                echo "<script>alert('Đổi mật khẩu thành công!');</script>";
            } else {
                echo "<script>alert('Đổi mật khẩu không thành công!');</script>";
            }
        } else {
            echo "<script>alert('Mật khẩu mới không khớp!');</script>";
        }
    } else {
        echo "<script>alert('Mật khẩu hiện tại không đúng!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Cập nhật Thông tin Người dùng</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Tên đầy đủ</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user_info['full_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user_info['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user_info['phone_number']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user_info['address']); ?>" required>
            </div>
            <button type="submit" name="update_info" class="btn btn-success">Cập nhật thông tin</button>
        </form>

        <h2 class="mt-5">Đổi mật khẩu</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-warning">Đổi mật khẩu</button>
        </form>

        <a href="index.php" class="btn btn-primary mt-3">Quay lại Trang chủ</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
