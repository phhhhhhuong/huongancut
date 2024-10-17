<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Giới Thiệu - Trang Bán Đồ Nội Thất</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .content {
            display: flex;
            flex: 1;
        }
        .menu-left {
            width: 250px;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        #about-us {
            background-color: #ffffff;
            padding: 50px 0;
        }
        #about-us h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1.5px;
        }
        #about-us .lead {
            font-size: 1.2rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        #about-us .mission-vision {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        #about-us .mission-vision h4 {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 15px;
        }
        #about-us .mission-vision p {
            font-size: 1rem;
            color: #555;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .about-image {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Phần đầu trang -->
    <?php include 'include/header.php'; ?>

    <div class="content">
        <!-- Menu bên trái -->
        <?php include 'include/menu_left.php'; ?>
        
        <!-- Nội dung Giới Thiệu -->
        <div class="main-content">
            <section id="about-us" class="py-5">
                <div class="container">
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8 text-center">
                            <h2>Về Chúng Tôi</h2>
                            <p class="lead">Chào mừng bạn đến với cửa hàng nội thất trực tuyến của chúng tôi. Chúng tôi cung cấp những sản phẩm nội thất cao cấp và hiện đại nhất để mang đến cho không gian sống của bạn sự sang trọng và tiện nghi.</p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                        <img src="img/intro.png" alt="Về Chúng Tôi" class="about-image">
                        </div>
                        <div class="col-md-6">
                            <div class="mission-vision">
                                <h4>Sứ Mệnh</h4>
                                <p>Chúng tôi mong muốn mang đến cho khách hàng những trải nghiệm mua sắm nội thất trực tuyến dễ dàng, tiện lợi, với những sản phẩm chất lượng và phong cách đẳng cấp nhất.</p>
                            </div>
                            <div class="mission-vision">
                                <h4>Tầm Nhìn</h4>
                                <p>Trở thành thương hiệu nội thất hàng đầu, luôn tiên phong trong việc cập nhật những xu hướng thiết kế mới nhất và đảm bảo sự hài lòng tuyệt đối cho khách hàng.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8 text-center">
                            <h2>Tại Sao Chọn Chúng Tôi?</h2>
                            <p class="lead">Chúng tôi luôn cố gắng mang đến sự khác biệt cho mỗi sản phẩm. Với đội ngũ chuyên nghiệp và tận tâm, chúng tôi cam kết mang đến những sản phẩm <span class="highlight">chất lượng nhất</span> với giá cả <span class="highlight">cạnh tranh nhất</span>.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Phần cuối trang -->
    <?php include 'include/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
