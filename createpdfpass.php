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


$SorD = "A/C";
$title = "";
if ($type == 'inpass') {
    $title = "INPASS";
} else if ($type == 'outpass') {
    $title = "OUTPASS";
}
$date = "";
$company = "";
$company_op = "";
$vehicle_no = "";
$extras = "";
$total_pieces = 0;
$profile_company_name = '';
//$profile_company_address = '';
$sql3 = " SELECT * FROM profile WHERE user_id = '" . (string) $loggedin_session . "'";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    // echo mysqli_error($conn);
    // die($conn);
}
$company_data = mysqli_fetch_assoc($retval3);
$profile_company_name = $company_data['name'];
//$profile_company_address = $company_data['address'];
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
    $source_opno = $result['op'];
    $vehicle_no = $result['vehicleno'];
    $extras = $result['extras'];
    $product_code = array();
    $product_name = array();
    $product_design = array();
    $product_size = array();
    $product_qty = array();
    mysqli_data_seek($retval2, 0);
    $i = 0;
    while ($row = mysqli_fetch_assoc($retval2)) {
        $product_code[$i] = $row['product_code'];
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
    $product_qty = array();
    $result = mysqli_fetch_assoc($retval);
    $date = $result['date'];
    $company = $result['dest'];
    $company_woc = $result['woc'];
    $vehicle_no = $result['vehicleno'];
    if ($type == 'inpass') {
        $company_op = $result['op'];
    }
    $vehicle_no = $result['vehicleno'];
    $extras = $result['extras'];
    mysqli_data_seek($retval2, 0);
    $i = 0;
    while ($row = mysqli_fetch_assoc($retval2)) {
        $product_code[$i] = $row['product_code'];
        $product_name[$i] = $row['product_name'];
        $product_design[$i] = $row['product_design'];
        $product_size[$i] = $row['product_size'];
        $product_qty[$i] = $row['product_qty'];
        $total_pieces += $product_qty[$i];
        $i = $i + 1;
    }
}

$pdf = new TCPDF('P', 'mm', 'A4'); // 'P' for portrait, 'mm' for millimeters, 'A4' for page size

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
$pdf->Cell(0, 5, 'NC John Dippo Road Thumpoli, Alapuzha', 0, 1, 'C');
$pdf->Ln(9); // Add some vertical spacing

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 8, "Date:  {$date}", 0, 1);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 8,  ucfirst($type)." No.: {$no}", 0, 1);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 8, "{$SorD}: {$company} {$company_woc}", 0, 1);
if ($type == 'inpass') {
    $pdf->Cell(0, 8, "OP#: {$source_opno}", 0, 1);
}
$pdf->Cell(0, 8, "Vehicle No. : {$vehicle_no}", 0, 1);
if (!empty($extras)) {
    $pdf->Cell(0, 8, "extras : {$extras}", 0, 1);
}
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(25, 10, 'Sl No.', 1, 0, 'C');
$pdf->Cell(90, 10, 'Particulars', 1, 0, 'C');
$pdf->Cell(45, 10, 'Size/Description', 1, 0, 'C');
$pdf->Cell(30, 10, 'Pieces', 1, 1, 'C');

for ($i = 0; $i < count($product_code); $i++) {
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(25, 10, $i + 1, 1, 0, 'C');
    $pdf->Cell(90, 10, ucwords($product_name[$i]) . ' ' . ucwords($product_design[$i]), 1, 0, 'C');
    $pdf->Cell(45, 10, $product_size[$i], 1, 0, 'C'); // Placeholder for Size/Description
    $pdf->Cell(30, 10, $product_qty[$i], 1, 1, 'C');

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
$pdf->Cell(0, 5, 'FOR '.strtoupper($profile_company_name), 0, 1, 'R');
$pdf->SetFont('helvetica', '', 10);
$pdf->Ln(15);
$pdf->Cell(0, 5, 'Authorised Signatory', 0, 1, 'R');




$pdf->SetFillColor(240, 240, 240);

$pdf->Output('output.pdf', 'I'); // 'D' to force download, or 'I' to display in the browser


?>