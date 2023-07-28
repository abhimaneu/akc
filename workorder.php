<?php
include 'conn.php';
include 'nav.php';
?>


<?php

$msgcolor = 'text-danger';
if (isset($_GET['f'])) {
    $f = $_GET['f'];
    if ($f == 's') {
        $msg = "Work Order Succesfully Generated";
        $msgcolor = 'text-success';
    } else {
        $msg = "Error Occured... Could Not Complete the Process";
    }
}

//fetch company data for dropdown
$sql2 = "Select * from company WHERE user_id = '" . (string) $loggedin_session . "'";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
    die($conn);
}
//fetch product data for company_products
$sql = "Select * from company_products WHERE user_id = '" . (string) $loggedin_session . "'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}
//fetch workorder data for table
$sql4 = "select * from work_orders,work_order_products where work_orders.work_order_no = work_order_products.work_order_no AND work_orders.user_id = '" . (string) $loggedin_session . "' AND work_order_products.user_id = '" . (string) $loggedin_session . "' order by timestamp desc LIMIT 5";
$retval3 = mysqli_query($conn, $sql4);
if (!$retval3) {
    echo mysqli_error($conn);
    die($conn);
}

//fetch workorders data for wno
$sql5 = "Select work_order_no from work_orders WHERE user_id = '" . (string) $loggedin_session . "'";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
    die($conn);
}
$exist_wnos = array();
$i = 0;
while ($row = mysqli_fetch_assoc($retval5)) {
    $exist_wnos[$i] = $row['work_order_no'];
    $i += 1;
}
?>

<html>

<title>Work Orders</title>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {

        $(function () {
            $('#add_product_field').click();
        });

        //check if outpass exist
        $('#workorderno').on('keyup', function () {
            var user_wno = $(this).val();
            var exist_wnos = <?php echo json_encode($exist_wnos); ?>;
            if (exist_wnos.includes(user_wno)) {
                $('#error_no').html("<h1 class='fs-6 pt-1 fw-normal text-danger'>&nbsp;Work Order Already Exists</h1>");
            }
            else {
                $('#error_no').html("");
            }
            initilizebootstrap();
        });


        //for Product Data
        $(document).on("change", ".product_code", function () {
            var productCode = $(this).val();
            var productNameField = $(this).closest(".product_field").find(".product_name");
            var productDesignField = $(this).closest(".product_field").find(".product_design");
            var productSizeField = $(this).closest(".product_field").find(".product_size");


            $.ajax({
                method: "POST",
                url: "getcompanyproductdata.php",
                data: {
                    product_code: productCode
                },
                success: function (response) {
                    if (response === "FALSE") {
                        var message = "ERROR: something went wrong on the MYSQL side";
                        alert(message);
                    } else {
                        var productData = JSON.parse(response);

                        if (productData) {
                            product = productData[0]
                            productNameField.val(product.name)
                            productDesignField.val(product.design)
                            productSizeField.val(product.size)
                            initilizebootstrap();
                        }
                    }
                    initilizebootstrap();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                    alert(message);
                }
            });
        });

        // Add product field
        $("#add_product_field").click(function () {
            var productField = `
        <div class="product_field mb-3">

        <div class=' d-flex align-items-start bg-light mb-1 w-25'>
        <div class="form-outline mb-1 col " >
          <input list="productcodelist" id='pcode' required name="product_code[]" class="product_code form-control">
          <datalist id="productcodelist">
          <?php
          while ($row = mysqli_fetch_assoc($retval)) {
              echo "<option>{$row['code']}";
          }
          ?>
            </datalist>
            <label for='pcode' class='form-label'>Product Code</label>
            </div>
            </div>

            <div class=' d-flex align-items-start bg-light mb-1'>

            <div class="form-outline mb-1 col ">
          <input list="productlist" id='pname' required name="products[]" class="product_name form-control">
          <datalist id="productlist">
                
            </datalist>
            <label for='pname' class='form-label'>Product Name</label>
         </div>
         &nbsp;
         <div class="form-outline mb-1 col ">
          <input name="product_design[]" id='pdes' required class="product_design form-control">
          <label for="pdes" class='form-label'>Design</label>
        </div>
        &nbsp;
        <div class="form-outline mb-1 col ">
          <input name="product_size[]" id='psize' required  onkeydown="if(['Space'].includes(arguments[0].code)){return false;};" class="product_size form-control">
          <label for="psize" class='form-label'>Size</label>
        </div>
        &nbsp;
          
        </div>
        <div class=' d-flex align-items-start bg-light mb-1 w-25'>
            <div class="form-outline mb-1 col ">
          <input type='number' name="product_qty[]" id='pqty' required class="product_qty form-control">
          <label for="pqty" class='form-label'>Req. Qty</label>
          </div>
          </div>
          
          <button type="button" class="remove_product_field btn btn-outline-danger" data-mdb-ripple-color="dark">Remove</button>
          <br> <br>
        </div>
      `;

            $("#product_fields").append(productField);
            initilizebootstrap();
        });

        // Remove product field
        $(document).on("click", ".remove_product_field", function () {
            $(this).parent(".product_field").remove();
        });
    });

    //Set Today Date
    $(document).ready(function () {
        var now = new Date();
        var month = (now.getMonth() + 1);
        var day = now.getDate();
        if (month < 10)
            month = "0" + month;
        if (day < 10)
            day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day;
        $('#date').val(today);
        initilizebootstrap();
    });
</script>

