<?php
include 'nav.php';
include 'conn.php';
?>

<?php
$sql = "SELECT * FROM invoice WHERE user_id = '".(string)$loggedin_session."'";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}

$sql2 = "SELECT work_order_no FROM work_orders WHERE user_id = '".(string)$loggedin_session."'";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}
$all_work_orders = array();
while($row2 = mysqli_fetch_assoc($retval2)) {
    $all_work_orders[] = $row2['work_order_no'];
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
                var rowData = rows[i].getElementsByClassName('databox');
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

    function generate_invoice_2(wno,ino) {
            window.open("creategstinvoice?wo=" + wno + "&in=" + ino);
    }

    function download_invoice(ino, wno) {
        window.open("createpdfgstinvoice?wo=" + wno + "&in=" + ino);
    }
</script>

<body>

    <div class="me-4 ms-4  shadow-1-strong   mt-4">
        <nav class="navbar navbar-expand-lg navbar-light shadow-1 ">

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
                            <a class="nav-link " href="billing_generate.php">Generate</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-black" href="billing_invoices.php">History</a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <br>
    <h2 class="mt-2 ms-4">Invoices</h2>
    <div class="container-fluid"> <br>
        <div class=''>
            <!-- <div class="mt-2 ms-4 pb-2 d-flex justify-content-between">
                <p class="d-flex justify-content-start fs-4">Generated Invoices</p>
                <button onclick="generate_invoice('-1')" class='btn btn-primary fs-7 fw-bold' mdbRipple
                    rippleColor="dark">Create Custom Invoice</button>
            </div> -->
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
                    <div class='databox border border-white shadow-2-strong border-1 rounded p-3'>
                        <div class='row'>
                        <h1 class='fs-5'>{$row['invoice_no']}</h1>
                        </div>
                        <div class='row'>
                        <small>WO.No.: {$row['work_order_no']}</small>
                        </div>
                        <div class='row'>
                        <small>{$row['company']}</small>
                        </div>
                        <div class='row'>
                        <small>Date: {$row['date']}</small>
                        </div>
                        <div class='row pt-2 pb-2'>
                        <div class='col'>
                        <form id='del_work_order' method='post'>
                        <small><button onclick=\"download_invoice('{$row['invoice_no']}','{$row['work_order_no']}')\" type='button' class='btn btn-primary btn-sm shadow-2'>Download</button></small>
                        <input type='hidden' name='cur_ino' value='{$row['invoice_no']}'>
                        <small><button type='submit' onclick=\"return confirm('Are you sure?');\" id='del_wo' name='del_work_order' class='btn btn-danger btn-sm shadow-2'>Delete</button></small>
                        </form>
                        </div>
                        </div>";
                        if(1==0){
                        echo "<small><button onclick=\"generate_invoice_2('{$row['work_order_no']}','{$row['invoice_no']}')\" type='button' class='btn btn-success btn-sm shadow-2'>Generate New Invoice</button></small>";
                        }
                        else {
                            echo "";
                        }
                        echo "</div>
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

<?php
if (isset($_POST['del_work_order'])) {
    $del_invoiceNo = $_POST['cur_ino'];

    $sql = "DELETE FROM `invoice` WHERE invoice_no = '$del_invoiceNo' AND user_id = '".(string)$loggedin_session."'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
    }
    $sql2 = "DELETE FROM `invoice_data` WHERE invoice_no = '$del_invoiceNo' AND user_id = '".(string)$loggedin_session."'";
    $update2 = mysqli_query($conn, $sql2);
    if (!$update2) {
        echo mysqli_error($conn);
    }

    echo "<script type='text/javascript'>
               alert('Invoice " . $del_invoiceNo . " has been deleted')
                </script>";
    echo "<script type='text/javascript'>
                window.location.href = 'billing_invoices.php';
                </script>";
}
?>