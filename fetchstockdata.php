<?php
include 'checkuserlogin.php';

$sql = "SELECT * FROM stock where user_id = '".(string)$loggedin_session."'";
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
            'wgs' => $row['wgs'],
            'name' => $row['item'],
            
            'size' => $row['size'],
            'qty' => $row['qty']
        );
    }
}
echo json_encode($product_data);
?>