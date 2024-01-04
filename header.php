<?php
session_start();
include 'connect/config.php'; // Kết nối tới cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tên Trang Của Bạn</title>
    <!-- Các thẻ meta, stylesheet, và scripts khác có thể được thêm vào đây -->
</head>
<body>
    <nav id="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-6"> </div>
                <div class="col-xs-6">
                    <ul class="top-link">
                        <?php
                        if (!isset($_SESSION['txtusername'])) {
                            printf('<li><a href="acccount.php"><span class="fa fa-sign-in"></span> Đăng nhập / Đăng kí</a></li>');
                        } else {
                            echo '<li><span class="fa fa-user-o"></span> Xin chào ';
                            echo '<span style="color:Tomato;"><b>' . $_SESSION['hotenuser'] . '</b></span></li>';
                            echo '<li><span class="fa fa-sign-out"></span><a href="logout.php"> Đăng xuất!</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <header class="container">
        <div class="row">
            <div class="col-md-4">
				<div id="logo"><a href="index.php"><img src="img/logo.jpg" width="200px" /></a></div>

            </div>
            <div class="col-md-4">
                <form class="form-search" method="GET" action="search.php">
                    <input type="text" class="input-medium search-query" name="search_term">
                    <button type="submit" class="btn"><span class="fa fa-search"></span></button>
                </form>
            </div>
            <div class="col-md-4">
                <div id="cart">
                    <a class="btn btn-1"
                        <?php if (isset($_SESSION['hotenuser'])) { ?>
                            href="cart.php">
                        <?php } else { ?>
                            href="acccount.php">
                        <?php } ?>
                        <span class="glyphicon glyphicon-shopping-cart"></span>CART
                        (<?php
                        $ok = 1;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                if (isset($key)) {
                                    $ok = 2;
                                }
                            }
                        }

                        if ($ok == 2) {
                            echo count($_SESSION['cart']);
                        } else {
                            echo   "0";
                        }
                        ?>)
                    </a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>
