<?php
include 'head.php';
include 'header.php';
include 'menu.php';
include 'slider.php';
?>
<div class="heading">
	<h2>Sách đang tìm</h2>
</div>
<?php

include 'connect/config.php'; // Kết nối tới cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_term'])) {
    $search_term = $_GET['search_term'];

    // Sử dụng Prepared Statement để ngăn chặn SQL Injection
    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE sp_ten LIKE ?");
    $search_query = "%{$search_term}%";
    $stmt->bind_param("s", $search_query);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Hiển thị kết quả nếu có
        while ($row = $result->fetch_assoc()) {
            // Hiển thị thông tin sản phẩm, ví dụ:
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
    } else {
        echo "Không tìm thấy kết quả phù hợp.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Yêu cầu tìm kiếm không hợp lệ.";
}

?>
</body>

</html>
<?php
include 'footer.php';
?>


