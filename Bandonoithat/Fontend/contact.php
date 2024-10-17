<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Liên Hệ - Trang Bán Đồ Nội Thất</title>
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
        #contact {
            background-color: #f9f9f9;
            padding: 50px 0;
        }
        #contact h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }
        #contact .form-control {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ddd;
        }
        #contact .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #contact .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Phần đầu trang -->
    <?php include 'include/header.php'; ?>

    <div class="content">
        <!-- Menu bên trái -->
        <?php include 'include/menu_left.php'; ?>
        
        <!-- Nội dung Liên Hệ -->
        <div class="main-content">
            <section id="contact" class="py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-center mb-4">Liên Hệ</h2>
                            <form action="xuly_lienhe.php" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Tin nhắn</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Gửi Tin Nhắn</button>
                                </div>
                            </form>
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
