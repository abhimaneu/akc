<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost','root','','akcdb');

$workorder_no = $_POST["workorder_no"];
$sql = "SELECT company FROM work_orders WHERE work_order_no = '$workorder_no' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn,$sql);
$c_name = "";
if(!$retval) {
    echo "Error Occured";
    exit;
}
else {
    while ($row = $retval->fetch_assoc()) {
        $c_name = $row['company'];
    }
}
echo $c_name;
?>