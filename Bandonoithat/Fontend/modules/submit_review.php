<?php
session_start(); // Đảm bảo rằng phiên đã được khởi động

include 'ketnoi.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để gửi đánh giá.";
    exit;
}

// Lấy dữ liệu từ form gửi đánh giá
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$user_id = $_SESSION['user_id']; // ID người dùng từ phiên
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

// Kiểm tra tính hợp lệ của dữ liệu
if ($product_id > 0 && $rating >= 1 && $rating <= 5) {
    // Thực hiện truy vấn chèn đánh giá
    $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);

    if ($stmt->execute()) {
        echo "Đánh giá đã được gửi thành công.";
    } else {
        echo "Có lỗi xảy ra khi gửi đánh giá: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID sản phẩm không hợp lệ hoặc đánh giá không hợp lệ.";
}

$conn->close();
?>
