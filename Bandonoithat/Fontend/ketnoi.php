<?php
$host = "localhost"; // Địa chỉ máy chủ
$username = "root"; // Tên đăng nhập
$password = ""; // Mật khẩu (nếu có)
$database = "bandonoithat"; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $database);
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
