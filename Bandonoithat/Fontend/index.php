<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Trang Bán Đồ Nội Thất</title>
    <style>
        
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .discount-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: #dc3545;
    color: #fff;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    z-index: 1;
}

        .content {
            display: flex;
            flex: 1;
            padding: 20px;
        }

        .menu-left {
            width: 250px;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        .menu-left:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        

        .card img {
            
    width: 100%; /* Đảm bảo hình ảnh rộng bằng chiều rộng của thẻ card */
    height: 200px; /* Thiết lập chiều cao cố định */
    object-fit: cover; /* Cắt bớt hình ảnh để không bị biến dạng */
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    transition: transform 0.2s ease;

        }

        .card img:hover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 14px;
            color: #666;
        }

        .discount-price {
            color: #dc3545;
            font-weight: bold;
            font-size: 16px;
        }

        .original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 14px;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-success:hover, .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
    </style>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <div class="content">
        <?php include 'include/menu_left.php'; ?>
        <div class="main-content">
    <h2 class="mb-3">Danh Sách Sản Phẩm</h2> <!-- Thêm tiêu đề danh sách sản phẩm -->
    <div class="d-flex justify-content-end mb-3"> <!-- Định vị phần sắp xếp bên phải -->
        <label for="sortOptions" class="form-label me-2">Sắp xếp theo:</label>
        <select id="sortOptions" class="form-select" onchange="location = this.value;">
            <option value="?sort=default" <?= isset($_GET['sort']) && $_GET['sort'] == 'default' ? 'selected' : ''; ?>>Mặc định</option>
            <option value="?sort=name" <?= isset($_GET['sort']) && $_GET['sort'] == 'name' ? 'selected' : ''; ?>>Tên (A-Z)</option>
            <option value="?sort=price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : ''; ?>>Giá (Tăng dần)</option>
            <option value="?sort=price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : ''; ?>>Giá (Giảm dần)</option>
            <option value="?sort=newest" <?= isset($_GET['sort']) && $_GET['sort'] == 'newest' ? 'selected' : ''; ?>>Mới nhất</option>
        </select>
    </div>

            <?php
            include 'ketnoi.php'; 

            // Hàm hiển thị sản phẩm
            // Hàm hiển thị sản phẩm
            function displayProductsWithPagination($conn, $page = 1, $limit = 8) {
    $offset = ($page - 1) * $limit;
    // Xử lý sắp xếp
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    $orderBy = '';

    switch ($sort) {
        case 'name':
            $orderBy = 'ORDER BY name ASC';
            break;
        case 'price_asc':
            $orderBy = 'ORDER BY price ASC';
            break;
        case 'price_desc':
            $orderBy = 'ORDER BY price DESC';
            break;
        case 'newest':
            $orderBy = 'ORDER BY created_at DESC'; // Giả sử bạn có trường created_at trong bảng sản phẩm
            break;
        default:
            $orderBy = '';
    }

    $sql = "SELECT * FROM products $orderBy LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-3 mb-4">';
    echo '    <div class="card h-100">';

    // Lấy đánh giá trung bình và số lượng đánh giá cho sản phẩm
    $productId = $row["id"];
    $ratingResult = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as review_count FROM reviews WHERE product_id = $productId");
    $ratingData = $ratingResult->fetch_assoc();
    $avgRating = $ratingData['avg_rating'] ? round($ratingData['avg_rating']) : 0; // Làm tròn đến số nguyên

    // Hiển thị nhãn phần trăm giảm giá nếu có giảm giá
    if ($row["percentage_discount"] > 0) {
        echo '        <span class="discount-badge">Giảm ' . $row["percentage_discount"] . '%</span>';
    }

    // Hiển thị hình ảnh sản phẩm
    echo '        <a href="product_detail.php?id=' . $row["id"] . '"><img src="' . htmlspecialchars($row["image"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["name"]) . '"></a>';
    echo '        <div class="card-body">';
    echo '            <h5 class="card-title">' . htmlspecialchars($row["name"]) . '</h5>';
    echo '            <p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';

    // Hiển thị đánh giá
    echo '            <div class="rating">';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $avgRating) {
            echo '<i class="fas fa-star" style="color: #ffc107;"></i>'; // Ngôi sao vàng
        } else {
            echo '<i class="far fa-star" style="color: #ccc;"></i>'; // Ngôi sao xám
        }
    }
    echo '            </div>';

    // Hiển thị giá sản phẩm
    if ($row["percentage_discount"] > 0) {
        $discountedPrice = number_format($row["price"] * (1 - ($row["percentage_discount"] / 100)), 2);
        echo '            <p class="card-text discount-price">Giá: ' . $discountedPrice . ' VNĐ</p>';
        echo '            <p class="card-text original-price">Giá gốc: ' . number_format($row["price"], 2) . ' VNĐ</p>';
    } else {
        echo '            <p class="card-text discount-price">Giá: ' . number_format($row["price"], 2) . ' VNĐ</p>';
    }

    echo '            <p class="card-text">Số lượng: ' . $row["quantity"] . '</p>';
    echo '            <div class="d-flex justify-content-between">';
    echo '                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buyModal" data-name="' . htmlspecialchars($row["name"]) . '" data-price="' . number_format($row["price"], 2) . ' VNĐ">Thêm <i class="fas fa-shopping-cart"></i></button>';
    echo '                <a href="buy.php?id=' . $row["id"] . '" class="btn btn-primary">Mua</a>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
}
        echo '</div>';
        // Thêm phần chia trang
        $resultTotal = $conn->query("SELECT COUNT(*) as total FROM products");
        $totalProducts = $resultTotal->fetch_assoc()['total'];
        $totalPages = ceil($totalProducts / $limit);
        
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item' . ($i === $page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul>';
        echo '</nav>';
    } else {
        echo "<p>Không có sản phẩm nào.</p>";
    }
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8; // Số sản phẩm mỗi trang

displayProductsWithPagination($conn, $page, $limit);


            // Gọi hàm hiển thị sản phẩm
        

            // Đóng kết nối
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Modal cho Mua Hàng -->
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel">Thêm vào Giỏ Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tên sản phẩm:</strong> <span id="buy-product-name"></span></p>
                    <p><strong>Giá:</strong> <span id="buy-product-price"></span></p>
                    <div class="mb-3">
                        <label for="quantityInput" class="form-label">Số lượng:</label>
                        <input type="number" class="form-control" id="quantityInput" min="1" value="1">
                    </div>
                    <p><strong>Tổng tiền:</strong> <span id="totalPrice">0 VNĐ</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-success" id="confirmPurchase">Xác Nhận Thêm vào Giỏ</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Để cập nhật thông tin sản phẩm trong modal mua hàng
        const buyModal = document.getElementById('buyModal');
        buyModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const productName = button.getAttribute('data-name');
            const productPrice = button.getAttribute('data-price');

            const buyProductName = buyModal.querySelector('#buy-product-name');
            const buyProductPrice = buyModal.querySelector('#buy-product-price');
            const totalPrice = buyModal.querySelector('#totalPrice');
            const quantityInput = buyModal.querySelector('#quantityInput');

            buyProductName.textContent = productName;
            buyProductPrice.textContent = productPrice;

            // Cập nhật tổng tiền khi số lượng thay đổi
            quantityInput.addEventListener('input', () => {
                const quantity = quantityInput.value;
                const price = parseFloat(productPrice.replace(/\./g, '').replace(' VNĐ', ''));
                totalPrice.textContent = (quantity * price).toLocaleString('vi-VN') + ' VNĐ';
            });
        });
    </script>
    <?php include 'include/footer.php'; ?>
</body>
</html>
