<?php
include '../modules/review.php'; // Kết nối với file module

// Lấy tất cả đánh giá từ cơ sở dữ liệu
$reviews = getAllReviews();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Giữ nguyên CSS từ file bên ngoài -->
    <title>Danh Sách Đánh Giá</title>
    <style>
         body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>
    <?php include '../include/header.php'; ?>

    <div class="content d-flex flex-grow-1">
        <?php include '../include/menu_left.php'; ?>
        <div class="main-content flex-grow-1 p-3">
            <h2 class="mb-3">Danh Sách Đánh Giá</h2>

            <?php if (!empty($reviews)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Đánh Giá</th>
                            <th>Tên Người Đánh Giá</th>
                            <th>ID Sản Phẩm</th>
                            <th>Đánh Giá</th>
                            <th>Bình Luận</th>
                            <th>Thời Gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reviews as $review): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($review['id']); ?></td>
                                <td><?php echo htmlspecialchars($review['username']); ?></td>
                                <td><?php echo htmlspecialchars($review['product_id']); ?></td>
                                <td><?php echo str_repeat('⭐', $review['rating']); ?></td>
                                <td><?php echo htmlspecialchars($review['comment']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($review['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Hiện tại không có đánh giá nào.</p>
            <?php endif; ?>

            <a href="../index.php" class="btn btn-secondary">Quay lại trang chủ</a>
        </div>
    </div>

    <?php include '../include/footer.php'; ?>
</body>
</html>
