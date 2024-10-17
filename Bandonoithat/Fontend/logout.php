<?php
session_start();
session_destroy(); // Xóa tất cả các biến session
header('Location: index.php'); // Chuyển hướng về trang index
exit();
?>
