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

$sql3 = "Select * from inpass ORDER BY no DESC";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
    die($conn);
}

$sql4 = "select * from inpass,inpass_products where inpass.no = inpass_products.inpass_no order by no desc";
$retval3 = mysqli_query($conn, $sql4);
if (!$retval3) {
    echo mysqli_error($conn);
    die($conn);
}

?>
<script>
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
          <input name="product_bundle[]"required class="product_bundle">
      
          <label for="product">Product Desc.</label>
          <textarea name="product_desc[]" class="product_description"></textarea>
          
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

<html>

<head>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

</head>

<body>
    <div>
        <h1>Inpass</h1>
        <form name="ip" method="post" action="">

            <label for="date">Date</label>
            <input type="date"required name="date" id="today_date"> <br>
            <label>Source Name</label>
            <input list="companylist" required name="source" id="source_name">
            <datalist id="companylist">
                <?php
                while ($row = mysqli_fetch_assoc($retval2)) {
                    echo "<option>{$row['name']}";
                }
                ?>
            </datalist> <br>
            <label for="woc">A/C of WGD WO#</label>
            <input type="text" required name="woc" id="company_code"> <br>
            <label for="opno">OP#</label>
            <input type="text" required name="opno"> <br>
            <label for="vechicle">Vehicle#</label>
            <input type="text" required name="vehicle"> <br>
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

            <button type="button" id="add_product_field">Add Product</button>
            <br>
            <label for="extras">Extras</label>
            <textarea name="extras"></textarea> <br>
            <button type="submit" name="ip">Generate InPass</button>
        </form>
        <br><br>
        <?php
        if (isset($_POST['ip'])) {
            $ipno = "";
            $date = "";
            $source = "";
            $woc = "";
            $op = "";
            $vechicle = "";
            $p_name = "";
            $p_code = "";
            $p_bundle = "";
            $desc = "";
            $extras = "";
            // $ipno = $_POST['ipno'];
            $date = $_POST['date'];
            $source = $_POST['source'];
            $woc = $_POST['woc'];
            $op = $_POST['opno'];
            $vehicle = $_POST['vehicle'];
            $p_name = $_POST['products'];
            $p_code = $_POST['product_code'];
            $p_bundle = $_POST['product_bundle'];
            $desc = $_POST['product_desc'];
            $extras = $_POST['extras'];
            $conn = mysqli_connect('localhost', 'root', '', 'akcdb');
            if (!$conn) {
            }
            $sql = "INSERT INTO inpass(no,date,source,woc,op,vehicleno,extras) VALUES ('$ipno','$date','$source','$woc','$op','$vehicle','$extras')";
            $sql2 = "INSERT INTO company(name,code) VALUES ('$source','$woc')";
            $insert = mysqli_query($conn, $sql);
            if (!$insert) {
                echo mysqli_error($conn);
            } else {
                echo "sucess";
            }
            $result = mysqli_query($conn, "SELECT name FROM company WHERE name = '$source'");
            if ($result->num_rows == 0) {
                $insert2 = mysqli_query($conn, $sql2);
            }
            $ino = "";
            $products = $_POST['products'];
            $productCodes = $_POST['product_code'];
            $productBundles = $_POST['product_bundle'];
            $productDescs = $_POST['product_desc'];
            $sql5 = "SELECT no from inpass ORDER BY no DESC";
            $retino = mysqli_query($conn, $sql5);
            if (!$retino) {
                echo "Error Occured";
            }
            $row = mysqli_fetch_array($retino);
            $ino = $row[0];
            for ($i = 0; $i < count($products); $i++) {
                $productName = $products[$i];
                $productCode = $productCodes[$i];
                $productBundle = $productBundles[$i];
                $productDesc = $productDescs[$i];

                $sql4 = "INSERT INTO inpass_products(inpass_no,product_name,product_code,product_bundle,product_desc) VALUES ('$ino','$productName','$productCode','$productBundle','$productDesc')";
                $insert = mysqli_query($conn, $sql4);
                if (!$insert) {
                    echo mysqli_error($conn);
                    echo "Error Occured";
                }

                $sql3 = "INSERT INTO products(name,code) VALUES ('$productName','$productCode')";
                $result = mysqli_query($conn, "SELECT name FROM products WHERE name = '$productName'");
                if ($result->num_rows == 0) {
                    $insert2 = mysqli_query($conn, $sql3);
                }
            }
            echo "<script type='text/javascript'>
            window.open('createpdfpass.php?no=$ino&io=inpass');
            </script>";
            echo "<script type='text/javascript'>
            window.location.href = 'inpass.php';
            </script>";
        }
        ?>
    </div>
    <div>

        <h1>Inpasses Generated</h1>
        <table style="border-spacing: 30px;">
            <thead>
                <th>
                    Inpass No.
                </th>
                <th>
                    Date
                </th>
                <th>
                    Source Company
                </th>
                <th>
                    WOC
                </th>
                <th>
                    Outpass No.
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
                    while ($row = $retval3->fetch_assoc()) {
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
                    {$row['source']}
                    </td>
                    <td>
                    {$row['woc']}
                    </td>
                    <td>
                    {$row['op']}
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