<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Thay đổi nếu cần
$password = "123456"; // Thay đổi nếu cần
$dbname = "bandonoithat"; // Thay đổi thành tên cơ sở dữ liệu của bạn
$conn = new mysqli($servername, $username, $password, $dbname);
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Biến lưu thông báo lỗi
$error_message = "";

// Xử lý xóa sản phẩm
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql_delete = "DELETE FROM products WHERE id = $delete_id";
    $conn->query($sql_delete);
    header("Location: " . $_SERVER['PHP_SELF']); // Chuyển hướng sau khi xóa
    exit();
}

// Biến lưu thông tin sản phẩm để sửa
$product = null;

// Xử lý sửa sản phẩm
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $sql_edit = "SELECT * FROM products WHERE id = $edit_id";
    $result_edit = $conn->query($sql_edit);
    $product = $result_edit->fetch_assoc();
}

// Xử lý thêm hoặc sửa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST['product_code'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $percentage_discount = $_POST['percentage_discount'];
    $category_id = $_POST['category_id'];

    // Xử lý tải ảnh lên
    $target_dir = "uploads/";
    $image_urls = []; // Mảng để lưu các URL hình ảnh
    // Kiểm tra nếu có hình ảnh mới được tải lên
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $original_filename = basename($_FILES["images"]["name"][$key]);
            $target_file = $target_dir . $original_filename;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Kiểm tra loại tệp
            if (isset($_POST["submit"])) {
                $check = getimagesize($tmp_name);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "Tệp không phải là ảnh.";
                    $uploadOk = 0;
                }
            }
    
            // Tự động đổi tên tệp nếu tệp đã tồn tại
            $i = 1;
            while (file_exists($target_file)) {
                $new_filename = pathinfo($original_filename, PATHINFO_FILENAME) . "_$i." . $imageFileType;
                $target_file = $target_dir . $new_filename;
                $i++;
            }
    
            // Kiểm tra kích thước tệp
            if ($_FILES["images"]["size"][$key] > 500000) {
                echo "Xin lỗi, tệp của bạn quá lớn.";
                $uploadOk = 0;
            }
    
            // Cho phép các định dạng tệp cụ thể
            if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                echo "Xin lỗi, chỉ cho phép các tệp JPG, JPEG, PNG & GIF.";
                $uploadOk = 0;
            }
    
            // Tải tệp lên
            if ($uploadOk == 1) {
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $image_urls[] = $target_file; // Lưu URL hình ảnh vào mảng
                } else {
                    echo "Xin lỗi, đã có lỗi khi tải tệp của bạn.";
                }
            }
        }
    }

    // Nếu không có lỗi, tiếp tục xử lý thêm hoặc sửa sản phẩm
    if (empty($error_message)) {
        // Tạo chuỗi URL hình ảnh
        $image_url_string = implode(',', $image_urls);

        // Thêm hoặc sửa sản phẩm vào cơ sở dữ liệu
        if (isset($_POST['product_id']) && $_POST['product_id']) {
            $product_id = $_POST['product_id'];
            // Cập nhật sản phẩm, bao gồm cả hình ảnh mới nếu có
            $sql = "UPDATE products SET product_code='$product_code', name='$name', description='$description', quantity=$quantity, price=$price, percentage_discount=$percentage_discount, category_id=$category_id" . 
                   (!empty($image_url_string) ? ", image='$image_url_string'" : "") . 
                   " WHERE id=$product_id";
        } else {
            $sql = "INSERT INTO products (product_code, name, description, quantity, price, percentage_discount, category_id, image) VALUES ('$product_code', '$name', '$description', $quantity, $price, $percentage_discount, $category_id, '$image_url_string')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Sản phẩm đã được thêm/sửa thành công!";
            header("Location: " . $_SERVER['PHP_SELF']); // Chuyển hướng sau khi thêm/sửa
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Hiển thị thông báo lỗi nếu có
        echo "<div style='color: red;'>" . $error_message . "</div>";
    }
}

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2, h3 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="number"], input[type="file"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px; /* Điều chỉnh kích thước hình ảnh */
            max-height: 100px;
        }
        .action-links a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Quản Lý Sản Phẩm</h2>
    <h3><?php echo $product ? 'Sửa Sản Phẩm' : 'Thêm Sản Phẩm'; ?></h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $product ? $product['id'] : ''; ?>">
        
        <label for="product_code">Mã sản phẩm:</label>
        <input type="text" id="product_code" name="product_code" value="<?php echo $product ? $product['product_code'] : ''; ?>" required>
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" value="<?php echo $product ? $product['name'] : ''; ?>" required>
        <label for="images">Ảnh sản phẩm:</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple required>
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description"><?php echo $product ? $product['description'] : ''; ?></textarea>
        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $product ? $product['quantity'] : '0'; ?>" required>
        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $product ? $product['price'] : ''; ?>" required>
        <label for="percentage_discount">Giảm giá (%):</label>
        <input type="number" id="percentage_discount" name="percentage_discount" step="0.01" value="<?php echo $product ? $product['percentage_discount'] : '0'; ?>">
        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" required>
            <option value="">Chọn danh mục</option>
            <?php
            // Lấy danh sách danh mục từ cơ sở dữ liệu nếu có
            $sql_categories = "SELECT * FROM product_catalog";
            $result_categories = $conn->query($sql_categories);
            while ($category = $result_categories->fetch_assoc()) {
                $selected = $product && $product['category_id'] == $category['id'] ? 'selected' : '';
                echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="<?php echo $product ? 'Cập Nhật' : 'Thêm'; ?>">
    </form>
    <h3>Danh Sách Sản Phẩm</h3>
    <table>
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Giảm giá (%)</th>
            <th>Danh mục</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['product_code']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
                <?php
                // Hiển thị hình ảnh
                $images = explode(',', $row['image']);
                foreach ($images as $image) {
                    echo "<img src='$image' alt='Hình ảnh sản phẩm'>";
                }
                ?>
            </td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo number_format($row['price'], 2); ?> VNĐ</td>
            <td><?php echo $row['percentage_discount']; ?>%</td>
            <td><?php echo $row['category_id']; ?></td>
            <td class="action-links">
                <a href="?edit=<?php echo $row['id']; ?>">Sửa</a>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php $conn->close(); ?>
</body>
</html>