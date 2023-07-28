<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php
$workOrderNo = '000000';


// $sql = "select * from outpass,outpass_products where work_order_no = '$workOrderNo'";
// $retval = mysqli_query($conn, $sql);
// if (!$retval) {
//     echo mysqli_error($conn);
// }

// $sql2 = "select * from outpass where work_order_no = '$workOrderNo'";
// $retval2 = mysqli_query($conn, $sql2);
// if (!$retval2) {
//     echo mysqli_error($conn);
// }

// $row2 = mysqli_fetch_assoc($retval2);
// $company = $row2['dest'];
// $date = $row2['date'];
// ?>

<?php
// $slno = 1;
// $descTypes = ['Passing Final', 'Packing', 'Tagging', 'Landing And Loading'];
// $rates = ['1.50', '2.00', '5.75', '0.16'];
// $descTypesJson = json_encode($descTypes);
// $ratesJson = json_encode($rates);
?>

<html>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Generate GST Invoice</title>
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
        //
        var workOrderNo = 'AAA000'
        var descTypes = ['Passing Final', 'Packing', 'Tagging', 'Landing And Loading'];
        var rates = ['1.50', '2.00', '5.75', '0.16'];


        $(document).ready(function () {
            $("#add_data").click();
            $("#add_data_type").click();
        });

        // Add product field
        $("#add_data").click(function () {
            var dataproductField = `
            <div class='data_fields container-fluid'>
       
        <div  class='border border-1 rounded  border-primary p-2 mb-2 mt-4'>
        <div class='row p-4 justify-content-between'><div class='form-outline w-50'><input type='text' required name='product_name[]' id='pnamefield' class='product_name form-control' placeholder='Product Name'><label for='pnamefield' class='form-label'>Product Name</label></div> <button type='button' class='btn btn-outline-danger btn-floating shadow-0 remove_product' id='remove_product'>X</button></div>        
               <div id='data_types1'>
        
      `;
            var datatypeField = `
        
                    <div class ='data_fields1 row p-1' style="display:none">
                    
                    <div class='col'><div class='form-outline'> <input type='text' name='type[]' value='-12345' id='tfield' class='type form-control' placeholder='Type'><label for='tfield' class='form-label'>Type</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' name='size[]' value=' ' id='sfield' class='size form-control'><label for='sfield' class='form-label'>Size</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' name='unit[]' value=' ' id='ufield' class='unit form-control'><label for='ufield' class='form-label'>Unit</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' name='nopcs[]' value=' ' id='nopcsfield' class='nopcs form-control'><label for='nopcsfield' class='form-label'>No Pcs.</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' name='rm[]' value=' ' id='rfield' class='rm form-control'><label for='rfield' class='form-label'>RM/Sqf/Sam</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' data-id="field" value=' ' id='tofield' name='total_unit[]' class='total_unit form-control'><label for='tofield' class='form-label'>Total Unit</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='number' step='0.01' data-id="field" value=' ' id='rafield' name='rate[]' class='rate form-control'><label for='rafield' class='form-label'>Rate</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='number' data-id="field" value=' ' id='gfield' name='gst_per[]' class='gst_per form-control'><label for='gfield' class='form-label'>GST%</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' name='amount[]' value=' ' id='afield' readonly class='amount form-control'><label for='afield' class='form-label'>Amount</label></div></div>
                </div>
                
      `;
            // var type_limit = 1;
            // for (var i = 0; i < type_limit; i++) {
            dataproductField += datatypeField;
            // }
            dataproductField += "</div><button type='button' class='btn btn-outline-secondary add_data_type' id='add_data_type'>Add Type</button></div></div>";

            $("#data_body").append(dataproductField);
            $(this).parent("#add_data_type").click();
            initilizebootstrap();
        });

        //add data type
        $(document).on("click", "#add_data_type", function () {
            // var datatypeField = $(this).parent(".data_fields1");
            var datatypeField_val = `<div class ='data_fields1 row p-1'>
            <button class='btn text-danger btn-floating shadow-0 remove_data_type' id='remove_data_type'>X</button>
            <div class='col'><div class='form-outline'> <input type='text' name='type[]' required id='tfield' class='type form-control' placeholder='Type'><label for='tfield' class='form-label'>Type</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' required name='size[]' id='sfield' class='size form-control'><label for='sfield' class='form-label'>Size</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' required name='unit[]' id='ufield' class='unit form-control'><label for='ufield' class='form-label'>Unit</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' required name='nopcs[]' id='nopcsfield' class='nopcs form-control'><label for='nopcsfield' class='form-label'>No Pcs.</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' required name='rm[]' id='rfield' class='rm form-control'><label for='rfield' class='form-label'>RM/Sqf/Sam</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' required data-id="field" id='tofield' name='total_unit[]' class='total_unit form-control'><label for='tofield' class='form-label'>Total Unit</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='number' step='0.01' required data-id="field" id='rafield' name='rate[]' class='rate form-control'><label for='rafield' class='form-label'>Rate</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='number' required data-id="field" value='18' id='gfield' name='gst_per[]' class='gst_per form-control'><label for='gfield' class='form-label'>GST%</label></div></div>
                    <div class='col'><div class='form-outline'> <input type='text' required name='amount[]' id='afield' class='amount form-control'><label for='afield' class='form-label'>Amount</label></div></div>
                    </div>`;
            $(this).closest(".data_fields").find("#data_types1").append(datatypeField_val);
            initilizebootstrap();
        })

        //remove data type
        $(document).on("click", "#remove_data_type", function () {
            // var datatypeField = $(this).parent(".data_fields1");
            $(this).parent(".data_fields1").remove();
            initilizebootstrap();
        })


        // Remove product field
        $(document).on("click", "#remove_product", function () {
            $(this).closest(".data_fields").remove();
            initilizebootstrap();
        });
    });

    $(document).ready(function () {

        $('.gst_per').on('change', function () {
            var newValue = $(this).val(); // Get the new value entered in the changed input field
            $('.gst_per').not(this).val(newValue); // Set the new value to all other input fields except the changed one
            initilizebootstrap();
        });
    });

    $(document).ready(function () {
        $('.gst_per').on('keyup', function () {
            var newValue = $(this).val(); // Get the new value entered in the changed input field
            $('.gst_per').not(this).val(newValue); // Set the new value to all other input fields except the changed one
            initilizebootstrap();
        });

        $(document).on('keyup', 'input[data-id="field"]', function () {
            var newValue = $(this).val()
            //for display
            var grand_total = $('.grand_total')
            // *_input for php
            var grand_total_input = $('#grand_total_input')
            var cgst = $('.cgst')
            var cgst_input = $('#cgst_input')
            var sgst = $('.sgst')
            var sgst_input = $('#sgst_input')
            var less_ro = $('.less_ro')
            var less_ro_input = $('#less_ro_input')
            var total_amount = $('.total_amount')
            var total_amount_input = $('#total_amount_input')
            // alert($(".data_fields").eq(1).find(".data_fields1").length);
            var l = $(".data_fields").length;
            var m = 0;
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
            var k2 = 0;
            for (var j = 0; j < l; j++) {
                m = $(".data_fields").eq(j).find(".data_fields1").length;

                for (var k = 0; k < m; k++, k2++) {
                    cur_amt = 0;
                    var skip = $(".data_fields1").eq(k2).find(".type").val();
                    if (skip == '-12345') {
                        continue;
                    }
                    var totalunitField = $(".data_fields1").eq(k2).find(".total_unit").val();
                    var rateField = $(".data_fields1").eq(k2).find(".rate").val();
                    var gstField = $(".data_fields1").eq(k2).find(".gst_per").val();
                    var amountField = $(".data_fields1").eq(k2).find(".amount");
                    //takes only numbers
                    var digits = totalunitField.match(/\d+(\.\d+)?/g);
                    // Join the extracted digits into a single string
                    var extractedDigits = digits ? digits.join('') : '';
                    cur_amt += (extractedDigits * rateField);
                    amountField.val(cur_amt.toFixed(2));
                    gt += parseFloat(cur_amt.toFixed(2));
                }
            }
            initilizebootstrap();

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
            initilizebootstrap();

        });

    });

