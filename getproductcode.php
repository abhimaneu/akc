<?php
$conn = mysqli_connect('localhost','root','','akcdb');

$product_name = $_POST["product_name"];
$sql = "SELECT code FROM products WHERE name = '$product_name'";
$retval = mysqli_query($conn,$sql);
$product_code = "";
if(!$retval) {
    echo "Error Occured";
}
else {
    while ($row = $retval->fetch_assoc()) {
        $product_code = $row['code'];
    }
}
echo $product_code;
?>