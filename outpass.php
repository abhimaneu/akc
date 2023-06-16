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

$sql4 = "select * from outpass,outpass_products where outpass.no = outpass_products.outpass_no ORDER BY no DESC";
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
            $('#watchButton').click();
            $('#add_product_field').click();
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

        //for Product Code
        $(document).on("change", ".product_name", function () {
            var productName = $(this).val();
            var productCodeField = $(this).closest(".product_field").find(".product_code");

            $.ajax({
                method: "POST",
                url: "getproductcode.php",
                data: {
                    product_name: productName
                },
                success: function (response) {
                    if (response === "FALSE") {
                        var message = "ERROR: something went wrong on the MYSQL side";
                        alert(message);
                    } else {
                        productCodeField.val(response);
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
          <label>Product Name</label>
          <input list="productlist" required name="products[]" class="product_name">
          <datalist id="productlist">
                <?php
                while ($row = mysqli_fetch_assoc($retval)) {
                    echo "<option>{$row['name']}";
                }
                ?>
            </datalist>
      
          <label for="productcode">Product Code</label>
          <input type="text" required name="product_code[]" class="product_code">
      
          <label for="product_bundle">Product Bundle</label>
          <input name="product_bundle[]" required class="product_bundle">
      
          <label for="product">Product Desc.</label>
          <textarea name="product_desc[]" class="product_description"></textarea> <br> <br>
          
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
                <label for="date">Date</label>
                <input type="date" required name="date" id="today_date"> <br>
                <label for="dest_name">Dest. Company</label>
                <input list="companylist" required type="text" id="dest_name" name="dest_name"> <br>
                <datalist id="companylist">
                    <?php
                    while ($row = mysqli_fetch_assoc($retval2)) {
                        echo "<option>{$row['name']}";
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
                        echo "<option>{$row['number']}";
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
            $opno = "";
            $date = "";
            $dest = "";
            $woc = "";
            $vechicle = "";
            $desc = "";
            $extras = "";
            $date = $_POST['date'];
            $dest = $_POST['dest_name'];
            $woc = $_POST['woc'];
            $vehicle = $_POST['vehicle'];
            $extras = $_POST['extras'];
            $conn = mysqli_connect('localhost', 'root', '', 'akcdb');
            if (!$conn) {
            }
            $sql = "INSERT INTO outpass(date,dest,woc,vehicleno,extras) VALUES ('$date','$dest','$woc','$vehicle','$extras')";
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
            $productCodes = $_POST['product_code'];
            $productBundles = $_POST['product_bundle'];
            $productDescs = $_POST['product_desc'];
            $sql5 = "SELECT no from outpass ORDER BY no DESC";
            $retino = mysqli_query($conn, $sql5);
            if (!$retino) {
                echo "Error Occured";
            }
            $row = mysqli_fetch_array($retino);
            $ono = $row[0];
            for ($i = 0; $i < count($products); $i++) {
                $productName = $products[$i];
                $productCode = $productCodes[$i];
                $productBundle = $productBundles[$i];
                $productDesc = $productDescs[$i];

                $sql4 = "INSERT INTO outpass_products(outpass_no,product_name,product_code,product_bundle,product_desc) VALUES ('$ono','$productName','$productCode','$productBundle','$productDesc')";
                $insert = mysqli_query($conn, $sql4);
                if (!$insert) {
                    echo mysqli_error($conn);
                    echo "Error Occured";
                }
                echo "<script type='text/javascript'>
            window.open('createpdfpass.php?no=$ono&io=outpass');
            </script>";
                echo "<script type='text/javascript'>
            window.location.href = 'outpass.php';
            </script>";
            }
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
                    WOC
                </th>
                <th>
                    Vehicle No.
                </th>
                <th>
                    Product Name - Code
                </th>
                <th>
                    Bundle
                </th>
                <th>
                    Product Description/Size
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
                    </td>
                    <td>
                    {$row['woc']}
                    </td>
                    <td>
                    {$row['vehicleno']}
                    </td>
                    <td>
                    {$row['product_name']}
                    &nbsp;
                    {$row['product_code']}
                    </td>
                    <td>
                    {$row['product_bundle']}
                    </td>
                    <td>
                    {$row['product_desc']}
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