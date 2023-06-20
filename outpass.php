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

$sql4 = "select * from outpass,outpass_products where outpass.no = outpass_products.outpass_no ORDER BY date DESC";
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

<link rel="stylesheet" href="css/outpass.css">

<html>

<head>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $(function () {
                // $('#watchButton').click();
                // $('#add_product_field').click();
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
                productQtyField.val('');
                product_code_final = productStockField.val();
            });

            //product quantity
            $(document).on("change", ".product_qty", function () {
                var productQtyField = $(this).val();
                var productStockField = $(this).closest(".product_field").find(".product_stock");
                if (productStockField.val() == null) {
                    alert("The Product is not in Stock")
                    $(this).val('');
                }
                var selectedTextqty = productStockField.find("option:selected").data('qty');
                if (productQtyField > selectedTextqty) {
                    alert("Available Amount of Selected Product in Stock is " + selectedTextqty);
                    $(this).val('');
                }
            });
            var productData;

            //for Product Code
            $(document).on("change", ".product_name", function () {
                var productName = $(this).val();
                var productStockField = $(this).closest(".product_field").find(".product_stock");

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
                            var options = ''
                            if (l > 0)
                                for (i = 0; i < l; i++) {
                                    // product_qty = {code:productData[i].code, qty:productData[i].qty}
                                    options += '<option value="' + productData[i].code + '" data-qty="' + productData[i].qty + '">' + productData[i].code + '&nbsp;' + productData[i].name + '&nbsp;' + productData[i].design + '&nbsp;' + productData[i].size + '</option>';
                                }
                            productStockField.html(options);
                            // var productData = JSON.parse(response);
                            // productStockField.val(response);
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
                                productReqQtyField.text(productData[i].qty)

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
            $("#add_product_field").click(function () {
                var productField = `
        <div class="product_field">

             <label>Product Type</label>
             <select name='product_type[] class='product_type'>
             <option selected>Finished</option>
             <option>Rejection</option>
             <option>Replacement</option>
             <option>Transfer</option>
             </select> <br> <br>
          
             <label for="product_code">Product Code</label>
          <input name="product_code[]"required class="product_code">


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
          <input name="product_design[]"required class="product_design">

          <label for="product_size">Size</label>
          <input name="product_size[]"required class="product_size">

          <label for="product_feature">Features</label>
          <input name="product_feature[]"required class="product_feature"> <br> <br>

          <label>Req. Quantity</label>
          <span class='req_qty'><caption></caption></span> <br> <br>

          <caption>The product will be taken from the following stock</caption> <br> <br>
          <select name='product_stock[]' class='product_stock'>
          <option></option>
          </select> <br>
           <br>
           <caption name='product_cap' class='product_cap'></caption>
           <br>

          <label for="product_qty">Desp. Qty</label>
          <input name="product_qty[]"required class="product_qty"> <br> <br>

          
           <br>
          
          <button type="button" class="remove_product_field">Remove</button>
        </div>
      `;

                $("#product_fields").append(productField);
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
        });
    </script>

</head>

<body>
    <div>
        <div class="formdiv">
            <h1>Outpass</h1>
            <form name="op" method="post" action="">
                <label for="opno">Outpass No.</label>
                <input type="text" required name="opno"> <br>
                <label for="date">Date</label>
                <input type="date" required name="date" id="today_date"> <br>
                <label for="dest_name">Dest. Company</label>
                <input list="companylist" required type="text" id="dest_name" name="dest_name"> <br>
                <datalist id="companylist">
                    <?php
                    while ($row = mysqli_fetch_assoc($retval2)) {
                        echo "<option>{$row['name']}</option>";
                    }
                    ?>
                </datalist>
                <label for="woc">A/C of WGD WO#</label>
                <input type="text" required name="woc" id="company_code"> <br>
                <label for="vehicle">Vehicle#</label>
                <input list="vehiclelist" required type="text" name="vehicle">
                <datalist id="vehiclelist">
                    <?php
                    while ($row = mysqli_fetch_assoc($retval6)) {
                        echo "<option>{$row['number']}</option>";
                    }
                    ?>
                </datalist> <br>
                <label for="work_order">Work Order No.</label>
                <input type="text" list="wnolist" required name="work_order" class="work_order">
                <datalist id="wnolist">
                    <?php
                    while ($row = mysqli_fetch_assoc($retval7)) {
                        echo "<option>{$row['work_order_no']}</option>";
                    }
                    ?>
                </datalist> <br>
                <label>Add Products</label>
                <div class="divider1"></div>
                <div id="product_fields">
                    <!-- Initial set of product fields -->
                    <!-- <div class="product_field">
                    <label>Product Name</label>
                    <input list="productlist" required name="products" id="product_name">

                    <label for="productcode">Product Code</label>
                    <input type="text" required name="product_code" id="product_code">

                    <label for="product_bundle">Product Bundle</label>
                    <input name="product_bundle" required id="product_bundle">

                    <label for="product">Product Desc.</label>
                    <textarea name="product_desc" id="product_description"></textarea>
                </div> -->
                </div>

                <button type="button" id="add_product_field">Add Product</button> <br>
                <label for="extras">Extras</label>
                <textarea name="extras"></textarea> <br>
                <button type="submit" name="op">Generate OutPass</button>
            </form>
        </div>
        <br><br>
        <?php
        if (isset($_POST['op'])) {
            $flag=0;
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
            // $sql5 = "SELECT no from outpass ORDER BY no DESC";
            // $retino = mysqli_query($conn, $sql5);
            // if (!$retino) {
            //     echo "Error Occured";
            // }
            // $row = mysqli_fetch_array($retino);
            // $ono = $row[0];
            for ($i = 0; $i < count($products); $i++) {
                $productName = $products[$i];
                $productCode = $productCodes[$i];
                $productType = $productTypes[$i];
                $productDesign = $productDesigns[$i];
                $productSize = $productSizes[$i];
                $productFeature = $productFeatures[$i];
                $productQty = $productQtys[$i];
                $productCode_stock = $productCodes_stock[$i];
                $productName_bill = $productName . ' ' . $productFeature;

                $sql4 = "INSERT INTO outpass_products(outpass_no,product_type,product_name,product_code,work_order,product_design,product_size,product_qty) VALUES ('$opno','$productType','$productName_bill','$productCode','$wno','$productDesign','$productSize','$productQty')";
                $insert = mysqli_query($conn, $sql4);
                if (!$insert) {
                    echo mysqli_error($conn);
                    echo "Error Occured";
                }

                //updating quantity in stock
                echo $productCode_stock;
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
                    $flag=1;
                    echo "<script>alert('Not Enough Stock Avalible for Selected Products')</script>";
                }

            }
            if($flag==0){
            $sql8 = "UPDATE `work_orders` SET `status`='Closed' WHERE work_order_no='$wno'";
            $update2 = mysqli_query($conn, $sql8);
            if (!$update2) {
                echo mysqli_error($conn);
            }
        }

            //     echo "<script type='text/javascript'>
            // window.open('createpdfpass.php?no=$ono&io=outpass');
            // </script>";
            mysqli_commit($conn);
                echo "<script type='text/javascript'>
            window.location.href = 'outpass.php';
            </script>";
        }
        ?>
    </div>
    <div>
        <h1>Outpasses Generated</h1>
        <table style="border-spacing: 30px;">
            <thead>
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
                    while ($row = $retval4->fetch_assoc()) {
                        if (!empty($row)) {
                            echo "
                    <tr>
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
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>