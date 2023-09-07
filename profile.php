<?php
include 'conn.php';
include 'nav.php';
?>

<?php

if (!$conn) {
    echo "Error Occured";
    die($conn);
}

$sql = "SELECT * FROM profile WHERE user_id = '" . (string) $loggedin_session . "'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}
$name = "";
$wo = "";
$gstin = '';
$phoneno = '';
$address = '';
while ($row = $retval->fetch_assoc()) {
    $name = $row['name'];
    $wo = $row['wo'];
    $gstin = $row['gstin'];
    $phoneno = $row['phoneno'];
    $address = $row['address'];
}

$sql = "SELECT * from vehicles WHERE user_id = '" . (string) $loggedin_session . "'";
$retval2 = mysqli_query($conn, $sql);
if (!$retval2) {
    echo mysqli_error($conn);
}

$sql2 = "SELECT * from company WHERE user_id = '" . (string) $loggedin_session . "' Order by name LIMIT 10";
$retval3 = mysqli_query($conn, $sql2);
if (!$retval3) {
    echo mysqli_error($conn);
}

$sql4 = "SELECT * from company_products WHERE user_id = '" . (string) $loggedin_session . "' LIMIT 10";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}

$sql5 = "SELECT * from products WHERE user_id = '" . (string) $loggedin_session . "' LIMIT 10";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
}

?>

<html>

<title>Profile</title>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<!-- MDB icon -->
<!-- <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" /> -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
<!-- MDB -->
<link rel="stylesheet" href="css/mdb.min.css" />

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            var NameField = $(".editcompanyfields").find(".cname");
            var CodeField = $(".editcompanyfields").find(".ccode");
            var GstField = $(".editcompanyfields").find(".cgstin");
            var PhonenoField = $(".editcompanyfields").find(".cphoneno");
            var AddressField = $(".editcompanyfields").find(".caddress");
            NameField.val('<?php echo $name ?>');
            CodeField.val('<?php echo $wo ?>');
            GstField.val('<?php echo $gstin ?>');
            PhonenoField.val('<?php echo $phoneno ?>');
            AddressField.val('<?php echo $address ?>');


            $('#editcompanyPopup').show();

            initilizebootstrap();



        });
        $('#cancelBtn').click(function () {
            // Hide the popup window
            $('#editcompanyPopup').hide();
            initilizebootstrap();
        });
    });
</script>

