<?php
include 'head.php';
include 'header.php';
include 'menu.php';
include 'slider.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Sách Khuyến Mãi</title>
    <!-- Thêm các tệp CSS của bạn nếu cần -->
    <link rel="stylesheet" href="styles.css">
    <style>
        .product {
            display: flex;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .product .caption {
            margin-top: 10px;
        }
    </style>
</head>
<body>
	
<div class="row">
	<div class="col-lg-12">
		<div class="heading" style="text-align: center;">
			<h2>Sách đang khuyến mãi</h2>
		</div>

		<div class="products">
			<?php
			require 'connect/config.php';
			//lay danh sach san pham khuyen mai
			$sql = "SELECT * FROM sanpham  WHERE sp_khuyenmai=1 ORDER BY sp_id desc  limit 4 ";
			$result = $conn->query($sql);
			?>
			<?php
			if (!empty($result) && $result->num_rows > 0) {
				// output data of each row
				while ($row = $result->fetch_assoc()) {
			?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="product">
							<div class="image"><a href="product.php?sp_id=<?php echo $row["sp_id"] ?>"><img src="img/<?php echo $row["sp_img"] ?>" style="width:300px;height:300px" /></a></div>
							<div class="caption">
								<div class="name">
									<h3><a href="product.php?sp_id=<?php echo $row["sp_id"] ?>"><?php echo $row["sp_ten"] ?></a></h3>
								</div>
								<?php
								if ($row["sp_khuyenmai"] == true) {
								?>
									<div class="price" style="color: red;"><?php echo $row["sp_giakhuyenmai"] ?>₫<span style="font-size: 14px;"><?php echo $row["sp_gia"] ?>₫</span></div>
								<?php
								} else {
								?>
									<div class="price" style="color: red;"><?php echo $row["sp_gia"] ?>₫</div>
								<?php
								}
								?>
								<div class="g-plusone" data-size="medium" data-annotation="none" data-href="/product.php?sp_id=<?php echo $row["sp_id"] ?>"></div>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>


	</div>

</div>	
		
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading" style="text-align: center;">
                    <h2>Tất cả Sách </h2>
                </div>

                <div class="row" id="productDisplay">
                    <?php
                    require 'connect/config.php';

                    $sql = "SELECT * FROM sanpham ORDER BY sp_id DESC LIMIT 4"; // Hiển thị 4 sản phẩm đầu tiên mặc định
                    $result = $conn->query($sql);

                    if (!empty($result) && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="product">
                                    <div class="image"><a href="product.php?sp_id=<?php echo $row["sp_id"] ?>"><img src="img/<?php echo $row["sp_img"] ?>" style="width:300px;height:300px" /></a></div>
                                    <div class="caption">
                                        <div class="name">
                                            <h3><a href="product.php?sp_id=<?php echo $row["sp_id"] ?>"><?php echo $row["sp_ten"] ?></a></h3>
                                        </div>
                                        <?php
                                        if ($row["sp_khuyenmai"] == true) {
                                        ?>
                                            <div class="price" style="color: red;"><?php echo $row["sp_giakhuyenmai"] ?>₫<span style="font-size: 14px;"><?php echo $row["sp_gia"] ?>VNĐ</span></div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="price" style="color: red;"><?php echo $row["sp_gia"] ?>₫</div>
                                        <?php
                                        }
                                        ?>
                                        <div class="g-plusone" data-size="medium" data-annotation="none" data-href="/product.php?sp_id=<?php echo $row["sp_id"] ?>"></div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                
                <div class="text-center">
                    <button onclick="showProducts(0)" class="btn btn-primary">1</button>
                    <button onclick="showProducts(4)" class="btn btn-primary">2</button>
                    <button onclick="showProducts(8)" class="btn btn-primary">3</button>
                    <!-- Thêm các nút khác nếu cần -->
                </div>
                
            </div>
        </div>
    </div>

    <script>
        function showProducts(offset) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("productDisplay").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getproducts.php?offset=" + offset, true);
            xmlhttp.send();
        }
    </script>

</body>
</html>

<?php
include 'footer.php';
?>
