<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

$product_name = $_POST["product_name"];
$sql = "SELECT * FROM stock WHERE item = '$product_name' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn, $sql);
$product_data = array();
if (!$retval) {
    echo "Error Occured";
} else {
    while ($row = $retval->fetch_assoc()) {
        $product_data[] = array(
            
            'name' => $row['item'],
            
            'size' => $row['size'],
            'qty' => $row['qty']
        );
    }
}
echo json_encode($product_data);
?>