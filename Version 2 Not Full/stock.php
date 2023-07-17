<?php
include 'conn.php';
include 'nav.php';
?>

<?php

$item = 'All';
$design = 'All';
$size = 'All';
$f = $_GET['f'];
if ($f != 0) {
    $item = $_GET['i'];
    $design = $_GET['d'];
    $size = $_GET['s'];
}

//for item filter
$sql2 = "SELECT item from stock where 1=1";
$sql2 .= " GROUP BY item";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}

//for design filter
$sql3 = "SELECT design from stock where 1=1";
$sql3 .= " GROUP BY design";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}

//for size filter
$sql4 = "SELECT size from stock where 1=1";
$sql4 .= " GROUP BY size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}

//for table
$sql = "SELECT * from stock where 1=1";

if ($item != 'All') {
    $sql .= " AND item = '$item'";
}

if ($design != 'All') {
    $sql .= " AND design = '$design'";
}

if ($size != 'All') {
    $sql .= " AND size = '$size'";
}

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo "Error Occred";
}

?>

<html>

<title>Stock</title>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        //search stock data
        var searchInput = document.getElementById("search");
        var table = document.getElementById("stockbody");
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

    $(document).ready(function () {
        $(document).on("click", ".stockreport", function () {
        //window.location.href = 'stockreport.php?f=0'
        window.open('stockreport.php?f=0', '_blank');

    });
    });

    function printTable() {
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

        #dontprintbtn2 {
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
    <h1 class="mt-2 ms-4">Current Stock</h1>
    <div class="container-fluid">
        <div class="row justify-content" id='dontprint'>
            <div class="col">
                <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                    <h4 class='mb-4'>Filter</h4>
                    <div class="col justify-content">

                        <label>Item</label>
                        <select name='item'>
                            <option selected>All</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($retval2)) {
                                echo "
            <option>{$row['item']}</option>
            ";
                            }
                            ?>
                        </select>
                        &nbsp;
                        <label>Design</label>
                        <select name='design'>
                            <option selected>All</option>
                            <?php
                            mysqli_data_seek($retval3, 0);
                            while ($row = mysqli_fetch_assoc($retval3)) {
                                echo "
            <option>{$row['design']}</option>
            ";
                            }
                            ?>
                        </select>
                        &nbsp;
                        <label>Size</label>
                        <select name='size'>
                            <option selected>All</option>
                            <?php
                            mysqli_data_seek($retval4, 0);
                            while ($row = mysqli_fetch_assoc($retval4)) {
                                echo "
            <option>{$row['size']}</option>
            ";
                            }
                            ?>
                        </select>
                        &nbsp; &nbsp;
                        <input type="submit" class=" btn btn-outline-primary btn-sm" data-mdb-ripple-color="dark"
                            name="filter" value="Search"> <br> <br>
                    </div>

                    <h5 class='mb-4'>Search By Keywords</h5>
                    <div class='col justify-content w-25'>
                        <div class="input-group">
                            <div class="form-outline">
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="eg. ABC001">
                                <label class="form-label" for="search">Search</label>
                            </div>

                        </div>
                    </div>


                </form>
            </div>
        </div>
        <div class='p-1 d-flex justify-content-end dontprintarea'>
            <button class="btn btn-primary stockreport" id='dontprintbtn2'>Stock
                Report</button> &nbsp;
            <button onclick="printTable()" id='dontprintbtn' class="btn btn-primary ">Print Stock</button>
        </div>
        <div class="container-fluid mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4" id='printbody'>
            <table class="table table-striped" id='myTable'>
                <thead class="table-light">
                    <th>
                        No.
                    </th>
                    <th>
                        Item
                    </th>
                    <th>
                        Design
                    </th>
                    <th>
                        Size
                    </th>
                    <th>
                        Quantity Available
                    </th>
                </thead>
                <tbody id='stockbody'>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($retval)) {
                        echo "
                <tr>
                <td>
                    $i
                </td>
                <td>
                    {$row['item']}
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
                </tr>";
                        $i = $i + 1;
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


</body>

</html>

<?php
if (isset($_POST['filter'])) {
    $item_fil = $_POST['item'];
    $design_fil = $_POST['design'];
    $size_fil = $_POST['size'];

    echo "<script type='text/javascript'>
            window.location.href = 'stock.php?f=1&i=$item_fil&d=$design_fil&s=$size_fil';
            </script>";
}
?>