</script>

<body>
    <main> <br>
        <h1 class="mt-2 ms-4">GST Invoice</h1>
        <div class="container-fluid">
            <form id='gstinvoice' class="bg-white " method='POST'>
                <div class="rounded-5 shadow-2-strong p-5">
                    <h4 class='mb-4 fw-bold'>Enter the following</h4>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" required id='invnofield' class="form-control" name='invoice_no'>
                                <label for='invnofield' class='form-label'>Invoice No</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="date" required id='datefield' class="form-control" name='date'>
                                <label for='datefield' class='form-label'>Date</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" required id='wnofield' class="form-control" name='wno'>
                                <label for='wnofield' class='form-label'>Work Order No.</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" required id='companyfield' class="form-control" name='company'>
                                <label for='companyfield' class='form-label'>Company (dest.)</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='comgstfield' class="form-control" name='company_gstin'>
                                <label for='comgstfield' class='form-label'>Company (dest.) GSTIN</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='confield' class="form-control" name='contact'>
                                <label for='confield' class='form-label'>Contact</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="posfield" class="form-control" name='place_of_supply'>
                                <label for='posfield' class='form-label'>Place of Supply</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='scfield' class="form-control" name='statecode'>
                                <label for='scfield' class='form-label'>State Code</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='motfield' class="form-control" name='mode_of_transport'>
                                <label for='motfield' class='form-label'> Mode of Transport</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='typefield' class="form-control" name='type_of_payment'>
                                <label for='typefield' class='form-label'>Payment Type</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='notefield' class="form-control" name='note'>
                                <label for='notefield' class='form-label'>Notes</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type='number' id='gstperallfield' name='gst_per_all' class='gst_per form-control'
                                    value="18">
                                <label for='gstperallfield' class='form-label'>GST Percentage</label>
                            </div>
                        </div>
                    </div>
                    <div id='data_field'>

                    </div>
                </div>

                <div class="container-fluid mt-2 mb-4 p-2 bg-white rounded-5 shadow-1-strong">
                    <h4 class='mb-4 fw-bold ps-4 pt-4'>Product Detials</h4>
                    <div class="row mb-1 ms-2">

                        <div class="col">
                            DESCRIPTION
                        </div>
                        <div class="col">
                            SIZE
                        </div>
                        <div class="col">
                            Unit
                        </div>
                        <div class="col">
                            NO: PICS
                        </div>
                        <div class="col">
                            RM/Sqf/Sam
                        </div>
                        <div class="col">
                            Total Unit
                        </div>
                        <div class="col">
                            Rate
                        </div>
                        <div class="col">
                            GST
                        </div>
                        <div class="col">
                            Amount
                        </div>
                    </div>
                    <div id='data_body'>

                    </div>
                    <button type="button" class='btn btn-outline-primary add_data' id='add_data'>Add Product</button>

                    <div class="container d-flex flex-column justify-content-start align-items-end">
                        <div class=''>
                            <div class="d-flex flex-row ">
                                <p class=' fs-6 text-muted'>Grand Total : &nbsp;</p><span id='grand_total'
                                    name='grand_total' class='grand_total fw-bold fs-5 fw-bold'></span>
                                <input type="hidden" name="grand_total" value="" id="grand_total_input">
                            </div>
                            <div class="d-flex flex-row ">
                                <p class=' fs-6 text-muted'>CGST Collected : &nbsp;</p><span id='cgst' name='cgst'
                                    class='cgst'></span>
                                <input type="hidden" name="cgst" value="" id="cgst_input">
                            </div>
                            <div class="d-flex flex-row ">
                                <p class=' fs-6 text-muted'>SGST Collected : &nbsp;</p><span id='sgst' name='sgst'
                                    class='sgst'></span>
                                <input type="hidden" name="sgst" value="" id="sgst_input">
                            </div>
                            <div class="d-flex flex-row ">
                                <p class=' fs-6 text-muted'>Less : Round Off : &nbsp;</p><span id='less_ro'
                                    name='less_ro' class='less_ro'></span>
                                <input type="hidden" name="less_ro" value="" id="less_ro_input">
                            </div>
                            <div class="d-flex flex-row ">
                                <p class=' fs-6 text-muted'>Total AMOUNT : &nbsp;</p><span id='total_amount'
                                    class='total_amount fw-bold fs-4 fw-bold'></span>
                                <input type="hidden" name="total_amount" value="" id="total_amount_input">
                            </div>
                        </div>
                    </div>
                </div>
                <center>
                    <label class="mb-2">Please Note that Old Invoice of this Work Order will be deleted if New Invoice
                        is
                        Generated</label>
                    <br>
                    <input type="submit" name='generate' class="btn btn-success" value="Generate Invoice">
                </center>
            </form>
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

    $invoice_no = $_POST['invoice_no'];
    $date = $_POST['date'];
    $workOrderNo = $_POST['wno'];
    $company = $_POST['company'];
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
    $sql4 = "DELETE FROM invoice where invoice_no = '$invoice_no' AND user_id = '".(string)$loggedin_session."'";
    $delete1 = mysqli_query($conn, $sql4);
    if (!$delete1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
    }
    $sql5 = "DELETE FROM invoice_data where invoice_no = '$invoice_no' AND user_id = '".(string)$loggedin_session."'";
    $delete2 = mysqli_query($conn, $sql5);
    if (!$delete2) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
    }

    $sql = "INSERT INTO invoice(invoice_no,date,company,company_gstin,work_order_no,place_of_supply,type_of_payment,contact,statecode,note,gst_percentage,grand_total,cgst,sgst,less_ro,total_amount,mode_of_transport,user_id) VALUES ('$invoice_no','$date','$company','$company_gstin','$workOrderNo','$place_of_supply','$type_of_payment','$contact','$statecode','$note','$gst_per_all','$grand_total','$cgst','$sgst','$less_ro','$total_amount','$mode_of_transport','".(string)$loggedin_session."')";
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

        if ($type == '-12345') {
            continue;
        }

        $sql2 = "INSERT INTO invoice_data(invoice_no,work_order_no,product_slno,product_name,type,size,unit,nopcs,rm,total_unit,rate,gst,amount,user_id) VALUES ('$invoice_no','$workOrderNo','$j','$productNames[$j]','$type','$size','$unit','$nopcs','$rm','$total_unit','$rate','$gst_per','$amount','".(string)$loggedin_session."')";
        $insert2 = mysqli_query($conn, $sql2);
        if (!$insert2) {
            echo mysqli_error($conn);
            mysqli_rollback($conn);
            exit;
        }
        if ($i + 1 < count($types) && $types[$i + 1] == '-12345') {
            $j += 1;
        }
    }
    // $sql3 = "UPDATE `outpass` SET invoice_no='$invoice_no' WHERE work_order_no = '$workOrderNo'";
    // $insert3 = mysqli_query($conn, $sql3);
    // if (!$insert3) {
    //     echo mysqli_error($conn);
    //     mysqli_rollback($conn);
    // }
    mysqli_commit($conn);
    echo "<script type='text/javascript'>
            window.location.href = 'createpdfgstinvoice.php?wo=$workOrderNo&in=$invoice_no';
            </script>";
}
?>