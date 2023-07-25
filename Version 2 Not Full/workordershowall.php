<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php

$f = $_GET['f'];
$start = '1990-01-31';
$end = '2099-12-31';
$company = 'All';
$p_name = 'All';
$size = 'All';
$p_code = 'All';
$status = 'All';

if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['cmp'];
    $p_name = $_GET['in'];
    $size = $_GET['is'];
    $wno = $_GET['wno'];
    $p_code = $_GET['ic'];
    $status = $_GET['st'];

}
if (!$conn) {
    echo "Error Occured";
}

//for dropdowns
$sql2 = "SELECT company from work_orders WHERE user_id = '".(string)$loggedin_session."'";
$sql2 .= " GROUP BY company";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$sql3 = "SELECT name from work_order_products WHERE user_id = '".(string)$loggedin_session."'";
$sql3 .= " GROUP BY name";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}
$sql4 = "SELECT size from work_order_products WHERE user_id = '".(string)$loggedin_session."'";
$sql4 .= " GROUP BY size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}
$sql5 = "SELECT work_order_no from work_orders WHERE user_id = '".(string)$loggedin_session."'";
$sql5 .= " GROUP BY work_order_no";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
}
$sql6 = "SELECT code from work_order_products WHERE user_id = '".(string)$loggedin_session."'";
$sql6 .= " GROUP BY code";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
}
$sql7 = "SELECT status from work_orders WHERE user_id = '".(string)$loggedin_session."'";
$sql7 .= " GROUP BY status";
$retval7 = mysqli_query($conn, $sql7);
if (!$retval7) {
    echo mysqli_error($conn);
}

//for table
$sql = "select * from work_orders,work_order_products where work_orders.work_order_no = work_order_products.work_order_no AND work_orders.user_id = '".(string)$loggedin_session."'";

if ($company != 'All') {
    $sql .= " AND company = '$company'";
}
if ($p_name != 'All') {
    $sql .= " AND name = '$p_name'";
}
if ($size != 'All') {
    $sql .= " AND size = '$size'";
}
if ($p_code != 'All') {
    $sql .= " AND code = '$p_code'";
}
if ($status != 'All') {
    $sql .= " AND status = '$status'";
}


$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}
?>


<html>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Work Order</title>
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

<style>
    .blur {
        box-shadow: 0px 0px 20px 20px rgba(255, 255, 255, 1);
        text-shadow: 0px 0px 10px rgba(51, 51, 51, 0.9);
        transform: scale(0.9);
        opacity: 0.6;
    }
</style>

