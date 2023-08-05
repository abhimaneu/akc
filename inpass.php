<?php
include 'conn.php';
include 'nav.php';
?>

<?php
if (!$conn) {
    echo "Error Occured";
}

$msgcolor = 'text-danger';
if (isset($_GET['f'])) {
    $f = $_GET['f'];
    if ($f == 's') {
        $msg = "Inpass Succesfully Generated";
        $msgcolor = 'text-success';
    } else {
        $msg = "Error Occured... Could Not Complete the Process";
    }
}

//fetch product data for dropdown
$sql = "Select * from products WHERE user_id = '" . (string) $loggedin_session . "'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}

//fetch company data for dropdown
$sql = "Select * from company WHERE user_id = '" . (string) $loggedin_session . "'";
$retval2 = mysqli_query($conn, $sql);
if (!$retval2) {
    echo mysqli_error($conn);
    die($conn);
}

// //fetch inpass data for table
// $sql3 = "Select * from inpass WHERE user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
// $retval3 = mysqli_query($conn, $sql3);
// if (!$retval3) {
//     echo mysqli_error($conn);
//     die($conn);
// }

//fetch inpass data for table
$sql4 = "select * from inpass,inpass_products where inpass.no = inpass_products.inpass_no AND inpass.user_id = '" . (string) $loggedin_session . "' AND inpass_products.user_id='" . (string) $loggedin_session . "' order by timestamp DESC LIMIT 5";
$retval3 = mysqli_query($conn, $sql4);
if (!$retval3) {
    echo mysqli_error($conn);
    die($conn);
}


//fetch inpass data for ipno
$sql4 = "Select no from inpass";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
    die($conn);
}
$exist_ipnos = array();
$i = 0;
while ($row = mysqli_fetch_assoc($retval4)) {
    $exist_ipnos[$i] = $row['no'];
    $i += 1;
}



?>


