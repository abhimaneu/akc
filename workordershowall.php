<?php
include 'conn.php';
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

$search = '';
$wno = '';
if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['cmp'];
    $p_name = $_GET['in'];
    $size = $_GET['is'];
    $wno = $_GET['wno'];
    $p_code = $_GET['ic'];
    $status = $_GET['st'];

    $search = $_GET['pns'];
    //$opno = $_GET['opno'];
}
if (!$conn) {
    echo "Error Occured";
}

//for dropdowns
$sql2 = "SELECT company from work_orders where 1=1";
$sql2 .= " GROUP BY company";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$sql3 = "SELECT name from work_order_products where 1=1";
$sql3 .= " GROUP BY name";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}
$sql4 = "SELECT size from work_order_products where 1=1";
$sql4 .= " GROUP BY size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}
$sql5 = "SELECT work_order_no from work_orders where 1=1";
$sql5 .= " GROUP BY work_order_no";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
}
$sql6 = "SELECT code from work_order_products where 1=1";
$sql6 .= " GROUP BY code";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
}
$sql7 = "SELECT status from work_orders where 1=1";
$sql7 .= " GROUP BY status";
$retval7 = mysqli_query($conn, $sql7);
if (!$retval7) {
    echo mysqli_error($conn);
}

//for table
$sql = "select * from work_orders,work_order_products where work_orders.work_order_no = work_order_products.work_order_no";

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
if (!empty($search)) {
    $sql .= " AND (name LIKE '%$search%' OR code LIKE '%$search%' OR design LIKE '%$search%')";
}
if (!empty($wno)) {
    $sql .= " AND (work_order_products.work_order_no LIKE '%$wno%')";
}


$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}
?>


<html>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

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
            var productStatus = $(this).closest('tr').find('td:eq(9)').text().trim();
            var extras = $(this).closest('tr').find('td:eq(10)').text().trim();
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
                        $('#company').val(company);
                        $('#productStatus').val(productStatus);
                        $('#extras').val(extras);
                        for (var i = 0; i < l; i++) {
                            $('#add_product_field').click();
                            var productCodeField = $(".product_field:eq(" + i + ")").find(".product_code");
                            var productNameField = $(".product_field:eq(" + i + ")").find(".product_name");
                            var productDesignField = $(".product_field:eq(" + i + ")").find(".product_design");
                            var productSizeField = $(".product_field:eq(" + i + ")").find(".product_size");
                            var productFeatureField = $(".product_field:eq(" + i + ")").find(".product_feature");
                            var productQtyField = $(".product_field:eq(" + i + ")").find(".product_qty");
                            productCodeField.val(productData[i].code);
                            productNameField.val(productData[i].name);
                            productDesignField.val(productData[i].design);
                            productSizeField.val(productData[i].size);
                            productFeatureField.val(productData[i].feature);
                            productQtyField.val(productData[i].qty)
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
        });

        // Handle click event on the cancel button in the popup window
        $('#cancelBtn').click(function () {
            // Hide the popup window
            $('#editPopup').hide();
        });


        //add product field
        $("#add_product_field").click(function () {

            var productField = `
<div class="product_field">

<label for="product_code">Product Code</label>
<input name="product_code[]" required class="product_code">


<label>Product Name</label>
<input list="productlist" required name="products[]" class="product_name">
<datalist id="productlist">
<?php
// while ($row = mysqli_fetch_assoc($retval)) {
//     echo "<option>{$row['name']}";
// }
?>
</datalist>


<label for="product_design">Design</label>
<input name="product_design[]" required class="product_design">

<label for="product_size">Size</label>
<input name="product_size[]" required class="product_size">

<label for="product_feature">Features</label>
<input name="product_feature[]" required class="product_feature">

<label for="product_qty">Req. Qty</label>
<input name="product_qty[]" required class="product_qty">

<button type="button" class="remove_product_field">Remove</button>  &nbsp;
</div>
`;

            $("#product_fields").append(productField);
        });

        // Remove product field
        $(document).on("click", ".remove_product_field", function () {
            $(this).parent(".product_field").remove();
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

        });
    });