<body>
    <main><br>
        <div id="editcompanyPopup" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content  container mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                    <div class="modal-header">
                        <h2 class="modal-title">Edit</h2>
                        <button type="button" id='cancelBtn' class="btn-close" data-mdb-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class='row justify-content'>
                            <div class="col-xl-10">
                                <form id="editcompany" class="editcompanyfields" method="post">
                                    <h4></h4>
                                    <div class="row mb-4">
                                        <div class='col'>
                                            <div class="form-outline">
                                                <input type="text" id="companyname" class="form-control cname"
                                                    name="company_name">
                                                <label for="companyname" class='form-label'>Company Name</label>
                                            </div>
                                        </div>

                                        <div class='col'>
                                            <div class="form-outline">
                                                <input type="text" id="companycode" class="form-control ccode"
                                                    name="company_code">
                                                <label for="companycode" class='form-label'>Company Code</label>
                                            </div>
                                        </div>

                                        <div class='col'>
                                            <div class="form-outline">
                                                <input type="text" id="comgstin" class="form-control cgstin" required
                                                    name="company_gstin">
                                                <label for="comgstin" class='form-label'>Company GSTIN</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <div class='col-md-3'>
                                            <div class="form-outline">
                                                <input type="text" id="comphoneno" class="form-control cphoneno"
                                                    required name="company_phoneno">
                                                <label for="comphoneno" class='form-label'>Phone No.</label>
                                            </div>
                                        </div>

                                        <div class='col-md-5'>
                                            <div class="form-outline">
                                                <input type="text" id="comaddress" class="form-control caddress"
                                                    required name="company_address">
                                                <label for="comaddress" class='form-label'>Address</label>
                                            </div>
                                        </div>
                                    </div>



                                    <input type="submit" class="btn btn-success" id='bsave' name="save" value="Save">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="mt-2 ms-4">Profile</h1>


        <div class="container-fluid">
            <div class=" mb-1 bg-white shadow-1-strong mt-4">
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
                                    <a class="nav-link text-black" href="profile.php">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="profile_inpass.php">Old Inpass</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="profile_outpass.php">Old Outpass</a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a class="nav-link " href="profile_workorder.php">Work Order</a>
                                </li> -->



                            </ul>

                        </div>
                        <ul class="navbar-nav">
                            <div class="d-flex align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link " href="profile_regfinancialyear.php">Settings</a>
                                </li>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">
            <div class="row-md-4">
                <div>
                    <button class='edit-btn btn btn-primary float-end' data-mdb-toggle='modal'
                        data-mdb-target='#editcompanyPopup' class='edit-btn btn btn-primary'
                        name='editcompany'>Edit</button>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class='fs-6 fw-light'>Company Name</p>

                    <h1 class="display-6">
                        <?php echo $name ?>
                    </h1>
                </div>

                <div class="col">
                    <p class='fs-6 fw-light'>Company Code</p>
                    <h1 class="display-6">
                        <?php echo $wo ?>
                    </h1>
                </div>

                <div class="col">
                    <p class='fs-6 fw-light'>Company GSTIN</p>
                    <h1 class="display-6">
                        <?php echo $gstin ?>
                    </h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <p class='fs-6 fw-light'>Phone Number</p>
                    <h1 class="display-6">
                        <?php echo $phoneno ?>
                    </h1>
                </div>

                <div class="col">
                    <p class='fs-6 fw-light'></p>
                    <h1 class="display-6">
                    <p class='fs-6 fw-light'>Address</p>
                    <h1 class="display-6">
                        <?php echo $address ?>
                    </h1>
                    </h1>
                </div>

                <div class="col">
                    <p class='fs-6 fw-light'></p>
                    <h1 class="display-6">

                    </h1>
                </div>
            </div>
        </div>
        <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">
            <div class="col">
                <h1>Company Products <a href="compproductshowall.php?f=0" class="fs-5" target="_blank">Show All</a></h1>
            </div>

            <table class='table table-sm'>
                <thead class="table-light">
                    <th>No.</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Design</th>
                    <th>Size</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($retval4)) {
                        echo "
                    <form method='POST'>
                    <tr>
                    <td>
                    $i
                    </td>
                    <td>
                    {$row['code']}
                    </td>
                    <td>
                    " . ucwords($row['name']) . "
                    </td>
                    <td>
                    " . ucwords($row['design']) . "
                    </td>
                    <td>
                    {$row['size']}
                    </td>
                    <td>
                    <form method='post' id='delete_company_product' name='delete_company_product'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <button type='submit' id='delete_company_product' class='btn btn-outline-danger btn-sm' data-mdb-ripple-color='dark' name='delete_company_product' >Delete</button>
                    </form>
                    </td>
                    </tr>   
                    </form>
                    ";
                        $i = $i + 1;
                    }
                    ?>
                    <tr>
                        <form method="post">
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='codefield'
                                        required name="code"><label for="codefield" class='form-label'> Code</label>
                                </div>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" id='namefield' class="form-control"
                                        required name="name"><label for="namefield" class='form-label'>Name</label>
                                </div>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" id="designfield" class="form-control"
                                        required name="design"><label for="designfield"
                                        class='form-label'>Design</label></div>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text"
                                        onkeydown="if(['Space'].includes(arguments[0].code)){return false;};"
                                        id='sizefield' class="form-control" required name="size"><label for="sizefield"
                                        class='form-label'>Size</label>
                                </div>
                            </td>

                            <td><button name="add_company_product" class="btn btn-outline-secondary text-nowrap"
                                    data-mdb-ripple-color="dark">Add Product</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <div class="col">
                <h1 class='mt-5'>Vehicle List</h1>
            </div>
            <table class='table table-sm'>
                <thead class="table-light">
                    <th>No.</th>
                    <th>Vehicle No.</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Owner</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($retval2)) {
                        echo "
                    <tr>
                    <td>
                    $i
                    </td>
                    <td>
                    {$row['number']}
                    </td>
                    <td>
                    " . ucwords($row['type']) . "
                    </td>
                    <td>
                     " . ucwords($row['owner']) . "
                    </td>
                    <td>
                    <form method='post' id='delete_vehicle' name='delete_vehicle'>
                    <input type='hidden' name='id' value='{$row['number']}'>
                    <input type='submit' id='delete_vehicle' class='btn btn-outline-danger btn-sm' data-mdb-ripple-color='dark' name='delete_vehicle' value='Delete'>
                    </form>
                    </td>
                    </tr>
                    ";
                        $i = $i + 1;
                    }
                    ?>
                    <tr>
                        <form method="post">
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='vnofield' required
                                        name="no"><label for="vnofield" class='form-label'>Vehicle No.</label></div>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='vtypefield'
                                        required name="type"><label for="vtypefield" class='form-label'>Vehicle
                                        Type</label></div>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='vownerfield'
                                        required name="owner"><label for="vownerfield" class='form-label'>Vehicle
                                        Owner</label></div>
                            </td>
                            <td><button name="add_vehicle" class="btn btn-outline-secondary text-nowrap"
                                    data-mdb-ripple-color="dark">Add Vechicle</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">

            <div class="col">
                <h1>Saved Products <a href='savedproductshowall.php?f=0' class="fs-5" target="_blank">Show All</a></h1>
            </div>
            <table class='table table-sm'>
                <thead class='table-light"'>
                    <th>No.</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Design</th>
                    <th>Size</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($retval5)) {
                        echo "
                    <form method='POST'>
                    <tr>
                    <td>
                    $i
                    </td>
                    <td>
                    {$row['code']}
                    </td>
                    <td>
                    " . ucwords($row['name']) . "
                    </td>
                    <td>
                    " . ucwords($row['design']) . "
                    </td>
                    <td>
                    {$row['size']}
                    </td>
                    <td>
                    <form method='post' id='delete_product' name='delete_product'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <button type='submit' class='btn btn-outline-danger btn-sm' data-mdb-ripple-color='dark' id='delete_product' name='delete_product' >Delete</button>
                    </form>
                    </td>
                    </tr>
                    </form>
                    ";
                        $i = $i + 1;
                    }
                    ?>
                    <tr>
                        <form method="post">
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='pnamef' required
                                        name="name"><label for='pnamef' class='form-label'>Name</label>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='pcodefield'
                                        required name="code"><label for='pcodef' class='form-label'>Code</label>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" class="form-control" id='pdesignf' required
                                        name="design"><label for='pdesignf' class='form-label'>Design</label>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text"
                                        onkeydown="if(['Space'].includes(arguments[0].code)){return false;};"
                                        class="form-control" id='psizef' required name="size"><label for='psizef'
                                        class='form-label'>Size</label>
                            </td>
                            <td><button name="add" class="btn btn-outline-secondary text-nowrap"
                                    data-mdb-ripple-color="dark">Add Product</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">
            <?php
            if (isset($_POST['delete_product'])) {
                //transaction
                $tran = 'START TRANSACTION';
                $transtart = mysqli_query($conn, $tran);
                if (!$transtart) {
                    echo mysqli_error($conn);
                }

                $delete_code = $_POST['id'];
                $sql = "DELETE from products where code = '$delete_code' AND user_id = '" . (string) $loggedin_session . "'";
                $retval6 = mysqli_query($conn, $sql);
                if (!$retval6) {
                    echo "Error Occured";
                }
                //transaction
                mysqli_commit($conn);

                echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
            }
            if (isset($_POST['add'])) {
                if (!$conn) {
                    echo "Error Occured";
                    die($conn);
                }
                $product_name = '';
                $product_code = '';
                $product_size = '';
                $product_design = '';
                $product_name = $_POST['name'];
                $product_code = $_POST['code'];
                $product_size = $_POST['size'];
                $product_design = $_POST['design'];

                //converting to lowercase
                $product_name = strtolower($product_name);
                $product_design = strtolower($product_design);
                $product_size = strtolower($product_size);

                $sql = "INSERT into products(name,code,design,size,user_id) VALUES ('$product_name','$product_code','$product_design','$product_size','" . (string) $loggedin_session . "')";
                $insert = mysqli_query($conn, $sql);
                if (!$insert) {
                    echo "Error";
                    echo mysqli_error($conn);
                    die($conn);
                }
                if ($insert) {
                    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
                }
            }
            ?>

            <div class="col">
                <h1>Saved Companies <a href="savedcompshowall.php?f=0" class="fs-5" target="_blank">Show All</a></h1>
            </div>

            <table class="table table-sm">
                <thead class='table-light'>
                    <th>No.</th>
                    <th>Company Name</th>
                    <th>WO#</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($retval3)) {
                        echo "
                    <form method='POST'>
                    <tr>
                    <td>
                    $i
                    </td>
                    <td>
                    {$row['name']}
                    </td>
                    <td>
                    {$row['code']}
                    </td>
                    <td>
                    <form method='post' id='delete_company' name='delete_company'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <button type='submit' id='delete_company' class='btn btn-outline-danger btn-sm' data-mdb-ripple-color='dark' name='delete_company' >Delete</button>
                    </form>
                    </td>
                    </tr>
                    </form>
                    ";
                        $i = $i + 1;
                    }
                    ?>
                    <tr>
                        <form method="post">
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" id='cnamef' class="form-control" required
                                        name="name"><label for='cnamef' class='form-label'>Name</label>
                            </td>
                            <td>
                                <div class='form-outline'><input type="text" id='ccodef' class="form-control" required
                                        name="code"><label for='ccodef' class='form-label'>Code</label>
                            </td>
                            <td><button name="add_company" class="btn btn-outline-secondary text-nowrap"
                                    data-mdb-ripple-color="dark">Add Company</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <div class="container m-5 bg-white rounded-5 shadow-4-strong p-5">
            <div class="row-md-4">
                <div>
                    

                </div>
            </div>
            <div class="row">
               <h1 class="Display-6">Contact for Support</h1>
            </div>
            <br>
            <div class="row">
                <small>abhimaneu2001@gmail.com</small>
                <small>bijoyanil74@gmail.com</small>
            </div>
        </div> -->

        <script>
            function initilizebootstrap() {
                document.querySelectorAll('.form-outline').forEach((formOutline) => {
                    new mdb.Input(formOutline).init();
                });
            }
        </script>
        <!-- MDB -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript"></script>

    </main>
