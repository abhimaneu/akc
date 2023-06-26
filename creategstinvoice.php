<?php
include 'conn.php';
?>

<?php
$workOrderNo = $_GET['wo'];
$invoice_no = $workOrderNo[0] . $workOrderNo[-3] . $workOrderNo[-2] . $workOrderNo[-1];

$sql = "select * from outpass,outpass_products where work_order_no = '$workOrderNo'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}

$sql2 = "select * from outpass where work_order_no = '$workOrderNo'";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}

$row2 = mysqli_fetch_assoc($retval2);
$company = $row2['dest'];
$date = $row2['date'];
?>

<?php
$slno = 1;
$descTypes = ['Passing Final', 'Packing', 'Tagging', 'Landing And Loading'];
$rates = ['1.50', '2.00', '5.75', '0.16'];
$descTypesJson = json_encode($descTypes);
$ratesJson = json_encode($rates);
?>

<html>
<style>
    input[type="text"] {
        width: 110px;
    }
</style>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {
        //
        var workOrderNo = '<?php echo $workOrderNo ?>'
        var descTypes = ['Passing Final', 'Packing', 'Tagging', 'Landing And Loading'];
        var rates = ['1.50', '2.00', '5.75', '0.16'];


        $.ajax({
            method: "POST",
            url: "getproductdatafromwnofromoutpass.php",
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
                    var m = l * 4;
                    var k = 0;

                    var grand_total = $('.grand_total')
                    var grand_total_input = $('#grand_total_input')
                    var cgst = $('.cgst')
                    var cgst_input = $('#cgst_input')
                    var sgst = $('.sgst')
                    var sgst_input = $('#sgst_input')
                    var less_ro = $('.less_ro')
                    var less_ro_input = $('#less_ro_input')
                    var total_amount = $('.total_amount')
                    var total_amount_input = $('#total_amount_input')
                    var l = productData.length;
                    var m = l * 4;
                    var k = 0;
                    var i = 0;
                    var cur_amt = 0;
                    var cur_total;
                    var gt = 0;
                    var cgst_def = 9;
                    var cgst_value = 0;
                    var sgst_def = 9;
                    var sgst_value = 0;
                    var lro_value = 0;

                    for (var i = 0; i < l; i++) {
                        $('#add_data').click();
                        var productNameField = $(".data_fields:eq(" + i + ")").find(".product_name");
                        productNameField.val(productData[i].name + " " + productData[i].design);
                    }
                    var i = 0;
                    var cur_amt = 0;
                    for (var j = 0; j < m; j++) {
                        cur_amt = 0;
                        var typeField = $(".data_fields1:eq(" + j + ")").find(".type");
                        var sizeField = $(".data_fields1:eq(" + j + ")").find(".size");
                        var unitField = $(".data_fields1:eq(" + j + ")").find(".unit");
                        var nopcsField = $(".data_fields1:eq(" + j + ")").find(".nopcs");
                        var rmField = $(".data_fields1:eq(" + j + ")").find(".rm");
                        var totalunitField = $(".data_fields1:eq(" + j + ")").find(".total_unit");
                        var rateField = $(".data_fields1:eq(" + j + ")").find(".rate");
                        var gstField = $(".data_fields1:eq(" + j + ")").find(".gst_per");
                        var amountField = $(".data_fields1:eq(" + j + ")").find(".amount");
                        typeField.val(descTypes[k]);
                        sizeField.val(productData[i].size);
                        unitField.val("Inch");
                        nopcsField.val(productData[i].qty);
                        rmField.val(productData[i].qty);
                        totalunitField.val(productData[i].qty + " " + "Nos");
                        rateField.val(rates[k]);
                        gstField.val('18');
                        amountField.val(0);

                        var digits = totalunitField.val().match(/\d+(\.\d+)?/g);
                        var extractedDigits = digits ? digits.join('') : '';
                        cur_amt += (extractedDigits * rateField.val());
                        amountField.val(cur_amt.toFixed(2));
                        gt += parseFloat(cur_amt.toFixed(2));
                        k += 1;
                        if ((j + 1) % 4 == 0) {
                            k = 0
                            i += 1;
                        }

                        grand_total.text(gt.toFixed(2));
                        grand_total_input.val(gt.toFixed(2));
                        cgst_value = gt.toFixed(2) * (cgst_def / 100);
                        sgst_value = gt.toFixed(2) * (sgst_def / 100);
                        cgst.text(cgst_value.toFixed(2));
                        cgst_input.val(cgst_value.toFixed(2));
                        sgst.text(sgst_value.toFixed(2));
                        sgst_input.val(sgst_value.toFixed(2));
                        cur_total = (parseFloat(gt.toFixed(2)) + parseFloat(cgst_value.toFixed(2)) + parseFloat(sgst_value.toFixed(2)));
                        lro_value = (parseFloat(cur_total) - parseFloat(Math.floor(cur_total)));
                        less_ro.text(lro_value.toFixed(2));
                        less_ro_input.val(lro_value.toFixed(2));
                        total_amount.text(Math.floor(cur_total) + '.00');
                        total_amount_input.val(Math.floor(cur_total) + '.00');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var message = "ERROR: something went wrong with the AJAX call - " + textStatus + " - " + errorThrown;
                alert(message);
            }
        });

        // Add product field
        $("#add_data").click(function () {
            var dataproductField = `
            <tbody class='data_fields'>
       
        
        <tr><td></td><td><input type='text' name='product_name[]' class='product_name' placeholder='Product Name'></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>        
               
        
      `;
            var datatypeField = `
        
                    <tr class ='data_fields1'>
                    <td> No. </td>
                    <td><input type='text' name='type[]' class='type' placeholder='Type'></td>
                    <td><input type='text' name='size[]' class='size'></td>
                    <td><input type='text' name='unit[]' class='unit'></td>
                    <td><input type='text' name='nopcs[]' class='nopcs'></td>
                    <td><input type='text' name='rm[]' class='rm'></td>
                    <td><input type='text' data-id="field" name='total_unit[]' class='total_unit'></td>
                    <td><input type='text' data-id="field" name='rate[]' class='rate'></td>
                    <td><input type='text' data-id="field" name='gst_per[]' class='gst_per'></td>
                    <td><input type='text' name='amount[]' readonly class='amount'></td>
                </tr>
                
      `;
            var type_limit = 4;
            for (var i = 0; i < type_limit; i++) {
                dataproductField += datatypeField;
            }
            dataproductField += '</tbody>'

            $("#data_body").append(dataproductField);
        });

        // Remove product field
        $(document).on("click", ".remove_product_field", function () {
            $(this).parent(".product_field").remove();
        });
    });

    $(document).ready(function () {
        $('.gst_per').on('change', function () {
            var newValue = $(this).val(); // Get the new value entered in the changed input field
            $('.gst_per').not(this).val(newValue); // Set the new value to all other input fields except the changed one
        });
    });

    $(document).ready(function () {
        $('.gst_per').on('keyup', function () {
            var newValue = $(this).val(); // Get the new value entered in the changed input field
            $('.gst_per').not(this).val(newValue); // Set the new value to all other input fields except the changed one
        });

        $(document).on('keyup', 'input[data-id="field"]', function () {
            var newValue = $(this).val()
            var grand_total = $('.grand_total')
            var grand_total_input = $('#grand_total_input')
            var cgst = $('.cgst')
            var cgst_input = $('#cgst_input')
            var sgst = $('.sgst')
            var sgst_input = $('#sgst_input')
            var less_ro = $('.less_ro')
            var less_ro_input = $('#less_ro_input')
            var total_amount = $('.total_amount')
            var total_amount_input = $('#total_amount_input')
            var l = productData.length;
            var m = l * 4;
            var k = 0;
            var i = 0;
            var cur_amt = 0;
            var cur_total;
            var gt = 0;
            var cgst_def = 9;
            var cgst_value = 0;
            var sgst_def = 9;
            var sgst_value = 0;
            var lro_value = 0;
            for (var j = 0; j < m; j++) {
                cur_amt = 0;
                var totalunitField = $(".data_fields1:eq(" + j + ")").find(".total_unit").val();
                var rateField = $(".data_fields1:eq(" + j + ")").find(".rate").val();
                var gstField = $(".data_fields1:eq(" + j + ")").find(".gst_per").val();
                var amountField = $(".data_fields1:eq(" + j + ")").find(".amount");
                //takes only numbers
                var digits = totalunitField.match(/\d+(\.\d+)?/g);
                // Join the extracted digits into a single string
                var extractedDigits = digits ? digits.join('') : '';
                cur_amt += (extractedDigits * rateField);
                amountField.val(cur_amt.toFixed(2));
                gt += parseFloat(cur_amt.toFixed(2));
                k += 1;
                if ((j + 1) % 4 == 0) {
                    k = 0
                    i += 1;
                }

            }

            grand_total.text(gt.toFixed(2));
            grand_total_input.val(gt.toFixed(2));
            cgst_value = gt.toFixed(2) * (cgst_def / 100);
            sgst_value = gt.toFixed(2) * (sgst_def / 100);
            cgst.text(cgst_value.toFixed(2));
            cgst_input.val(cgst_value.toFixed(2));
            sgst.text(sgst_value.toFixed(2));
            sgst_input.val(sgst_value.toFixed(2));
            cur_total = (parseFloat(gt.toFixed(2)) + parseFloat(cgst_value.toFixed(2)) + parseFloat(sgst_value.toFixed(2)));
            lro_value = (parseFloat(cur_total) - parseFloat(Math.floor(cur_total)));
            less_ro.text(lro_value.toFixed(2));
            less_ro_input.val(lro_value.toFixed(2));
            total_amount.text(Math.floor(cur_total) + '.00');
            total_amount_input.val(Math.floor(cur_total) + '.00');

        });

    });

