<?php
$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

$product_code = $_POST["product_code"];
$sql = "SELECT * FROM products WHERE code = '$product_code'";
$retval = mysqli_query($conn, $sql);
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
            'size' => $row['size']
        );
    }
}
echo json_encode($product_data);
?>