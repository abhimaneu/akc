<?php
include 'conn.php';
include 'nav.php';
?>

<?php
$start = date('Y') . '-04' . '-01';
$end = (date('Y')+1) . '-03' . '-31' ;
$company = 'All';
$product = 'All';
$size = 'All';
$type = 'All';
$f = $_GET['f'];
if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $company = $_GET['c'];
    $product = $_GET['p'];
    $size = $_GET['s'];
    $type = $_GET['type'];
}
$sql = "SELECT no, date, dest AS company, woc, product_name,work_order as product_wono, product_design,product_size, product_qty, type,timestamp,product_code
FROM outpass
INNER JOIN outpass_products ON outpass.no = outpass_products.outpass_no
WHERE outpass.user_id = '" . (string) $loggedin_session . "' AND outpass_products.user_id = '" . (string) $loggedin_session . "' AND date BETWEEN '$start' AND '$end'";
if ($company != 'All') {
    $sql .= " AND dest = '$company'";
}
if ($product != 'All') {
    $sql .= " AND product_name  LIKE '%$product%'";
}
if ($size != 'All') {
    $sql .= " AND product_size = '$size'";
}
if ($type != 'All') {
    $sql .= " AND type = '$type'";
}


$sql .= " UNION
SELECT no, date, source AS company, woc, product_name, product_wono,product_design,product_size, product_qty, type,timestamp,product_code
FROM inpass
INNER JOIN inpass_products ON inpass.no = inpass_products.inpass_no
WHERE inpass.user_id = '" . (string) $loggedin_session . "' AND inpass_products.user_id = '" . (string) $loggedin_session . "' AND date BETWEEN '$start' AND '$end'";

if ($company != 'All') {
    $sql .= " AND source = '$company'";
}
if ($product != 'All') {
    $sql .= " AND product_name = '$product'";
}
if ($size != 'All') {
    $sql .= " AND product_size = '$size'";
}
if ($type != 'All') {
    $sql .= " AND type = '$type'";
}

$sql .= " ORDER BY timestamp DESC;";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);

}

$sql2 = "select * from company WHERE user_id = '" . (string) $loggedin_session . "'";
$retval2 = mysqli_query($conn, $sql2);
$sql3 = "select * from products WHERE user_id = '" . (string) $loggedin_session . "'";
$retval3 = mysqli_query($conn, $sql3);


?>

<html>

<title>Ledger</title>

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

<script>
    $(document).ready(function () {
        //search stock data
        var searchInput = document.getElementById("search");
        var table = document.getElementById("lbody");
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

    function printTable() {
        document.getElementById('tablehead').classList.remove('sticky-top')
        print();
    }
</script>

<style>
    @media print {
        body {
            padding: 20px;
            /* Add padding to provide margin around the content */
        }

        #dontprint {
            display: none;
        }

        #dontprintbtn {
            display: none;
        }

        #dontprintnav {
            display: none;
        }

        #printbody {
            padding-top: 0;
            /* Remove padding at the top of the printed content */
        }

        #myTable td {
            page-break-inside: avoid;
            /* Prevent table cells from breaking across pages */
        }

        /* #printbody * {
            display: block;
        } */
    }
</style>

