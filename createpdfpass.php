<?php
include 'checkuserlogin.php.';

require_once('TCPDF-main/tcpdf.php');

$inpass_old = 0;
$outpass_old = 0;

$no = $_GET['no'];
$type = $_GET['io'];
if (isset($_GET['f'])) {
    if (isset($_GET['f']) == 'old') {
        $inpass_old = 1;
        $outpass_old = 1;
    }
}

if (!$conn) {
    // echo "Error Occured ";
}


$SorD = "";
$title = "";
$filename = $no;
if ($type == 'inpass') {
    $title = "INPASS";
    $SorD = "From";
    $filename .= ' INPASS';
} else if ($type == 'outpass') {
    $title = "OUTPASS";
    $SorD = "To";
    $filename .= ' OUTPASS';
}

$date = "";
$company = "";
$company_op = "";
$vehicle_no = "";
$extras = "";
$total_pieces = 0;
$profile_company_name = '';
$profile_company_address = '';
$sql3 = " SELECT * FROM profile WHERE user_id = '" . (string) $loggedin_session . "'";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    // echo mysqli_error($conn);
    // die($conn);
}
$company_data = mysqli_fetch_assoc($retval3);
$profile_company_name = $company_data['name'];
$profile_company_address = $company_data['address'];
if ($type == 'inpass') {
    if ($inpass_old == 1) {
        $sql = " SELECT * FROM inpass_old,inpass_products_old WHERE inpass_old.no_year = inpass_products_old.no_year AND inpass_products_old.no_year = '$no' AND inpass_old.user_id = '" . (string) $loggedin_session . "' AND inpass_products_old.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            // echo mysqli_error($conn);
            // die($conn);
        }

        $sql2 = " SELECT * FROM inpass_old,inpass_products_old WHERE inpass_old.no_year = inpass_products_old.no_year AND inpass_products_old.no_year = '$no' AND inpass_old.user_id = '" . (string) $loggedin_session . "' AND inpass_products_old.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval2 = mysqli_query($conn, $sql2);
        if (!$retval2) {
            // echo mysqli_error($conn);
            // die($conn);
        }
    } else {
        $sql = " SELECT * FROM inpass,inpass_products WHERE inpass.no = inpass_products.inpass_no AND inpass_products.inpass_no = '$no' AND inpass.user_id = '" . (string) $loggedin_session . "' AND inpass_products.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            // echo mysqli_error($conn);
            // die($conn);
        }

        $sql2 = " SELECT * FROM inpass,inpass_products WHERE inpass.no = inpass_products.inpass_no AND inpass_products.inpass_no = '$no' AND inpass.user_id = '" . (string) $loggedin_session . "' AND inpass_products.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval2 = mysqli_query($conn, $sql2);
        if (!$retval2) {
            // echo mysqli_error($conn);
            // die($conn);
        }
    }

    $result = mysqli_fetch_assoc($retval);
    $date = $result['date'];
    $company = $result['source'];
    $company_woc = $result['woc'];
    // $company_wono = $result['product_wono'];
    $source_opno = $result['op'];
    $vehicle_no = $result['vehicleno'];
    $extras = $result['extras'];
    $timestamp = $result['timestamp'];
    $datetime = explode(" ", $timestamp);
    $time = $datetime[1];
    $product_code = array();
    $product_wono = array();
    $product_name = array();
    $product_design = array();
    $product_size = array();
    $product_qty = array();
    mysqli_data_seek($retval2, 0);
    $i = 0;
    while ($row = mysqli_fetch_assoc($retval2)) {
        $product_code[$i] = $row['product_code'];
        $product_wono[$i] = $row['product_wono'];
        $product_name[$i] = $row['product_name'];
        $product_design[$i] = $row['product_design'];
        $product_size[$i] = $row['product_size'];
        $product_qty[$i] = $row['product_qty'];
        $total_pieces += $product_qty[$i];
        $i = $i + 1;
    }
}
if ($type == 'outpass') {
    if ($outpass_old == 1) {
        $sql = " SELECT * FROM outpass_old,outpass_products_old WHERE outpass_old.no_year = outpass_products_old.no_year AND outpass_products_old.no_year = '$no' AND outpass_old.user_id = '" . (string) $loggedin_session . "' AND outpass_products_old.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            // echo mysqli_error($conn);
            // die($conn);
        }

        $sql2 = "SELECT * FROM outpass_old,outpass_products_old WHERE outpass_old.no_year = outpass_products_old.no_year AND outpass_products_old.no_year = '$no' AND outpass_old.user_id = '" . (string) $loggedin_session . "' AND outpass_products_old.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval2 = mysqli_query($conn, $sql2);
        if (!$retval2) {
            // echo mysqli_error($conn);
            // die($conn);
        }
    } else {
        $sql = " SELECT * FROM outpass,outpass_products WHERE outpass.no = outpass_products.outpass_no AND outpass_products.outpass_no = '$no' AND outpass.user_id = '" . (string) $loggedin_session . "' AND outpass_products.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            // echo mysqli_error($conn);
            // die($conn);
        }

        $sql2 = "SELECT * FROM outpass,outpass_products WHERE outpass.no = outpass_products.outpass_no AND outpass_products.outpass_no = '$no' AND outpass.user_id = '" . (string) $loggedin_session . "' AND outpass_products.user_id = '" . (string) $loggedin_session . "' ORDER BY no DESC";
        $retval2 = mysqli_query($conn, $sql2);
        if (!$retval2) {
            // echo mysqli_error($conn);
            // die($conn);
        }
    }
    $product_code = array();
    $product_name = array();
    $product_design = array();
    $product_size = array();
    $product_bundle = array();
    $product_qty = array();
    $result = mysqli_fetch_assoc($retval);
    $date = $result['date'];
    $company = $result['dest'];
    $company_woc = $result['work_order_no'];
    $vehicle_no = $result['vehicleno'];
    $extras = $result['extras'];
    $timestamp = $result['timestamp'];
    $datetime = explode(" ", $timestamp);
    $time = $datetime[1];
    mysqli_data_seek($retval2, 0);
    $i = 0;
    while ($row = mysqli_fetch_assoc($retval2)) {
        $product_code[$i] = $row['product_code'];
        $product_name[$i] = $row['product_name'];
        $product_design[$i] = $row['product_design'];
        $product_size[$i] = $row['product_size'];
        $product_bundle[$i] = $row['product_bundle'];
        $product_qty[$i] = $row['product_qty'];
        $total_pieces += $product_qty[$i];
        $i = $i + 1;
    }
}

