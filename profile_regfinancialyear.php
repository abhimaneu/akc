<?php
include 'conn.php';
include 'nav.php';
?>

<?php
if (isset($_GET['f'])) {
    if ($_GET['f'] == 's') {
        echo "<h1 class='d-flex p-1 fs-4 text-success justify-content-center'>New Financial Year Registered<h1>";
    }
    if ($_GET['f'] == 'cs') {
        echo "<h1 class='d-flex p-1 fs-4 text-success justify-content-center'>Cleared Succesfully<h1>";
    }
}
?>

<html>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


<body>
    <br>
    <h1 class="mt-2 ms-4">Profile</h1>

    <div class="container-fluid">
        <div class=" mb-1 bg-white shadow-1-strong   mt-4">
            <nav class="navbar navbar-expand-lg navbar-light shadow-0 ">

                <div class="container-fluid">
                    <a class="navbar-brand" href="#"></a>

                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link " href="profile.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="profile_inpass.php">Inpass</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="profile_outpass.php">Outpass</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="profile_workorder.php">Work Order</a>
                            </li>
                        </ul>
                    </div>

                    <ul class="navbar-nav">
                        <div class="d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link text-black" href="profile_regfinancialyear.php">Settings</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">

        <div class="row">
            <div class="col">
                <p class='fs-4 fw-light'>Register as New Financial Year</p>
                <form id='regfinyear' method='POST'>
                    <h1 class="display-6">
                        <button type='submit' onclick="return confirm('Are you sure?');" class='btn btn-primary btn-lg' name='regfinyear'>Register</button>
                    </h1>
                </form>
            </div>
        </div>
        <div class="row p-4 ps-0 pb-0">
            <div class="col">
                <small class="lead fs-6">Registering Will Clear current Inpass, Outpass, Work Orders <br>
                    Go to Inpass/Outpass/Work Orders from Profile Section to access Old Data</small>
            </div>
        </div>
    </div>

    <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">

        <div class="row">
            <div class="col">
                <p class='fs-4 fw-light'>Clear Data</p>
                <form id='clear_data' method='POST'>
                    <div class="col">

                        <div class="row pb-4">
                            <div class="col">
                                <small class='fs-6 pe-4'>Clear All Company Products</small>
                                <button type='submit' onclick="return confirm('Are you sure?');" class='btn btn-danger shadow-3 btn-sm'
                                    name='clear_company_products'>Clear</button>
                            </div>
                        </div>

                        <div class="row pb-4">
                            <div class="col">
                                <small class='fs-6 pe-4'>Clear All Vehicle List
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                                <button type='submit' onclick="return confirm('Are you sure?');" class='btn btn-danger shadow-3 btn-sm'
                                    name='clear_vehicles'>Clear</button>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col">
                                <small class='fs-6 pe-4'>Clear All Saved Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                                <button type='submit' onclick="return confirm('Are you sure?');" class='btn btn-danger shadow-3 btn-sm'
                                    name='clear_saved_products'>Clear</button>
                            </div>
                        </div>
                        <div class="row pb-2">
                            <div class="col">
                                <small class='fs-6 pe-4'>Clear All Saved Companies &nbsp;</small>
                                <button type='submit' onclick="return confirm('Are you sure?');" class='btn btn-danger shadow-3 btn-sm'
                                    name='clear_saved_companies'>Clear</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row p-4 ps-0 pb-0">
            <div class="col">
                <small class="lead fs-6">Deletion Of any Data will Remove it Completely <br>
                    Go to Profile Home to Add New Data</small>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['regfinyear'])) {

    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }

    //INPASS
    $sql = "INSERT into inpass_old(no,no_year,date,source,woc,op,vehicleno,extras,type,timestamp,user_id) select no,CONCAT(no, '/', SUBSTRING(date,3,2),SUBSTRING(date,3,2)+1),date,source,woc,op,vehicleno,extras,type,timestamp,user_id from inpass where user_id = '" . $loggedin_session . "'";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "DELETE from inpass where user_id = '" . $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "INSERT into inpass_products_old(inpass_no,no_year,date_of_entry,product_name,product_code,product_design,product_size,product_qty,user_id) select inpass_no,CONCAT(inpass_no, '/', SUBSTRING(date_of_entry,3,2),SUBSTRING(date_of_entry,3,2)+1),date_of_entry,product_name,product_code,product_design,product_size,product_qty,user_id from inpass_products where user_id = '" . $loggedin_session . "'";
    $insert2 = mysqli_query($conn, $sql);
    if (!$insert2) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "DELETE from inpass_products where user_id = '" . $loggedin_session . "'";
    $delete2 = mysqli_query($conn, $sql);
    if (!$delete2) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "UPDATE profile SET inpass_count = 1 where user_id='" . (string) $loggedin_session . "'";
    $update = mysqli_query($conn, $sql);
    if (!$update) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }

    //OUTPASS
    $sql = "INSERT into outpass_old(no,no_year,date,work_order_no,dest,woc,vehicleno,extras,type,timestamp,user_id) select no,CONCAT(no, '/', SUBSTRING(date,3,2),SUBSTRING(date,3,2)+1),date,work_order_no,dest,woc,vehicleno,extras,type,timestamp,user_id from outpass where user_id = '" . $loggedin_session . "'";
    $insert3 = mysqli_query($conn, $sql);
    if (!$insert3) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "DELETE from outpass where user_id = '" . $loggedin_session . "'";
    $delete3 = mysqli_query($conn, $sql);
    if (!$delete3) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "INSERT into outpass_products_old(outpass_no,no_year,date_of_entry,product_type,product_name,work_order,product_code,product_design,product_size,product_qty,user_id) select outpass_no,CONCAT(outpass_no, '/', SUBSTRING(date_of_entry,3,2),SUBSTRING(date_of_entry,3,2)+1),date_of_entry,product_type,product_name,work_order,product_code,product_design,product_size,product_qty,user_id from outpass_products where user_id = '" . $loggedin_session . "'";
    $insert4 = mysqli_query($conn, $sql);
    if (!$insert4) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "DELETE from outpass_products where user_id = '" . $loggedin_session . "'";
    $delete4 = mysqli_query($conn, $sql);
    if (!$delete4) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "UPDATE profile SET outpass_count = 1 where user_id='" . (string) $loggedin_session . "'";
    $update2 = mysqli_query($conn, $sql);
    if (!$update2) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }

    //WORK ORDER
    $sql = "INSERT into work_orders_old(date,no_year,work_order_no,company,extras,status,timestamp,user_id) select date,CONCAT(work_order_no, '/', SUBSTRING(date,3,2),SUBSTRING(date,3,2)+1),work_order_no,company,extras,status,timestamp,user_id from work_orders where user_id = '" . $loggedin_session . "'";
    $insert5 = mysqli_query($conn, $sql);
    if (!$insert5) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "DELETE from work_orders where user_id = '" . $loggedin_session . "'";
    $delete5 = mysqli_query($conn, $sql);
    if (!$delete5) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "INSERT into work_order_products_old(work_order_no,no_year,date_of_entry,code,name,design,size,qty,user_id) select work_order_no,CONCAT(work_order_no, '/', SUBSTRING(date_of_entry,3,2),SUBSTRING(date_of_entry,3,2)+1),date_of_entry,code,name,design,size,qty,user_id from work_order_products where user_id = '" . $loggedin_session . "'";
    $insert6 = mysqli_query($conn, $sql);
    if (!$insert6) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    $sql = "DELETE from work_order_products where user_id = '" . $loggedin_session . "'";
    $delete6 = mysqli_query($conn, $sql);
    if (!$delete6) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }

    mysqli_commit($conn);
    echo "<script type='text/javascript'>
            window.location.href = 'profile_regfinancialyear.php?f=s';
            </script>";
}

