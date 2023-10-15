<?php
include 'checkuserlogin.php';

require_once('TCPDF-main/tcpdf.php');

$invoice_no = $_GET['in'];


if (!$conn) {
    // echo "Error Occured ";
}

$sql = "SELECT * FROM invoice a inner join invoice_data b on a.invoice_no=b.invoice_no where a.invoice_no='$invoice_no' AND a.user_id = '" . (string) $loggedin_session . "' AND b.user_id = '" . (string) $loggedin_session . "'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {

}

$sql2 = "SELECT * FROM invoice a inner join invoice_data b on a.invoice_no=b.invoice_no where a.invoice_no='$invoice_no' AND a.user_id = '" . (string) $loggedin_session . "'  AND b.user_id = '" . (string) $loggedin_session . "'";
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
$workOrderNo = '';
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
$bank_name = $data3['bank_name'];
$accno = $data3['acc_no'];
$ifsc = $data3['ifsc'];
//$profile_company_address = $company_data['address'];


$data1 = mysqli_fetch_assoc($retval);
$date = $data1['date'];
$company = $data1['company'];
$company_gstin = $data1['company_gstin'];
$workOrderNo = $data1['work_order_no'];
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
$sized1 = array();
$sized2 = array();
$sizeunit = array();
$nopcs = array();
$initqty = array();
$total_qty = array();
$total_unit = array();
$rate = array();
$amount = array();
$i = 0;
while ($row = mysqli_fetch_assoc($retval2)) {
    $product_slno[$i] = $row['product_slno'];
    $productName[$i] = $row['product_name'];
    $type[$i] = $row['type'];
    $sized1[$i] = $row['size_d1'];
    $sized2[$i] = $row['size_d2']; 
    $sizeunit[$i] = $row['size_unit'];
    $nopcs[$i] = $row['nopcs'];
    $initqty[$i] = $row['initqty'];
    $total_qty[$i] = $row['total_qty'];
    $total_unit[$i] = $row['total_unit'];
    $rate[$i] = $row['rate'];
    $amount[$i] = $row['amount'];
    $i = $i + 1;
}

//get dest_addr
$sql4 = "SELECT * FROM company WHERE name='$company' AND user_id = '" . (string) $loggedin_session . "'";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {

}
$destination_address = "";
$data2 = mysqli_fetch_assoc($retval4);
if(!$data2){
    $destination_address = "";
}
else {
$destination_address = $data2['address'];
}

function numberToWords($number)
{
    $fmt = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $fmt->format($number);
}
$total_inwords = numberToWords($total_amount);
$total_inwords = ucwords($total_inwords);

//$pdf = new TCPDF('P', 'mm', 'A4'); // 'P' for portrait, 'mm' for millimeters, 'A4' for page size


$pdf = new TCPDF('P', 'mm', "A4"); // 'P' for portrait, 'mm' for millimeters, 'A4' for page size


