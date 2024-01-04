<?php
// Kết nối đến cơ sở dữ liệu
require 'connect/config.php';

// Lấy offset từ yêu cầu GET
$offset = $_GET['offset'];

// Truy vấn để lấy 4 sản phẩm kế tiếp dựa trên offset
$sql = "SELECT * FROM sanpham ORDER BY sp_id DESC LIMIT 4 OFFSET $offset";
$result = $conn->query($sql);

// Hiển thị sản phẩm
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
