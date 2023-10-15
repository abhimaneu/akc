<?php
include 'nav.php';
include 'conn.php';
?>

<?php
$sql = "SELECT * FROM work_orders WHERE user_id = '".(string)$loggedin_session."'";
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
    // $(document).ready(function () {
    //     //search stock data
    //     var searchInput = document.getElementById("search");
    //     var datas = document.getElementById("listwo");
    //     var rows = datas.getElementsByClassName('wos');

    //     searchInput.addEventListener("keyup", function () {
    //         var input = searchInput.value.toLowerCase();

    //         for (var i = 0; i < rows.length; i++) {
    //             var rowData = rows[i].getElementsByTagName("h1");
    //             var found = false;

    //             for (var j = 0; j < rowData.length; j++) {
    //                 if (rowData[j].innerHTML.toLowerCase().indexOf(input) > -1) {
    //                     found = true;
    //                     initilizebootstrap();
    //                     break;
    //                 }
    //             }

    //             if (found) {
    //                 rows[i].style.display = "";
    //                 initilizebootstrap();
    //             } else {
    //                 rows[i].style.display = "none";
    //                 initilizebootstrap();
    //             }
    //         }
    //     });
    // });

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
                        <a class="nav-link text-black" href="billing_generate.php">Generate</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="billing_invoices.php">History</a>
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
    <?php
    include 'creategstinvoice_custom.php';
    ?>
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