//Add Later
// $pdf->SetCreator('Your Name');
$pdf->SetAuthor($profile_company_name);
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
$pdf->Ln(3);
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

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(0, 5, 'Invoice No: ' . $invoice_no, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'Date: ' . $date, 0, 1, 'R');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'To: ' . $company, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'Type: ' . $type_of_payment, 0, 1, 'R');
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(0, 5, '      ' . $destination_address, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'WO NO: ' . $workOrderNo, 0, 1, 'R');
$pdf->Cell(0, 5, 'Place of Supply: ' . $place_of_supply, 0, 0, 'L');
$pdf->Cell(0, 5, 'Mode of Transport: ' . $mode_of_transport, 0, 1, 'R');
$pdf->Cell(0, 5, 'Contact: ' . $contact, 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(0, 5, 'GSTIN: ' . $company_gstin, 0, 0, 'L');
$pdf->SetFont('helvetica', '', 9);
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
$pdf->Cell(8, 4, "", 'LR', 0, '');
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(45, 4, $productName[0], 'LR', 0, '');
$pdf->Cell(20, 4, "", 'LR', 0, '');
$pdf->Cell(15, 4, "", 'LR', 0, '');
$pdf->Cell(15, 4, "", 'LR', 0, '');
$pdf->Cell(18, 4, "", 'LR', 0, '');
$pdf->Cell(25, 4, "", 'LR', 0, '');
$pdf->Cell(15, 4, "", 'LR', 0, '');
$pdf->Cell(12, 4, "", 'LR', 0, '');
$pdf->Cell(17, 4, "", 'LR', 1, '');
for ($i = 0; $i < count($productName); $i++) {
    if ($product_slno[$i] != $product_slno_f) {
        $pdf->Cell(8, 4, "", 'LR', 0, '');
        $pdf->SetFont('helvetica', 'B', 7);
        $pdf->Cell(45, 4, $productName[$i], 'LR', 0, '');
        $pdf->Cell(20, 4, "", 'LR', 0, '');
        $pdf->Cell(15, 4, "", 'LR', 0, '');
        $pdf->Cell(15, 4, "", 'LR', 0, '');
        $pdf->Cell(18, 4, "", 'LR', 0, '');
        $pdf->Cell(25, 4, "", 'LR', 0, '');
        $pdf->Cell(15, 4, "", 'LR', 0, '');
        $pdf->Cell(12, 4, "", 'LR', 0, '');
        $pdf->Cell(17, 4, "", 'LR', 1, '');
        $product_slno_f = $product_slno[$i];
        $k = 0;
    }
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(8, 4, $k + 1, 'LR', 0, 'C');
    $pdf->Cell(45, 4, $type[$i], 'LR', 0, '');
    $pdf->Cell(20, 4, $sized1[$i]. " x " .$sized2[$i], 'LR', 0, 'R');
    $pdf->Cell(15, 4, $sizeunit[$i], 'LR', 0, 'R');
    $pdf->Cell(15, 4, $nopcs[$i], 'LR', 0, 'R');
    $pdf->Cell(18, 4, $initqty[$i], 'LR', 0, 'R');
    $pdf->Cell(25, 4, $total_qty[$i]. " " .$total_unit[$i], 'LR', 0, 'R');
    $pdf->Cell(15, 4, $rate[$i], 'LR', 0, 'R');
    $pdf->Cell(12, 4, $gst_per_all . '%', 'LR', 0, 'R');
    $pdf->Cell(17, 4, $amount[$i], 'LR', 1, 'R');
    $k += 1;
    // if (($i + 1) % 4 == 0) {
    //     $k=0;
    //     $j = $j + 1;
    // }
}

//change 1 to other data if length of table needs to be increased
for($i=0;$i<5-count($productName);$i++){
$pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(8, 4, " ", 'LR', 0, 'C');
    $pdf->Cell(45, 4, " ", 'LR', 0, '');
    $pdf->Cell(20, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(15, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(15, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(18, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(25, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(15, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(12, 4, " ", 'LR', 0, 'R');
    $pdf->Cell(17, 4, " ", 'LR', 1, 'R');
    $k += 1;
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

$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'Note: ' . $note, 0, 0, 'L');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 5, 'Grand Total:  ' . $grand_total, 0, 1, 'R');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, 'CGST Collected:  ' . $cgst, 0, 1, 'R');
$pdf->Cell(0, 5, 'SGST Collected:  ' . $sgst, 0, 1, 'R');
if($less_ro < 0){
    $pdf->Cell(0, 5, 'Add: Round Off:  ' . abs($less_ro), 0, 1, 'R');
}else {
    $pdf->Cell(0, 5, 'Less: Round Off:  ' . abs($less_ro), 0, 1, 'R');

}
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 5, 'Rupees: ' . $total_inwords . ' Only', 0, 0, 'L');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 5, 'TOTAL Amount: ' . $total_amount, 0, 1, 'R');

$startX = $pdf->GetX();
$startY = $pdf->GetY();
$endX = $pdf->GetPageWidth() - $pdf->GetX();
$endY = $startY;
// Draw the line
$pdf->Line($startX, $startY, $endX, $endY);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 5, 'Terms & Conditions', 0, 0, 'L');
$pdf->Cell(0, 5, 'FOR '.strtoupper($profile_company_name), 0, 1, 'R');
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 5, '1 E & O.E', 0, 1, 'L');
$pdf->Cell(0, 5, '2 All Disputes are subject to Alapuzha Jurisdiction only', 0, 1, 'L');
$pdf->Cell(0, 5, '3 Certified that the particulars given below are true and correct', 0, 0, 'L');
$pdf->Cell(0, 5, 'Authorised Signatory', 0, 1, 'R');

$pdf->Ln(5);

$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(0, 5, 'Account Details', 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(5, 5, 'Bank Name:  ' .$bank_name, 0, 1, 'L');
$pdf->Cell(5, 5, 'Account No.: '.$accno, 0, 0, 'L');
$pdf->Cell(0, 5, 'IFSC Code: '.$ifsc, 0, 0, 'C');


$pdf->SetFillColor(240, 240, 240);
$pdf->Output('output.pdf', 'I');
?>