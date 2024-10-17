<?php
include 'ketnoi.php'; // Kết nối cơ sở dữ liệu

// Hàm lấy sản phẩm theo category_id
function getProductsByCategoryId($categoryId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Hàm lấy tên danh mục theo category_id
function getCategoryNameById($categoryId) {
    global $conn;
    $stmt = $conn->prepare("SELECT name FROM product_catalog WHERE id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['name'] ?? 'Danh Mục Không Tồn Tại'; // Trả về tên danh mục hoặc thông báo nếu không tồn tại
}

// Lấy danh mục từ URL
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

// Lấy sản phẩm theo danh mục
$products = getProductsByCategoryId($categoryId);

// Lấy tên danh mục
$name = getCategoryNameById($categoryId);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm Theo Danh Mục: <?php echo htmlspecialchars($name); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            display: flex;
            flex: 1;
        }
        .menu-left {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        .main-content {
        padding: 20px; /* Khoảng cách giữa nội dung và viền */
    }

    .card {
        transition: transform 0.2s; /* Hiệu ứng khi di chuột */
    }

    .card:hover {
        transform: scale(1.05); /* Phóng to khi di chuột */
    }

    .card-img-top {
        height: 200px; /* Chiều cao cố định cho hình ảnh */
        object-fit: cover; /* Đảm bảo hình ảnh giữ tỷ lệ */
    }

    @media (max-width: 768px) {
        .col-md-3 {
            flex: 0 0 50%; /* Trên màn hình nhỏ hơn, hiển thị 2 sản phẩm trong 1 hàng */
            max-width: 50%; /* Đặt chiều rộng tối đa cho cột */
        }
    }
    
    @media (max-width: 576px) {
        .col-md-3 {
            flex: 0 0 100%; /* Trên màn hình rất nhỏ, hiển thị 1 sản phẩm trong 1 hàng */
            max-width: 100%; /* Đặt chiều rộng tối đa cho cột */
        }
    }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'include/header.php'; ?>

    <div class="content">
        <!-- Menu bên trái -->
        <?php include 'include/menu_left.php'; ?>
        
        <!-- Nội dung chính -->
        <div class="main-content">
    <h2>Sản Phẩm Theo Danh Mục: <?php echo htmlspecialchars($name); ?></h2>

    <?php if (!empty($products)): ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3"> <!-- Thay đổi từ col-md-4 thành col-md-3 -->
                    <div class="card mb-4 shadow-sm"> <!-- Thêm shadow để làm nổi bật -->
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                            <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Không có sản phẩm nào trong danh mục này.</p>
    <?php endif; ?>
</div>

    </div>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>
</body>
</html>
