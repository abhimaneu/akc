<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php

$f = $_GET['f'];
$start = '1990-01-31';
$end = '2099-12-31';
$company = 'All';
$p_name = 'All';
$size = 'All';
$wno = 'All';
$p_code = 'All';
$p_type = 'All';

if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['cmp'];
    $p_name = $_GET['pn'];
    $size = $_GET['sz'];
    $wno = $_GET['wno'];
    $p_code = $_GET['pc'];
    $p_type = $_GET['pt'];
}
if (!$conn) {
    echo "Error Occured";
}

//for dropdowns
$sql2 = "SELECT dest from outpass WHERE user_id = '" . (string) $loggedin_session . "'";
$sql2 .= " GROUP BY dest";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$sql3 = "SELECT product_name from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql3 .= " GROUP BY product_name";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}
$sql4 = "SELECT product_size from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql4 .= " GROUP BY product_size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}
$sql5 = "SELECT work_order_no from outpass WHERE user_id = '" . (string) $loggedin_session . "'";
$sql5 .= " GROUP BY work_order_no";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
}
$sql6 = "SELECT product_code from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql6 .= " GROUP BY product_code";
$retval6 = mysqli_query($conn, $sql6);
if (!$retval6) {
    echo mysqli_error($conn);
}
$sql7 = "SELECT product_type from outpass_products WHERE user_id = '" . (string) $loggedin_session . "'";
$sql7 .= " GROUP BY product_type";
$retval7 = mysqli_query($conn, $sql7);
if (!$retval7) {
    echo mysqli_error($conn);
}

//for table
$sql = "select * from outpass,outpass_products where outpass.no = outpass_products.outpass_no AND outpass.user_id = '" . (string) $loggedin_session . "'";

if ($company != 'All') {
    $sql .= " AND dest = '$company'";
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
if ($p_type != 'All') {
    $sql .= " AND product_type = '$p_type'";
}
if ($wno != 'All') {
    $sql .= " AND work_order_no = '$wno'";
}


$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
    die($conn);
}
?>


<html>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Outpass Generated</title>
<!-- MDB icon -->
<!-- <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" /> -->
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
        $('#start').click(function () {
            // Get the current date
            var currentDate = new Date();

            // Get the current year and month
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed

            // Set the default value to the current month
            var defaultValue = year + '-' + month;
            document.getElementById('start').value = defaultValue;
            initilizebootstrap();
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
            initilizebootstrap();
        });
    });

    $(document).ready(function () {
        //search outpass data
        var searchInput = document.getElementById("search");
        var table = document.getElementById("tablebody");
        var rows = table.getElementsByTagName("tr");

        searchInput.addEventListener("keyup", function () {
            var input = searchInput.value.toLowerCase();

            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].getElementsByTagName("td");
                var found = false;

                for (var j = 0; j < rowData.length; j++) {
                    if (rowData[j].innerHTML.toLowerCase().indexOf(input) > -1) {
                        found = true;
                        initilizebootstrap();
                        break;
                    }
                }

                if (found) {
                    rows[i].style.display = "";
                    initilizebootstrap();
                } else {
                    rows[i].style.display = "none";
                    initilizebootstrap();
                }
            }
        });
    });


</script>

<body>
    <main> <br>
        <h1 class="mt-2 ms-4">Outpass</h1>
        <div class="container-fluid">
            <div class='row justify-content'>
                <div class="col">
                    <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                        <h4 class='mb-4'>Filter</h4>
                        <div class="row ms-1 justify-content w-50">
                            <div class="form-outline col">
                                <input type="date" class="form-control" value="1990-01-01" id='start' required
                                    name="start">
                                <label for="start" class='form-label'>Start</label>
                            </div>
                            <div class="col col-sm-1">
                                <center>to</center>
                            </div>
                            <div class="form-outline col">
                                <input name="end" class="form-control" value="2099-12-31" id='end' required type="date">
                                <label for="end" class='form-label'>End</label>
                            </div>
                        </div>
                        <div class="col mt-4 mb-4 ms-1">
                            <label>Work Order No.</label>
                            <select name='workorderno'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval5, 0);
                                while ($row = mysqli_fetch_assoc($retval5)) {
                                    echo "
            <option>{$row['work_order_no']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
                            <label>Dest. Company</label>
                            <select name='company'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval2, 0);
                                while ($row = mysqli_fetch_assoc($retval2)) {
                                    echo "
            <option>{$row['dest']}</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
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
                        </div>
                        <div class="col mt-4 mb-4 ms-1">
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
                            &nbsp;
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
                            </select>
                            &nbsp;
                            <label>Product Type</label>
                            <select name='product_type'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval7, 0);
                                while ($row = mysqli_fetch_assoc($retval7)) {
                                    echo "
            <option>{$row['product_type']}</option>
            ";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class=" btn btn-outline-primary btn-sm" data-mdb-ripple-color="dark"
                            name="filter" value="Search">
                        <br> <br>
                        <h5 class='mb-4'>Search By Keywords</h5>
                        <div class='col justify-content w-25'>
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="text" id='search' class="form-control" name="search"
                                        placeholder="eg. ABC001">
                                    <label class="form-label" for="search">Search</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                <table class="table table-sm">
                    <thead class="table-light sticky-top">
                        <th>
                            Outpass No.
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Destination Company
                        </th>
                        <th>
                            Work Order No.
                        </th>
                        <th>
                            Product Desc.
                        </th>
                        <th>
                            Product Desp. Quantity
                        </th>
                        <th>
                            Product Type
                        </th>
                        <th>
                            Vehicle No.
                        </th>
                        <th>
                            Extras
                        </th>
                        <th>
                            Outpass PDF
                        </th>

                    </thead>
                    <tbody id='tablebody'>
                        <tr>
                            <?php
                            $cur_no = -1;
                            $table_active = '';
                            while ($row = $retval->fetch_assoc()) {
                                if ($cur_no == $row['no']) {

                                } else {
                                    if ($table_active == 'table-active') {
                                        $table_active = '';
                                    } else {
                                        $table_active = 'table-active';
                                    }
                                }
                                $time = strtotime($row['date']);
                                $outpass_short_date = '';
                                if (date('n', $time) > 4) {
                                    $temp_date = date('y', $time);
                                    $outpass_short_date = $temp_date . ($temp_date + 1);
                                } else {
                                    $temp_date = date('y', $time);
                                    $outpass_short_date = ($temp_date - 1) . $temp_date;
                                }
                                if (!empty($row)) {
                                    echo "
                    <tr class='$table_active'>
                    <td>
                    {$row['no']}/". $outpass_short_date ."
                    </td>
                    <td>
                    {$row['date']}
                    </td>
                    <td>
                    {$row['dest']}
                    &nbsp;
                    {$row['woc']}
                    </td>
                    <td>
                    {$row['work_order']}
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
                    {$row['product_type']}
                    </td>
                    <td>
                    {$row['vehicleno']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                    <td>
                    <a href='createpdfpass.php?no={$row['no']}&io=outpass' target='_blank'>Download</a>
                    </td>
                    ";
                                    $cur_no = $row['no'];
                                }
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
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
if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $pn = $_POST['product_name'];
    $cmp = $_POST['company'];
    $sz = $_POST['product_size'];
    $wno = $_POST['workorderno'];
    $pc = $_POST['product_code'];
    $pt = $_POST['product_type'];

    echo "<script type='text/javascript'>
            window.location.href = 'outpassshowall.php?f=1&start=$start_date&end=$end_date&pn=$pn&cmp=$cmp&sz=$sz&wno=$wno&pc=$pc&pt=$pt';
            </script>";
}
?>