<body>
    <main>
        <br>
        <h1 class='mt-2 ms-4'>Generate Work Order</h1>
        <div class="container">
            <div class='row justify-content'>
                <div class="col-xl-10">
                    <h1 class='fs-6 text-center <?php echo $msgcolor; ?>'><?php echo $msg; ?></h1>
                    <br>
                    <form name='work_orders' class="bg-white rounded-5 shadow-5-strong p-5" method="POST">
                        <h4>Enter Details Below</h4> <br>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-outline">

                                    <input type="text" id="workorderno" class="form-control" required
                                        name='work_order_no'>
                                    <label for='workorderno' class='form-label'>Work Order No.</label>
                                </div>
                                <div id='error_no'></div>
                                <div class='mb-4'></div>
                            </div>
                            <div class="col">
                                <div class="form-outline datepicker">
                                    <input type="date" id='date' class="form-control" required name='date'>
                                    <label for='date' class='form-label'>Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input list='companylist' id='cname' class="form-control" required type="text"
                                        name='company_name'>
                                    <datalist id="companylist">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($retval2)) {
                                            echo "<option>{$row['name']}";
                                        }
                                        ?>
                                    </datalist>
                                    <label for='cname' class='form-label'>Dest. Company</label>
                                </div>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                        <label class="form-check-label">
                            <h5>Products</h5>
                        </label> <br>
                        <div id='product_fields' class='row  border border-1 border-primary rounded pt-2 mb-2'>

                        </div>
                        <button type="button" id="add_product_field" class="btn btn-outline-secondary"
                            data-mdb-ripple-color="dark">Add Product</button> <br>
                        <div class="form-outline mb-4 mt-4">
                            <textarea name='extras' id='extras' class='form-control'></textarea>
                            <label for='extras' class='form-label'>Extras</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="work_orders">Generate Work
                            Order</button>
                    </form> <br>
                </div>
                <?php
                if (isset($_POST['work_orders'])) {
                    $wno = "";
                    $date = "";
                    $company_name = "";
                    $extras = "";
                    $wno = $_POST['work_order_no'];
                    $date = $_POST['date'];
                    $company_name = $_POST['company_name'];
                    $extras = $_POST['extras'];
                    
                    if (!$conn) {
                    }
                    $tran = 'START TRANSACTION';
                    $transtart = mysqli_query($conn, $tran);
                    if (!$transtart) {
                        echo mysqli_error($conn);
                    }
                    $sql = "INSERT INTO work_orders(work_order_no,date,company,extras,user_id) VALUES ('$wno','$date','$company_name','$extras','" . (string) $loggedin_session . "')";
                    //$sql2 = "INSERT INTO company(name,code) VALUES ('$source','$woc')";
                    $insert = mysqli_query($conn, $sql);
                    if (!$insert) {
                        echo mysqli_error($conn);
                        mysqli_rollback($conn);
                        echo "<script type='text/javascript'>
                        window.location.href = 'workorder.php?f=e1';
                        </script>";
                        exit;
                    } else {
                        echo "sucess";
                    }
                    // $result = mysqli_query($conn, "SELECT name FROM company WHERE name = '$source'");
                    // if ($result->num_rows == 0) {
                    //     $insert2 = mysqli_query($conn, $sql2);
                    // }
                    $products = $_POST['products'];
                    $productCodes = $_POST['product_code'];
                    $productDeisgns = $_POST['product_design'];
                    $productSizes = $_POST['product_size'];
                    $productQtys = $_POST['product_qty'];

                    for ($i = 0; $i < count($products); $i++) {
                        $productName = $products[$i];
                        $productCode = $productCodes[$i];
                        $productDesign = $productDeisgns[$i];
                        $productSize = $productSizes[$i];
                        $productQty = $productQtys[$i];

                        //converting to lowercase
                        $productName = strtolower($productName);
                        $productDesign = strtolower($productDesign);
                        $productSize = strtolower($productSize);

                        $sql7 = "INSERT INTO work_order_products(work_order_no,date_of_entry,code,name,design,size,org_qty,qty,user_id) VALUES ('$wno','$date','$productCode','$productName','$productDesign','$productSize','$productQty','$productQty','" . (string) $loggedin_session . "')";
                        $insert2 = mysqli_query($conn, $sql7);
                        if (!$insert2) {
                            echo mysqli_error($conn);
                            mysqli_rollback($conn);
                            echo "<script type='text/javascript'>
                            window.location.href = 'workorder.php?f=e2';
                            </script>";
                            exit;
                        }
                    }
                    mysqli_commit($conn);
                    echo "<script type='text/javascript'>
        window.location.href = 'workorder.php?f=s';
        </script>";
                }
                ?>

            </div>
        </div>
        <div class="container mt-4 ms-2">
            <div class="col">
                <h1>Work Orders Generated <a href="workordershowall.php?f=0" class="fs-5" target="_blank">Show All</a>
                </h1>
            </div>
        </div>

        <div class="container-fluid mt-2 p-2 bg-white rounded-5 shadow-5-strong">
            <table class='table'>
                <thead class="table-light">
                    <th>
                        Work Order No.
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Company Name
                    </th>
                    <th>
                        Product Description/Size
                    </th>
                    <th>
                        Product Quantity
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Extras
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $cur_no = -1;
                        $table_active = '';
                        while ($row = $retval3->fetch_assoc()) {
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
            &nbsp;
            " . ucwords($row['name']) . "
            &nbsp;
            " . ucwords($row['design']) . "
            &nbsp;
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
            </tr>
            ";
                                $cur_no = $row['work_order_no'];
                            }
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
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
    </main>
</body>

</html>