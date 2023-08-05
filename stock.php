<?php
include 'conn.php';
include 'nav.php';
?>

<?php

$item = 'All';
$design = 'All';
$size = 'All';
$acof_fill = 'All';
$f = $_GET['f'];
if ($f != 0) {
    $item = $_GET['i'];
    $design = $_GET['d'];
    $size = $_GET['s'];
    $acof_fill = $_GET['w'];
}

//for item filter
$sql2 = "SELECT item from stock WHERE user_id = '" . (string) $loggedin_session . "'";
$sql2 .= " GROUP BY item";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}

//for design filter
$sql3 = "SELECT design from stock WHERE user_id = '" . (string) $loggedin_session . "'";
$sql3 .= " GROUP BY design";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}

//for size filter
$sql4 = "SELECT size from stock WHERE user_id = '" . (string) $loggedin_session . "'";
$sql4 .= " GROUP BY size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}

//for acof filter
$sql5 = "SELECT acof from stock WHERE user_id = '" . (string) $loggedin_session . "'";
$sql5 .= " GROUP BY acof";
$retval5 = mysqli_query($conn, $sql5);
if (!$retval5) {
    echo mysqli_error($conn);
}

//for table
$sql = "SELECT * from stock WHERE user_id = '" . (string) $loggedin_session . "'";

if ($item != 'All') {
    $sql .= " AND item = '$item'";
}

if ($design != 'All') {
    $sql .= " AND design = '$design'";
}

if ($size != 'All') {
    $sql .= " AND size = '$size'";
}

