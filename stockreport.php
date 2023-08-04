<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php
$start = '1990-01-31';
$end = '2099-12-31';

$f = $_GET['f'];
if ($f != 0) {
    $start = $_GET['start'];
    $end = $_GET['end'];
}

$sql = "SELECT * from stock_data where user_id = '".(string)$loggedin_session."' AND timestamp BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
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

                    <div class="row ms-1 justify-content w-50">
                        <div class="form-outline col">
                            <input type="date" value="1990-01-01" class="form-control" id='start' required name="start">
                            <label for="start" class='form-label'>Start</label>
                        </div>
                        <div class="col col-sm-1">
                            <center>to</center>
                        </div>
                        <div class="form-outline col">
                            <input name="end" value="2099-12-31" class="form-control" id='end' required type="date">
                            <label for="end" class='form-label'>End</label>
                        </div>
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
                        A/C WGS WO#
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Product Size
                    </th>
                    <th>
                        Quantity Arrv./Desp.
                    </th>
                    <th>
                        Total Quantity
                    </th>
                </thead>
                <tbody id="tablebody">
                    <?php
                    while ($row = $retval->fetch_assoc()) {
                        echo "
                        <tr>
                        <td>{$row['timestamp']}</td>
                        <td>{$row['wgs']}</td>
                        <td> " . ucwords($row['product_name']) . "</td>
                        <td>{$row['product_size']}</td>
                         <td>";
                        if ($row['type'] == 'Inpass') {
                            echo "+ ";
                        } else if($row['type'] == 'Outpass' || $row['type'] == 'Delete') {
                            echo "- ";
                        }
                        else {
                            echo "";
                        }
                        echo "{$row['product_qty']}</td>
                        <td>{$row['total_qty']}</td>
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
    echo "<script type='text/javascript'>
    window.location.href = 'stockreport.php?f=1&start=$start_date&end=$end_date';
    </script>";
}
?>