</body>

</html>

<?php
if (isset($_POST['delete_vehicle']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!$conn) {
        echo "Error Occured";
    }

    $sql = "DELETE FROM vehicles where number = '$id' AND user_id = '" . (string) $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo "Delete was not possible";
    }
    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
}

if (isset($_POST['delete_company']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!$conn) {
        echo "Error Occured";
    }

    $sql = "DELETE FROM company where code = '$id' AND user_id = '" . (string) $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo "Delete was not possible";
    }
    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
}

if (isset($_POST['add_company'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $company_name = '';
    $company_code = '';
    $company_name = $_POST['name'];
    $company_code = $_POST['code'];
    $sql = "INSERT into company(name,code,user_id) VALUES ('$company_name','$company_code','" . (string) $loggedin_session . "')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
    }
}

if (isset($_POST['save'])) {
    $cname = '';
    $ccode = '';
    $cgstin = '';
    $cname = $_POST['company_name'];
    $ccode = $_POST['company_code'];
    $cgstin = $_POST['company_gstin'];
    $cphoneno = $_POST['company_phoneno'];
    $caddress = $_POST['company_address'];
    $sqlupdate = "UPDATE profile SET name='$cname',wo='$ccode',gstin='$cgstin',phoneno='$cphoneno',address='$caddress' WHERE user_id = '" . (string) $loggedin_session . "'";
    $updatedata = mysqli_query($conn, $sqlupdate);
    if (!$updatedata) {
        echo mysqli_error($conn);
    }
    echo "<script type='text/javascript'>
        window.location.href = 'profile.php';
        </script>";
}

if (isset($_POST['add_vehicle'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $vehicle_no = '';
    $vehicle_type = '';
    $vehicle_owner = '';
    $vehicle_no = $_POST['no'];
    $vehicle_type = $_POST['type'];
    $vehicle_owner = $_POST['owner'];

    //converting vehicle no
    $vehicle_no = strtoupper($vehicle_no);

    $sql = "INSERT into vehicles(type,number,owner,user_id) VALUES ('$vehicle_type','$vehicle_no','$vehicle_owner','" . (string) $loggedin_session . "')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
        window.location.href = 'profile.php';
        </script>";
    }
}

if (isset($_POST['delete_company_product'])) {
    $delete_code = $_POST['id'];
    $sql = "DELETE from company_products where code = '$delete_code' AND user_id = '" . (string) $loggedin_session . "'";
    $retval7 = mysqli_query($conn, $sql);
    if (!$retval7) {
        echo "Error Occured";
    }

    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
}

if (isset($_POST['add_company_product'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $product_name = '';
    $product_code = '';
    $product_size = '';
    $product_design = '';
    $product_name = $_POST['name'];
    $product_code = $_POST['code'];
    $product_size = $_POST['size'];
    $product_design = $_POST['design'];

    //converting to lowercase
    $product_name = strtolower($product_name);
    $product_design = strtolower($product_design);
    $product_size = strtolower($product_size);

    $sql = "INSERT into company_products(code,name,design,size,user_id) VALUES ('$product_code','$product_name','$product_design','$product_size','" . (string) $loggedin_session . "')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
    }
}
?>