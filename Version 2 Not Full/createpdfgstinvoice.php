<?php
include 'checkuserlogin.php';

require_once('TCPDF-main/tcpdf.php');

$workOrderNo = $_GET['wo'];
$invoice_no = $_GET['in'];

$conn = mysqli_connect('localhost', 'root', '', 'akcdb');

if (!$conn) {
    // echo "Error Occured ";
}

$sql = "SELECT * FROM invoice a inner join invoice_data b on a.invoice_no=b.invoice_no where a.invoice_no='$invoice_no' AND a.user_id = '" . (string) $loggedin_session . "'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {

}

$sql2 = "SELECT * FROM invoice a inner join invoice_data b on a.invoice_no=b.invoice_no where a.invoice_no='$invoice_no' AND a.user_id = '" . (string) $loggedin_session . "'";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {

}

$sql3 = "SELECT * FROM profile WHERE user_id = '" . (string) $loggedin_session . "'";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {

}
$gstin = '';
$date = '';
$company = '';
$company_gstin = '';
$work_order_no = '';
$place_of_supply = '';
$type_of_payment = '';
$contact = '';
$statecode = '';
$note = '';
$gst_per_all = '';
$grand_total = '';
$cgst = '';
$sgst = '';
$less_ro = '';
$total_amount = '';
$mode_of_transport = '';

$profile_company_name = '';
$profile_company_phoneno = '';
//$profile_company_address = '';
$data3 = mysqli_fetch_assoc($retval3);
$gstin = $data3['gstin'];
$profile_company_name = $data3['name'];
$profile_company_phoneno = $data3['phoneno'];
//$profile_company_address = $company_data['address'];


$data1 = mysqli_fetch_assoc($retval);
$date = $data1['date'];
$company = $data1['company'];
$company_gstin = $data1['company_gstin'];
$work_order_no = $data1['work_order_no'];
$place_of_supply = $data1['place_of_supply'];
$type_of_payment = $data1['type_of_payment'];
$contact = $data1['contact'];
$statecode = $data1['statecode'];
$note = $data1['note'];
$gst_per_all = $data1['gst_percentage'];
$grand_total = $data1['grand_total'];
$cgst = $data1['cgst'];
$sgst = $data1['sgst'];
$less_ro = $data1['less_ro'];
$total_amount = $data1['total_amount'];
$mode_of_transport = $data1['mode_of_transport'];

$product_slno = array();
$productName = array();
$type = array();
$size = array();
$unit = array();
$nopcs = array();
$rm = array();
$total_unit = array();
$rate = array();
$gst_per = array();
$amount = array();
$i = 0;
while ($row = mysqli_fetch_assoc($retval2)) {
    $product_slno[$i] = $row['product_slno'];
    $productName[$i] = $row['product_name'];
    $type[$i] = $row['type'];
    $size[$i] = $row['size'];
    $unit[$i] = $row['unit'];
    $nopcs[$i] = $row['nopcs'];
    $rm[$i] = $row['rm'];
    $total_unit[$i] = $row['total_unit'];
    $rate[$i] = $row['rate'];
    $gst_per[$i] = $row['gst'];
    $amount[$i] = $row['amount'];
    $i = $i + 1;
}
function numberToWords($number)
{
    $fmt = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $fmt->format($number);
}
$total_inwords = numberToWords($total_amount);
$total_inwords = ucwords($total_inwords);

$pdf = new TCPDF('P', 'mm', 'A4'); // 'P' for portrait, 'mm' for millimeters, 'A4' for page size

//Add Later
// $pdf->SetCreator('Your Name');
$pdf->SetAuthor('Akshay Coir');
$pdf->SetTitle($invoice_no . ' ' . 'GST Invoice');
// $pdf->SetSubject('Document Subject');

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 8); // Set font
//$pdf->Cell(0, 10, 'AKSHAY COIR' , 0, 1, 'C'); // Add centered text
$pdf->SetLineStyle(array('width' => 0.2, 'color' => array(0, 0, 0)));

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 8, $profile_company_name, 0, 1, 'C');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 4, 'NC JOHN DIPPO ROAD, THUMPOLI', 0, 1, 'C');
$pdf->Cell(0, 4, 'ALAPUZHA', 0, 1, 'C');
$pdf->Cell(0, 4, 'PH: ' .$profile_company_phoneno, 0, 1, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 5, 'GSTIN: ' . $gstin, 0, 0, 'L');
$pdf->Cell(0, 5, 'State Code: 32', 0, 1, 'R');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'GST INVOICE', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 8);