<script>
    //editing
    $(document).ready(function () {

        // Handle click event on the edit button
        $('.edit-btn').click(function (e) {
            e.preventDefault(); // Prevent the default form submission



            $("#product_fields").empty();
            var workOrderNo = $(this).closest('tr').find('td:eq(0)').text().trim();
            var date = $(this).closest('tr').find('td:eq(1)').text().trim();
            var company = $(this).closest('tr').find('td:eq(2)').text().trim();
            var productStatus = $(this).closest('tr').find('td:eq(8)').text().trim();
            var extras = $(this).closest('tr').find('td:eq(9)').text().trim();
            $.ajax({
                method: "POST",
                url: "getproductdatafromwno.php",
                data: {
                    workorder_no: workOrderNo
                },
                success: function (response) {
                    if (response === "FALSE") {
                        var message = "ERROR: something went wrong on the MYSQL side";
                        alert(message);
                    } else {
                        productData = JSON.parse(response)
                        var l = productData.length;
                        $('#workOrderNo').val(workOrderNo);
                        $('#date').text(date);
                        $('#date_of_entry').val(date);
                        $('#company').val(company);
                        $('#productStatus').val(productStatus);
                        $('#extras').val(extras);
                        for (var i = 0; i < l; i++) {
                            $('#add_product_field').click();
                            var productCodeField = $(".product_field:eq(" + i + ")").find(".product_code");
                            var productNameField = $(".product_field:eq(" + i + ")").find(".product_name");
                            var productDesignField = $(".product_field:eq(" + i + ")").find(".product_design");
                            var productSizeField = $(".product_field:eq(" + i + ")").find(".product_size");
                            var productQtyField = $(".product_field:eq(" + i + ")").find(".product_qty");
                            productCodeField.val(productData[i].code);
                            productNameField.val(productData[i].name);
                            productDesignField.val(productData[i].design);
                            productSizeField.val(productData[i].size);
                            productQtyField.val(productData[i].qty)
                            initilizebootstrap();

                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                    alert(message);
                }
            });

            $.ajax({
                method: "POST",
                url: "getcompanynamefromwno.php",
                data: {
                    workorder_no: workOrderNo
                },
                success: function (response) {
                    $("#dest_name").val(response);
                    $("#dest_name").trigger("change");
                },
                error: function (xhr, status, error) {
                    var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                    alert(message);
                }
            });

            // // Show the popup window
            $('#editPopup').show();

            initilizebootstrap();

        });

        // Handle click event on the cancel button in the popup window
        $('#cancelBtn').click(function () {
            // Hide the popup window
            $('#editPopup').hide();
            initilizebootstrap();

        });


        //add product field
        $("#add_product_field").click(function () {

            var productField = `
<div class="product_field mb-3">
<div class=' d-flex align-items-start bg-light mb-1 mt-4'>

<div class="form-outline mb-1 col " >
<input name="product_code[]" id='pcode' required class="product_code form-control">
<label for="pcode" class='form-label'>Product Code</label>
</div>
&nbsp;
<div class="form-outline mb-1 col " >
<input list="productlist" required name="products[]" class="product_name form-control" id='pname'>
<label for='pname' class='form-label'>Product Name</label>
<datalist id="productlist">
<?php
// while ($row = mysqli_fetch_assoc($retval)) {
//     echo "<option>{$row['name']}";
// }
?>
</datalist>
</div>
&nbsp;
<div class="form-outline mb-1 col " >
<input name="product_design[]" required class="product_design form-control" id='pdes'>
<label for="pdes" class='form-label'>Design</label>
</div>
&nbsp;

<div class="form-outline mb-1 col " >
<input name="product_size[]" required class="product_size form-control" id='psize'>
<label for="psize" class='form-label'>Size</label>
</div>
&nbsp;


&nbsp;
<div class="form-outline mb-1 col " >
<input name="product_qty[]" required class="product_qty form-control" id='pqty'>
<label for="pqty" class='form-label'>Req. Qty</label>
</div>
</div>
&nbsp;
<button type="button" class="remove_product_field  btn btn-outline-danger" data-mdb-ripple-color="dark">Remove</button>  &nbsp;
</div>
`;

            $("#product_fields").append(productField);
            initilizebootstrap();
        });

        // Remove product field
        $(document).on("click", ".remove_product_field", function () {
            $(this).parent(".product_field").remove();
            initilizebootstrap();

        });
    });

    $(document).ready(function () {
        $('#start').click(function () {
            // Get the current date
            var currentDate = new Date();

            // Get the current year and month
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed

            // Set the default value to the current month
            var defaultValue = year + '-' + month;
            document.getElementById('start').value = defaultValue;
            initilizebootstrap();


        });

        $('#end').click(function () {
            // Get the current date
            var currentDate = new Date();

            // Get the current year and month
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed

            // Set the default value to the current month
            var defaultValue = year + '-' + month;
            document.getElementById('end').value = defaultValue;
            initilizebootstrap();


        });
    });

    $(document).ready(function () {
        //search workorder data
        var searchInput = document.getElementById("search");
        var table = document.getElementById("tablebody");
        var rows = table.getElementsByTagName("tr");

        searchInput.addEventListener("keyup", function () {
            var input = searchInput.value.toLowerCase();

            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].getElementsByTagName("td");
                var found = false;

                for (var j = 0; j < rowData.length; j++) {
                    if (rowData[j].innerHTML.toLowerCase().indexOf(input) > -1) {
                        found = true;
                        initilizebootstrap();
                        break;
                    }
                }

                if (found) {
                    rows[i].style.display = "";
                    initilizebootstrap();
                } else {
                    rows[i].style.display = "none";
                    initilizebootstrap();
                }
            }
        });
    });


    

</script>

