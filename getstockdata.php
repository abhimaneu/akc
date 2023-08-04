<?php
include 'checkuserlogin.php';

$product_name = $_POST["product_name"];
$product_size = $_POST["product_size"];
$sql = "SELECT * FROM stock WHERE item = '$product_name' AND size = '$product_size' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn, $sql);
$product_data = array();
if (!$retval) {
    echo "Error Occured";
} else {
    while ($row = $retval->fetch_assoc()) {
        $product_data[] = array(
            'wgs' => $row['wgs'],
            'name' => $row['item'],
            
            'size' => $row['size'],
            'qty' => $row['qty']
        );
    }
}
echo json_encode($product_data);
?>