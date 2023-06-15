<?php
include 'conn.php';
include 'nav.php';
?>

<?php
$start = '1990-01-31';
$end='2099-12-31';
$f=$_GET['f'];
if($f!=0){
$start = $_GET['start'];
$end = $_GET['end'];
}
$sql = "SELECT no, date, dest AS company, woc, product_name, product_code, product_bundle, product_desc, type
FROM outpass
INNER JOIN outpass_products ON outpass.no = outpass_products.outpass_no
WHERE date BETWEEN '$start' AND '$end'
UNION
SELECT no, date, source AS company, woc, product_name, product_code, product_bundle, product_desc, type
FROM inpass
INNER JOIN inpass_products ON inpass.no = inpass_products.inpass_no
WHERE date BETWEEN '$start' AND '$end'
ORDER BY date DESC;";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}

?>

<html>

<style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
    }

    tr {
        border: 1px solid black;
    }
</style>

<body>
    <h2>Ledger</h2>
    <br>
    Filter &nbsp;
    <br>
    <br>
    <form name="filter-date" method="post">
    <label for="start">Start</label> 
    <input type="date" required name="start">
     &nbsp;
    <label for="end">End</label> 
    <input name="end" required type="date">
    &nbsp;
    <input type="submit" name="filter-date" value="Search">
    </form>
    <br> 
    <table style="border-spacing:30px;">
        <thead>
            <th>
                Date
            </th>
            <th>
                IP/OP (No.)
            </th>
            <th>
                Source/Destination
            </th>
            <th>
                WO / SO
            </th>
            <th>
                Product
            </th>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($retval)) {
                echo "<tr>
                <td>
                {$row['date']}
                </td>
                <td>
                {$row['no']}
                </td>
                <td>
                {$row['company']}
                </td>
                <td>
                {$row['woc']}
                </td>
                <td>
                {$row['product_name']}
                &nbsp; &nbsp;
                {$row['product_code']}
                &nbsp; &nbsp;
                {$row['product_bundle']}
                &nbsp; &nbsp;
                {$row['product_desc']}
                </td>
                <td>
                {$row['type']}
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
    if(isset($_POST['filter-date'])) {
        $s = $_POST['start'];
        $e = $_POST['end'];
        echo "<script type='text/javascript'>
            window.location.href = 'ledger.php?f=1&start=$s&end=$e';
            </script>";
    }
    ?>