</script>

<body>
    <h1>GST Invoice</h1>
    <form id='gstinvoice' method='POST'>
        Invoice No.:
        <?php echo "$invoice_no"; ?><br>
        To:
        <?php echo "$company"; ?> <br>
        Date:
        <?php echo "$date"; ?> <br>
        Place of Sply: <input type="text" name='place_of_supply' placeholder="Enter if avalable"> <br>
        Contact : <input type="text" name='contact' placeholder="Enter if avalable"> <br>
        GSTIN: <input type="text" name='company_gstin' placeholder="Type Here"> <br> <br>
        Type: <input type="text" name='type_of_payment' placeholder="Payment Method"> <br> <br>
        Mode of Transport: <input type="text" name='mode_of_transport' placeholder="Enter Here"> <br> <br>
        WO NO:
        <?php echo "$workOrderNo"; ?> <br> <br>
        StateCode: <input type="text" name='statecode' placeholder="Type Here"> <br> <br>
        Note: <input type="text" name='note' placeholder="Enter if avalable">
        Current GST Percentage : <input type='text' name='gst_per_all' class='gst_per' value="18">
        <div id='data_field'>

        </div>
        <table style="border-spacing:30px;">
            <thead>
                <th>
                    No.
                </th>
                <th>
                    DESCRIPTION
                </th>
                <th>
                    SIZE
                </th>
                <th>
                    Unit
                </th>
                <th>
                    NO: PICS
                </th>
                <th>
                    RM/Sqf/Sam
                </th>
                <th>
                    Total Unit
                </th>
                <th>
                    Rate
                </th>
                <th>
                    GST
                </th>
                <th>
                    Amount
                </th>
            </thead>
        </table>
        <div id='data_body'>

        </div>
        <button type="button" style="visibility: hidden;" class='add_data' id='add_data'>Add</button>
        <button type="button" style="visibility: hidden;" class='add_data_type' id='add_data_type'>Add Type</button>
        <div>
            Grand Total : <span id='grand_total' name='grand_total' class='grand_total'></span> <br>
            <input type="hidden" name="grand_total" value="" id="grand_total_input">
            CGST Collected : <span id='cgst' name='cgst' class='cgst'></span> <br>
            <input type="hidden" name="cgst" value="" id="cgst_input">
            SGST Collected : <span id='sgst' name='sgst' class='sgst'></span> <br>
            <input type="hidden" name="sgst" value="" id="sgst_input">
            Less : Round Off : <span id='less_ro' name='less_ro' class='less_ro'></span> <br>
            <input type="hidden" name="less_ro" value="" id="less_ro_input">
            Total AMOUNT : <span id='total_amount' class='total_amount'></span> <br>
            <input type="hidden" name="total_amount" value="" id="total_amount_input">
        </div>
        <center>
            <label>Please Note that old invoice of this WO will be deleted if new Invoice is Generated</label> <br>
            <input type="submit" name='generate' value="Generate Invoice">
        </center>
    </form>