$customWidth = 210;
$aspect_ratio = 1.414;
$customHeight = 207;

if(count($product_code)>4){
for($l = 0;$l < count($product_code);$l++){
    $customHeight = $customHeight + 10;
}}

$pdf = new TCPDF('P', 'mm', array($customWidth,$customHeight)); // 'P' for portrait, 'mm' for millimeters, 'A4' for page size
$pdf->SetAutoPageBreak(false);

//Add Later
// $pdf->SetCreator('Your Name');
$pdf->SetAuthor($profile_company_name);
$pdf->SetTitle($no . ' ' . $title . ' PDF');
// $pdf->SetSubject('Document Subject');

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 10); // Set font
$pdf->Cell(0, 8, $title, 0, 1, 'C'); // Add centered text
// $pdf->Cell(0, 20, 'AKSHAY COIR', 0, 1, 'C');

// $pdf->SetFont('helvetica', '', 12); // Set font
// $pdf->Cell(0, 0, 'ALAPUZHA', 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 8, $profile_company_name, 0, 1, 'C');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, $profile_company_address, 0, 1, 'C');
$pdf->Ln(9); // Add some vertical spacing

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 8, "{$SorD}: {$company}", 0, 0);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 8, "Date:  {$date}", 0, 1, 'R');
if ($type == 'inpass') {
    $pdf->Cell(0, 8, "A/C of {$company_woc}", 0, 0, 'L');
}
if ($type == 'outpass') {
    $pdf->Cell(0, 8, "WO#: {$company_woc}", 0, 0, 'L');
}
$pdf->Cell(0, 8, "Time: " . date('g:i A', strtotime($time)), 0, 1, 'R');
if ($type == 'inpass') {
    $pdf->Cell(0, 8, "OP#: {$source_opno}", 0, 0, 'L');
}
// if($type == 'inpass'){
//     $pdf->Cell(0, 8, "WO#: {$company_wono}", 0, 0, 'L');
// }
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 8, ucfirst($type) . " No.: {$no}", 0, 1, 'R');
$pdf->SetFont('helvetica', '', 10);
// $pdf->Cell(0, 8, "{$SorD}: {$company} {$company_woc}", 0, 1);
$pdf->Cell(0, 8, "Vehicle No.: {$vehicle_no}", 0, 1, 'R');
if (!empty($extras)) {
    $pdf->Cell(0, 8, "Note: {$extras}", 0, 0);
}

