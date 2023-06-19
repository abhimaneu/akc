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
                <th>Design</th>
                <th>Size</th>
                <th></th>
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
                    <td>
                    {$row['design']}
                    </td>
                    <td>
                    {$row['size']}
                    </td>
                    <td>
                    <form method='post' id='delete_product' name='delete_product'>
                    <input type='hidden' name='id' value='{$row['code']}'>
                    <input type='submit' id='delete_product' name='delete_product' value='Delete'>
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
                        <td><input type="text" required name="design"></td>
                        <td><input type="text" required name="size"></td>
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
    </div>
</body>
<?php
if(isset($_POST['delete_product'])) {
    $delete_code = $_POST['id'];
    $sql = "DELETE from products where code = '$delete_code'";
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
    $product_size = '';
    $product_design = '';
    $product_name = $_POST['name'];
    $product_code = $_POST['code'];
    $product_size = $_POST['size'];
    $product_design = $_POST['design'];
    $sql = "INSERT into products(name,code,design,size) VALUES ('$product_name','$product_code','$product_design','$product_size')";
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