if ($acof_fill != 'All') {
    $sql .= " AND acof = '$acof_fill'";
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

        //populating values on edit
        $('.edit-btn').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            var index_editpopup = $(this).closest('tr').find('td:eq(6)').text().trim();
            var acof_editpopup = $(this).closest('tr').find('td:eq(1)').text().trim();
            var name_editpopup = $(this).closest('tr').find('td:eq(2)').text().trim();
            var design_editpopup = $(this).closest('tr').find('td:eq(3)').text().trim();
            var size_editpopup = $(this).closest('tr').find('td:eq(4)').text().trim();
            var qty_editpopup = $(this).closest('tr').find('td:eq(5)').text().trim();

            $('#name_edit').val(name_editpopup);
            $('#design_edit').val(design_editpopup);
            $('#size_edit').val(size_editpopup);
            $('#qty_edit').val(qty_editpopup);
            $('#acof_edit').val(acof_editpopup);
            $('#index_edit').val(index_editpopup);
            initilizebootstrap();
        });

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

        #dontprintbtn3 {
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
    <div id="editPopup" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content  container mt-1 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                <div class="modal-header">
                    <h2 class="modal-title">Edit</h2>
                    <button type="button" id='cancelBtn' class="btn-close" data-mdb-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class='row justify-content'>
                        <div class="col-xl-10">
                            <form id="editForm" method="post">
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="hidden" id='index_edit' class="form-control" required
                                            name="index_edit">
                                    </div>
                                </div>
                                <div class='row pb-4'>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id='acof_edit' class="form-control" required
                                                name="acof_edit">
                                            <label for="acofeditfield" class='form-label'>A/C of</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id='name_edit' class="form-control" required
                                                name="name_edit">
                                            <label for="nameeditfield" class='form-label'>Name of Item</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id='design_edit' class="form-control" required
                                                name="design_edit">
                                            <label for="designeditfield" class='form-label'>Design</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id='size_edit' class="form-control" required
                                                name="size_edit">
                                            <label for="sizeeditfield" class='form-label'>Size</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">
                                            <input type="text" id='qty_edit' class="form-control" required
                                                name="qty_edit">
                                            <label for="qtyeditfield" class='form-label'>Quantity</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-success" name="save" value="Save">
                                <input type="submit" onclick="return confirm('Are you sure?');" class="btn btn-danger"
                                    name="delete" value="Delete">
                                <!-- <input type='submit' class='btn btn-danger' name='delete' id='delete' value='Are You Sure?'> -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <h1 class="mt-2 ms-4">Current Stock</h1>
    <div class="container-fluid">
        <div class="mt-4 m-2">
            <?php
            if (isset($_GET['e']) == 'e1' || isset($_GET['e']) == 'e2') {
                echo "<center><small class='fs-5 pb-2 text-danger'>Some Error Occured</small></center>";
            }
            ?>
            <form method="post"
                class="bg-white rounded-5 shadow-2-strong ps-5 pb-5 pt-1  border-1 border-primary rounded pt-2 mb-2">
                <h4 class='mb-4 mt-4'>Add New Product to Stock</h4>
                <div class='row'>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id='acofaddfield' class="form-control" required name="acof_add">
                            <label for="acofaddfield" class='form-label'>A/C of</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id='nameaddfield' class="form-control" required name="name_add">
                            <label for="nameaddfield" class='form-label'>Name of Item</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id='designaddfield' class="form-control" required name="design_add">
                            <label for="designaddfield" class='form-label'>Design</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id='sizeaddfield' class="form-control"
                                onkeydown="if(['Space'].includes(arguments[0].code)){return false;};" required
                                name="size_add">
                            <label for="sizeaddfield" class='form-label'>Size</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id='qtyaddfield' class="form-control" required name="qty_add">
                            <label for="qtyaddfield" class='form-label'>Quantity</label>
                        </div>
                    </div>

                    <div class="col">
                        <button name="add_stock" class="btn btn-outline-secondary text-nowrap"
                            data-mdb-ripple-color="dark">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content" id='dontprint'>
            <div class="col">
                <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                    <h4 class='mb-4'>Filter</h4>
                    <div class="col justify-content">

                        <label>A/C of</label>
                        <select name='acof'>
                            <option selected>All</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($retval5)) {
                                echo "
            <option> " . ucwords($row['acof']) . "</option>
            ";
                            }
                            ?>
                        </select>
                        &nbsp;

                        <label>Item</label>
                        <select name='item'>
                            <option selected>All</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($retval2)) {
                                echo "
            <option> " . ucwords($row['item']) . "</option>
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
            <option> " . ucwords($row['design']) . "</option>
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
                        A/C of
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
                    <th>

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
                " . ucwords($row['acof']) . "
                </td>
                <td>
                " . ucwords($row['item']) . "
                </td>
                <td>
                " . ucwords($row['design']) . "
                </td>
                <td>
                    {$row['size']}
                </td>
                <td>
                    {$row['qty']}
                </td>
                <td style='display:none;'>
                {$row['index']}
                </td>
                <td>
                     <input type='button' data-mdb-toggle='modal' id='dontprintbtn3' data-mdb-target='#editPopup' class='edit-btn btn btn-outline-primary' value='Edit'>
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
    $acof_fil = $_POST['acof'];

    echo "<script type='text/javascript'>
            window.location.href = 'stock.php?f=1&i=$item_fil&d=$design_fil&s=$size_fil&w=$acof_fil';
            </script>";
}

if (isset($_POST['add_stock'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $name_add = '';
    $design_add = '';
    $size_add = '';
    $qty_add = '';
    $acof_add = '';

    $name_add = $_POST['name_add'];
    $design_add = $_POST['design_add'];
    $size_add = $_POST['size_add'];
    $qty_add = $_POST['qty_add'];
    $acof_add = $_POST['acof_add'];

    //converting to lowercase
    $name_add = strtolower($name_add);
    $design_add = strtolower($design_add);
    $size_add = strtolower($size_add);

    $sqltrans = "START TRANSACTION";
    $transtart = mysqli_query($conn, $sqltrans);
    if (!$transtart) {
        echo "Error Occured";
        exit;
    }

    $sql = "INSERT into stock(item,design,size,qty,acof,user_id) VALUES ('$name_add','$design_add','$size_add','$qty_add','$acof_add','" . (string) $loggedin_session . "')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'stock.php?f=0&e=e1';
        </script>";
        echo "<script>alert('Some Error Occured')</script>";
        exit;
    }
    $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$name_add','$size_add','$qty_add','$qty_add','$acof_add','Inpass','" . (string) $loggedin_session . "')";
    $update92 = mysqli_query($conn, $sql92);
    if (!$update92) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'stock.php?f=0&e=e2';
        </script>";
        echo "<script>alert('Some Error Occured')</script>";
        exit;
    }

    mysqli_commit($conn);

    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'stock.php?f=0';
    </script>";
    }
}

