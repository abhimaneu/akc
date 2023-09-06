<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php

$f = $_GET['f'];
$start = date('Y') . '-04' . '-01';
$end = (date('Y') + 1) . '-03' . '-31';
$company = 'All';
$p_name = 'All';
$size = 'All';
$p_code = 'All';

if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['cmp'];
    $p_name = $_GET['pn'];
    $size = $_GET['sz'];
    $p_code = $_GET['pc'];
}
if (!$conn) {
    echo "Error Occured";
}

//for dropdowns
$sql2 = "SELECT source from inpass WHERE user_id = '" . (string) $loggedin_session . "'";
$sql2 .= " GROUP BY source";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$sql3 = "SELECT product_name from inpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql3 .= " GROUP BY product_name";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}
$sql4 = "SELECT product_size from inpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql4 .= " GROUP BY product_size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}
$sql6 = "SELECT product_code from inpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql6 .= " GROUP BY product_code";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
}

//for table
$sql = "select * from inpass,inpass_products where inpass.no = inpass_products.inpass_no AND inpass.user_id = '" . (string) $loggedin_session . "' AND inpass_products.user_id = '" . (string) $loggedin_session . "'";

if ($company != 'All') {
    $sql .= " AND source = '$company'";
}
if ($p_name != 'All') {
    $sql .= " AND product_name = '$p_name'";
}
if ($size != 'All') {
    $sql .= " AND product_size = '$size'";
}
if ($p_code != 'All') {
    $sql .= " AND product_code = '$p_code'";
}

$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}
?>


