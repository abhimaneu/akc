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
$wno = 'All';
$p_code = 'All';
$p_type = 'All';

if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['cmp'];
    $p_name = $_GET['pn'];
    $size = $_GET['sz'];
    $wno = $_GET['wno'];
    $p_code = $_GET['pc'];
    $p_type = $_GET['pt'];
}
if (!$conn) {
    echo "Error Occured";
}

//for dropdowns
$sql2 = "SELECT dest from outpass WHERE user_id = '" . (string) $loggedin_session . "'";
$sql2 .= " GROUP BY dest";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$sql3 = "SELECT product_name from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql3 .= " GROUP BY product_name";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}
$sql4 = "SELECT product_size from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql4 .= " GROUP BY product_size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}
$sql5 = "SELECT work_order_no from outpass WHERE user_id = '" . (string) $loggedin_session . "'";
$sql5 .= " GROUP BY work_order_no";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
}
$sql6 = "SELECT product_code from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql6 .= " GROUP BY product_code";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
}
$sql7 = "SELECT product_type from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql7 .= " GROUP BY product_type";
$retval7 = mysqli_query($conn, $sql7);
if (!$retval7) {
    echo mysqli_error($conn);
}

//for table
$sql = "select * from outpass,outpass_products where outpass.no = outpass_products.outpass_no AND outpass.user_id = '" . (string) $loggedin_session . "' AND outpass_products.user_id = '" . (string) $loggedin_session . "'";

