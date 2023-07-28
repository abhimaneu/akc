<?php
include 'checkuserlogin.php';

$conn = mysqli_connect('localhost','root','','akcdb');

$company_name = $_POST["source_name"];
$sql = "SELECT code FROM company WHERE name = '$company_name' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn,$sql);
$company_code = "";
if(!$retval) {
    echo "Error Occured";
}
else {
    while ($row = $retval->fetch_assoc()) {
        $company_code = $row['code'];
    }
}
echo $company_code;
?>