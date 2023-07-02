<?php
include 'conn.php';
include 'nav.php';
?>

<?php

if (!$conn) {
    echo "Error Occured";
}
$sql = "Select * from products";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}

$sql = "Select * from company";
$retval2 = mysqli_query($conn, $sql);
if (!$retval2) {
    echo mysqli_error($conn);
    die($conn);
}

$sql3 = "Select * from outpass ORDER BY no DESC";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
    die($conn);
}

//for table
$sql4 = "select * from outpass,outpass_products where outpass.no = outpass_products.outpass_no ORDER BY timestamp DESC LIMIT 5";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
    die($conn);
}

$sql6 = "Select * from vehicles";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
    die($conn);
}

//only for dropdown menu
$sql7 = "SELECT work_order_products.* from work_order_products join work_orders on work_order_products.work_order_no=work_orders.work_order_no where work_orders.status = 'open' GROUP BY work_order_no";
$retval7 = mysqli_query($conn, $sql7);
if (!$retval7) {
    echo mysqli_error($conn);
    die($conn);
}

$sql8 = "SELECT work_order_products.* from work_order_products join work_orders on work_order_products.work_order_no=work_orders.work_order_no where work_orders.status = 'open'";
$retval8 = mysqli_query($conn, $sql8);
if (!$retval8) {
    echo mysqli_error($conn);
    die($conn);
}
?>

<html>

<title>Outpass</title>

<link rel="stylesheet" href="css/outpass.css">

<html>

