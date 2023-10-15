<?php
include 'checkuserlogin.php';

$company_name = $_POST["company_name"];
$sql = "SELECT * FROM company WHERE name = '$company_name' AND user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn,$sql);
$company_data = array();
if(!$retval) {
    echo "Error Occured";
}
else {
    while ($row = $retval->fetch_assoc()) {
        $company_data[] = array(
            'gstin' => $row['gstin'],
            'address' => $row['address'],
            'contact' => $row['contact'],
        );
    }
}
echo json_encode($company_data);
?>