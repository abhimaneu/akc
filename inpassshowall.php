<?php
include 'conn.php';
?>

<?php

$f = $_GET['f'];
$start = '1990-01-31';
$end = '2099-12-31';
$company = 'All';
$p_name = 'All';
$size = 'All';
$p_code = 'All';

$search = '';
$ipno = '';
if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['cmp'];
    $p_name = $_GET['pn'];
    $size = $_GET['sz'];
    $p_code = $_GET['pc'];

    $search = $_GET['pns'];
    $ipno = $_GET['ipno'];
}
if (!$conn) {
    echo "Error Occured";
}

//for dropdowns
$sql2 = "SELECT source from inpass where 1=1";
$sql2 .= " GROUP BY source";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$sql3 = "SELECT product_name from inpass_products where 1=1";
$sql3 .= " GROUP BY product_name";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}
$sql4 = "SELECT product_size from inpass_products where 1=1";
$sql4 .= " GROUP BY product_size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}
$sql6 = "SELECT product_code from inpass_products where 1=1";
$sql6 .= " GROUP BY product_code";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
}

//for table
$sql = "select * from inpass,inpass_products where inpass.no = inpass_products.inpass_no";

if ($company != 'All') {
    $sql .= " AND source = '$company'";
}
if ($p_name != 'All') {
    $sql .= " AND product_name = '$p_name'";
}
if ($size != 'All') {
    $sql .= " AND product_size = '$size'";
}
if ($p_code != 'All') {
    $sql .= " AND product_code = '$p_code'";
}
if (!empty($search)) {
    $sql .= " AND (product_name LIKE '%$search%' OR product_code LIKE '%$search%' OR product_design LIKE '%$search%' OR product_size LIKE '%$search%')";
}
if (!empty($ipno)) {
    $sql .= " AND (inpass_no LIKE '%$ipno%')";
}


$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}
?>


<html>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

<script>

    $(document).ready(function () {
        $('#start').click(function () {
            // Get the current date
            var currentDate = new Date();

            // Get the current year and month
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed

            // Set the default value to the current month
            var defaultValue = year + '-' + month;
            document.getElementById('start').value = defaultValue;

        });

        $('#end').click(function () {
            // Get the current date
            var currentDate = new Date();

            // Get the current year and month
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed

            // Set the default value to the current month
            var defaultValue = year + '-' + month;
            document.getElementById('end').value = defaultValue;

        });
    });

</script>

<body>
    <div>
        <h1>Inpasses</h1>
        <form name="filter" method="post">
            <label for="start">Start</label>
            <input type="date" value="1990-01-01" id='start' required name="start">
            &nbsp;
            <label for="end">End</label>
            <input name="end" value="2099-12-31" id='end' required type="date">

            <br> <br>
            <label>Source. Company</label>
            <select name='company'>
                <option selected>All</option>
                <?php
                mysqli_data_seek($retval2, 0);
                while ($row = mysqli_fetch_assoc($retval2)) {
                    echo "
            <option>{$row['source']}</option>
            ";
                }
                ?>
            </select>
            <label>Product Name</label>
            <select name='product_name'>
                <option selected>All</option>
                <?php
                while ($row = mysqli_fetch_assoc($retval3)) {
                    echo "
            <option>{$row['product_name']}</option>
            ";
                }
                ?>
            </select>
            <label>Product Code</label>
            <select name='product_code'>
                <option selected>All</option>
                <?php
                mysqli_data_seek($retval6, 0);
                while ($row = mysqli_fetch_assoc($retval6)) {
                    echo "
            <option>{$row['product_code']}</option>
            ";
                }
                ?>
            </select>
            <label>Product Size</label>
            <select name='product_size'>
                <option selected>All</option>
                <?php
                mysqli_data_seek($retval4, 0);
                while ($row = mysqli_fetch_assoc($retval4)) {
                    echo "
            <option>{$row['product_size']}</option>
            ";
                }
                ?>
            </select> &nbsp;
            <input type="submit" name="filter" value="Search">
            <br> <br>
            Search by Keywords <br> <br>
            <input type="text" name="ipno" placeholder="Enter Inpass No.">
            <input type="text" name="search" placeholder="Search Product Name/Code">
            <input type="submit" name="filter" value="Search">

        </form>
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
                    Product Desc.
                </th>
                <th>
                    Product Desp. Quantity
                </th>
                <th>
                    Vehicle No.
                </th>
                <th>
                    Extras
                </th>
                <th>
                    
                </th>
            </thead>
            <tbody>
                <tr>
                    <?php
                    while ($row = $retval->fetch_assoc()) {
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
                    &nbsp;
                    {$row['woc']}
                    </td>
                    <td>
                    {$row['product_name']}
                    &nbsp;
                    {$row['product_code']}
                    &nbsp;
                    {$row['product_design']}
                    &nbsp;
                    {$row['product_size']}
                    </td>
                    <td>
                    {$row['product_qty']}
                    </td>
                    <td>
                    {$row['vehicleno']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                    <td>
                    <a href='createpdfpass.php?no={$row['no']}&io=inpass' target='_blank' >Download</a>
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

<?php
if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $pn = $_POST['product_name'];
    $cmp = $_POST['company'];
    $sz = $_POST['product_size'];
    $pc = $_POST['product_code'];

    $p_search = $_POST['search'];
    $ipno = $_POST['ipno'];
    echo "<script type='text/javascript'>
            window.location.href = 'inpassshowall.php?f=1&start=$start_date&end=$end_date&pn=$pn&cmp=$cmp&sz=$sz&pc=$pc&pns=$p_search&ipno=$ipno';
            </script>";
}
?>