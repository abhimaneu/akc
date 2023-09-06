<?php
include 'checkuserlogin.php';

$ino = $_POST["inpass_no"];
$sql = "SELECT * FROM inpass_products WHERE inpass_no = '$ino' AND user_id = '".(string)$loggedin_session."'";
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
            'product_wono' => $row['product_wono'],
            'code' => $row['product_code'],
            'name' => $row['product_name'],
            'design' => $row['product_design'],
            'size' => $row['product_size'],
            'qty' => $row['product_qty'],
        );
    }
}
echo json_encode($product_data);
?>