</body>

</html>

<?php
if (isset($_POST['generate'])) {
    $productNames = $_POST['product_name'];
    $types = $_POST['type'];
    $sizes = $_POST['size'];
    $units = $_POST['unit'];
    $nopcses = $_POST['nopcs'];
    $rms = $_POST['rm'];
    $total_units = $_POST['total_unit'];
    $rates = $_POST['rate'];
    $gst_pers = $_POST['gst_per'];
    $amounts = $_POST['amount'];
    $grand_total = $_POST['grand_total'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $less_ro = $_POST['less_ro'];
    $total_amount = $_POST['total_amount'];

    $company_gstin = $_POST['company_gstin'];
    $type_of_payment = $_POST['type_of_payment'];
    $place_of_supply = $_POST['place_of_supply'];
    $mode_of_transport = $_POST['mode_of_transport'];
    $contact = $_POST['contact'];
    $statecode = $_POST['statecode'];
    $note = $_POST['note'];
    $gst_per_all = $_POST['gst_per_all'];

    $begintrans = "START TRANSACTION";
    $trans = mysqli_query($conn, $begintrans);
    if (!$trans) {
        echo mysqli_error($conn);
        exit;
    }

    //delete existing if new invoice is being generated
    $sql4 = "DELETE FROM invoice where work_order_no = '$workOrderNo'";
    $delete1 = mysqli_query($conn, $sql4);
    if (!$delete1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
    }
    $sql5 = "DELETE FROM invoice_data where work_order_no = '$workOrderNo'";
    $delete2 = mysqli_query($conn, $sql5);
    if (!$delete2) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
    }

    $sql = "INSERT INTO invoice(invoice_no,date,company,company_gstin,work_order_no,place_of_supply,type_of_payment,contact,statecode,note,gst_percentage,grand_total,cgst,sgst,less_ro,total_amount,mode_of_transport) VALUES ('$invoice_no','$date','$company','$company_gstin','$workOrderNo','$place_of_supply','$type_of_payment','$contact','$statecode','$note','$gst_per_all','$grand_total','$cgst','$sgst','$less_ro','$total_amount','$mode_of_transport')";
    $insert1 = mysqli_query($conn, $sql);
    if (!$insert1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
    }

    $j = 0;
    for ($i = 0; $i < count($types); $i++) {
        $type = $types[$i];
        $size = $sizes[$i];
        $unit = $units[$i];
        $nopcs = $nopcses[$i];
        $rm = $rms[$i];
        $total_unit = $total_units[$i];
        $rate = $rates[$i];
        $gst_per = $gst_pers[$i];
        $amount = $amounts[$i];
        $sql2 = "INSERT INTO invoice_data(invoice_no,work_order_no,product_name,type,size,unit,nopcs,rm,total_unit,rate,gst,amount) VALUES ('$invoice_no','$workOrderNo','$productNames[$j]','$type','$size','$unit','$nopcs','$rm','$total_unit','$rate','$gst_per','$amount')";
        $insert2 = mysqli_query($conn, $sql2);
        if (!$insert2) {
            echo mysqli_error($conn);
            mysqli_rollback($conn);
            exit;
        }
        if (($i + 1) % 4 == 0) {
            $j += 1;
        }
    }
    $sql3 = "UPDATE `outpass` SET invoice_no='$invoice_no' WHERE work_order_no = '$workOrderNo'";
    $insert3 = mysqli_query($conn, $sql3);
    if (!$insert3) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
    }
    mysqli_commit($conn);
    echo "<script type='text/javascript'>
            window.open('createpdfgstinvoice.php?wo=$workOrderNo&in=$invoice_no');
            </script>";
}
?>