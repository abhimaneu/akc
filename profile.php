<?php
include 'conn.php';
include 'nav.php';
?>

<?php
// $conn = mysqli_connect('localhost','root','','akcdb');
if (!$conn) {
    echo "Error Occured";
    die($conn);
}
$sql = "SELECT * from profile";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_error($conn);
}
$name = "";
$wo = "";
while ($row = $retval->fetch_assoc()) {
    $name = $row['name'];
    $wo = $row['wo'];
}

$sql = "SELECT * from vehicles";
$retval2 = mysqli_query($conn, $sql);
if (!$retval2) {
    echo mysqli_query($conn, $sql);
}

$sql2 = "SELECT * from company Order by name";
$retval3 = mysqli_query($conn, $sql2);
if (!$retval3) {
    echo mysqli_query($conn, $sql);
}

$sql4 = "SELECT * from company_products";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_query($conn, $sql);
}

?>

<html>

<body> <br>
    Company Name:
    <?php echo $name ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    Company Code:
    <?php echo $wo ?> <br> <br>
    <h1>Company Products</h1>
    <table style="border-spacing: 30px;">
            <thead>
                <th>No.</th>
                <th>Code</th>
                <th>Name</th>
                <th>Design</th>
                <th>Size</th>
                <th>Feature</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($retval4)) {
                    echo "
                    <form method='POST'>
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
                    {$row['features']}
                    </td>
                    <td>
                    <form method='post' id='delete_company_product' name='delete_company_product'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <input type='submit' id='delete_company_product' name='delete_company_product' value='Delete'>
                    </form>
                    </td>
                    </tr>
                    </form>
                    ";
                    $i = $i + 1;
                }
                ?>
                <tr>
                    <form method="post">
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td><input type="text" required name="code"></td>
                        <td><input type="text" required name="name"></td>
                        <td><input type="text" required name="design"></td>
                        <td><input type="text" required name="size"></td>
                        <td><input type="text" name="features"></td>
                        <td><button name="add_company_product">Add Product</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
        <br> <br>
    <h1>Vehicle List</h1> <br> <br>
    <table style="border-spacing: 30px;">
        <thead>
            <th>No.</th>
            <th>Vehicle No.</th>
            <th>Vehicle Type</th>
            <th>Vehicle Owner</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($retval2)) {
                echo "
                    <tr>
                    <td>
                    $i
                    </td>
                    <td>
                    {$row['number']}
                    </td>
                    <td>
                    {$row['type']}
                    </td>
                    <td>
                    {$row['owner']}
                    </td>
                    <td>
                    <form method='post' id='delete_vehicle' name='delete_vehicle'>
                    <input type='hidden' name='id' value='{$row['number']}'>
                    <input type='submit' id='delete_vehicle' name='delete_vehicle' value='Delete'>
                    </form>
                    </td>
                    </tr>
                    ";
                $i = $i + 1;
            }
            ?>
            <tr>
                <form method="post">
                    <td>
                        <?php echo $i ?>
                    </td>
                    <td><input type="text" required name="no"></td>
                    <td><input type="text" required name="type"></td>
                    <td><input type="text" required name="owner"></td>
                    <td><button name="add_vehicle">Add Vechicle</button></td>
                </form>
            </tr>
        </tbody>
    </table>
    <br>
    <h1>Saved Companies</h1>
    <table style="border-spacing: 30px;">
        <thead>
            <th>No.</th>
            <th>Company Name</th>
            <th>WO#</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($retval3)) {
                echo "
                    <form method='POST'>
                    <tr>
                    <td>
                    $i
                    </td>
                    <td>
                    {$row['name']}
                    </td>
                    <td>
                    {$row['code']}
                    </td>
                    <td>
                    <form method='post' id='delete_company' name='delete_company'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <input type='submit' id='delete_company' name='delete_company' value='Delete'>
                    </form>
                    </td>
                    </tr>
                    </form>
                    ";
                $i = $i + 1;
            }
            ?>
            <tr>
                <form method="post">
                    <td>
                        <?php echo $i ?>
                    </td>
                    <td><input type="text" required name="name"></td>
                    <td><input type="text" required name="code"></td>
                    <td><button name="add_company">Add Company</button></td>
                </form>
            </tr>
        </tbody>
    </table>

</body>

</html>

<?php
if (isset($_POST['delete_vehicle']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!$conn) {
        echo "Error Occured";
    }

    $sql = "DELETE FROM vehicles where number = '$id'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo "Delete was not possible";
    }
    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
}

if (isset($_POST['delete_company']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!$conn) {
        echo "Error Occured";
    }

    $sql = "DELETE FROM company where code = '$id'";
    $delete = mysqli_query($conn, $sql);
    if (!$delete) {
        echo "Delete was not possible";
    }
    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
}

if (isset($_POST['add_company'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $company_name = '';
    $company_code = '';
    $company_name = $_POST['name'];
    $company_code = $_POST['code'];
    $sql = "INSERT into company(name,code) VALUES ('$company_name','$company_code')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
    }
}


if (isset($_POST['add_vehicle'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $vehicle_no = '';
    $vehicle_type = '';
    $vehicle_owner = '';
    $vehicle_no = $_POST['no'];
    $vehicle_type = $_POST['type'];
    $vehicle_owner = $_POST['owner'];
    $sql = "INSERT into vehicles(type,number,owner) VALUES ('$vehicle_type','$vehicle_no','$vehicle_owner')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
        window.location.href = 'profile.php';
        </script>";
    }
}

if (isset($_POST['delete_company_product'])) {
    // //transaction
    // $tran = 'START TRANSACTION';
    // $transtart = mysqli_query($conn, $tran);
    // if (!$transtart) {
    //     echo mysqli_error($conn);
    // }
    // $tran = 'SET AUTOCOMMIT = OFF';
    // $transtart = mysqli_query($conn, $tran);
    // if (!$transtart) {
    //     echo mysqli_error($conn);
    // }

    $delete_code = $_POST['id'];
    $sql = "DELETE from company_products where code = '$delete_code'";
    $retval7 = mysqli_query($conn, $sql);
    if (!$retval7) {
        echo "Error Occured";
    }
    // //transaction
    // mysqli_commit($conn);

    echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
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
    $product_features = '';
    $product_name = $_POST['name'];
    $product_code = $_POST['code'];
    $product_size = $_POST['size'];
    $product_design = $_POST['design'];
    $product_features = $_POST['features'];
    $sql = "INSERT into company_products(code,name,design,size,features) VALUES ('$product_code','$product_name','$product_design','$product_size','$product_features')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'profile.php';
    </script>";
    }
}
?>