<head>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $(function () {
                // $('#watchButton').click();
                //$('#add_product_field').click();
            });


            //for Product Data
            $(document).on("change", ".product_code", function () {
                var productCode = $(this).val();
                var productNameField = $(this).closest(".product_field").find(".product_name");
                var productDesignField = $(this).closest(".product_field").find(".product_design");
                var productSizeField = $(this).closest(".product_field").find(".product_size");
                var productFeatureField = $(this).closest(".product_field").find(".product_feature");


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
                                productFeatureField.val(product.features)
                                $(productNameField).trigger("change");
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



            //for Company Code
            $("#dest_name").on("change", function () { //use an appropriate event handler here
                $.ajax({
                    method: "POST",
                    url: "getcompanyid.php",
                    data: {
                        source_name: $("#dest_name").val(),
                    },
                    success: function (response) {
                        if (response == "FALSE") {
                            var message = "ERROR: something went wrong on the MYSQL side";
                            alert(message);
                        } else {
                            $("#company_code").val(response);
                            initilizebootstrap();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                        alert(message);
                    }
                });
            });

            var product_code_final;
            //product stock reseting quantity on change
            $(document).on("change", ".product_stock", function () {
                var productQtyField = $(this).closest(".product_field").find(".product_qty");
                var productStockField = $(this).closest(".product_field").find(".product_stock");
                var productCustomField = $(this).closest(".product_field").find(".custom_field");
                if (productStockField.val() == 'custom') {
                    productCustomField.removeAttr('hidden', true);
                    productCustomField.attr("required", true);
                    initilizebootstrap();
                }
                else {
                    productCustomField.attr("hidden", true);
                    productCustomField.removeAttr('required', true);
                    initilizebootstrap();
                }
                productQtyField.val('');
                product_code_final = productStockField.val();
                initilizebootstrap();
            });

            //product quantity
            $(document).on("change", ".product_qty", function () {
                var productQtyField = $(this).val();
                var productStockField = $(this).closest(".product_field").find(".product_stock");
                if (productStockField.val() == null) {
                    alert("The Product is not in Stock")
                    $(this).val('');
                    initilizebootstrap();
                }
                var selectedTextqty = productStockField.find("option:selected").data('qty');
                if (productQtyField > selectedTextqty) {
                    alert("Available Amount of Selected Product in Stock is " + selectedTextqty);
                    $(this).val('');
                    initilizebootstrap();
                }
            });
            var productData;

            //for Product Code
            $(document).on("change", ".product_name", function () {
                var productName = $(this).val();
                var productStockField = $(this).closest(".product_field").find(".product_stock");
                var options = "<option selected value=''>None</option>";

                $.ajax({
                    method: "POST",
                    url: "getstockdata.php",
                    data: {
                        product_name: productName
                    },
                    success: function (response) {
                        if (response === "FALSE") {
                            var message = "ERROR: something went wrong on the MYSQL side";
                            alert(message);
                        } else {
                            productData = JSON.parse(response)
                            var l = productData.length
                            var i
                            if (l > 0)
                                for (i = 0; i < l; i++) {

                                    options += '<option selected value="' + productData[i].code + '" data-qty="' + productData[i].qty + '">' + productData[i].code + '&nbsp;' + productData[i].name + '&nbsp;' + productData[i].design + '&nbsp;' + productData[i].size + '</option>';
                                }
                            options += "<option value='custom'>Custom</option>";
                            productStockField.html(options);
                            initilizebootstrap();

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                        alert(message);
                    }
                });
            });

            //for Product Data from work order no
            $(document).on("change", ".work_order", function () {
                var workorderNo = $(this).val();
                var stopExecution = false;

                $.ajax({
                    method: "POST",
                    url: "checkworkorderopen.php",
                    data: {
                        workorder_no: workorderNo
                    },
                    success: function (response) {
                        if (response == 'Closed') {
                            alert("This work Order has already been Completed");
                            stopExecution = true;
                        }
                        if (!response) {
                            alert("A Work Order with this No. has not been generated yet")
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.log(error);
                    },
                    complete: function () {
                        if (!stopExecution) {
                            continueExecution();
                        }
                    }
                });

                function continueExecution() {

                    $.ajax({
                        method: "POST",
                        url: "getproductdatafromwno.php",
                        data: {
                            workorder_no: workorderNo
                        },
                        success: function (response) {
                            if (response === "FALSE") {
                                var message = "ERROR: something went wrong on the MYSQL side";
                                alert(message);
                            } else {
                                productData = JSON.parse(response)
                                var l = productData.length;
                                for (var i = 0; i < l; i++) {
                                    $('#add_product_field').click();
                                    var productCodeField = $(".product_field:eq(" + i + ")").find(".product_code");
                                    var productNameField = $(".product_field:eq(" + i + ")").find(".product_name");
                                    var productDesignField = $(".product_field:eq(" + i + ")").find(".product_design");
                                    var productSizeField = $(".product_field:eq(" + i + ")").find(".product_size");
                                    var productFeatureField = $(".product_field:eq(" + i + ")").find(".product_feature");
                                    var productReqQtyField = $(".product_field:eq(" + i + ")").find(".req_qty");
                                    var productQtyField = $(".product_field:eq(" + i + ")").find(".product_qty");
                                    productCodeField.val(productData[i].code);
                                    productNameField.val(productData[i].name);
                                    $(productNameField).trigger("change");
                                    productDesignField.val(productData[i].design);
                                    productSizeField.val(productData[i].size);
                                    productFeatureField.val(productData[i].feature);
                                    productReqQtyField.val(productData[i].qty)
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
                            workorder_no: workorderNo
                        },
                        success: function (response) {
                            $("#dest_name").val(response);
                            $("#dest_name").trigger("change");
                            initilizebootstrap();
                        },
                        error: function (xhr, status, error) {
                            var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                            alert(message);
                        }
                    });
                }
            });

        });

        $(document).ready(function () {
            var flag_forstockdata = 0;
            $("#add_product_field").click(function () {
                if (flag_forstockdata == 0) {
                    var stockdata = document.getElementById('stockdata');
                    stockdata.style.display = 'block';

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'fetchstockdata.php', true);
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            // Update the content of the hidden div with the received data

                            flag_forstockdata = 1;
                            var response = JSON.parse(xhr.responseText);
                            var tableBody = document.getElementById('stockbody');
                            tableBody.innerHTML = '';
                            for (var i = 0; i < response.length; i++) {
                                var row = document.createElement('tr');
                                var cell1 = document.createElement('td');
                                cell1.textContent = response[i].code;
                                var cell2 = document.createElement('td');
                                cell2.textContent = response[i].name;
                                var cell3 = document.createElement('td');
                                cell3.textContent = response[i].design;
                                var cell4 = document.createElement('td');
                                cell4.textContent = response[i].size;
                                var cell5 = document.createElement('td');
                                cell5.textContent = response[i].qty;

                                row.appendChild(cell1);
                                row.appendChild(cell2);
                                row.appendChild(cell3);
                                row.appendChild(cell4);
                                row.appendChild(cell5);

                                tableBody.appendChild(row);
                                initilizebootstrap();
                            }
                        } else {
                            // Handle errors if necessary
                            hiddenDiv.innerHTML = 'Error fetching data.';
                            initilizebootstrap();
                        }
                    };
                    xhr.send();
                }
            });

            //search stock data
            var searchInput = document.getElementById("search_input");
            var table = document.getElementById("stockbody");
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

            // Add product field
            $("#add_product_field").click(function () {

                var productField = `
        <div class="product_field mb-3 border border-1 border-primary rounded p-4">

        <div class='mb-2'>
            <label>Product Type</label> &nbsp;
             <select name='product_type[] id='ptype' class='product_type'>
             <option selected>Finished</option>
             <option>Rejection</option>
             <option>Replacement</option>
             <option>Transfer</option>
             </select> 
             </div>
             
             
             <div class=' d-flex align-items-start bg-light mb-3 w-25'>
             <div class='form-outline mb-1 col'>
          <input name="product_code[]" id='procode' required class="product_code form-control">
          <label for="procode" class='form-label'>Product Code</label>
            </div>
            </div>

            <div class=' d-flex align-items-start bg-light mb-3'>
             <div class='form-outline mb-1 col'>
          <input list="productlist" id='pname' required name="products[]" class="product_name form-control">
          <datalist id="productlist">
                
            </datalist>
            <label for='pname' class='form-label'>Product Name</label>
            </div>
         &nbsp;
            <div class='form-outline mb-1 col'>
          <input name="product_design[]" id='pdes' required class="product_design form-control">
          <label for="pdes" class='form-label'>Design</label>
          </div>
          &nbsp;
          <div class='form-outline mb-1 col'>
          <input name="product_size[]" id='psize' required class="product_size form-control">
          <label for="psize" class='form-label'>Size</label>
          </div>
          &nbsp;
          <div class='form-outline mb-1 col'>
          <input name="product_feature[]" id='pfeat' required class="product_feature form-control">
          <label for="pfeat" class='form-label'>Features</label>
          </div>
          </div>

          <div class=' d-flex align-items-start bg-light mb-3 w-25'>
          <div class='form-outline mb-1 col'>
          <input type='text' id='rquant' readonly name='req_qty[]' class='req_qty form-control border-0'>
          <label for='rquant' class='form-label'>Req. Quantity</label>
          </div>
          </div>

          <caption>The product will be taken from the following stock:</caption> <br>
          <select name='product_stock[]' class='product_stock'>
          <option selected>None</option>
          <option value='custom'>Custom</option>
          </select>
          <br>
          <div class='form-outline mb-3 mt-2 col'>
          <input type='text' hidden class='custom_field w-100' name='custom_field[]' placeholder='Enter Product Code Here (Refer to Stock Data)' >
          </div>
           <caption name='product_cap' class='product_cap'></caption>

           <div class=' d-flex align-items-start bg-light mb-3 w-25'>
          <div class='form-outline mb-1 col'>
          <input name="product_qty[]" id='pqty' required class="product_qty form-control">
          <label for="pqty" class='form-label'>Desp. Qty</label>
          </div>
          </div>
          
          <button type="button" class="remove_product_field  btn btn-outline-danger" data-mdb-ripple-color="dark">Remove</button>
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

</head>

<body>
    <main>
        <br>
        <h1 class="mt-2 ms-4">Generate Outpass</h1>
        <div class="container-fluid">
            <div class="row justify-content">
                <div class="row">
                    <div class="col-xl-7">
                        <br>
                        <form name="op" class="bg-white rounded-5 shadow-5-strong p-5" method="post" action="">
                            <h4>Enter Details Below</h4> <br>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="form-outline mb-4">
                                        <input type="text" class="form-control" required name="opno">
                                        <label for="opno" class="form-label">Outpass No.</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline datepicker">
                                        <input type="date" class="form-control" required name="date" id="today_date">
                                        <label for="date" class="form-label">Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="form-outline mb-4">
                                        <input list="companylist" class="form-control" required type="text"
                                            id="dest_name" name="dest_name">
                                        <datalist id="companylist">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($retval2)) {
                                                echo "<option>{$row['name']}</option>";
                                            }
                                            ?>
                                        </datalist>
                                        <label for="dest_name" class='form-label'>Dest. Company</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline mb-4">
                                        <input type="text" class="form-control" required name="woc" id="company_code">
                                        <label for="company_code" class="form-label">A/C of WGD WO#</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="form-outline mb-4">
                                        <input list="vehiclelist" class="form-control" required type="text" id='vno'
                                            name="vehicle">
                                        <datalist id="vehiclelist">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($retval6)) {
                                                echo "<option>{$row['number']}</option>";
                                            }
                                            ?>
                                        </datalist>
                                        <label for="vno" class="form-label">Vehicle No.</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- Dummy -->
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="form-outline mb-4">
                                        <input type="text" list="wnolist" id="worder" required name="work_order"
                                            class="work_order form-control">
                                        <datalist id="wnolist">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($retval7)) {
                                                echo "<option>{$row['work_order_no']}</option>";
                                            }
                                            ?>
                                        </datalist>
                                        <label for="worder" class="form-label">Work Order No.</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- Dummy -->
                                </div>
                            </div>
                            <label class="form-check-label">
                                <h5>Products</h5>
                            </label> <br>
                            <div id="product_fields" class="row pt-2 mb-2">

                            </div>

                            <button type="button" id="add_product_field" class="btn btn-outline-secondary"
                                data-mdb-ripple-color="dark">Add Product</button> <br>
                            <div class="form-outline mb-4 mt-4">
                                <textarea name="extras" id='ext' class="form-control"></textarea>
                                <label for="ext" class="form-label">Extras</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="op">Generate OutPass</button>
                        </form>
                    </div>
                    <br><br>
                    <?php
                    if (isset($_POST['op'])) {
                        $flag = 0;
                        $opno = "";
                        $date = "";
                        $dest = "";
                        $woc = "";
                        $vechicle = "";
                        $wno = "";
                        $extras = "";
                        $opno = $_POST['opno'];
                        $date = $_POST['date'];
                        $dest = $_POST['dest_name'];
                        $woc = $_POST['woc'];
                        $vehicle = $_POST['vehicle'];
                        $wno = $_POST['work_order'];
                        $extras = $_POST['extras'];
                        $conn = mysqli_connect('localhost', 'root', '', 'akcdb');
                        if (!$conn) {
                        }
                        $tran = 'START TRANSACTION';
                        $transtart = mysqli_query($conn, $tran);
                        if (!$transtart) {
                            echo mysqli_error($conn);
                        }
                        $sql = "INSERT INTO outpass(no,date,dest,woc,vehicleno,work_order_no,extras) VALUES ('$opno','$date','$dest','$woc','$vehicle','$wno','$extras')";
                        $sql2 = "INSERT INTO company(name,code) VALUES ('$dest','$woc')";
                        $insert = mysqli_query($conn, $sql);
                        if (!$insert) {
                            echo mysqli_error($conn);
                        } else {
                            echo "sucess";
                        }
                        $result = mysqli_query($conn, "SELECT name FROM company WHERE name = '$dest'");
                        if ($result->num_rows == 0) {
                            $insert2 = mysqli_query($conn, $sql2);
                        }
                        $ino = "";
                        $products = $_POST['products'];
                        $productTypes = $_POST['product_type'];
                        $productCodes = $_POST['product_code'];
                        $productDesigns = $_POST['product_design'];
                        $productSizes = $_POST['product_size'];
                        $productFeatures = $_POST['product_feature'];
                        $productQtys = $_POST['product_qty'];
                        $productCodes_stock = $_POST['product_stock'];
                        $productCodes_customstock = $_POST['custom_field'];
                        $reqQtys = $_POST['req_qty'];

                        for ($i = 0; $i < count($products); $i++) {
                            $productName = $products[$i];
                            $productCode = $productCodes[$i];
                            $productType = $productTypes[$i];
                            $productDesign = $productDesigns[$i];
                            $productSize = $productSizes[$i];
                            $productFeature = $productFeatures[$i];
                            $productQty = $productQtys[$i];
                            $productCode_stock = $productCodes_stock[$i];
                            $productCode_customstock = $productCodes_customstock[$i];
                            $productName_bill = $productName . ' ' . $productFeature;
                            if ($productCode_stock == 'custom') {
                                $productCode_stock = $productCode_customstock;
                            }
                            $reqQty = $reqQtys[$i];

                            $sql4 = "INSERT INTO outpass_products(outpass_no,product_type,product_name,product_code,work_order,product_design,product_size,product_qty) VALUES ('$opno','$productType','$productName_bill','$productCode','$wno','$productDesign','$productSize','$productQty')";
                            $insert = mysqli_query($conn, $sql4);
                            if (!$insert) {
                                echo mysqli_error($conn);
                                echo "Error Occured";
                            }

                            //updating quantity in stock
                            $sql8 = "Select qty from stock where code = '$productCode_stock'";
                            $retval4 = mysqli_query($conn, $sql8);
                            if (!$retval4) {
                                echo "Error Occured";
                            }
                            $row8 = mysqli_fetch_array($retval4);
                            $oldqty = $row8[0];
                            $newqty = $oldqty - $productQty;
                            if (!($newqty < 0)) {
                                echo $oldqty;
                                echo $newqty;
                                $sql9 = "UPDATE stock SET qty = '$newqty' where code = '$productCode_stock'";
                                $update = mysqli_query($conn, $sql9);
                                if (!$update) {
                                    echo mysqli_error($conn);
                                }
                            } else {
                                mysqli_rollback($conn);
                                $flag = 1;
                                echo "<script>alert('Not Enough Stock Avalible for Selected Products')</script>";
                            }

                        }
                        if ($flag == 0) {
                            if ($reqQty - $productQty > 0) {
                                $newqtywo = $reqQty - $productQty;
                                $sql8 = "UPDATE `work_order_products` SET `qty`=$newqtywo WHERE code='$productCode'";
                                $update2 = mysqli_query($conn, $sql8);
                                if (!$update2) {
                                    echo mysqli_error($conn);
                                    mysqli_rollback($conn);
                                    $flag = 1;
                                }
                            } else {
                                $sql8 = "UPDATE `work_orders` SET `status`='Closed',timestamp = CURRENT_TIME() WHERE work_order_no='$wno'";
                                $update2 = mysqli_query($conn, $sql8);
                                if (!$update2) {
                                    echo mysqli_error($conn);
                                    mysqli_rollback($conn);
                                    $flag = 1;
                                }
                            }
                        }

                        if ($flag == 0) {
                            echo "<script type='text/javascript'>
            window.open('createpdfpass.php?no=$opno&io=outpass');
            </script>";
                        }
                        mysqli_commit($conn);
                        echo "<script type='text/javascript'>
            window.location.href = 'outpass.php';
            </script>";
                    }
                    ?>

                    <div id="stockdata" class="col bg-white rounded-5 shadow-5-strong pt-5 pb-1" style="
    display: none;
    ">
                        <div class='card sticky-top'>
                            <div class="card-header">
                                <h4>Stock Data</h4>
                            </div>

                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col">
                                        <p class='fw-normal p-1'>Seach For any Specific Product</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="search_input" required class="form-control">
                                            <label for="search_input" class='form-label'>Search Here</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive" style="max-height:500px;">
                                    <table class='table table-sm'>
                                        <thead class="table-light">
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Design</th>
                                            <th>Size</th>
                                            <th>Available. Qty</th>
                                        </thead>
                                        <tbody id='stockbody'>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Add HTML structure for AJAX content, e.g., loading indicator or placeholder text -->
                    </div>
                </div>
            </div>
        </div>
        <br> <br>
        <div class="container mt-2 mb-2 ms-2">

            <div class="col">
                <h1>Outpasses Generated <a href="outpassshowall.php?f=0" class="fs-5" target="_blank">Show All</a></h1>
            </div>

        </div>
        <div class="container-fluid bg-white rounded-5 shadow-5-strong p-5">
            <table class="table">
                <thead class="table-light">
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
                        Product Desp. Quantity
                    </th>
                    <th>
                        Product Type
                    </th>
                    <th>
                        Vehicle No.
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
                        while ($row = $retval4->fetch_assoc()) {
                            if ($cur_no == $row['no']) {

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
                    {$row['no']}
                    </td>
                    <td>
                    {$row['date']}
                    </td>
                    <td>
                    {$row['dest']}
                    &nbsp;
                    {$row['woc']}
                    </td>
                    <td>
                    {$row['work_order']}
                    </td>
                    <td>
                    {$row['product_name']}
                    &nbsp;
                    {$row['product_code']}
                    &nbsp;
                    {$row['product_design']}
                    &nbsp;
                    {$row['product_size']}
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