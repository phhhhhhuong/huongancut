<?php
include 'ketnoi.php'; // Kết nối cơ sở dữ liệu

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
   
    $sql = "SELECT products.*, product_catalog.name AS category_name 
            FROM products 
            LEFT JOIN product_catalog ON products.category_id = product_catalog.id 
            WHERE products.id = $product_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Sản phẩm không tồn tại.";
        exit;
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Chi Tiết Sản Phẩm - <?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        body {
    background-color: #f8f9fa;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Đảm bảo footer luôn ở dưới cùng */
}

.content-wrapper {
    flex: 1;
    display: flex;
    flex-wrap: wrap; /* Thêm thuộc tính này để tránh bị chồng chéo khi kích thước nhỏ */
    margin-top: 20px;
}

.menu-left {
    width: 100%;
    max-width: 250px; /* Cố định chiều rộng của menu */
    padding-right: 20px;
}

.main-content {
    flex: 1; /* Để phần nội dung chính chiếm không gian còn lại */
    min-width: 0; /* Tránh việc tràn ngang màn hình */
    padding-left: 20px;
}

.product-image {
    height: 400px;
    object-fit: contain;
    border-radius: 10px;
}

.product-details {
    border-radius: 10px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

footer {
    background-color: #343a40;
    color: white;
    padding: 20px;
    text-align: center;
    width: 100%;
}

    </style>
</head>
<body>

    <!-- Header luôn nằm trên cùng -->
    <?php include 'include/header.php'; ?>

    <!-- Phần nội dung và menu -->
    <div class="container content-wrapper">
    <?php include 'include/menu_left.php'; ?>
        
        <main class="main-content">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid product-image">
                </div>
                <div class="col-md-6 product-details">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>
                    <p><strong>Giá:</strong> <?php echo number_format($product['price'] * (1 - ($product['percentage_discount'] / 100)), 2); ?> VNĐ</p>
                    <p class="text-danger"><strong>Giá gốc:</strong> <del><?php echo number_format($product['price'], 2); ?> VNĐ</del></p>
                    <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Mô tả chi tiết sản phẩm:</strong> <?php echo htmlspecialchars($product['description1']); ?></p>
                    <p><strong>Số lượng:</strong> <?php echo $product['quantity']; ?></p>
                    <a href="buy.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Mua Hàng</a>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buyModal" data-name="<?php echo htmlspecialchars($product['name']); ?>" data-price="<?php echo number_format($product['price'], 2); ?> VNĐ">Thêm vào Giỏ Hàng</button>
                </div>
            </div>
            <div class="mt-3">
                <a href="index.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </main>
    </div>

    <!-- Footer luôn nằm dưới cùng -->
    <?php include 'include/footer.php'; ?>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const buyModal = document.getElementById('buyModal');
        buyModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price').replace(/ VNĐ/g, '').replace(/,/g, ''));

            const buyProductName = buyModal.querySelector('#buy-product-name');
            const buyProductPrice = buyModal.querySelector('#buy-product-price');
            const quantityInput = buyModal.querySelector('#quantityInput');
            const totalPriceElement = buyModal.querySelector('#totalPrice');

            buyProductName.textContent = name;
            buyProductPrice.textContent = button.getAttribute('data-price');
            quantityInput.value = 1;
            totalPriceElement.textContent = price + ' VNĐ';

            quantityInput.addEventListener('input', () => {
                const quantity = quantityInput.value;
                const totalPrice = price * quantity;
                totalPriceElement.textContent = totalPrice.toFixed(2) + ' VNĐ';
            });
        });

        document.getElementById('confirmPurchase').addEventListener('click', () => {
            alert('Sản phẩm đã được thêm vào giỏ hàng!');
            $('#buyModal').modal('hide');
        });
    </script>
</body>
</html>
