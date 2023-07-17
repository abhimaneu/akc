<?php
include 'conn.php';
?>

<?php

$p_name = 'All';
$design = 'All';
$size = 'All';
//$feature = 'All';
$f = $_GET['f'];
if ($f != 0) {
    $p_name = $_GET['i'];
    $design = $_GET['d'];
    $size = $_GET['s'];
}

//for item filter
$sql2 = "SELECT name from company_products where 1=1";
$sql2 .= " GROUP BY name";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}

//for design filter
$sql3 = "SELECT design from company_products where 1=1";
$sql3 .= " GROUP BY design";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}

//for size filter
$sql4 = "SELECT size from company_products where 1=1";
$sql4 .= " GROUP BY size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}

//for table
$sql = "SELECT * from company_products where 1=1";

if ($p_name != 'All') {
    $sql .= " AND name = '$p_name'";
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

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Company Products</title>
<!-- MDB icon -->
<!-- <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" /> -->
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
        //search stock data
        var searchInput = document.getElementById("search");
        var table = document.getElementById("pbody");
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
    <main><br>
        <h1 class="mt-2 ms-4">Company Products</h1>
        <div class="container-fluid">
            <div class="mt-4 m-2">

                <form method="post"
                    class="bg-white rounded-5 shadow-2-strong ps-5 pb-5 pt-1  border-1 border-primary rounded pt-2 mb-2">
                    <h4 class='mb-4 mt-4'>Add Product</h4>
                    <div class='row'>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='codefield' class="form-control" required name="code">
                                <label for="codefield" class='form-label'>Code</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='namefield' class="form-control" required name="name">
                                <label for="namefield" class='form-label'>Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='designfield' class="form-control" required name="design">
                                <label for="designfield" class='form-label'>Design</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id='sizefield' class="form-control" required name="size">
                                <label for="sizefield" class='form-label'>Size</label>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="form-outline">
                                <input type="text" id='featfield' class="form-control" name="features">
                                <label for="featfield" class='form-label'>Features</label>
                            </div>
                        </div> -->
                        <div class="col">
                            <button name="add_company_product" class="btn btn-outline-secondary text-nowrap"
                                data-mdb-ripple-color="dark">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row justify-content">
                <div class="col">
                    <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                        <h4 class='mb-4'>Filter</h4>
                        <div class="col justify-content">
                            <label>Name</label>
                            <select name='name'>
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
                            &nbsp;
                            <input type="submit" class=" btn btn-outline-primary btn-sm" data-mdb-ripple-color="dark"
                                name="filter" value="Search">
                        </div>
                        <h5 class='mb-4 mt-4'>Search By Keywords</h5>
                        <div class='col justify-content w-25'>
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="text" name="search" class="form-control" id='search'
                                        placeholder="eg. ABC001">
                                    <label class="form-label" for="search">Search</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>

            <div class="container-fluid mt-4 mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                <table class="table table-striped">
                    <thead class="table-light">
                        <th>
                            No.
                        </th>
                        <th>
                            Code
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Design
                        </th>
                        <th>
                            Size
                        </th>
                        <!-- <th>
                            Feature
                        </th> -->
                        <th>

                        </th>
                    </thead>
                    <tbody id='pbody'>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($retval)) {
                            echo "
                <tr>
                <td>
                    $i
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
                    <form method='post' id='delete_company_product' name='delete_company_product'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <input type='submit' class='btn btn-outline-danger btn-sm' data-mdb-ripple-color='dark' id='delete_company_product' name='delete_company_product' value='Delete'>
                    </form>
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

    </main>
</body>

</html>

<?php
if (isset($_POST['delete_company_product'])) {

    $delete_code = $_POST['id'];
    $sql = "DELETE from company_products where code = '$delete_code'";
    $retval7 = mysqli_query($conn, $sql);
    if (!$retval7) {
        echo "Error Occured";
    }

    echo "<script type='text/javascript'>
    window.location.href = 'compproductshowall.php?f=0';
    </script>";
}
if (isset($_POST['add_company_product'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $product_name = '';
    $product_code = '';
    $product_size = '';
    $product_design = '';
    //$product_features = '';
    $product_name = $_POST['name'];
    $product_code = $_POST['code'];
    $product_size = $_POST['size'];
    $product_design = $_POST['design'];
    //$product_features = $_POST['features'];
    $sql = "INSERT into company_products(code,name,design,size) VALUES ('$product_code','$product_name','$product_design','$product_size')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'compproductshowall.php?f=0';
    </script>";
    }
}

if (isset($_POST['filter'])) {
    $pro_fil = $_POST['name'];
    $design_fil = $_POST['design'];
    $size_fil = $_POST['size'];

    echo "<script type='text/javascript'>
            window.location.href = 'compproductshowall.php?f=1&i=$pro_fil&d=$design_fil&s=$size_fil';
            </script>";
}
?>