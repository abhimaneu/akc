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

$sql = "SELECT * from products";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo mysqli_query($conn, $sql);
}
$sql2 = "SELECT * from products";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_query($conn, $sql);
}


?>

<html>

<body>
    <div>
        <h1>Products</h1>
        <table>
            <thead>
                <th>No.</th>
                <th>Name</th>
                <th>Code</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($retval)) {
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
                        <td><button name="add">Add Product</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
        <br>



        <!-- -----old code------ -->
        <!-- <form name="add" method="post" action="">
            <label for="name">Product Name</label>
            <input type="text" name="name"> <br>
            <label for="code">Product Code</label>
            <input type="text" name="code"> <br>
            <button type="submit" name="add">Add Product</button>
        </form> -->
        <br>

        <form method='post' name="delete_product" id="delete_product">
                <select name="productlist" id="productlist">
                    <option default>Choose Product to Delete</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($retval2)) {
                        echo "
                        <option>{$row['name']}</option>
                        ";
                    }
                    ?>
                </select> <br> <br>
                <input type="submit" name="delete_product" value="Delete">
        </form>
    </div>
</body>
<?php
if(isset($_POST['delete_product'])) {
    $name = $_POST['productlist'];
    $sql = "DELETE from products where name = '$name'";
    $retval4 = mysqli_query($conn,$sql);
    if(!$retval4) {
        echo "Error Occured";
    }
    echo "<script type='text/javascript'>
    window.location.href = 'products.php';
    </script>";
}
if (isset($_POST['add'])) {
    if (!$conn) {
        echo "Error Occured";
        die($conn);
    }
    $product_name = '';
    $product_code = '';
    $product_name = $_POST['name'];
    $product_code = $_POST['code'];
    $sql = "INSERT into products(name,code) VALUES ('$product_name','$product_code')";
    $insert = mysqli_query($conn, $sql);
    if (!$insert) {
        echo "Error";
        echo mysqli_error($conn);
        die($conn);
    }
    if ($insert) {
        echo "<script type='text/javascript'>
    window.location.href = 'products.php';
    </script>";
    }
}

//-----------old code----------
// if (isset($_POST['add'])) {
//     $name = "";
//     $code = "";
//     $name = $_POST['name'];
//     $code = $_POST['code'];
//     $conn = mysqli_connect('localhost', 'root', '', 'akcdb');
//     if(!$conn){
//         echo "Error Occured";
//         die($conn);
//     }
//     $sql = "INSERT INTO products(name,code) VALUES ('$name','$code')";
//     $insert = mysqli_query($conn,$sql);
//     if(!$insert){
//         echo mysqli_error($conn);
//     }
//     else{
//         echo "Added Succesfully";
//     }
//     mysqli_close($conn);
// }
// 
?>

</html>