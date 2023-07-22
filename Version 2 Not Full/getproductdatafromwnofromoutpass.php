<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

$wno = $_POST["workorder_no"];
$sql = "SELECT * FROM outpass_products WHERE work_order = '$wno' AND user_id = '".(string)$loggedin_session."'";
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
            'code' => $row['product_code'],
            'name' => $row['product_name'],
            'design' => $row['product_design'],
            'size' => $row['product_size'],
            'qty' => $row['product_qty']
        );
    }
}
echo json_encode($product_data);
?>