<body>
    <main> <br>
        <h1 class="mt-2 ms-4">Ledger</h1>
        <div class="container-fluid">
            <div class="row justify-content">
                <div class="col" id='dontprint'>
                    <form name="filter-date" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                        <h4 class='mb-4'>Filter</h4>

                        <div class="row ms-1 justify-content w-50">
                            <div class="form-outline col">
                                <input type="date" value="<?php echo $start;?>" class="form-control" id='start' required
                                    name="start">
                                <label for="start" class='form-label'>Start</label>
                            </div>
                            <div class="col col-sm-1">
                                <center>to</center>
                            </div>
                            <div class="form-outline col">
                                <input name="end" value="<?php echo $end;?>" class="form-control" id='end' required type="date">
                                <label for="end" class='form-label'>End</label>
                            </div>
                        </div>
                        <div class="col mt-5 mb-4 ms-1">
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
                            &nbsp;
                            <label>Product</label>
                            <select name='product'>
                                <option selected>All</option>
                                <?php
                                mysqli_data_seek($retval3, 0);
                                while ($row = mysqli_fetch_assoc($retval3)) {
                                    echo "
            <option> " . ucwords($row['name']) . "</option>
            ";
                                }
                                ?>
                            </select>
                            &nbsp;
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
                            </select>
                            &nbsp;
                            <label>Type</label>
                            <select name='type'>
                                <option selected>All</option>
                                <option value='inpass'>Inpass</option>
                                <option value='outpass'>Outpass</option>
                            </select>
                            <input type="submit" name="filter-date" class=" btn btn-outline-primary btn-sm"
                                data-mdb-ripple-color="dark" value="Search">
                        </div>

                        <h5 class='mb-4 pt-4'>Search By Keywords</h5>
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
                <div class='p-1 d-flex justify-content-end'>
                    <button onclick="printTable()" class="btn btn-primary " id='dontprintbtn'>Print Ledger</button>
                </div>
                <div class="container-fluid mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4" id='printbody'>
                    <table class="table table-sm" id='myTable'>
                        <thead class="table-light sticky-top" id='tablehead'>
                            <th>
                                Date
                            </th>
                            <th>
                                IP/OP (No.)
                            </th>
                            <th>
                                Source/Destination - A/C
                            </th>
                            <th>
                                WO#(Inpass/Outpass)
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
                        <tbody id='lbody'>
                            <?php
                            $cur_no = -1;
                            $table_active = '';
                            $table_color = '';
                            while ($row = mysqli_fetch_assoc($retval)) {
                                if ($cur_no == $row['no']) {

                                } else {
                                    if ($table_active == 'table-active') {
                                        $table_active = '';
                                    } else {
                                        $table_active = 'table-active';
                                    }
                                }
                                if ($row['type'] == 'inpass') {
                                    $table_color = 'bg-info text-dark bg-opacity-50';
                                } else {
                                    $table_color = 'bg-danger text-dark bg-opacity-50';
                                }
                                $time = strtotime($row['date']);
                                $pass_short_date = '';
                                if (date('n', $time) > 4) {
                                    $temp_date = date('y', $time);
                                    $pass_short_date = $temp_date . ($temp_date + 1);
                                } else {
                                    $temp_date = date('y', $time);
                                    $pass_short_date = ($temp_date - 1) . $temp_date;
                                }
                                echo "<tr  class='$table_active $table_color'>
                <td>
                {$row['date']}
                </td>
                <td>
                {$row['no']}/". $pass_short_date ."
                </td>
                <td>
                {$row['company']}
                &nbsp;
                {$row['woc']}
                </td>
                <td>
                {$row['product_wono']}
                </td>
                <td>
                ".$row['product_code']."
                " . ucwords($row['product_name']) . "
                &nbsp;
                " . ucwords($row['product_design']) . "
                &nbsp;
                {$row['product_size']}
                </td>
                <td>
                {$row['product_qty']}
                </td>
                <td>"
                                    . ucfirst($row['type']) . "
                </td>
                </tr>";
                                $cur_no = $row['no'];
                            }
                            ?>
                        </tbody>
                    </table>
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

    </main>
</body>

</html>

<?php
if (isset($_POST['filter-date'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $company_fil = $_POST['company'];
    $product_fil = $_POST['product'];
    $size_fil = $_POST['size'];
    $type_fil = $_POST['type'];
    echo "<script type='text/javascript'>
            window.location.href = 'ledger.php?f=1&start=$start_date&end=$end_date&c=$company_fil&p=$product_fil&s=$size_fil&type=$type_fil';
            </script>";
}
?>