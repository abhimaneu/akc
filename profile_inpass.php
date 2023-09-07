<?php
include 'conn.php';
include 'nav.php';
?>

<?php

$start = '1990-01-31';
$end = '2099-12-31';
if (isset($_GET['f'])) {
    $start = $_GET['start'];
    $end = $_GET['end'];
}

if (!$conn) {
    echo "Error Occured";
}

//for table
$sql = "select * from inpass_old,inpass_products_old where inpass_old.no_year = inpass_products_old.no_year AND inpass_old.user_id = '" . (string) $loggedin_session . "' AND inpass_products_old.user_id = '" . (string) $loggedin_session . "'";

$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC LIMIT 10000";
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
        //search inpass data
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
    <br>
    <h1 class="mt-2 ms-4">Profile</h1>

    <div class="container-fluid">
        <div class=" mb-1 bg-white shadow-1-strong   mt-4">
            <nav class="navbar navbar-expand-lg navbar-light shadow-0 ">

                <div class="container-fluid">
                    <a class="navbar-brand" href="#"></a>

                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link " href="profile.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-black" href="profile_inpass.php">Old Inpass</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="profile_outpass.php">Old Outpass</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link " href="profile_workorder.php">Old Work Order</a>
                            </li> -->
                        </ul>
                    </div>

                    <ul class="navbar-nav">
                        <div class="d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link " href="profile_regfinancialyear.php">Settings</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class='row justify-content'>
            <div class="col">
                <?php
                if (isset($_GET['e'])) {
                    if ($_GET['e'] == 'e1' || $_GET['e'] == 'e2') {
                        echo "<center><small class='fs-5 p-2 text-danger'>Some Error Occurred</small></center>";
                    } elseif ($_GET['e'] == 's') {
                        echo "<center><small class='fs-5 p-2 text-success'>Deleted Successfully</small></center>";
                    }
                }
                ?>
                <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                    <h4 class='mb-4'>Filter</h4>
                    <div class="row ms-1 justify-content w-50">
                        <div class="form-outline col">
                            <input type="date" class="form-control" value="1990-01-01" id='start' required name="start">
                            <label for="start" class="form-label">Start</label>
                        </div>
                        <div class="col col-sm-1">
                            <center>to</center>
                        </div>
                        <div class="form-outline col">
                            <input name="end" class="form-control" value="2099-12-31" id='end' required type="date">
                            <label for="end" class='form-label'>End</label>
                        </div>
                        <div class="col">
                            <input type="submit" class=" btn btn-outline-primary " data-mdb-ripple-color="dark"
                                name="filter" value="Search">
                        </div>
                    </div>
                    <br><br>
                    <h5 class='mb-2'>Search By Keywords</h5>
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

        <form method="post">
            <div class='d-flex pb-2 rounded-5 shadow-0-strong justify-content-end dontprintarea'>
                <div class="row">
                    <div class="col p-0 m-0">
                        <div class="form-outline">
                            <input type="number" class="form-control" name="year_delete" placeholder="2010">
                            <label class="form-label" for="form">Year</label>
                        </div>
                    </div>
                    <div class="col">
                        <button onclick="return confirm('Are You Sure?')" id='delete' name='delete_data'
                            class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </form>


        <div class="container-fluid mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
            <table class="table">
                <thead class="table-light sticky-top">
                    <th>
                        Inpass No.
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Source Company - A/C of
                    </th>
                    <th>
                        WO#
                    </th>
                    <th>
                        Product Desc.
                    </th>
                    <th>
                        Product Quantity
                    </th>
                    <th>
                        OP#
                    </th>
                    <th>
                        Vehicle No.
                    </th>
                    <th>
                        Note
                    </th>
                    <th>
                        PDF
                    </th>
                </thead>
                <tbody id="tablebody">
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
                        $inpass_short_date = '';
                        if (date('n', $time) > 4) {
                            $temp_date = date('y', $time);
                            $inpass_short_date = $temp_date . ($temp_date + 1);
                        } else {
                            $temp_date = date('y', $time);
                            $inpass_short_date = ($temp_date - 1) . $temp_date;
                        }
                        if (!empty($row)) {
                            echo "
                    <tr class='$table_active'>
                    <td>
                    {$row['no']}/" . $inpass_short_date . "
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
                    {$row['product_wono']}
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
                    {$row['op']}
                    </td>
                    <td>
                    {$row['vehicleno']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                    <td>
                    <a href='createpdfpass.php?f=old&no={$row['no_year']}&io=inpass' target='_blank' >Download</a>
                    </td>
                    </tr>
                    ";
                            $cur_no = $row['no'];
                        }
                    }
                    ?>
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
</body>

</html>

<?php
if (isset($_POST['filter'])) {
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];

    echo "<script type='text/javascript'>
            window.location.href = 'profile_inpass.php?f=1&start=$start_date&end=$end_date';
            </script>";
}

if (isset($_POST['delete_data'])) {
    $year_delete = $_POST['year_delete'];
    $year_start_date = $year_delete . '-04' . '-01';
    $year_end_date = ($year_delete+1) . '-03' . '-31';

    $sql = "DELETE from inpass_old where date BETWEEN '$year_start_date' AND '$year_end_date' AND user_id ='" . (string) $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo "Error Occured";
        echo "<script type='text/javascript'>
        window.location.href = 'profile_inpass.php?e=e1';
        </script>";
        exit;
    }

    $sql = "DELETE from inpass_products_old where date_of_entry BETWEEN '$year_start_date' AND '$year_end_date' AND user_id ='" . (string) $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo mysqli_error($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'profile_inpass.php?e=e2';
        </script>";
        exit;
    }

    echo "<script type='text/javascript'>
        window.location.href = 'profile_inpass.php?e=s';
        </script>";
}
?>