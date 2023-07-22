<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");

include 'conn.php';

session_start();
$user_check = $_SESSION['username'];
$ses_sql = mysqli_query($conn, "select user_id from profile where user_id='$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$loggedin_session = $row['user_id'];

if ($loggedin_session == NULL) {

    
    header("Location: index.php");
    exit();
}
?>