<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Inpass</title>
    <!-- MDB icon -->
    <!-- <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" /> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />




    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <script>

        function capitalizeWords(str) {
            return str.replace(/\b\w/g, (c) => c.toUpperCase());
        }

        $(document).ready(function () {

            $(function () {
                $('#watchButton').click();
                $('#add_product_field').click();
            });
            //for Company Code
            $("#source_name").on("change", function () { //use an appropriate event handler here
                $.ajax({
                    method: "POST",
                    url: "getcompanyid.php",
                    data: {
                        source_name: $("#source_name").val(),
                    },
                    success: function (response) {
                        if (response == "FALSE") {
                            var message = "ERROR: something went wrong on the MYSQL side";
                            alert(message);
                        } else {
                            //$("#company_code").val(response);
                            initilizebootstrap();

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                        alert(message);
                    }
                });
            });


            $('#ipno').trigger('click');
            initilizebootstrap();

            //check if inpass exist
            $('#ipno').on('keyup', function () {
                var user_ipno = $(this).val();
                var exist_ipnos = <?php echo json_encode($exist_ipnos); ?>;
                if (exist_ipnos.includes(user_ipno)) {
                    $('#error_no').html("<h1 class='fs-6 pt-1 fw-normal text-danger'>&nbsp;Inpass No. Already Exists</h1>");
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
                    url: "getproductdata.php",
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
                                productNameField.val(capitalizeWords(product.name))
                                productDesignField.val(capitalizeWords(product.design))
                                productSizeField.val(product.size)
                                initilizebootstrap();
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                        alert(message);
                    }
                });
            });


        });

        $(document).ready(function () {
            // Add product field
            $("#add_extras_field").click(function () {
                var extrasfield = `<div class='extras_field p-4 pt-1'>
                <div class='form-text d-flex justify-content-end pb-2'>Remember Not to Add Products With Extras</div>
                <div class='col p-2'>
                <div class="form-outline">
                    <textarea class="form-control" id="extras_name_field" name='extras_name_field' rows="4"></textarea>
                        <label class="form-label" for="extras_name_field">Extras Name</label>
                </div>
                </div>
                <div class='col p-2'>
                <div class="form-outline">
                    <input type='text' class="form-control" id="extras_qty_field" name='extras_qty_field'>
                        <label class="form-label" for="extras_qty_field">Extras Qty</label>
                        </div>
                </div>
                </div>`
                $("#product_fields").html(extrasfield);
                $("#add_product_field").prop('disabled', true)
                initilizebootstrap();
            })
        })

        //Adding Product Field
        $(document).ready(function () {
            // Add product field
            $("#add_product_field").click(function () {
                var productField = `
        <div class="product_field mb-3">
        <div class=' d-flex align-items-start bg-light mb-1 w-50'>
        
        <div class="form-outline mb-1 col " >
          <input type="text" list="supplynolist" id='pcode' required name="product_code[]" class="product_code form-control">
          <datalist id="supplynolist">
                <?php
                while ($row = mysqli_fetch_assoc($retval)) {
                    echo "<option>{$row['code']}";
                }
                ?>
            </datalist>
            <label for="productcode" class="form-label">Product Code</label>
            </div>

            &nbsp;
         <div class="form-outline mb-1 col">
          <input name="product_wono[]" required class="product_wono form-control">
          <label for="product_wono" class="form-label">WO#</label>
        </div>
        &nbsp;

            </div>
            <div class=' d-flex align-items-start bg-light mb-1'>

            <div class="form-outline mb-1 col ">
          
          <input list="productlist" id='pname' required name="products[]" class="product_name form-control">
          <datalist id="productlist">
               
            </datalist>
            <label for='pname' class="form-label">Product Name</label>
         </div>
      &nbsp;
         <div class="form-outline mb-1 col">
          <input name="product_design[]"required class="product_design form-control">
          <label for="product_design" class="form-label">Design</label>
        </div>
        &nbsp;
        <div class="form-outline mb-1 col">
          <input name="product_size[]" onkeydown="if(['Space'].includes(arguments[0].code)){return false;};" required class="product_size form-control">
          <label for="product_size" class='form-label'>Size</label>
        </div>
        &nbsp;

        
        <div class="form-outline mb-1 col">
          <input type='number' name="product_qty[]" required class="product_qty form-control">
          <label for="product_qty" class='form-label'>Accp. Qty</label>
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
            $('#today_date').val(today);
            initilizebootstrap();
        });
    </script>

    <style>
        body {
            background-color: white;
        }
    </style>
</head>

<body>
    <main>
        <br>
        <h1 class='mt-2 ms-4'>Generate Inpass</h1>
        <div class="container">
            <div class='row justify-content'>
                <div class="col-xl-10">
                    <h1 class='fs-6 text-center <?php echo $msgcolor; ?>'><?php echo $msg; ?></h1>
                    <div class='text-center' id='confirm_msg'></div>
                    <br>
                    <form name="ip" class="bg-white rounded-5 shadow-5-strong p-5" method="post" action="">
                        <h4>Enter Details Below</h4> <br>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-outline mb-0">
                                    <input type="text" id='ipno' class="form-control" name="ipno">
                                    <label for="ipno" class="form-label">Inpass No.</label>
                                </div>
                                <div id="textExample1" class="form-text">
                                    &nbsp;Leave Empty for Auto-Generation
                                </div>
                                <div id='error_no'></div>
                                <div class='mb-4'></div>
                            </div>
                            <div class="col">
                                <div class="form-outline datepicker">
                                    <input type="date" class="form-control" required name="date" id="today_date">
                                    <label for="roday_date" class="form-label">Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input list="companylist" class="form-control" required name="source"
                                        id="source_name">
                                    <datalist id="companylist">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($retval2)) {
                                            echo "<option>{$row['name']}";
                                        }
                                        ?>
                                    </datalist>
                                    <label class="form-label">Source Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="text" class="form-control" required name="acof"
                                                id="company_code">
                                            <label for="acof" class="form-label">A/C of</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-outline mb-4 ">
                                    <input type="text" class="form-control" required name="opno">
                                    <label for="opno" class="form-label">OP#</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input type="text" class="form-control" required name="vehicle">
                                    <label for="vehicle" class="form-label">Vehicle No.</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input add_extras_field" name='add_extras' type="checkbox"
                                id="add_extras_field" />
                            <label class="form-check-label" for="add_extras_field">Add Extras</label>
                        </div>
                        <br>
                        <label class="form-check-label">
                            <h5>Products</h5>
                        </label> <br>
                        <div id="product_fields" class="row border border-1 border-primary rounded pt-2 mb-2">

                        </div>


                        <button type="button" id="add_product_field" class="btn btn-outline-secondary"
                            data-mdb-ripple-color="dark">Add Product</button>



                        <br>

                        <div class="form-outline mb-4 mt-4">
                            <textarea id="extras" class="form-control" name="extras"></textarea>
                            <label for="extras" class="form-label">Note</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="ip">Generate InPass</button>
                    </form>
                </div>
                <br><br>
                <?php
                if (isset($_POST['ip'])) {
                    $add_extras = 0;
                    $ipno = "";
                    $date = "";
                    $source = "";
                    $acof = "";
                    
                    $op = "";
                    $vehicle = "";
                    $p_name = "";
                    $p_code = "";
                    $p_bundle = "";
                    $extras = "";
                    $ipno = $_POST['ipno'];
                    $date = $_POST['date'];
                    $source = $_POST['source'];
                    $acof = $_POST['acof'];
                    
                    $op = $_POST['opno'];
                    $vehicle = $_POST['vehicle'];



                    // $p_name = $_POST['products'];
                    // $p_code = $_POST['product_code'];
                    // $p_design = $_POST['product_design'];
                    $extras = $_POST['extras'];

                    if (!$conn) {
                    }


                    $tran = 'START TRANSACTION';
                    $transtart = mysqli_query($conn, $tran);
                    if (!$transtart) {
                        echo mysqli_error($conn);
                    }
                    $inpass_flag = 0;
                    if (!$ipno) {
                        $sql00 = "SELECT inpass_count FROM profile WHERE user_id='" . (string) $loggedin_session . "'";
                        $result = mysqli_query($conn, $sql00);
                        if (!$result) {
                            echo mysqli_error($conn);
                            mysqli_rollback($conn);
                            echo "<script type='text/javascript'>
                        window.location.href = 'inpass.php?f=e7';
                        </script>";
                            echo "<script>alert('Some Error Occured')</script>";
                            exit;
                        }
                        $retipno = mysqli_fetch_assoc($result);
                        $ipno = $retipno['inpass_count'];
                        $inpass_flag = 1;
                    }

                    //converting to uppercase
                    $vehicle = strtoupper($vehicle);

                    //ADDING EXTRAS
                    if (isset($_POST['add_extras'])) {

                        $add_extras = 1;
                        $extras_name = $_POST['extras_name_field'];
                        $extras_qty = $_POST['extras_qty_field'];
                        $sql = "INSERT INTO inpass(no,date,source,woc,op,vehicleno,extras,user_id) VALUES ('$ipno','$date','$source','$acof','$op','$vehicle','$extras','" . (string) $loggedin_session . "')";
                        $insert9 = mysqli_query($conn, $sql);
                        if (!$insert9) {
                            echo mysqli_error($conn);
                            mysqli_rollback($conn);
                            echo "<script type='text/javascript'>
                        window.location.href = 'inpass.php?f=e1';
                        </script>";
                            echo "<script>alert('Some Error Occured')</script>";
                            exit;
                        }

                        $sql4 = "INSERT INTO inpass_products(inpass_no,date_of_entry,product_wono,product_name,product_code,product_design,product_size,product_qty,user_id) VALUES ('$ipno','$date',' ','$extras_name',' ',' ',' ','$extras_qty','" . (string) $loggedin_session . "')";
                        $insert10 = mysqli_query($conn, $sql4);
                        if (!$insert10) {
                            echo mysqli_error($conn);
                            echo "Error Occured";
                            mysqli_rollback($conn);
                            echo "<script type='text/javascript'>
                            window.location.href = 'inpass.php?f=e5';
                            </script>";
                            echo "<script>alert('Some Error Occured')</script>";
                            exit;
                        }

                        if ($inpass_flag == 1) {
                            $sql01 = "UPDATE profile SET inpass_count = inpass_count + 1 where user_id='" . (string) $loggedin_session . "'";
                            $updipno = mysqli_query($conn, $sql01);
                            if (!$updipno) {
                                echo mysqli_error($conn);
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e8';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                        }
                        mysqli_commit($conn);
                        echo "<script type='text/javascript'>
                window.open('createpdfpass.php?no=$ipno&io=inpass');
                </script>";
                        echo "<script type='text/javascript'>
                window.location.href = 'inpass.php?f=s';
                </script>";
                        exit;
                    }


                    $sql = "INSERT INTO inpass(no,date,source,woc,op,vehicleno,extras,user_id) VALUES ('$ipno','$date','$source','$acof','$op','$vehicle','$extras','" . (string) $loggedin_session . "')";
                    $sql2 = "INSERT INTO company(name,code,user_id) VALUES ('$source','$acof','" . (string) $loggedin_session . "')";
                    $insert = mysqli_query($conn, $sql);
                    if (!$insert) {
                        echo mysqli_error($conn);
                        mysqli_rollback($conn);
                        echo "<script type='text/javascript'>
                        window.location.href = 'inpass.php?f=e1';
                        </script>";
                        echo "<script>alert('Some Error Occured')</script>";
                        exit;
                    }
                    $result = mysqli_query($conn, "SELECT name FROM company WHERE name = '$source' AND user_id = '" . (string) $loggedin_session . "'");
                    if ($result->num_rows == 0) {
                        $insert2 = mysqli_query($conn, $sql2);
                    }
                    $ino = "";
                    $products = $_POST['products'];
                    $productCodes = $_POST['product_code'];
                    $productWonos = $_POST['product_wono'];
                    $productDeisgns = $_POST['product_design'];
                    $productSizes = $_POST['product_size'];
                    $productQtys = $_POST['product_qty'];

                    for ($i = 0; $i < count($products); $i++) {
                        $productName = $products[$i];
                        $productCode = $productCodes[$i];
                        $productWono = $productWonos[$i];
                        $productDesign = $productDeisgns[$i];
                        $productSize = $productSizes[$i];
                        $productQty = $productQtys[$i];

                        //converting to lowercase
                        $productName = strtolower($productName);
                        $productDesign = strtolower($productDesign);
                        $productSize = strtolower($productSize);

                        $sql7 = "INSERT INTO stock(item,design,size,qty,acof,user_id) VALUES ('$productName','$productDesign','$productSize','$productQty','$acof','" . (string) $loggedin_session . "')";
                        $result2 = mysqli_query($conn, "SELECT item FROM stock WHERE item = '$productName' AND size = '$productSize' AND acof = '$acof' AND user_id = '" . (string) $loggedin_session . "'");
                        $flag_stock1 = 0;
                        if ($result2->num_rows == 0) {
                            $insert2 = mysqli_query($conn, $sql7);
                            if (!$insert2) {
                                echo mysqli_error($conn);
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e2';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                        } else {
                            $sql8 = "Select qty from stock where item = '$productName' AND size = '$productSize' AND acof = '$acof' AND user_id = '" . (string) $loggedin_session . "'";
                            $retval4 = mysqli_query($conn, $sql8);
                            if (!$retval4) {
                                echo "Error Occured";
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e3';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                            $row8 = mysqli_fetch_array($retval4);
                            $oldqty = $row8[0];
                            $newqty = $oldqty + $productQty;
                            echo $oldqty;
                            echo $newqty;
                            $sql9 = "UPDATE stock SET qty = '$newqty' where item='$productName' AND size='$productSize' AND acof = '$acof' AND user_id = '" . (string) $loggedin_session . "'";
                            $update = mysqli_query($conn, $sql9);
                            if (!$update) {
                                echo mysqli_error($conn);
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e4';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                            $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productName','$productSize','$productQty','$newqty','$acof','Inpass','" . (string) $loggedin_session . "')";
                            $update92 = mysqli_query($conn, $sql92);
                            $flag_stock1 = 1;
                            if (!$update92) {
                                echo mysqli_error($conn);
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e4';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                        }
                        if ($flag_stock1 != 1) {
                            $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$productName','$productSize','$productQty','$productQty','$acof','Inpass','" . (string) $loggedin_session . "')";
                            $update92 = mysqli_query($conn, $sql92);
                            if (!$update92) {
                                echo mysqli_error($conn);
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e4';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                        }

                        $sql4 = "INSERT INTO inpass_products(inpass_no,date_of_entry,product_wono,product_name,product_code,product_design,product_size,product_qty,user_id) VALUES ('$ipno','$date','$productWono','$productName','$productCode','$productDesign','$productSize','$productQty','" . (string) $loggedin_session . "')";
                        $insert = mysqli_query($conn, $sql4);
                        if (!$insert) {
                            echo mysqli_error($conn);
                            echo "Error Occured";
                            mysqli_rollback($conn);
                            echo "<script type='text/javascript'>
                            window.location.href = 'inpass.php?f=e5';
                            </script>";
                            echo "<script>alert('Some Error Occured')</script>";
                            exit;
                        }

                        $sql3 = "INSERT INTO products(name,code,design,size,user_id) VALUES ('$productName','$productCode','$productDesign','$productSize','" . (string) $loggedin_session . "')";
                        $result = mysqli_query($conn, "SELECT code FROM products WHERE code = '$productCode' AND user_id = '" . (string) $loggedin_session . "'");
                        if ($result->num_rows == 0) {
                            $insert3 = mysqli_query($conn, $sql3);
                            if (!$insert3) {
                                echo mysqli_error($conn);
                                mysqli_rollback($conn);
                                echo "<script type='text/javascript'>
                                window.location.href = 'inpass.php?f=e6';
                                </script>";
                                echo "<script>alert('Some Error Occured')</script>";
                                exit;
                            }
                        }


                    }
                    if ($inpass_flag == 1) {
                        $sql01 = "UPDATE profile SET inpass_count = inpass_count + 1 where user_id='" . (string) $loggedin_session . "'";
                        $updipno = mysqli_query($conn, $sql01);
                        if (!$updipno) {
                            echo mysqli_error($conn);
                            mysqli_rollback($conn);
                            echo "<script type='text/javascript'>
                            window.location.href = 'inpass.php?f=e8';
                            </script>";
                            echo "<script>alert('Some Error Occured')</script>";
                            exit;
                        }
                    }
                    mysqli_commit($conn);

                    echo "<script type='text/javascript'>
                window.open('createpdfpass.php?no=$ipno&io=inpass');
                </script>";
                    echo "<script type='text/javascript'>
                window.location.href = 'inpass.php?f=s';
                </script>";
                }
                ?>
            </div>
        </div>
        <br> <br>
        <div class="container mt-2 ms-2">

            <div class="col">
                <h1>Inpasses Generated <a href="inpassshowall.php?f=0" class="fs-5" target="_blank">Show All</a></h1>
            </div>

        </div>
        <div class="container-fluid mt-2 p-2 bg-white rounded-5 shadow-5-strong">
            <table class='table'>
                <thead class="table-light">
                    <th>
                        Inpass No.
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Source Company - A/C of
                    </th>
                    <th>
                        WO#
                    </th>
                    <th>
                        Product Description/Size
                    </th>
                    <th>
                        Product Accp. Quantity
                    </th>
                    <th>
                        Outpass No.(Source)
                    </th>
                    <th>
                        Vehicle No.
                    </th>
                    <th>
                        Note
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $cur_no = -1;
                        $table_active = '';
                        while ($row = $retval3->fetch_assoc()) {
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
                    &nbsp;
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
                    </tr>
                    ";
                                $cur_no = $row['no'];
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