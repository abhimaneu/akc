<?php
include 'conn.php';
include 'nav.php';
?>

<?php
$start = '1990-01-31';
$end = '2099-12-31';
$company = 'All';
$product = 'All';
$size = 'All';
$f = $_GET['f'];
if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['c'];
    $product = $_GET['p'];
    $size = $_GET['s'];
}
$sql = "SELECT no, date, dest AS company, woc, product_name,work_order as product_code, product_design,product_size, product_qty, type,timestamp
FROM outpass
INNER JOIN outpass_products ON outpass.no = outpass_products.outpass_no
WHERE date BETWEEN '$start' AND '$end'";

if ($company != 'All') {
    $sql .= " AND dest = '$company'";
}
if ($product != 'All') {
    $sql .= " AND product_name  LIKE '%$product%'";
}
if ($size != 'All') {
    $sql .= " AND product_size = '$size'";
}

$sql .= " UNION
SELECT no, date, source AS company, woc, product_name, product_code,product_design,product_size, product_qty, type,timestamp
FROM inpass
INNER JOIN inpass_products ON inpass.no = inpass_products.inpass_no
WHERE date BETWEEN '$start' AND '$end'";

if ($company != 'All') {
    $sql .= " AND source = '$company'";
}
if ($product != 'All') {
    $sql .= " AND product_name = '$product'";
}
if ($size != 'All') {
    $sql .= " AND product_size = '$size'";
}

$sql .= " ORDER BY timestamp DESC;";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);

}

$sql2 = "select * from company";
$retval2 = mysqli_query($conn, $sql2);
$sql3 = "select * from products";
$retval3 = mysqli_query($conn, $sql3);


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

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    h2 {
        margin-top: 20px;
        text-align: center;
    }

    form {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="date"] {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    thead {
        background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

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
    <h2>Ledger</h2>
    <br>
    <br>
    <form name="filter-date" method="post">
        <label>Company</label>
        <select name='company'>
            <option selected>All</option>
            <?php
            while ($row = mysqli_fetch_assoc($retval2)) {
                echo "
            <option>{$row['name']}</option>
            ";
            }
            ?>
        </select>
        <label>Product</label>
        <select name='product'>
            <option selected>All</option>
            <?php
            mysqli_data_seek($retval3, 0);
            while ($row = mysqli_fetch_assoc($retval3)) {
                echo "
            <option>{$row['name']}</option>
            ";
            }
            ?>
        </select>
        <label>Size</label>
        <select name='size'>
            <option selected>All</option>
            <?php
            mysqli_data_seek($retval3, 0);
            while ($row = mysqli_fetch_assoc($retval3)) {
                echo "
            <option>{$row['size']}</option>
            ";
            }
            ?>
        </select> <br>
        <br>
        <label for="start">Start</label>
        <input type="date" value="1990-01-01" id='start' required name="start">
        &nbsp;
        <label for="end">End</label>
        <input name="end" value="2099-12-31" id='end' required type="date">

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
                Pro.#(Inpass)/WO#(Outpass)
            </th>
            <th>
                Product
            </th>
            <th>
                Quantity
            </th>
            <th>
                Type
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
                &nbsp;
                {$row['woc']}
                </td>
                <td>
                {$row['product_code']}
                </td>
                <td>
                {$row['product_name']}
                &nbsp;
                {$row['product_design']}
                &nbsp;
                {$row['product_size']}
                </td>
                <td>
                {$row['product_qty']}
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
if (isset($_POST['filter-date'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $company_fil = $_POST['company'];
    $product_fil = $_POST['product'];
    $size_fil = $_POST['size'];
    echo "<script type='text/javascript'>
            window.location.href = 'ledger.php?f=1&start=$start_date&end=$end_date&c=$company_fil&p=$product_fil&s=$size_fil';
            </script>";
}
?>