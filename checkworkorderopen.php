<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost','root','','akcdb');

$workorderNo = $_POST["workorder_no"];
$sql = "SELECT status FROM work_orders WHERE work_order_no = '$workorderNo' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn,$sql);
$status = "";
if(!$retval) {
    echo "Error Occured";
}
else {
    while ($row = $retval->fetch_assoc()) {
        $status = $row['status'];
    }
}
echo $status;
?>