$pdf->Ln(15);

if ($type == 'inpass') {
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(25, 10, 'Sl No.', 1, 0, 'C');
    $pdf->Cell(20, 10, 'WO#', 1, 0, 'C');
    $pdf->Cell(70, 10, 'Particulars', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Size/Description', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Pieces', 1, 1, 'C');
} else if ($type == 'outpass') {
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(15, 10, 'Sl No.', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Particulars', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Size/Description', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Bundle', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Pieces', 1, 1, 'C');
}

if ($type == 'inpass') {
    for ($i = 0; $i < count($product_code); $i++) {
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Cell(25, 10, $i + 1, 1, 0, 'C');
        $pdf->Cell(20, 10, $product_wono[$i], 1, 0, 'C');
        $pdf->Cell(70, 10, ucwords($product_name[$i]) . ' ' . ucwords($product_design[$i]), 1, 0, 'C');
        $pdf->Cell(45, 10, $product_size[$i], 1, 0, 'C'); // Placeholder for Size/Description
        $pdf->Cell(30, 10, $product_qty[$i], 1, 1, 'C');

    }
} else if($type == 'outpass'){
    for ($i = 0; $i < count($product_code); $i++) {
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Cell(15, 10, $i + 1, 1, 0, 'C');
        $pdf->Cell(80, 10, ucwords($product_name[$i]) . ' ' . ucwords($product_design[$i]), 1, 0, 'C');
        $pdf->Cell(45, 10, $product_size[$i], 1, 0, 'C'); // Placeholder for Size/Description
        $pdf->Cell(25, 10, $product_bundle[$i], 1, 0, 'C');
        $pdf->Cell(20, 10, $product_qty[$i], 1, 1, 'C');

    }
}

//---------------- 5 COULOUMNS TEMPLATE --------------------
// $pdf->SetFont('helvetica', 'B', 12);
// $pdf->Cell(25, 10, 'Sl No.', 1, 0, 'C');
// $pdf->Cell(80, 10, 'Particulars', 1, 0, 'C');
// $pdf->Cell(40, 10, 'Size/Description', 1, 0, 'C');
// $pdf->Cell(20, 10, 'Pieces', 1, 0, 'C');
// $pdf->Cell(30, 10, 'Total Pcs', 1, 1, 'C');

// for($i = 0 ; $i < count($product_code) ; $i++) {
//     $pdf->SetFont('helvetica', '', 8);
//     $pdf->Cell(25, 10, $i+1, 1, 0, 'C');
//     $pdf->Cell(80, 10, $product_name[$i] .' ' . $product_design[$i], 1, 0, 'C');
//     $pdf->Cell(40, 10, $product_size[$i], 1, 0, 'C'); // Placeholder for Size/Description
//     $pdf->Cell(20, 10, $product_qty[$i], 1, 0, 'C');
//     $pdf->Cell(30, 10, $product_qty[$i], 1, 1, 'C');
// }
//-----------------------------------------------------------

//initial template
// $pdf->SetFont('helvetica', '', 12);
// $pdf->Cell(10, 10, '2', 1, 0, 'C');
// $pdf->Cell(50, 10, 'Product Name 1', 1, 0, 'C');
// $pdf->Cell(40, 10, '', 1, 0, 'C'); // Placeholder for Size/Description
// $pdf->Cell(20, 10, '2', 1, 0, 'C');
// $pdf->Cell(20, 10, '', 1, 0, 'C'); // Placeholder for Pieces
// $pdf->Cell(20, 10, '', 1, 0, 'C'); // Placeholder for Units
// $pdf->Cell(30, 10, '$100', 1, 1, 'C');

$pdf->Ln(5);

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'Total Pieces: ' . $total_pieces, 0, 1, 'R');
$pdf->Ln(5);

$startX = $pdf->GetX();
$startY = $pdf->GetY();
$endX = $pdf->GetPageWidth() - $pdf->GetX();
$endY = $startY;
// Draw the line
$pdf->Line($startX, $startY, $endX, $endY);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'FOR ' . strtoupper($profile_company_name), 0, 1, 'R');
$pdf->SetFont('helvetica', '', 10);
$pdf->Ln(15);
$pdf->Cell(0, 5, 'Authorised Signatory', 0, 1, 'R');




$pdf->SetFillColor(240, 240, 240);


$pdf->Output($filename . '.pdf', 'I'); // 'D' to force download, or 'I' to display in the browser


?>