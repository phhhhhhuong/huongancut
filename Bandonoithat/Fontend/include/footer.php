<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="footer.css">

    <style>
        /* Phong cách cho footer */
        .footer {
            background-color: #343a40; /* Màu nền cho footer */
            color: #f8f9fa; /* Màu chữ */
            padding: 40px 0; /* Padding cho footer */
            margin-top : 20px;
        }
        .footer-section h3 {
            color: #ff69b4; /* Màu tiêu đề */
            margin-bottom: 15px; /* Khoảng cách dưới tiêu đề */
        }
        .footer a {
            text-decoration: none; /* Bỏ gạch chân */
            color: #f8f9fa; /* Màu chữ */
        }
        .footer a:hover {
            color: #ff69b4; /* Màu khi hover */
            text-decoration: underline; /* Gạch chân khi hover */
        }
        .social-links img {
            transition: transform 0.3s;
            margin: 0 5px; /* Khoảng cách giữa các biểu tượng xã hội */
        }
        .social-links img:hover {
            transform: scale(1.2); /* Phóng to biểu tượng khi hover */
        }
        .footer-bottom {
            border-top: 1px solid #6c757d; /* Đường viền trên phần chân footer */
            padding-top: 20px; /* Padding cho phần chân footer */
            color: #cfd3d6; /* Màu chữ cho phần chân footer */
            font-size: 14px; /* Kích thước chữ */
        }
    </style>
</head>
<body>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4 footer-section mb-4">
                    <h5>Thông Tin Liên Hệ</h5>
                    <p>Email: <a href="mailto:nhom2@gmail.com">nhom2@gmail.com</a></p>
                    <p>Điện thoại: <a href="tel:+84335754117">+84 33 575 4117</a></p>
                    <p>Địa chỉ: Lĩnh Nam, Hoàng Mai, Việt Nam</p>
                </div>
                
                <div class="col-md-4 footer-section mb-4">
                    <h5>Liên Kết Hữu Ích</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                        <li><a href="#">Hỗ trợ khách hàng</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 footer-section mb-4">
                    <h5>Theo Dõi Chúng Tôi</h5>
                    <div class="social-links">
                        <a href="https://www.facebook.com/cvan.062"><img src="images/fbicon.jpg" alt="Facebook" style="width: 30px; height: 30px;"></a>
                        <a href="#"><img src="images/twicon.jpg" alt="Twitter" style="width: 30px; height: 30px;"></a>
                        <a href="#"><img src="images/inta.jpg" alt="Instagram" style="width: 30px; height: 30px;"></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom text-center mt-4">
                <p>&copy; 2024 Công Ty Cổ Phần Nhóm 2. Đã đăng ký bản quyền.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
