<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh Sách Sản Phẩm</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Căn chỉnh tổng thể */
    body {
      display: flex;
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa; /* Màu nền tổng thể */
      
    }

    /* Menu trái */
    .menu-left {
      width: 300px; /* Chiều rộng của menu */
      background-color: #ffffff; /* Màu nền menu */
      padding: 20px; /* Padding cho menu */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Đổ bóng cho menu */
      border-radius: 8px; /* Bo góc cho menu */
      transition: box-shadow 0.3s ease; /* Hiệu ứng chuyển đổi cho đổ bóng */
      border: 1px solid #e0e0e0; /* Đường viền nhẹ cho menu */
      margin-right : 15px;
    }

    .menu-left:hover {
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2); /* Tăng đổ bóng khi hover */
      border: 1px solid #ff6600; /* Đường viền nổi bật khi hover */
    }

    .menu-left h5 {
      margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
      font-size: 23px; /* Kích thước font tiêu đề */
      color: #ff6600; /* Màu tiêu đề */
      position: relative; /* Để căn chỉnh icon */
      padding: 10px; /* Thêm padding cho tiêu đề */
    }

    /* .menu-left h4:before,
    .menu-left h4:after {
      content: '\f0e7'; /* Icon pháo hoa từ Font Awesome */
      /* font-family: 'Font Awesome 5 Free'; Font Awesome */
      /* font-weight: 900; Định dạng chữ đậm */
      /* fon/t-size: 28px; Kích thước icon */
      /* color: #ff6600; Màu icon */
      /* position: absolute; Định vị icon */
    /* }  */

    /* .menu-left h4:before {
      left: -40px; /* Đưa icon bên trái */
      /* animation: firework-left 1.5s infinite; Hiệu ứng animation cho icon bên trái */
    /* } */

    /* .menu-left h4:after {
      right: -40px; /* Đưa icon bên phải */
      /* animation: firework-right 1.5s infinite; Hiệu ứng animation cho icon bên phải */
    /* }  */ 

    @keyframes firework-left {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    @keyframes firework-right {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .menu-left ul {
      list-style-type: none; /* Bỏ dấu gạch đầu dòng */
      padding: 0; /* Bỏ padding cho ul */
    }

    .menu-left ul li {
      margin-bottom: 10px; /* Khoảng cách giữa các mục */
      border-radius: 5px; /* Bo góc cho mỗi mục */
    }

    .menu-left ul li a {
      text-decoration: none; /* Bỏ gạch chân */
      color: #343a40; /* Màu chữ */
      font-size: 18px; /* Kích thước chữ */
      display: flex; /* Sử dụng flexbox để căn chỉnh icon và text */
      align-items: center; /* Căn giữa icon và chữ theo chiều dọc */
      padding: 10px 15px; /* Padding cho các mục */
      transition: background-color 0.3s, color 0.3s; /* Hiệu ứng chuyển đổi cho màu nền và màu chữ */
      border-radius: 5px; /* Bo góc cho các mục */
    }

    .menu-left ul li a:hover {
      background-color: #ff6600; /* Màu nền khi hover */
      color: #ffffff; /* Màu chữ trắng khi hover */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ khi hover */
    }

    .menu-left ul li a i {
      margin-right: 10px !important; /* Khoảng cách giữa icon và chữ */
      font-size: 22px; /* Kích thước icon */
      transition: transform 0.2s; /* Hiệu ứng chuyển đổi cho icon */
    }

    .fas{
      margin-right : 10px !important;
    }

    .menu-left ul li a:hover i {
      transform: scale(1.2); /* Phóng to icon khi hover */
    }

    /* Phần danh sách sản phẩm */
    .product-list {
      flex: 1; /* Cho phép phần sản phẩm chiếm không gian còn lại */
      background-color: #fff; /* Màu nền trắng cho danh sách sản phẩm */
      padding: 20px; /* Thêm padding cho phần danh sách sản phẩm */
      border-radius: 8px; /* Bo góc cho phần sản phẩm */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho phần sản phẩm */
      margin-left: 20px; /* Khoảng cách giữa menu trái và phần sản phẩm */
    }
  </style>
</head>
<body>

  <!-- Menu bên trái -->
  <div class="menu-left">
    <h5>Danh Mục Sản Phẩm</h5>
    <ul>
      <li><a href="products.php?category_id=1"><i class="fas fa-tags"></i>&nbsp;&nbsp;Khuyến Mãi</a></li>
      <li><a href="products.php?category_id=1"><i class="fas fa-couch"></i>&nbsp;&nbsp;Nội thất phòng khách</a></li>
      <li><a href="products.php?category_id=2"><i class="fas fa-bed"></i>&nbsp;&nbsp;Nội thất phòng ngủ</a></li>
      <li><a href="products.php?category_id=3"><i class="fas fa-utensils"></i>&nbsp;&nbsp;Nội thất phòng bếp</a></li>
      <li><a href="products.php?category_id=4"><i class="fas fa-sun"></i>&nbsp;&nbsp;Hàng trang trí</a></li>
      <li><a href="products.php?category_id=5"><i class="fas fa-plug"></i>&nbsp;&nbsp;Thiết bị điện</a></li>
      <li><a href="products.php?category_id=6"><i class="fas fa-chair"></i>&nbsp;&nbsp;Đồ gỗ</a></li>
    </ul>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
