<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php
$start = '1990-01-31';
$end = '2099-12-31';
$acof_fil = 'All';

$f = $_GET['f'];
if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    $acof_fil = $_GET['acof_fil'];
}

$sql = "SELECT * from stock_data where user_id = '" . (string) $loggedin_session . "'";

if ($acof_fil != 'All') {
    $sql .= " AND acof = '$acof_fil'";
}

$sql .= " AND timestamp BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}

//for item filter
$sql2 = "SELECT acof from stock_data WHERE user_id = '" . (string) $loggedin_session . "'";
$sql2 .= " GROUP BY acof";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}

?>

<html>

<title>Stock Report</title>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<!-- MDB icon -->
<link rel="icon" href="img/icon.png" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
<!-- MDB -->
<link rel="stylesheet" href="css/mdb.min.css" />


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
    <br>
    <h1 class="mt-2 ms-4">Stock Report</h1>
    <div class="container-fluid">
        <div class="row justify-content" id='dontprint'>
            <div class="col" id='dontprint'>
                <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                    <h4 class='mb-4'>Filter</h4>

                    <div class="row ms-1 pb-4 justify-content w-50">
                        <div class="col">
                        <div class="form-outline">
                            <input type="date" value="1990-01-01" class="form-control" id='start' required name="start">
                            <label for="start" class='form-label'>Start</label>
                        </div>
                        </div>
                        <div class="col col-sm-1">
                            <center>to</center>
                        </div>
                        <div class="col">
                        <div class="form-outline">
                            <input name="end" value="2099-12-31" class="form-control" id='end' required type="date">
                            <label for="end" class='form-label'>End</label>
                        </div>
                        </div>
                    </div>

                    <div class="row ms-1 pb-4 justify-content w-50">
                        <div class="col">
                            <label class=''>A/C of</label>
                            <select name='acof_fil'>
                                <option selected>All</option>
                                <?php

                                while ($row = mysqli_fetch_assoc($retval2)) {
                                    echo "
            <option>{$row['acof']}</option>
            ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row ms-1 justify-content w-50">
                        <div class='col'>
                            <input type="submit" class=" btn btn-outline-primary btn" data-mdb-ripple-color="dark"
                                name="filter" value="Search">
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class='p-1 d-flex justify-content-end'>
            <button onclick="printTable()" class="btn btn-primary " id='dontprintbtn'>Print Report</button>
        </div>

        <div class="container-fluid mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4" id='printbody'>
            <table class="table table-sm" id='myTable'>
                <thead class="table-light sticky-top" id='tablehead'>
                    <th>
                        Modified Date
                    </th>
                    <th>
                        A/C of
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Product Size
                    </th>
                    <th>
                        Total Quantity
                    </th>
                    <th>
                        Remarks
                    </th>
                </thead>
                <tbody id="tablebody">
                    <?php
                    while ($row = $retval->fetch_assoc()) {
                        echo "
                        <tr>
                        <td>{$row['timestamp']}</td>
                        <td>{$row['acof']}</td>
                        <td> " . ucwords($row['product_name']) . "</td>
                        <td>{$row['product_size']}</td>
                        <td>{$row['total_qty']}</td>
                        <td></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
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

</html>
<?php
if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $acof_fil = $_POST['acof_fil'];
    echo "<script type='text/javascript'>
    window.location.href = 'stockreport.php?f=1&start=$start_date&end=$end_date&acof_fil=$acof_fil';
    </script>";
}
?>