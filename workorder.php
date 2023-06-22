<?php
include 'conn.php';
include 'nav.php';
?>


<?php
//fetch company data for dropdown
$sql2 = "Select * from company";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
    die($conn);
}
//fetch product data for company_products
$sql = "Select * from company_products";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}
//fetch workorder data for table
$sql4 = "select * from work_orders,work_order_products where work_orders.work_order_no = work_order_products.work_order_no order by date desc LIMIT 10";
$retval3 = mysqli_query($conn, $sql4);
if (!$retval3) {
    echo mysqli_error($conn);
    die($conn);
}
?>

<html>

<link rel="stylesheet" href="css/inpass.css">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {

        $(function () {
            $('#add_product_field').click();
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
                        }
                    }
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
        <div class="product_field">

            <label>Product Code</label>
          <input list="productcodelist" required name="product_code[]" class="product_code">
          <datalist id="productcodelist">
          <?php
          while ($row = mysqli_fetch_assoc($retval)) {
              echo "<option>{$row['code']}";
          }
          ?>
            </datalist> <br>

          <label>Product Name</label>
          <input list="productlist" required name="products[]" class="product_name">
          <datalist id="productlist">
                
            </datalist> <br>
         
      
          <label for="product_design">Design</label>
          <input name="product_design[]"required class="product_design"> <br>

          <label for="product_size">Size</label>
          <input name="product_size[]"required class="product_size"> <br>

          <label for="product_feature">Features</label>
          <input name="product_feature[]"required class="product_feature"> <br>

          <label for="product_qty">Quantity</label>
          <input name="product_qty[]"required class="product_qty"> <br>
          
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
        $('#date').val(today);
    });
</script>

<body>
    <h1>Work Order</h1>
    <form name='work_orders' method="POST">
        <label>Date</label>
        <input type="date" id='date' name='date'> <br>
        <label>Work Order No.</label>
        <input type="text" name='work_order_no'> <br>
        <label>Dest. Company</label>
        <input list='companylist' type="text" name='company_name'>
        <datalist id="companylist">
            <?php
            while ($row = mysqli_fetch_assoc($retval2)) {
                echo "<option>{$row['name']}";
            }
            ?>
        </datalist> <br>
        <label>Add Products</label>
        <div id='product_fields'>

        </div>
        <button type="button" id="add_product_field">Add Product</button> <br>
        <label>Extras</label>
        <textarea name='extras'></textarea> <br> <br>
        <button type="submit" name="work_orders">Generate Work Order</button>
    </form> <br>

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
        $conn = mysqli_connect('localhost', 'root', '', 'akcdb');
        if (!$conn) {
        }
        $sql = "INSERT INTO work_orders(work_order_no,date,company,extras) VALUES ('$wno','$date','$company_name','$extras')";
        //$sql2 = "INSERT INTO company(name,code) VALUES ('$source','$woc')";
        $insert = mysqli_query($conn, $sql);
        if (!$insert) {
            echo mysqli_error($conn);
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
        $productFeatures = $_POST['product_feature'];
        $productQtys = $_POST['product_qty'];

        for ($i = 0; $i < count($products); $i++) {
            $productName = $products[$i];
            $productCode = $productCodes[$i];
            $productDesign = $productDeisgns[$i];
            $productSize = $productSizes[$i];
            $productFeature = $productFeatures[$i];
            $productQty = $productQtys[$i];
            $sql7 = "INSERT INTO work_order_products(work_order_no,code,name,design,size,features,qty) VALUES ('$wno','$productCode','$productName','$productDesign','$productSize','$productFeature','$productQty')";
            //$result2 = mysqli_query($conn, "SELECT code FROM stock WHERE code = '$productCode'");
            $insert2 = mysqli_query($conn, $sql7);
            if(!$insert2) {
                echo mysqli_error($conn);
            }
        }
        
            echo "<script type='text/javascript'>
        window.location.href = 'workorder.php';
        </script>";
    }
    ?>

<div>

<h1>Work Orders Generated</h1>
<a href="workordershowall.php?f=0" target="_blank">Show All</a>
<table style="border-spacing: 30px;">
    <thead>
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
            while ($row = $retval3->fetch_assoc()) {
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
            &nbsp;
            {$row['name']}
            &nbsp;
            {$row['design']}
            &nbsp;
            {$row['size']}
            &nbsp;
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