<?php
include 'checkuserlogin.php';

$ono = $_POST["outpass_no"];
$sql = "SELECT * FROM outpass_products WHERE outpass_no = '$ono' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn, $sql);
// if(!$retval){
//     echo mysqli_error($conn);
// }
$product_data = array(); 
if (!$retval) {
    echo "Error Occured";
} else {
    while ($row = $retval->fetch_assoc()) {
        $product_data[] = array(
            'product_type' => $row['product_type'],
            'code' => $row['product_code'],
            'name' => $row['product_name'],
            'design' => $row['product_design'],
            'size' => $row['product_size'],
            'bundle' => $row['product_bundle'],
            'qty' => $row['product_qty'],
            'stock_acof' => $row['stock_acof'],
            'stock_name' => $row['stock_name'],
            'stock_size' => $row['stock_size'],
        );
    }
}
echo json_encode($product_data);
?>