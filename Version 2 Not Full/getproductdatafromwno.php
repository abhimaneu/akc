<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

$wno = $_POST["workorder_no"];
$sql = "SELECT * FROM work_order_products WHERE work_order_no = '$wno' AND user_id = '".(string)$loggedin_session."'";
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
            'code' => $row['code'],
            'name' => $row['name'],
            'design' => $row['design'],
            'size' => $row['size'],
            'qty' => $row['qty']
        );
    }
}
echo json_encode($product_data);
?>