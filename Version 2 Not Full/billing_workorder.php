<?php
include 'nav.php';
include 'conn.php';
?>

<?php
$sql = 'SELECT * FROM work_orders';
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}
?>

<html>
<title>Billing</title>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        //search stock data
        var searchInput = document.getElementById("search");
        var datas = document.getElementById("listwo");
        var rows = datas.getElementsByClassName('wos');

        searchInput.addEventListener("keyup", function () {
            var input = searchInput.value.toLowerCase();

            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].getElementsByTagName("h1");
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

    function generate_invoice(wno) {
        if (wno == -1) {
            window.open("creategstinvoice_custom.php");
        } else {
            window.open("creategstinvoice?wo=" + wno + "");
        }
    }
</script>

<body>
    <!-- Navbar -->
    <div class="me-4 ms-4  shadow-1-strong   mt-4">
    <nav class="navbar navbar-expand-lg navbar-light shadow-1 "  >
        <!-- Container wrapper -->
        <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <!-- Link -->
                   
                    <li class="nav-item">
                        <a class="nav-link text-black" href="billing_workorder.php">Work Order</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="billing_invoices.php">Invoice</a>
                    </li>

                </ul>

            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    </div>
    <!-- Navbar -->
    <br>
    <h2 class="mt-2 ms-4">Generate Bill</h2>
    <div class="container-fluid"> <br>
        <div class=''>
            <div class="mt-2 ms-4 pb-2 d-flex justify-content-between">
                <p class="d-flex justify-content-start fs-4">Choose a Work Order to Generate Invoice</p>
                <button onclick="generate_invoice('-1')" class='btn btn-primary fs-7 fw-bold' mdbRipple
                    rippleColor="dark">Create Custom Invoice</button>
            </div>
        </div>
        <div class="row justify-content-end">

            <div class='row justify-content m-4 shadow-0 w-25'>
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" class="form-control" id="search" name="search" placeholder="eg. ABC001">
                        <label class="form-label" for="search">Search</label>
                    </div>
                </div>
            </div>

            <div class='ps-5 pe-5 pb-5' id='listwo'>
                <?php
                $row_count = 4;
                $i = $row_count;
                while ($row = mysqli_fetch_assoc($retval)) {
                    if ($i % $row_count == 0) {
                        echo "<div class='row p-2 wos'>";
                    }
                    echo "
                    <div class='col-3'>
                    <div class='border border-white shadow-2-strong border-1 rounded p-3'>
                        <div class='row'>
                        <h1 class='fs-5'>{$row['work_order_no']}</h1>
                        </div>
                        <div class='row'>
                        <small>Dt. of Issue: {$row['date']}</small>
                        </div>
                        <div class='row'>
                        <small>{$row['company']}</small>
                        </div>
                        <div class='row'>
                        <small>Status: {$row['status']}</small>
                        </div>
                        <div class='row pt-2'>
                        <small><button onclick=\"generate_invoice('{$row['work_order_no']}')\" type='button' class='btn btn-success shadow-2'>Generate</button></small>
                        </div>
                        </div>
                    </div>";
                    if ($i % $row_count == $row_count - 1) {
                        echo "</div>";
                    }
                    $i = $i + 1;
                }
                ?>
            </div>
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

</body>

</html>