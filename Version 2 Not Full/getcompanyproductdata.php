<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

$product_code = $_POST["product_code"];
$sql = "SELECT * FROM company_products WHERE code = '$product_code' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn, $sql);
// if(!$retval){
//     echo mysqli_error($conn);
// }
$product_name = "";
$product_design = "";
$product_size = "";
$product_data = array(); 
if (!$retval) {
    echo "Error Occured";
} else {
    while ($row = $retval->fetch_assoc()) {
        $product_data[] = array(
            'name' => $row['name'],
            'design' => $row['design'],
            'size' => $row['size'],
        );
    }
}
echo json_encode($product_data);
?>