//Delete Company Products
if (isset($_POST['clear_company_products'])) {
    $sql = "DELETE from company_products where user_id = '" . $loggedin_session . "'";
    $delete7 = mysqli_query($conn, $sql);
    if (!$delete7) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    echo "<script type='text/javascript'>
            window.location.href = 'profile_regfinancialyear.php?f=cs';
            </script>";
}

//Delete Vehicle List
if (isset($_POST['clear_vehicles'])) {
    $sql = "DELETE from vehicles where user_id = '" . $loggedin_session . "'";
    $delete8 = mysqli_query($conn, $sql);
    if (!$delete8) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    echo "<script type='text/javascript'>
            window.location.href = 'profile_regfinancialyear.php?f=cs';
            </script>";
}

//Delte Saved Products
if (isset($_POST['clear_saved_products'])) {
    $sql = "DELETE from products where user_id = '" . $loggedin_session . "'";
    $delete9 = mysqli_query($conn, $sql);
    if (!$delete9) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    echo "<script type='text/javascript'>
            window.location.href = 'profile_regfinancialyear.php?f=cs';
            </script>";
}

//Delete Saved Companies
if (isset($_POST['clear_saved_companies'])) {
    $sql = "DELETE from company where user_id = '" . $loggedin_session . "'";
    $delete10 = mysqli_query($conn, $sql);
    if (!$delete10) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<h1 class='d-flex p-1 fs-4 text-danger justify-content-center'>Error Occured<h1>";
        exit;
    }
    echo "<script type='text/javascript'>
            window.location.href = 'profile_regfinancialyear.php?f=cs';
            </script>";
}
?>