<html>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Inpass Generated</title>
<!-- MDB icon -->
<link rel="icon" href="img/icon.png" type="image/x-icon" />
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
        //add product field
        $("#add_product_field").click(function () {

            var productField = `
<div class="product_field mb-3">
<div class=' d-flex align-items-start bg-light mb-1 mt-4 w-50'>

<div class="form-outline mb-1 col " >
<input name="product_code[]" id='pcode' required class="product_code form-control">
<label for="pcode" class='form-label'>Product Code</label>
</div>
&nbsp;
<div class="form-outline mb-1 col " >
<input name="product_wono[]" id='pwono' required class="product_wono form-control">
<label for="pwono" class='form-label'>WO#</label>
</div>
&nbsp;
</div>
<div class=' d-flex align-items-start bg-light mb-1 mt-4'>
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
<input name="product_size[]" onkeydown="if(['Space'].includes(arguments[0].code)){return false;};" required class="product_size form-control" id='psize'>
<label for="psize" class='form-label'>Size</label>
</div>
&nbsp;


&nbsp;
<div class="form-outline mb-1 col " >
<input name="product_qty[]" required class="product_qty form-control" id='pqty'>
<label for="pqty" class='form-label'>Qty</label>
</div>
<input name="product_org_qty[]" type='hidden' class="product_org_qty form-control" id='poqty'>
</div>
&nbsp;
<button type="button" style="display:none;" class="remove_product_field  btn btn-outline-danger" data-mdb-ripple-color="dark">Remove</button>  &nbsp;
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
        //search inpass data
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

    //editing
    $(document).ready(function () {



        // Handle click event on the edit button
        $('.edit-btn').click(function (e) {
            e.preventDefault(); // Prevent the default form submission



            $("#product_fields").empty();
            var inpassNo = $(this).closest('tr').find('td:eq(0)').text().trim();
            inpassNo = inpassNo.substring(0, inpassNo.indexOf('/'));
            var date = $(this).closest('tr').find('td:eq(1)').text().trim();
            var company = $(this).closest('tr').find('td:eq(2)').text().trim();
            var woc = $(this).closest('tr').find('td:eq(3)').text().trim();
            var opno = $(this).closest('tr').find('td:eq(7)').text().trim();
            var vehicleNo = $(this).closest('tr').find('td:eq(8)').text().trim();
            var notes = $(this).closest('tr').find('td:eq(9)').text().trim();
            $.ajax({
                method: "POST",
                url: "getinpassdatafromno.php",
                data: {
                    inpass_no: inpassNo
                },
                success: function (response) {
                    if (response === "FALSE") {
                        var message = "ERROR: something went wrong on the MYSQL side";
                        alert(message);
                    } else {
                        productData = JSON.parse(response)
                        var l = productData.length;
                        $('#inpassNo').val(inpassNo);
                        $('#date').text(date);
                        $('#date_of_entry').val(date); $('#company').val(company);
                        $('#woc').val(woc);
                        $('#opno').val(opno);
                        $('#notes').val(notes);
                        $('#vehicleno').val(vehicleNo);
                        for (var i = 0; i < l; i++) {
                            $('#add_product_field').click();
                            var productCodeField = $(".product_field:eq(" + i + ")").find(".product_code");
                            var productWonoField = $(".product_field:eq(" + i + ")").find(".product_wono");
                            var productNameField = $(".product_field:eq(" + i + ")").find(".product_name");
                            var productDesignField = $(".product_field:eq(" + i + ")").find(".product_design");
                            var productSizeField = $(".product_field:eq(" + i + ")").find(".product_size");
                            var productQtyField = $(".product_field:eq(" + i + ")").find(".product_qty");
                            var productOrgQtyField = $(".product_field:eq(" + i + ")").find(".product_org_qty");
                            productCodeField.val(productData[i].code);
                            productWonoField.val(productData[i].product_wono);
                            productNameField.val(capitalizeWords(productData[i].name));
                            productDesignField.val(productData[i].design);
                            productSizeField.val(productData[i].size);
                            productQtyField.val(productData[i].qty)
                            productOrgQtyField.val(productData[i].qty)
                            initilizebootstrap();

                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                    alert(message);
                }
            });

            function capitalizeWords(str) {
                return str.replace(/\b\w/g, (c) => c.toUpperCase());
            }
        });
    });




</script>

<body>
    <!-- EDIT -->
    <div id="editPopup" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content  container mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                <div class="modal-header">
                    <h2 class="modal-title">Edit Values</h2>
                    <button type="button" id='cancelBtn' class="btn-close" data-mdb-dismiss="modal"></button>
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
                                <div class="row mb-4">
                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="inpassNo" class="form-control" name="inpassNo"
                                                readonly>
                                            <label for="inpassNo" class='form-label'>Inpass No.</label>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="company" class="form-control" required
                                                name="company">
                                            <label for="company" class='form-label'>Company</label>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="woc" class="form-control" required name="woc">
                                            <label for="woc" class='form-label'>A/C of</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="opno" class="form-control" name="opno">
                                            <label for="opno" class='form-label'>OP#</label>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="notes" class="form-control" name="notes">
                                            <label for="notes" class='form-label'>Note</label>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="vehicleno" class="form-control" required
                                                name="vehicleno">
                                            <label for="vehicleno" class='form-label'>Vehicle No</label>
                                        </div>
                                    </div>
                                </div>
                                <label class="mt-4">
                                    <h6>Products</h6>
                                </label> <br>
                               
                                <div id="product_fields" class='row border border-1 border-primary rounded pt-2 mb-2'>

                                </div>
                                <button type="button" style="display: none;" id="add_product_field" class="btn btn-outline-secondary"
                                    data-mdb-ripple-color="dark">Add
                                    Product</button> <br>

                                <input type="submit" class="btn btn-success mt-4" id='bsave' name="save" value="Save">
                                <input type="submit" onclick="return confirm('Are you sure?');" class="btn btn-danger"
                                    id='del' name="delete" value="Delete">
                                <!-- <input type='submit' class='btn btn-danger' name='delete' id='delete' value='Are You Sure?'> -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ----- -->
    <main> <br>
        <h1 class="mt-2 ms-4">Inpass</h1>
        <div class="container-fluid">
            <div class='row justify-content'>
                <div class="col">
                    <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                        <h4 class='mb-4'>Filter</h4>
                        <div class="row ms-1 justify-content w-50">
                            <div class="form-outline col">
                                <input type="date" class="form-control" value="<?php echo $start; ?>" id='start'
                                    required name="start">
                                <label for="start" class="form-label">Start</label>
                            </div>
                            <div class="col col-sm-1">
                                <center>to</center>
                            </div>
                            <div class="form-outline col">
                                <input name="end" class="form-control" value="<?php echo $end; ?>" id='end' required
                                    type="date">
                                <label for="end" class='form-label'>End</label>
                            </div>
                        </div>

                        <div class="col mt-4 mb-4 ms-1">
                            <label>Source. Company</label>
                            <select name='company'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval2, 0);
                                while ($row = mysqli_fetch_assoc($retval2)) {
                                    echo "
            <option>{$row['source']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
                            <label>Product Name</label>
                            <select name='product_name'>
                                <option selected>All</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($retval3)) {
                                    echo "
            <option> " . ucfirst($row['product_name']) . "</option>
            ";
                                }
                                ?>
                            </select> &nbsp;
                            <label>Product Code</label>
                            <select name='product_code'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval6, 0);
                                while ($row = mysqli_fetch_assoc($retval6)) {
                                    echo "
            <option>{$row['product_code']}</option>
            ";
                                }
                                ?>
                            </select> &nbsp;
                            <label>Product Size</label>
                            <select name='product_size'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval4, 0);
                                while ($row = mysqli_fetch_assoc($retval4)) {
                                    echo "
            <option>{$row['product_size']}</option>
            ";
                                }
                                ?>
                            </select>
                        </div> &nbsp;
                        <input type="submit" class=" btn btn-outline-primary btn-sm" data-mdb-ripple-color="dark"
                            name="filter" value="Search">
                        <br> <br>
                        <h5 class='mb-4'>Search By Keywords</h5>
                        <div class='col justify-content w-25'>
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="text" id='search' class="form-control" name="search"
                                        placeholder="eg. ABC001">
                                    <label class="form-label" for="search">Search</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                <table class="table">
                    <thead class="table-light sticky-top">
                        <th>
                            Inpass No.
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Company
                        </th>
                        <th>
                            A/C of
                        </th>
                        <th>
                            WO#
                        </th>
                        <th>
                            Product Desc.
                        </th>
                        <th>
                            Product Quantity
                        </th>
                        <th>
                            OP#
                        </th>
                        <th>
                            Vehicle No.
                        </th>
                        <th>
                            Note
                        </th>
                        <th>
                            PDF
                        </th>
                        <th>

                        </th>
                    </thead>
                    <tbody id="tablebody">
                        <?php
                        $cur_no = -1;
                        $table_active = '';
                        while ($row = $retval->fetch_assoc()) {
                            if ($cur_no == $row['no']) {

                            } else {
                                if ($table_active == 'table-active') {
                                    $table_active = '';
                                } else {
                                    $table_active = 'table-active';
                                }
                            }
                            $time = strtotime($row['date']);
                            $inpass_short_date = '';
                            if (date('n', $time) > 4) {
                                $temp_date = date('y', $time);
                                $inpass_short_date = $temp_date . ($temp_date + 1);
                            } else {
                                $temp_date = date('y', $time);
                                $inpass_short_date = ($temp_date - 1) . $temp_date;
                            }
                            if (!empty($row)) {
                                echo "
                    <tr class='$table_active'>
                    <td>
                    {$row['no']}/" . $inpass_short_date . "
                    </td>
                    <td>
                    {$row['date']}
                    </td>
                    <td>
                    {$row['source']}
                    </td>
                    <td>
                    {$row['woc']}
                    </td>
                    <td>
                    {$row['product_wono']}
                    </td>
                    <td>
                    " . ucwords($row['product_name']) . "
                    &nbsp;
                    {$row['product_code']}
                    &nbsp;
                    " . ucwords($row['product_design']) . "
                    &nbsp;
                    {$row['product_size']}
                    </td>
                    <td>
                    {$row['product_qty']}
                    </td>
                    <td>
                    {$row['op']}
                    </td>
                    <td>
                    {$row['vehicleno']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                    <td>
                    <a href='createpdfpass.php?no={$row['no']}&io=inpass' target='_blank' >Download</a>
                    </td>";
                                if ($row['product_wono'] != " " && $row['product_code'] != " ") {
                                    echo "<td>
                    <input type='submit' data-mdb-toggle='modal' data-mdb-target='#editPopup' id='{$row['inpass_no']}' class='edit-btn btn btn-primary' name='edit' value='Edit'>
                    </td>";
                                } else {
                                    echo "<td></td>";
                                }
                                echo "
                    </tr>
                    ";
                                $cur_no = $row['no'];
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
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
if (isset($_POST['save'])) {
    $inpassNo = $_POST['inpassNo'];
    $company = $_POST['company'];
    $woc = $_POST['woc'];
    $notes = $_POST['notes'];
    $date = $_POST['date_of_entry'];
    $opno = $_POST['opno'];
    $vehicleno = $_POST['vehicleno'];
    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }
    $sql = "UPDATE `inpass` SET `source`='$company',`woc`='$woc',`op`='$opno',`vehicleno`='$vehicleno',`extras`='$notes' WHERE no = '$inpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
    }

    $products = $_POST['products'];
    $productWonos = $_POST['product_wono'];
    $productCodes = $_POST['product_code'];
    $productDesigns = $_POST['product_design'];
    $productSizes = $_POST['product_size'];
    $productQtys = $_POST['product_qty'];
    $productOrgqtys = $_POST['product_org_qty'];

    $sql3 = "DELETE FROM `inpass_products` WHERE inpass_no = '$inpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update3 = mysqli_query($conn, $sql3);
    if (!$update3) {
        echo mysqli_error($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
        mysqli_rollback($conn);

    }
    for ($i = 0; $i < count($products); $i++) {
        $productName = $products[$i];
        $productWono = $productWonos[$i];
        $productCode = $productCodes[$i];
        $productDesign = $productDesigns[$i];
        $productSize = $productSizes[$i];
        $productQty = $productQtys[$i];
        $productOrgqty = $productOrgqtys[$i];

        //converting to lowercase
        $productName = strtolower($productName);
        $productDesign = strtolower($productDesign);
        $productSize = strtolower($productSize);

        $qtydiff = $productQty - $productOrgqty;

        //updating stock
        $sql7 = "INSERT INTO stock(item,design,size,qty,acof,user_id) VALUES ('$productName','$productDesign','$productSize','$productQty','$woc','" . (string) $loggedin_session . "')";
        $result2 = mysqli_query($conn, "SELECT item FROM stock WHERE item = '$productName' AND size = '$productSize' AND acof = '$woc' AND user_id = '" . (string) $loggedin_session . "'");
        $flag_stock1 = 0;
        if ($result2->num_rows == 0) {
            $insert2 = mysqli_query($conn, $sql7);
            if (!$insert2) {
                echo mysqli_error($conn);
                mysqli_rollback($conn);
                echo "<script type='text/javascript'>
                                window.location.href = 'inpassshowall.php?f=0';
                                </script>";
                echo "<script>alert('Some Error Occured')</script>";
                exit;
            }
        } else {

            $sql8 = "Select qty from stock where item = '$productName' AND size = '$productSize' AND acof = '$woc' AND user_id = '" . (string) $loggedin_session . "'";
            $retval4 = mysqli_query($conn, $sql8);
            if (!$retval4) {
                echo "Error Occured";
                mysqli_rollback($conn);
                echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                echo "<script>alert('Some Error Occured')</script>";
                exit;
            }
            $row8 = mysqli_fetch_array($retval4);
            $oldqty = $row8[0];
            $newqty = $oldqty + $qtydiff;
            if ($newqty < 0) {
                echo "<script>alert('Stock Error Occured,Total Stock value cannot be less than 0')</script>";
                mysqli_rollback($conn);
                exit;
            }
            $sql9 = "UPDATE stock SET qty = '$newqty' where item='$productName' AND size='$productSize' AND acof = '$woc' AND user_id = '" . (string) $loggedin_session . "'";
            $update = mysqli_query($conn, $sql9);
            if (!$update) {
                echo mysqli_error($conn);
                mysqli_rollback($conn);
                echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                echo "<script>alert('Some Error Occured')</script>";
                exit;
            }

            if ($qtydiff != 0) {
                $qtydiff2 = abs($qtydiff);
                $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productName','$productSize','$qtydiff','$newqty','$woc','Manual','" . (string) $loggedin_session . "')";
                $update92 = mysqli_query($conn, $sql92);
                $flag_stock1 = 1;
                if (!$update92) {
                    echo mysqli_error($conn);
                    mysqli_rollback($conn);
                    echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                    echo "<script>alert('Some Error Occured')</script>";
                    exit;
                }
            }
        }

        if ($qtydiff != 0) {
            if ($flag_stock1 != 1) {
                $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productName','$productSize','$productQty','$productQty','$acof','Manual','" . (string) $loggedin_session . "')";
                $update92 = mysqli_query($conn, $sql92);
                if (!$update92) {
                    echo mysqli_error($conn);
                    mysqli_rollback($conn);
                    echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                    echo "<script>alert('Some Error Occured')</script>";
                    exit;
                }
            }
        }
        //-------------

        $sql2 = "INSERT INTO inpass_products(inpass_no,date_of_entry,product_wono,product_name,product_code,product_design,product_size,product_qty,user_id) VALUES ('$inpassNo','$date','$productWono','$productName','$productCode','$productDesign','$productSize','$productQty','" . (string) $loggedin_session . "')";
        $update2 = mysqli_query($conn, $sql2);
        if (!$update2) {
            echo mysqli_error($conn);
            echo "<script>alert('Error Occured Aborting!')</script>";
            mysqli_rollback($conn);
        }
    }

    mysqli_commit($conn);
    echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
}

if (isset($_POST['delete'])) {
    // $inpassNo = $_POST['inpassNo'];

    // $sql = "DELETE FROM `inpass` WHERE no = '$inpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    // $update1 = mysqli_query($conn, $sql);
    // if (!$update1) {
    //     echo mysqli_error($conn);
    // }
    // $sql2 = "DELETE FROM `inpass_products` WHERE inpass_no = '$inpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    // $update2 = mysqli_query($conn, $sql2);
    // if (!$update2) {
    //     echo mysqli_error($conn);
    // }

    // echo "<script type='text/javascript'>
    //            alert('Inpass " . $inpassNo . " has been deleted')
    //             </script>";
    // echo "<script type='text/javascript'>
    //             window.location.href = 'inpassshowall.php?f=0';
    //             </script>";



    $inpassNo = $_POST['inpassNo'];
    $company = $_POST['company'];
    $woc = $_POST['woc'];
    $notes = $_POST['notes'];
    $date = $_POST['date_of_entry'];
    $opno = $_POST['opno'];
    $vehicleno = $_POST['vehicleno'];
    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }
    $sql = "DELETE FROM `inpass` WHERE no = '$inpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
    }

    $products = $_POST['products'];
    $productWonos = $_POST['product_wono'];
    $productCodes = $_POST['product_code'];
    $productDesigns = $_POST['product_design'];
    $productSizes = $_POST['product_size'];
    $productQtys = $_POST['product_qty'];
    $productOrgqtys = $_POST['product_org_qty'];

    $sql3 = "DELETE FROM `inpass_products` WHERE inpass_no = '$inpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update3 = mysqli_query($conn, $sql3);
    if (!$update3) {
        echo mysqli_error($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
        mysqli_rollback($conn);

    }
    for ($i = 0; $i < count($products); $i++) {
        $productName = $products[$i];
        $productWono = $productWonos[$i];
        $productCode = $productCodes[$i];
        $productDesign = $productDesigns[$i];
        $productSize = $productSizes[$i];
        $productQty = $productQtys[$i];
        $productOrgqty = $productOrgqtys[$i];

        //converting to lowercase
        $productName = strtolower($productName);
        $productDesign = strtolower($productDesign);
        $productSize = strtolower($productSize);

        //updating stock
            $sql8 = "Select qty from stock where item = '$productName' AND size = '$productSize' AND acof = '$woc' AND user_id = '" . (string) $loggedin_session . "'";
            $retval4 = mysqli_query($conn, $sql8);
            if (!$retval4) {
                echo "Error Occured";
                mysqli_rollback($conn);
                echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                echo "<script>alert('Some Error Occured')</script>";
                exit;
            }
            $row8 = mysqli_fetch_array($retval4);
            $oldqty = $row8[0];
            $newqty = $oldqty - $productOrgqty;
            if ($newqty < 0) {
                echo "<script>alert('Stock Error Occured,Total Stock value cannot be less than 0')</script>";
                mysqli_rollback($conn);
                exit;
            }
            $sql9 = "UPDATE stock SET qty = '$newqty' where item='$productName' AND size='$productSize' AND acof = '$woc' AND user_id = '" . (string) $loggedin_session . "'";
            $update = mysqli_query($conn, $sql9);
            if (!$update) {
                echo mysqli_error($conn);
                mysqli_rollback($conn);
                echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                echo "<script>alert('Some Error Occured')</script>";
                exit;
            }

            //updating stock data
                $qtydiff2 = abs($qtydiff);
                $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productName','$productSize','$qtydiff','$newqty','$woc','Manual','" . (string) $loggedin_session . "')";
                $update92 = mysqli_query($conn, $sql92);
                $flag_stock1 = 1;
                if (!$update92) {
                    echo mysqli_error($conn);
                    mysqli_rollback($conn);
                    echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
                    echo "<script>alert('Some Error Occured')</script>";
                    exit;
                }
        //-------------
    }

    mysqli_commit($conn);
    echo "<script type='text/javascript'>
                window.location.href = 'inpassshowall.php?f=0';
                </script>";
}

if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $pn = $_POST['product_name'];
    $cmp = $_POST['company'];
    $sz = $_POST['product_size'];
    $pc = $_POST['product_code'];
    echo "<script type='text/javascript'>
            window.location.href = 'inpassshowall.php?f=1&start=$start_date&end=$end_date&pn=$pn&cmp=$cmp&sz=$sz&pc=$pc';
            </script>";
}
?>