if ($company != 'All') {
    $sql .= " AND dest = '$company'";
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
if ($p_type != 'All') {
    $sql .= " AND product_type = '$p_type'";
}
if ($wno != 'All') {
    $sql .= " AND work_order_no = '$wno'";
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
<title>Outpass Generated</title>
<!-- MDB icon -->
<link rel="icon" href="img/icon.png" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
<!-- MDB -->
<link rel="stylesheet" href="css/mdb.min.css" />
</head>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        //add product field
        $("#add_product_field").click(function () {

            var productField = `
<div class="product_field mb-3">
<div class='mb-2'>
<label>Product Type</label> &nbsp;
             <select name='product_type[] id='ptype' class='product_type'>
             <option selected>Finished</option>
             <option>Rejection</option>
             <option>Replacement</option>
             <option>Transfer</option>
             </select> 
             </div>
<div class=' d-flex align-items-start bg-light mb-1 mt-4 w-25'>

<div class="form-outline mb-1 col " >
<input name="product_code[]" id='pcode' required class="product_code form-control">
<label for="pcode" class='form-label'>Product Code</label>
</div>
&nbsp;
</div>
<div class=' d-flex align-items-start bg-light mb-1 mt-4'>
<div class="form-outline mb-1 col " >
<input list="productlist" required readonly name="products[]" class="product_name form-control" id='pname'>
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
<input name="product_design[]" required readonly class="product_design form-control" id='pdes'>
<label for="pdes" class='form-label'>Design</label>
</div>
&nbsp;

<div class="form-outline mb-1 col " >
<input name="product_size[]" readonly onkeydown="if(['Space'].includes(arguments[0].code)){return false;};" required class="product_size form-control" id='psize'>
<label for="psize" class='form-label'>Size</label>
</div>
&nbsp;
<div class="form-outline mb-1 col " >
<input name="product_bundle[]" required readonly class="product_bundle form-control" id='pbun'>
<label for="pbun" class='form-label'>Bundle</label>
</div>

&nbsp;
<div class="form-outline mb-1 col " >
<input name="product_qty[]" required class="product_qty form-control" id='pqty'>
<label for="pqty" class='form-label'>Qty</label>
</div>
<input name="product_org_qty[]" type='hidden' class="product_org_qty form-control" id='poqty'>
</div>
<lead class='fw-bold'>From Stock: </lead> <br>
<div class=''>
<lead class='fs-6 fw-light pe-2'>A/C of: </lead>
<input name="productacof_stock[]" type='hidden' class='pacof_stock'>
<span class="pacofstock" name="pacof">
<caption></caption>
</span> <br>
<lead class='fs-6 pe-2 fw-light'>Name: </lead>
<input name="productname_stock[]" type='hidden' class='pname_stock'>
<span class="pnamestock" name="pn">
<caption></caption>
</span> <br>
<lead class='fs-6 pe-3 fw-light'>Size: </lead>
<input name="productsize_stock[]" type='hidden' class='psize_stock'>
<span class="psizestock" name="ps">
<caption></caption>
</span>
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

        // Handle click event on the edit button
        $('.edit-btn').click(function (e) {
            e.preventDefault(); // Prevent the default form submission



            $("#product_fields").empty();
            var outpassNo = $(this).closest('tr').find('td:eq(0)').text().trim();
            outpassNo = outpassNo.substring(0, outpassNo.indexOf('/'));
            var date = $(this).closest('tr').find('td:eq(1)').text().trim();
            var company = $(this).closest('tr').find('td:eq(2)').text().trim();
            var wono = $(this).closest('tr').find('td:eq(3)').text().trim();
            var vehicleNo = $(this).closest('tr').find('td:eq(8)').text().trim();
            var notes = $(this).closest('tr').find('td:eq(9)').text().trim();
            $.ajax({
                method: "POST",
                url: "getoutpassdatafromno.php",
                data: {
                    outpass_no: outpassNo
                },
                success: function (response) {
                    if (response === "FALSE") {
                        var message = "ERROR: something went wrong on the MYSQL side";
                        alert(message);
                    } else {
                        productData = JSON.parse(response)
                        var l = productData.length;
                        $('#outpassNo').val(outpassNo);
                        $('#date').text(date);
                        $('#date_of_entry').val(date);
                        $('#company').val(company);
                        $('#wono').val(wono);
                        $('#notes').val(notes);
                        $('#vehicleno').val(vehicleNo);
                        for (var i = 0; i < l; i++) {
                            $('#add_product_field').click();
                            var productCodeField = $(".product_field:eq(" + i + ")").find(".product_code");
                            var productTypeField = $(".product_field:eq(" + i + ")").find(".product_type");
                            var productNameField = $(".product_field:eq(" + i + ")").find(".product_name");
                            var productDesignField = $(".product_field:eq(" + i + ")").find(".product_design");
                            var productSizeField = $(".product_field:eq(" + i + ")").find(".product_size");
                            var productBundleField = $(".product_field:eq(" + i + ")").find(".product_bundle");
                            var productQtyField = $(".product_field:eq(" + i + ")").find(".product_qty");
                            var productOrgQtyField = $(".product_field:eq(" + i + ")").find(".product_org_qty");
                            var productAcofstockField = $(".product_field:eq(" + i + ")").find(".pacofstock");
                            var productNamestockField = $(".product_field:eq(" + i + ")").find(".pnamestock");
                            var productSizestockField = $(".product_field:eq(" + i + ")").find(".psizestock");
                            var producthiddenAcofstockField = $(".product_field:eq(" + i + ")").find(".pacof_stock");
                            var producthiddenNamestockField = $(".product_field:eq(" + i + ")").find(".pname_stock");
                            var producthiddenSizestockField = $(".product_field:eq(" + i + ")").find(".psize_stock");
                            productCodeField.val(productData[i].code);
                            productTypeField.val(productData[i].product_type);
                            productNameField.val(capitalizeWords(productData[i].name));
                            productDesignField.val(productData[i].design);
                            productSizeField.val(productData[i].size);
                            productBundleField.val(productData[i].bundle);
                            productQtyField.val(productData[i].qty)
                            productOrgQtyField.val(productData[i].qty)
                            productAcofstockField.text(productData[i].stock_acof);
                            productNamestockField.text(capitalizeWords(productData[i].stock_name));
                            productSizestockField.text(productData[i].stock_size);
                            producthiddenAcofstockField.val(productData[i].stock_acof);
                            producthiddenNamestockField.val(capitalizeWords(productData[i].stock_name));
                            producthiddenSizestockField.val(productData[i].stock_size);
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
        //search outpass data
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
                                            <input type="text" id="outpassNo" class="form-control" name="outpassNo"
                                                readonly>
                                            <label for="outpassNo" class='form-label'>Outpass No.</label>
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

                                <div class="row">
                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="wono" class="form-control" name="wono">
                                            <label for="wono" class='form-label'>Work Order No.</label>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="vehicleno" class="form-control" required
                                                name="vehicleno">
                                            <label for="vehicleno" class='form-label'>Vehicle No.</label>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        <div class="form-outline">
                                            <input type="text" id="notes" class="form-control" name="notes">
                                            <label for="notes" class='form-label'>Note</label>
                                        </div>
                                    </div>

                                </div>
                                <label class="mt-4">
                                    <h6>Products</h6>
                                </label> <br>
                                
                                <div id="product_fields" class='row border border-1 border-primary rounded pt-2 mb-2'>

                                </div>
                                <button type="button" style="display: none;" id="add_product_field"
                                    class="btn btn-outline-secondary" data-mdb-ripple-color="dark">Add
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
        <h1 class="mt-2 ms-4">Outpass</h1>
        <div class="container-fluid">
            <div class='row justify-content'>
                <div class="col">
                    <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                        <h4 class='mb-4'>Filter</h4>
                        <div class="row ms-1 justify-content w-50">
                            <div class="form-outline col">
                                <input type="date" class="form-control" value="<?php echo $start; ?>" id='start'
                                    required name="start">
                                <label for="start" class='form-label'>Start</label>
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
                            <label>Work Order No.</label>
                            <select name='workorderno'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval5, 0);
                                while ($row = mysqli_fetch_assoc($retval5)) {
                                    echo "
            <option>{$row['work_order_no']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
                            <label>Dest. Company</label>
                            <select name='company'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval2, 0);
                                while ($row = mysqli_fetch_assoc($retval2)) {
                                    echo "
            <option>{$row['dest']}</option>
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
            <option> " . ucwords($row['product_name']) . "</option>
            ";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col mt-4 mb-4 ms-1">
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
                            </select>
                            &nbsp;
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
                            &nbsp;
                            <label>Product Type</label>
                            <select name='product_type'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval7, 0);
                                while ($row = mysqli_fetch_assoc($retval7)) {
                                    echo "
            <option>{$row['product_type']}</option>
            ";
                                }
                                ?>
                            </select>
                        </div>
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
                <table class="table table-sm">
                    <thead class="table-light sticky-top">
                        <th>
                            Outpass No.
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Destination Company
                        </th>
                        <th>
                            Work Order No.
                        </th>
                        <th>
                            Product Desc.
                        </th>
                        <th>
                            Product Bundle
                        </th>
                        <th>
                            Product Desp. Quantity
                        </th>
                        <th>
                            Product Type
                        </th>
                        <th>
                            Vehicle No.
                        </th>
                        <th>
                            Note
                        </th>
                        <th>
                            Outpass PDF
                        </th>
                        <th>

                        </th>
                    </thead>
                    <tbody id='tablebody'>
                        <tr>
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
                                $outpass_short_date = '';
                                if (date('n', $time) > 4) {
                                    $temp_date = date('y', $time);
                                    $outpass_short_date = $temp_date . ($temp_date + 1);
                                } else {
                                    $temp_date = date('y', $time);
                                    $outpass_short_date = ($temp_date - 1) . $temp_date;
                                }
                                if (!empty($row)) {
                                    echo "
                    <tr class='$table_active'>
                    <td>
                    {$row['no']}/" . $outpass_short_date . "
                    </td>
                    <td>
                    {$row['date']}
                    </td>
                    <td>
                    {$row['dest']}
                    </td>
                    <td>
                    {$row['work_order']}
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
                    {$row['product_bundle']}
                    </td>
                    <td>
                    {$row['product_qty']}
                    </td>
                    <td>
                    {$row['product_type']}
                    </td>
                    <td>
                    {$row['vehicleno']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                    <td>
                    <a href='createpdfpass.php?no={$row['no']}&io=outpass' target='_blank'>Download</a>
                    </td>
                    <td>
                    <input type='submit' data-mdb-toggle='modal' data-mdb-target='#editPopup' id='{$row['outpass_no']}' class='edit-btn btn btn-sm shadow-0 btn-primary' name='edit' value='Edit'>
                    </td>
                    ";
                                    $cur_no = $row['no'];
                                }
                            }
                            ?>
                        </tr>
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
    $outpassNo = $_POST['outpassNo'];
    $company = $_POST['company'];
    $wono = $_POST['wono'];
    $notes = $_POST['notes'];
    $date = $_POST['date_of_entry'];
    $vehicleno = $_POST['vehicleno'];
    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }
    $sql = "UPDATE `outpass` SET `dest`='$company',`work_order_no`='$wono',`vehicleno`='$vehicleno',`extras`='$notes' WHERE no = '$outpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
    }

    $products = $_POST['products'];
    $productCodes = $_POST['product_code'];
    $productTypes = $_POST['product_type'];
    $productDesigns = $_POST['product_design'];
    $productSizes = $_POST['product_size'];
    $productBundles = $_POST['product_bundle'];
    $productQtys = $_POST['product_qty'];
    $productOrgqtys = $_POST['product_org_qty'];
    $productAcofStocks = $_POST['productacof_stock'];
    $productNameStocks = $_POST['productname_stock'];
    $productSizeStocks = $_POST['productsize_stock'];

    $sql3 = "DELETE FROM `outpass_products` WHERE outpass_no = '$outpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update3 = mysqli_query($conn, $sql3);
    if (!$update3) {
        echo mysqli_error($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
        mysqli_rollback($conn);

    }
    for ($i = 0; $i < count($products); $i++) {
        $productName = $products[$i];
        $productType = $productTypes[$i];
        $productCode = $productCodes[$i];
        $productDesign = $productDesigns[$i];
        $productSize = $productSizes[$i];
        $productBundle = $productBundles[$i];
        $productQty = $productQtys[$i];
        $productOrgqty = $productOrgqtys[$i];
        $productAcofStock = $productAcofStocks[$i];
        $productNameStock = $productNameStocks[$i];
        $productSizeStock = $productSizeStocks[$i];


        //converting to lowercase
        $productName = strtolower($productName);
        $productDesign = strtolower($productDesign);
        $productSize = strtolower($productSize);

        $productNameStock = strtolower(($productNameStock));

        $qtydiff = $productOrgqty - $productQty;

        //updating stock
        $sql8 = "Select qty from stock where item = '$productNameStock' AND size = '$productSizeStock' AND acof = '$productAcofStock' AND user_id = '" . (string) $loggedin_session . "'";
        $retval4 = mysqli_query($conn, $sql8);
        if (!$retval4) {
            echo "Error Occured";
            mysqli_rollback($conn);
            echo "<script type='text/javascript'>
            window.location.href = 'outpassshowall.php?f=0';
            </script>";
            echo "<script>alert('Some Error Occured')</script>";
            exit;
        }
        $row8 = mysqli_fetch_array($retval4);
        $oldqty = $row8[0];
        $newqty = $oldqty + $qtydiff;
        if ($newqty < 0) {
            echo "<script>alert('Stock Error Occured,Check Stock and Try Again!')</script>";
            mysqli_rollback($conn);
            exit;
        }
        $sql9 = "UPDATE stock SET qty = '$newqty' where item='$productNameStock' AND size='$productSizeStock' AND acof = '$productAcofStock' AND user_id = '" . (string) $loggedin_session . "'";
        $update = mysqli_query($conn, $sql9);
        if (!$update) {
            echo mysqli_error($conn);
            mysqli_rollback($conn);
            echo "<script type='text/javascript'>
                window.location.href = 'outpassshowall.php?f=0';
                </script>";
            echo "<script>alert('Some Error Occured')</script>";
            exit;
        }
        if ($qtydiff != 0) {
            $qtydiff2 = abs($qtydiff);
            $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productNameStock','$productSizeStock','$qtydiff','$newqty','$productAcofStock','Manual','" . (string) $loggedin_session . "')";
            $update92 = mysqli_query($conn, $sql92);
            $flag_stock1 = 1;
            if (!$update92) {
                echo mysqli_error($conn);
                mysqli_rollback($conn);
                echo "<script type='text/javascript'>
            window.location.href = 'outpasshowall.php?f=0';
            </script>";
                echo "<script>alert('Some Error Occured')</script>";
                exit;
            }
        }

        $sql2 = "INSERT INTO outpass_products(outpass_no,date_of_entry,product_type,product_name,work_order,product_code,product_design,product_size,product_bundle,product_qty,stock_acof,stock_name,stock_size,user_id) VALUES ('$outpassNo','$date','$productType','$productName','$wono','$productCode','$productDesign','$productSize','$productBundle','$productQty','$productAcofStock','$productNameStock','$productSizeStock','" . (string) $loggedin_session . "')";
        $update2 = mysqli_query($conn, $sql2);
        if (!$update2) {
            echo mysqli_error($conn);
            echo "<script>alert('Error Occured Aborting!')</script>";
            mysqli_rollback($conn);
            exit;
        }
    }

    mysqli_commit($conn);
    echo "<script type='text/javascript'>
                window.location.href = 'outpassshowall.php?f=0';
                </script>";
}

if (isset($_POST['delete'])) {
    $outpassNo = $_POST['outpassNo'];
    $company = $_POST['company'];
    $wono = $_POST['wono'];
    $notes = $_POST['notes'];
    $date = $_POST['date_of_entry'];
    $vehicleno = $_POST['vehicleno'];
    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }

    $sql3 = "DELETE FROM `outpass` WHERE no = '$outpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update3 = mysqli_query($conn, $sql3);
    if (!$update3) {
        echo mysqli_error($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
        mysqli_rollback($conn);

    }
    

    $products = $_POST['products'];
    $productCodes = $_POST['product_code'];
    $productTypes = $_POST['product_type'];
    $productDesigns = $_POST['product_design'];
    $productSizes = $_POST['product_size'];
    $productBundles = $_POST['product_bundle'];
    $productQtys = $_POST['product_qty'];
    $productOrgqtys = $_POST['product_org_qty'];
    $productAcofStocks = $_POST['productacof_stock'];
    $productNameStocks = $_POST['productname_stock'];
    $productSizeStocks = $_POST['productsize_stock'];

    $sql3 = "DELETE FROM `outpass_products` WHERE outpass_no = '$outpassNo' AND user_id = '" . (string) $loggedin_session . "'";
    $update3 = mysqli_query($conn, $sql3);
    if (!$update3) {
        echo mysqli_error($conn);
        echo "<script>alert('Error Occured Aborting!')</script>";
        mysqli_rollback($conn);

    }
    for ($i = 0; $i < count($products); $i++) {
        $productName = $products[$i];
        $productType = $productTypes[$i];
        $productCode = $productCodes[$i];
        $productDesign = $productDesigns[$i];
        $productSize = $productSizes[$i];
        $productBundle = $productBundles[$i];
        $productQty = $productQtys[$i];
        $productOrgqty = $productOrgqtys[$i];
        $productAcofStock = $productAcofStocks[$i];
        $productNameStock = $productNameStocks[$i];
        $productSizeStock = $productSizeStocks[$i];

        //converting to lowercase
        $productName = strtolower($productName);
        $productDesign = strtolower($productDesign);
        $productSize = strtolower($productSize);

        $productNameStock = strtolower($productNameStock);

        $qtydiff = $productQty - $productOrgqty;

        //updating stock
        $sql8 = "Select qty from stock where item = '$productNameStock' AND size = '$productSizeStock' AND acof = '$productAcofStock' AND user_id = '" . (string) $loggedin_session . "'";
        $retval4 = mysqli_query($conn, $sql8);
        if (!$retval4) {
            echo mysqli_error($conn);
            mysqli_rollback($conn);
            echo "<script type='text/javascript'>
            window.location.href = 'outpassshowall.php?f=0';
            </script>";
            echo "<script>alert('Some Error Occured')</script>";
            exit;
        }
        $row8 = mysqli_fetch_array($retval4);
        $oldqty = $row8[0];
        $newqty = $oldqty + $productOrgqty;
        if ($newqty < 0) {
            echo mysqli_error($conn);
            echo "<script>alert('Stock Error Occured,Check Stock and Try Again!')</script>";
            mysqli_rollback($conn);
            exit;
        }
        $sql9 = "UPDATE stock SET qty = '$newqty' where item='$productNameStock' AND size='$productSizeStock' AND acof = '$productAcofStock' AND user_id = '" . (string) $loggedin_session . "'";
        $update = mysqli_query($conn, $sql9);
        if (!$update) {
            echo mysqli_error($conn);
            mysqli_rollback($conn);
            echo "<script type='text/javascript'>
            window.location.href = 'outpassshowall.php?f=0';
            </script>";
            echo "<script>alert('Some Error Occured')</script>";
            exit;
        }
        //updating stock data
        $qtydiff2 = abs($qtydiff);
        $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productNameStock','$productSizeStock','$qtydiff','$newqty','$productAcofStock','Manual','" . (string) $loggedin_session . "')";
        $update92 = mysqli_query($conn, $sql92);
        $flag_stock1 = 1;
        if (!$update92) {
            echo mysqli_error($conn);
            mysqli_rollback($conn);
            echo "<script type='text/javascript'>
        window.location.href = 'outpassshowall.php?f=0';
        </script>";
            echo "<script>alert('Some Error Occured')</script>";
            exit;
        }
        //---------------------
    }

    mysqli_commit($conn);

    echo "<script type='text/javascript'>
               alert('Outpass " . $outpassNo . " has been deleted')
                </script>";
    echo "<script type='text/javascript'>
                window.location.href = 'outpassshowall.php?f=0';
                </script>";
}

if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $pn = $_POST['product_name'];
    $cmp = $_POST['company'];
    $sz = $_POST['product_size'];
    $wno = $_POST['workorderno'];
    $pc = $_POST['product_code'];
    $pt = $_POST['product_type'];

    echo "<script type='text/javascript'>
            window.location.href = 'outpassshowall.php?f=1&start=$start_date&end=$end_date&pn=$pn&cmp=$cmp&sz=$sz&wno=$wno&pc=$pc&pt=$pt';
            </script>";
}
?>