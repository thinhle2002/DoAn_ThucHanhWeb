<?php
    require '../connect/config.php';
    $id = $_GET['nxb_id'];
   
    $sql1 = "SELECT * from sanpham WHERE nxb_id=".$id;
    $e=$conn->query($sql1);
    if($e->num_rows > 0 ){
        header('Location: dsnxb.php');
    }
  
    else {
        $sql = "DELETE FROM nhaxuatban WHERE nxb_id=".$id;
            if ($conn->query($sql) === TRUE) {
                header('Location: dsnxb.php');
            } else {    
                echo "Error deleting record: " . $conn->error;
            }
}
$conn->close();
    
?>
