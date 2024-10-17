<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header Web Bán Hàng</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
    /* Tùy chỉnh cho Header */
    body {
      background-color: #f8f9fa;
    }
    
    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      height: 60px;
      width: auto;
    }

    .navbar-brand-text h1 {
      font-size: 24px;
      color: #343a40;
      margin: 0;
    }

    .navbar-brand-text span {
      font-size: 14px;
      color: #ff6600;
    }

    .search-bar {
      width: 400px;
      display: flex;
    }

    .search-bar input {
      border-radius: 20px;
      padding: 10px;
      border: 1px solid #ced4da;
    }

    .search-bar button {
      border-radius: 20px;
      background-color: #ff6600;
      color: white;
      border: none;
      margin-left: 10px;
    }

    .icon-link {
      color: #343a40;
      font-size: 16px;
      margin-left: 15px;
    }

    .icon-link:hover {
      color: #ff6600;
    }

    .cart-badge {
    background-color: #ff6600;
    color: white;
    border-radius: 50%;
    padding: 3px 6px;
    font-size: 12px;
    position: absolute;
    top: -5px; /* Điều chỉnh vị trí theo chiều dọc */
    right: -10px; /* Điều chỉnh vị trí theo chiều ngang */
    transform: translate(50%, -50%); /* Căn giữa */
    display: flex; /* Căn giữa nội dung bên trong */
    justify-content: center; /* Căn giữa theo chiều ngang */
    align-items: center; /* Căn giữa theo chiều dọc */
    min-width: 20px; /* Đảm bảo kích thước tối thiểu để tránh hiển thị bị lệch */
}


    /* Menu chính */
    .main-menu .nav-link {
      color: #343a40;
      padding: 10px 15px;
      font-size: 18px;
    }

    .main-menu .nav-link:hover {
      color: #ff6600;
    }
  </style>
</head>
<body>

  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container d-flex justify-content-between align-items-center">
        
        <div class="d-flex align-items-center">
          <a class="navbar-brand" href="#">
            <img src="img/logo.jpg" alt="Logo">
          </a>
          <div class="navbar-brand-text">
            <h1>NOITHAT.COM</h1>
            <span>bạn cần gì - tôi có đó</span>
          </div>
        </div>

        <form class="search-bar">
          <input class="form-control" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
          <button class="btn" type="submit">Tìm kiếm</button>
        </form>

        <div class="d-flex align-items-center">
          <?php
            if (isset($_SESSION['username'])) {
              echo '<a class="nav-link icon-link" href="user_infor.php">' . htmlspecialchars($_SESSION['username']) . '</a>';
              echo '<a class="nav-link icon-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>';
            } else {
              echo '<a class="nav-link icon-link" href="./login.php"><i class="fas fa-user"></i> Tài khoản</a>';
            }
          ?>
          <a class="nav-link icon-link" href="views/review_form.php">
            <i class="fas fa-heart"></i> Yêu thích
          </a>
          
          <a class="nav-link icon-link position-relative" href="#">
    <i class="fas fa-shopping-cart"></i> Giỏ hàng
    <span class="cart-badge position-absolute">3</span>
</a>



        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light main-menu">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" href="./index.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./intro.php">Giới thiệu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sản phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tin tức</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./contact.php">Liên hệ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