</script>

<body>
    <div>
        <h1>Work Orders</h1>
        <form name="filter" method="post">
            <label for="start">Start</label>
            <input type="date" value="1990-01-01" id='start' required name="start">
            &nbsp;
            <label for="end">End</label>
            <input name="end" value="2099-12-31" id='end' required type="date">

            <br> <br>
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
            </select> &nbsp;
            <input type="submit" name="filter" value="Search">
            <br> <br>
            Search by Keywords <br> <br>
            <input type="text" name="wno" placeholder="Enter Work Order No.">
            <input type="text" name="search" placeholder="Search Item Name/Code">
            <input type="submit" name="filter" value="Search">

        </form> <br>

        <div id="editPopup" style="display: none;">
            <h2>Edit Values</h2>
            <form id="editForm" method="post">
                <label for="workOrderNo">Work Order No.</label>
                <input type="text" id="workOrderNo" name="workOrderNo" readonly><br>
                <label for="date">Date : </label>
                <span id="date" name="date">
                    <caption></caption>
                </span><br>
                <label for="company">Company</label>
                <input type="text" id="company" required name="company"><br>

                <div id="product_fields">

                </div>
                <button type="button" id="add_product_field">Add Product</button> <br>
                <label for="productStatus">Product Status (Open/Closed)</label>
                <input type="text" id="productStatus" required pattern="^(Open|Closed)$" name="productStatus"><br>

                <label for="extras">Extras</label>
                <input type="text" id="extras" name="extras"><br> <br>

                <input type="submit" name="save" value="Save">
                <input type="button" id="cancelBtn" value="Cancel">
                <input type="submit" name='delete' id="delete" value="Delete">
            </form>
        </div>


        <br>
        <table style="border-spacing: 30px;">
            <thead>
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
            <tbody>
                <tr>
                    <?php
                    while ($row = $retval->fetch_assoc()) {
                        if (!empty($row)) {
                            echo "
                    <tr>
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
                    {$row['features']}
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
                     <input type='submit' id='{$row['work_order_no']}' class='edit-btn' name='edit' value='Edit'>
            </td>
                    </tr>
                    ";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
if (isset($_POST['save'])) {
    $workOrderNo = $_POST['workOrderNo'];
    $company = $_POST['company'];
    $productStatus = $_POST['productStatus'];
    $extras = $_POST['extras'];
    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }
    $sql = "UPDATE `work_orders` SET `company`='$company',`extras`='$extras',`status`='$productStatus' WHERE work_order_no = '$workOrderNo'";
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
    $productFeatures = $_POST['product_feature'];
    $productQtys = $_POST['product_qty'];

    $sql3 = "DELETE FROM `work_order_products` WHERE work_order_no = '$workOrderNo'";
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
        $productFeature = $productFeatures[$i];
        $productQty = $productQtys[$i];
        $sql2 = "INSERT INTO work_order_products(work_order_no,code,name,design,size,features,qty) VALUES ('$workOrderNo','$productCode','$productName','$productDesign','$productSize','$productFeature','$productQty')";
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

    $sql = "DELETE FROM `work_orders` WHERE work_order_no = '$workOrderNo'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
    }
    $sql2 = "DELETE FROM `work_order_products` WHERE work_order_no = '$workOrderNo'";
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

    $p_search = $_POST['search'];
    $wno = $_POST['wno'];
    // echo "<script type='text/javascript'>
    //         window.location.href = 'workordershowall.php?f=1&start=$start_date&end=$end_date&in=$in&cmp=$cmp&is=$is&wno=$wno&ic=$ic&st=$st&pns=$p_search&wno=$wno';
    //         </script>";
}
?>