<body>
    <main>
        <br>
        <h1 class="mt-2 ms-4">Work Orders</h1>
        <div class="container-fluid">
            <div class='row justify-content main-container'>
                <div class="col">
                    <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                        <h4 class='mb-4'>Filter</h4>
                        <div class="row ms-1 justify-content w-50">
                            <div class="form-outline col">
                                <input type="date" class="form-control" value="1990-01-01" id='start' required
                                    name="start">
                                <label for="start" class='form-label'>Start</label>
                            </div>
                            <div class="col col-sm-1">
                                <center>to</center>
                            </div>
                            <div class="form-outline col">
                                <input name="end" class="form-control" value="2099-12-31" id='end' required type="date">
                                <label for="end" class="form-label">End</label>
                            </div>
                        </div>
                        <div class="col mt-4 mb-4 ms-1">
                            <label>Company</label>
                            <select name='company'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval2, 0);
                                while ($row = mysqli_fetch_assoc($retval2)) {
                                    echo "
            <option>{$row['company']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
                            <label>Item Name</label>
                            <select name='name'>
                                <option selected>All</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($retval3)) {
                                    echo "
            <option>{$row['name']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
                            <label>Item Code</label>
                            <select name='code'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval6, 0);
                                while ($row = mysqli_fetch_assoc($retval6)) {
                                    echo "
            <option>{$row['code']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
                            <label>Item Size</label>
                            <select name='size'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval4, 0);
                                while ($row = mysqli_fetch_assoc($retval4)) {
                                    echo "
            <option>{$row['size']}</option>
            ";
                                }
                                ?>
                            </select> &nbsp;
                            <label>Status</label>
                            <select name='status'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval7, 0);
                                while ($row = mysqli_fetch_assoc($retval7)) {
                                    echo "
            <option>{$row['status']}</option>
            ";
                                }
                                ?>
                            </select>

                            &nbsp;
                            <input type="submit" class=" btn btn-outline-primary btn-sm" data-mdb-ripple-color="dark"
                                name="filter" value="Search">
                        </div>
                        <h5 class='mb-4'>Search By Keywords</h5>
                        <div class='col justify-content w-25'>
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="text" id='search' class="form-control" name="search"
                                        placeholder="eg. ABC123">
                                    <label class="form-label" for="search">Search</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="editPopup" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content  container mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                            <div class="modal-header">
                                <h2 class="modal-title">Edit Values</h2>
                                <button type="button" id='cancelBtn' class="btn-close"
                                    data-mdb-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class='row justify-content'>
                                    <div class="col-xl-10">
                                        <form id="editForm" method="post">
                                            <div class="row mb-4 w-75">
                                                <div class="col">
                                                    <label for="date">Date : </label>
                                                    <span id="date" name="date">
                                                        <caption></caption>
                                                    </span>
                                                    <input type='hidden' id='date_of_entry' name='date_of_entry'>
                                                </div>
                                            </div>
                                            <div class="row w-75">
                                                <div class='col'>
                                                    <div class="form-outline">
                                                        <input type="text" id="workOrderNo" class="form-control"
                                                            name="workOrderNo" readonly>
                                                        <label for="workOrderNo" class='form-label'>Work Order
                                                            No.</label>
                                                    </div>
                                                </div>

                                                <div class='col'>
                                                    <div class="form-outline">
                                                        <input type="text" id="company" class="form-control" required
                                                            name="company">
                                                        <label for="company" class='form-label'>Company</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="mt-4">
                                                <h6>Products</h6>
                                            </label> <br>
                                            <div id="product_fields"
                                                class='row border border-1 border-primary rounded pt-2 mb-2'>

                                            </div>
                                            <button type="button" id="add_product_field"
                                                class="btn btn-outline-secondary" data-mdb-ripple-color="dark">Add
                                                Product</button> <br>
                                            <div class="form-outline mt-4 w-50">
                                                <input type="text" class="form-control" id="productStatus" required
                                                    pattern="^(Open|Closed)$" name="productStatus">
                                                <label for="productStatus" class='form-label'>Product Status
                                                    (Open/Closed)</label>
                                            </div>
                                            <div class="form-outline mt-4 mb-4 w-50">
                                                <input type="text" class="form-control" id="extras" name="extras">
                                                <label for="extras" class='form-label'>Extras</label>
                                            </div>

                                            <input type="submit" class="btn btn-success" id='bsave' name="save"
                                                value="Save">
                                            <input type="submit" onclick="return confirm('Are you sure?');" class="btn btn-danger" id='del' name="delete"
                                                value="Delete">
                                            <!-- <input type='submit' class='btn btn-danger' name='delete' id='delete' value='Are You Sure?'> -->

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class=" mt-1 mb-2 bg-white rounded-5 shadow-5-strong p-4">
                        <table class="table">
                            <thead class='table-light sticky-top'>
                                <th>
                                    Work Order No.
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Company
                                </th>
                                <th>
                                    Product Code
                                </th>
                                <th>
                                    Product Desc.
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                                <th>
                                    Product Desp. Quantity
                                </th>
                                <th>
                                    Product Status
                                </th>
                                <th>
                                    Extras
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody id='tablebody'>

                                <?php
                                $cur_no = -1;
                                $table_active = '';
                                while ($row = $retval->fetch_assoc()) {
                                    if ($cur_no == $row['work_order_no']) {

                                    } else {
                                        if ($table_active == 'table-active') {
                                            $table_active = '';
                                        } else {
                                            $table_active = 'table-active';
                                        }
                                    }
                                    if (!empty($row)) {
                                        echo "
                    <tr class='$table_active'>
                    <td>
                    {$row['work_order_no']}
                    </td>
                    <td>
                    {$row['date']}
                    </td>
                    <td>
                    {$row['company']}
                    </td>
                    <td>
                    {$row['code']}
                    </td>
                    <td>
                    {$row['name']}
                    </td>
                    <td>
                    {$row['design']}
                    </td>
                    <td>
                    {$row['size']}
                    </td>
                    <td>
                    {$row['qty']}
                    </td>
                    <td>
                    {$row['status']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                     <td>
                     
                     <input type='submit' data-mdb-toggle='modal' data-mdb-target='#editPopup' id='{$row['work_order_no']}' class='edit-btn btn btn-primary' name='edit' value='Edit'>
            </td>
                    </tr>
                    ";
                                        $cur_no = $row['work_order_no'];
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function initilizebootstrap() {
                document.querySelectorAll('.form-outline').forEach((formOutline) => {
                    new mdb.Input(formOutline).init();
                });
            }
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
            integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
            crossorigin="anonymous"></script>
        <!-- MDB -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript"></script>
    </main>
</body>

</html>

<?php
if (isset($_POST['save'])) {
    $workOrderNo = $_POST['workOrderNo'];
    $company = $_POST['company'];
    $productStatus = $_POST['productStatus'];
    $extras = $_POST['extras'];
    $date = $_POST['date_of_entry'];
    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }
    $sql = "UPDATE `work_orders` SET `company`='$company',`extras`='$extras',`status`='$productStatus' WHERE work_order_no = '$workOrderNo' AND user_id = '".(string)$loggedin_session."'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
    }

    $products = $_POST['products'];
    $productCodes = $_POST['product_code'];
    $productDesigns = $_POST['product_design'];
    $productSizes = $_POST['product_size'];
    $productQtys = $_POST['product_qty'];

    $sql3 = "DELETE FROM `work_order_products` WHERE work_order_no = '$workOrderNo' AND user_id = '".(string)$loggedin_session."'";
    $update3 = mysqli_query($conn, $sql3);
    if (!$update3) {
        echo mysqli_error($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
        mysqli_rollback($conn);

    }
    for ($i = 0; $i < count($products); $i++) {
        $productName = $products[$i];
        $productCode = $productCodes[$i];
        $productDesign = $productDesigns[$i];
        $productSize = $productSizes[$i];
        $productQty = $productQtys[$i];
        $sql2 = "INSERT INTO work_order_products(work_order_no,date_of_entry,code,name,design,size,qty,user_id) VALUES ('$workOrderNo','$date','$productCode','$productName','$productDesign','$productSize','$productQty','".(string)$loggedin_session."')";
        $update2 = mysqli_query($conn, $sql2);
        if (!$update2) {
            echo mysqli_error($conn);
            echo "<script>alert('Error Occured Aborting!')</script>";
            mysqli_rollback($conn);
        }
    }

    mysqli_commit($conn);
    echo "<script type='text/javascript'>
                window.location.href = 'workordershowall.php?f=0';
                </script>";
}

if (isset($_POST['delete'])) {
    $workOrderNo = $_POST['workOrderNo'];

    $sql = "DELETE FROM `work_orders` WHERE work_order_no = '$workOrderNo' AND user_id = '".(string)$loggedin_session."'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
    }
    $sql2 = "DELETE FROM `work_order_products` WHERE work_order_no = '$workOrderNo' AND user_id = '".(string)$loggedin_session."'";
    $update2 = mysqli_query($conn, $sql2);
    if (!$update2) {
        echo mysqli_error($conn);
    }

    echo "<script type='text/javascript'>
               alert('Work Order " . $workOrderNo . " has been deleted')
                </script>";
    echo "<script type='text/javascript'>
                window.location.href = 'workordershowall.php?f=0';
                </script>";
}


if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $in = $_POST['name'];
    $cmp = $_POST['company'];
    $is = $_POST['size'];
    $ic = $_POST['code'];
    $st = $_POST['status'];

    echo "<script type='text/javascript'>
            window.location.href = 'workordershowall.php?f=1&start=$start_date&end=$end_date&in=$in&cmp=$cmp&is=$is&wno=$wno&ic=$ic&st=$st';
            </script>";
}
?>