if (isset($_POST['save'])) {
    $name_edit = $_POST['name_edit'];
    $design_edit = $_POST['design_edit'];
    $size_edit = $_POST['size_edit'];
    $qty_edit = $_POST['qty_edit'];
    $acof_edit = $_POST['acof_edit'];
    $index_edit = $_POST['index_edit'];

    //converting to lowercase
    $name_edit = strtolower($name_edit);
    $design_edit = strtolower($design_edit);
    $size_edit = strtolower($size_edit);

    $tran = 'START TRANSACTION';
    $transtart = mysqli_query($conn, $tran);
    if (!$transtart) {
        echo mysqli_error($conn);
    }

    $sql = "UPDATE `stock` SET `item`='$name_edit',`design`='$design_edit',`size`='$size_edit',`qty`='$qty_edit',`acof`='$acof_edit' WHERE `index` = $index_edit AND `user_id` = '" . (string) $loggedin_session . "'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'stock.php?f=0&e=e1';
        </script>";
        echo "<script>alert('Some Error Occured')</script>";
        exit;
    }

    $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$name_edit','$size_edit','$qty_edit','$qty_edit','$acof_edit','Manual','" . (string) $loggedin_session . "')";
    $update92 = mysqli_query($conn, $sql92);
    if (!$update92) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'stock.php?f=0&e=e2';
        </script>";
        echo "<script>alert('Some Error Occured')</script>";
        exit;
    }

    mysqli_commit($conn);
    echo "<script type='text/javascript'>
                window.location.href = 'stock.php?f=0';
                </script>";
}

if (isset($_POST['delete'])) {
    $name_edit = $_POST['name_edit'];
    $design_edit = $_POST['design_edit'];
    $size_edit = $_POST['size_edit'];
    $qty_edit = $_POST['qty_edit'];
    $acof_edit = $_POST['acof_edit'];
    $index_edit = $_POST['index_edit'];

    //converting to lowercase
    $name_edit = strtolower($name_edit);
    $design_edit = strtolower($design_edit);
    $size_edit = strtolower($size_edit);

    $sql = "DELETE FROM `stock` WHERE `index` = '$index_edit' AND `user_id` = '" . (string) $loggedin_session . "'";
    $update1 = mysqli_query($conn, $sql);
    if (!$update1) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'stock.php?f=0&e=e2';
        </script>";
        echo "<script>alert('Some Error Occured')</script>";
        exit;
    }

    $sql92 = "INSERT INTO stock_data(product_name,product_size,product_qty,total_qty,acof,type,user_id) VALUES ('$name_edit','$size_edit','0','0','$acof_edit','Delete','" . (string) $loggedin_session . "')";
    $update92 = mysqli_query($conn, $sql92);
    if (!$update92) {
        echo mysqli_error($conn);
        mysqli_rollback($conn);
        echo "<script type='text/javascript'>
        window.location.href = 'stock.php?f=0&e=e2';
        </script>";
        echo "<script>alert('Some Error Occured')</script>";
        exit;
    }

    echo "<script type='text/javascript'>
               alert('Product has been deleted')
                </script>";
    echo "<script type='text/javascript'>
                window.location.href = 'stock.php?f=0';
                </script>";
}
?>