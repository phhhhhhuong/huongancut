<?php
include '../ketnoi.php'; // Kết nối cơ sở dữ liệu

// Hàm lấy tất cả đánh giá từ cơ sở dữ liệu
function getAllReviews() {
    global $conn; // Sử dụng kết nối toàn cục

    $sql = "SELECT reviews.*, users.username 
            FROM reviews 
            JOIN users ON reviews.user_id = users.id 
            ORDER BY created_at DESC";
    
    $result = $conn->query($sql);

    $reviews = [];
    if ($result && $result->num_rows > 0) {
        $reviews = $result->fetch_all(MYSQLI_ASSOC);
    }

    return $reviews;
}
?>
