<?php
require_once('TCPDF-main/tcpdf.php');

$no = $_GET['no'];
$type = $_GET['io'];

$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

if (!$conn) {
    // echo "Error Occured ";
}

$SorD = "A/C";
$date = "";
$company = "";
$company_op = "";
$vehicle_no = "";
$extras = "";
if ($type == 'inpass') {
    $sql = " SELECT * FROM inpass,inpass_products WHERE inpass.no = inpass_products.inpass_no AND inpass_products.inpass_no = '$no' ORDER BY no DESC";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        // echo mysqli_error($conn);
        // die($conn);
    }

    $sql2 = " SELECT * FROM inpass,inpass_products WHERE inpass.no = inpass_products.inpass_no AND inpass_products.inpass_no = '$no' ORDER BY no DESC";
    $retval2 = mysqli_query($conn, $sql2);
    if (!$retval2) {
        // echo mysqli_error($conn);
        // die($conn);
    }
    $result = mysqli_fetch_assoc($retval);
    $date = $result['date'];
    $company = $result['source'];
    $company_woc = $result['woc'];
    $company_op = $result['op'];
    $vehicle_no = $result['vehicleno'];
    $extras = $result['extras'];
}
if ($type == 'outpass') {
    $sql = " SELECT * FROM outpass,outpass_products WHERE outpass.no = outpass_products.outpass_no AND outpass_products.outpass_no = '$no' ORDER BY no DESC";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        // echo mysqli_error($conn);
        // die($conn);
    }

    $sql2 = "SELECT * FROM outpass,outpass_products WHERE outpass.no = outpass_products.outpass_no AND outpass_products.outpass_no = '$no' ORDER BY no DESC";
    $retval2 = mysqli_query($conn, $sql2);
    if (!$retval2) {
        // echo mysqli_error($conn);
        // die($conn);
    }
    $result = mysqli_fetch_assoc($retval);
    $date = $result['date'];
    $company = $result['dest'];
    $company_woc = $result['woc'];
    $vehicle_no = $result['vehicleno'];
    if($type == 'inpass'){
    $company_op = $result['op'];
    }
    $vehicle_no = $result['vehicleno'];
    $extras = $result['extras'];
}

$pdf = new TCPDF('P', 'mm', 'A4'); // 'P' for portrait, 'mm' for millimeters, 'A4' for page size

//Add Later
// $pdf->SetCreator('Your Name');
// $pdf->SetAuthor('Your Name');
// $pdf->SetTitle('Your Document Title');
// $pdf->SetSubject('Document Subject');

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 12); // Set font
$pdf->Cell(0, 10, 'OUTPASS', 0, 1, 'C'); // Add centered text
// $pdf->Cell(0, 20, 'AKSHAY COIR', 0, 1, 'C');

// $pdf->SetFont('helvetica', '', 12); // Set font
// $pdf->Cell(0, 0, 'ALAPUZHA', 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Akshay Coir', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 5, 'Chettikad,Alapuzha', 0, 1, 'C');
$pdf->Ln(10); // Add some vertical spacing

$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Date:  {$date}", 0, 1);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, "No. {$no}", 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "{$SorD} : {$company} {$company_woc}", 0, 1);
if ($type != 'inpass') {
    $pdf->Cell(0, 10, "Vehicle No. {$vehicle_no}", 0, 1);
}
$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(10, 10, 'Item', 1, 0, 'C');
$pdf->Cell(50, 10, 'Particulars', 1, 0, 'C');
$pdf->Cell(40, 10, 'Size/Description', 1, 0, 'C');
$pdf->Cell(20, 10, 'Bundle', 1, 0, 'C');
$pdf->Cell(20, 10, 'Pieces', 1, 0, 'C');
$pdf->Cell(20, 10, 'Units', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total Pcs', 1, 1, 'C');

$i = 1;
while ($row = mysqli_fetch_assoc($retval2)) {
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(10, 10, $i, 1, 0, 'C');
    $pdf->Cell(50, 10, $row['product_name'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['product_desc'], 1, 0, 'C'); // Placeholder for Size/Description
    $pdf->Cell(20, 10, $row['product_bundle'], 1, 0, 'C');
    $pdf->Cell(20, 10, '', 1, 0, 'C'); // Placeholder for Pieces
    $pdf->Cell(20, 10, '', 1, 0, 'C'); // Placeholder for Units
    $pdf->Cell(30, 10, $row['product_bundle'], 1, 1, 'C');
    $i = $i + 1;
}

// $pdf->SetFont('helvetica', '', 12);
// $pdf->Cell(10, 10, '2', 1, 0, 'C');
// $pdf->Cell(50, 10, 'Product Name 1', 1, 0, 'C');
// $pdf->Cell(40, 10, '', 1, 0, 'C'); // Placeholder for Size/Description
// $pdf->Cell(20, 10, '2', 1, 0, 'C');
// $pdf->Cell(20, 10, '', 1, 0, 'C'); // Placeholder for Pieces
// $pdf->Cell(20, 10, '', 1, 0, 'C'); // Placeholder for Units
// $pdf->Cell(30, 10, '$100', 1, 1, 'C');

$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Total Pieces: ', 0, 1, 'R');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'Thank you for your business!', 0, 0, 'C');



$pdf->SetFillColor(240, 240, 240);

$pdf->Output('output.pdf', 'I'); // 'D' to force download, or 'I' to display in the browser


?>