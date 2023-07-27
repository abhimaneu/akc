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
$sql = "select * from work_orders_old,work_order_products_old where work_orders_old.no_year = work_order_products_old.no_year AND work_orders_old.user_id = '" . (string) $loggedin_session . "'";

$sql .= "  AND date BETWEEN '$start' AND '$end' ORDER BY timestamp DESC";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
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
        //search workorder data
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
                                <a class="nav-link " href="profile.php">Saved Data</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="profile_inpass.php">Inpass</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="profile_outpass.php">Outpass</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-black" href="profile_workorder.php">Work Orders</a>
                            </li>



                        </ul>

                    </div>
                    <ul class="navbar-nav">
                        <div class="d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link " href="profile_regfinancialyear.php">Register New Financial Year</a>
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

        <div class="container-fluid mt-1 mb-2 bg-white rounded-5 shadow-5-strong p-4">
            <table class="table">
                <thead class='table-light sticky-top'>
                    <th>
                        Work Order No.
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Company
                    </th>
                    <th>
                        Product Code
                    </th>
                    <th>
                        Product Desc.
                    </th>
                    <th>

                    </th>
                    <th>

                    </th>
                    <th>
                        Product Desp. Quantity
                    </th>
                    <th>
                        Product Status
                    </th>
                    <th>
                        Extras
                    </th>
                </thead>
                <tbody id='tablebody'>

                    <?php
                    $cur_no = -1;
                    $table_active = '';
                    while ($row = $retval->fetch_assoc()) {
                        if ($cur_no == $row['work_order_no']) {

                        } else {
                            if ($table_active == 'table-active') {
                                $table_active = '';
                            } else {
                                $table_active = 'table-active';
                            }
                        }
                        if (!empty($row)) {
                            echo "
                    <tr class='$table_active'>
                    <td>
                    {$row['work_order_no']}
                    </td>
                    <td>
                    {$row['date']}
                    </td>
                    <td>
                    {$row['company']}
                    </td>
                    <td>
                    {$row['code']}
                    </td>
                    <td>
                    {$row['name']}
                    </td>
                    <td>
                    {$row['design']}
                    </td>
                    <td>
                    {$row['size']}
                    </td>
                    <td>
                    {$row['qty']}
                    </td>
                    <td>
                    {$row['status']}
                    </td>
                    <td>
                    {$row['extras']}
                    </td>
                    ";
                            $cur_no = $row['work_order_no'];
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
            window.location.href = 'profile_workorder.php?f=1&start=$start_date&end=$end_date';
            </script>";
}

if (isset($_POST['delete_data'])) {
    $year_delete = $_POST['year_delete'];
    $year_start_date = $year_delete . '-04' . '-01';
    $year_end_date = ($year_delete + 1) . '-03' . '-31';

    $sql = "DELETE from work_orders_old where date BETWEEN '$year_start_date' AND '$year_end_date' AND user_id ='" . (string) $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo "Error Occured";
        echo "<script type='text/javascript'>
        window.location.href = 'profile_inpass.php?e=e1';
        </script>";
        exit;
    }

    $sql = "DELETE from work_order_products_old where date_of_entry BETWEEN '$year_start_date' AND '$year_end_date' AND user_id ='" . (string) $loggedin_session . "'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo mysqli_error($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'profile_workorder.php?e=e2';
        </script>";
        exit;
    }

    echo "<script type='text/javascript'>
        window.location.href = 'profile_workorder.php?e=s';
        </script>";
}
?>