// Set the starting and ending coordinates for the line
$startX = $pdf->GetX();
$startY = $pdf->GetY();
$endX = $pdf->GetPageWidth() - $pdf->GetX();
$endY = $startY;
// Draw the line
$pdf->Line($startX, $startY, $endX, $endY);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'Invoice No: ' . $invoice_no, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'Date: ' . $date, 0, 1, 'R');
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'To: ' . $company, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'Type: ' . $type_of_payment, 0, 1, 'R');
$pdf->Cell(0, 5, 'WO NO: ' . $workOrderNo, 0, 1, 'R');
$pdf->Cell(0, 5, 'Place of Suuply: ' . $place_of_supply, 0, 0, 'L');
$pdf->Cell(0, 5, 'Mode of Transport: ' . $mode_of_transport, 0, 1, 'R');
$pdf->Cell(0, 5, 'Contact: ' . $contact, 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'GSTIN: ' . $company_gstin, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'State Code: ' . $statecode, 0, 1, 'R');

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(8, 10, 'No.', 1, 0, 'C');
$pdf->Cell(45, 10, 'Description', 1, 0, 'C');
$pdf->Cell(20, 10, 'Size', 1, 0, 'C');
$pdf->Cell(15, 10, 'Unit', 1, 0, 'C');
$pdf->Cell(15, 10, 'NO: PICS', 1, 0, 'C');
$pdf->Cell(18, 10, 'RM/Sqf/Sam', 1, 0, 'C');
$pdf->Cell(25, 10, 'Total Unit', 1, 0, 'C');
$pdf->Cell(15, 10, 'Rate', 1, 0, 'C');
$pdf->Cell(12, 10, 'GST', 1, 0, 'C');
$pdf->Cell(17, 10, 'Amount', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 6);
$j = 0;
$k = 0;
$product_slno_f = $product_slno[0];
$pdf->Cell(8, 5, "", 'LR', 0, '');
$pdf->SetFont('helvetica', 'B', 7);
$pdf->Cell(45, 5, $productName[0], 'LR', 0, '');
$pdf->Cell(20, 5, "", 'LR', 0, '');
$pdf->Cell(15, 5, "", 'LR', 0, '');
$pdf->Cell(15, 5, "", 'LR', 0, '');
$pdf->Cell(18, 5, "", 'LR', 0, '');
$pdf->Cell(25, 5, "", 'LR', 0, '');
$pdf->Cell(15, 5, "", 'LR', 0, '');
$pdf->Cell(12, 5, "", 'LR', 0, '');
$pdf->Cell(17, 5, "", 'LR', 1, '');
for ($i = 0; $i < count($productName); $i++) {
    if ($product_slno[$i] != $product_slno_f) {
        $pdf->Cell(8, 5, "", 'LR', 0, '');
        $pdf->SetFont('helvetica', 'B', 7);
        $pdf->Cell(45, 5, $productName[$i], 'LR', 0, '');
        $pdf->Cell(20, 5, "", 'LR', 0, '');
        $pdf->Cell(15, 5, "", 'LR', 0, '');
        $pdf->Cell(15, 5, "", 'LR', 0, '');
        $pdf->Cell(18, 5, "", 'LR', 0, '');
        $pdf->Cell(25, 5, "", 'LR', 0, '');
        $pdf->Cell(15, 5, "", 'LR', 0, '');
        $pdf->Cell(12, 5, "", 'LR', 0, '');
        $pdf->Cell(17, 5, "", 'LR', 1, '');
        $product_slno_f = $product_slno[$i];
        $k = 0;
    }
    $pdf->SetFont('helvetica', '', 7);
    $pdf->Cell(8, 5, $k + 1, 'LR', 0, 'C');
    $pdf->Cell(45, 5, $type[$i], 'LR', 0, '');
    $pdf->Cell(20, 5, $size[$i], 'LR', 0, 'R');
    $pdf->Cell(15, 5, $unit[$i], 'LR', 0, 'R');
    $pdf->Cell(15, 5, $nopcs[$i], 'LR', 0, 'R');
    $pdf->Cell(18, 5, $rm[$i], 'LR', 0, 'R');
    $pdf->Cell(25, 5, $total_unit[$i], 'LR', 0, 'R');
    $pdf->Cell(15, 5, $rate[$i], 'LR', 0, 'R');
    $pdf->Cell(12, 5, $gst_per[$i] . '%', 'LR', 0, 'R');
    $pdf->Cell(17, 5, $amount[$i], 'LR', 1, 'R');
    $k += 1;
    // if (($i + 1) % 4 == 0) {
    //     $k=0;
    //     $j = $j + 1;
    // }
}
$startX = $pdf->GetX();
$startY = $pdf->GetY();
$endX = $pdf->GetPageWidth() - $pdf->GetX();
$endY = $startY;
// Draw the line
$pdf->Line($startX, $startY, $endX, $endY);


// $pdf->Ln(135);
$pdf->Ln(10);
// Set the starting and ending coordinates for the line
$startX = $pdf->GetX();
$startY = $pdf->GetY();
$endX = $pdf->GetPageWidth() - $pdf->GetX();
$endY = $startY;
// Draw the line
$pdf->Line($startX, $startY, $endX, $endY);

$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'Note: ' . $note, 0, 0, 'L');
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'Grand Total ' . $grand_total, 0, 1, 'R');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'CGST Collected ' . $cgst, 0, 1, 'R');
$pdf->Cell(0, 5, 'SGST Collected ' . $sgst, 0, 1, 'R');
$pdf->Cell(0, 5, 'Less: Round Off ' . $less_ro, 0, 1, 'R');
$pdf->Cell(0, 5, 'Rupees: ' . $total_inwords . ' Only', 0, 0, 'L');
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'TOTAL Amount: ' . $total_amount, 0, 1, 'R');

$startX = $pdf->GetX();
$startY = $pdf->GetY();
$endX = $pdf->GetPageWidth() - $pdf->GetX();
$endY = $startY;
// Draw the line
$pdf->Line($startX, $startY, $endX, $endY);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'Terms & Conditions', 0, 0, 'L');
$pdf->Cell(0, 5, 'FOR AKSHAY COIR', 0, 1, 'R');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, '1 E & O.E', 0, 1, 'L');
$pdf->Cell(0, 5, '2 All Disputes are subject to Alapuzha Jurisdiction only', 0, 1, 'L');
$pdf->Cell(0, 5, '3 Certified that the particulars given below are true and correct', 0, 0, 'L');
$pdf->Cell(0, 5, 'Authorised Signatory', 0, 1, 'R');

$pdf->SetFillColor(240, 240, 240);
$pdf->Output('output.pdf', 'I');
?>