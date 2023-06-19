<?php
include 'conn.php';
include 'nav.php';
?>

<?php
$sql = "SELECT * from stock";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo "Error Occred";
}

$item = 'All';
$design = 'All';
$size = 'All';
$f = $_GET['f'];
if ($f != 0) {
    $item = $_GET['i'];
    $design = $_GET['d'];
    $size = $_GET['s'];
}
$sql2 = "SELECT item from stock where 1=1";

if($item!='All'){
    $sql2 .= " AND item = '$item'";
}

$sql2 .= " GROUP BY item";
$retval2 = mysqli_query($conn, $sql2);
if (!$retval2) {
    echo mysqli_error($conn);
}

$sql3 = "SELECT design from stock where 1=1";

if($design!='All'){
    $sql3 .= " AND design = '$design'";
}

$sql3 .= " GROUP BY design";
$retval3 = mysqli_query($conn, $sql3);
if (!$retval3) {
    echo mysqli_error($conn);
}

$sql4 = "SELECT size from stock where 1=1";

if($size!='All'){
    $sql4 .= " AND size = '$size'";
}

$sql4 .= " GROUP BY size";
$retval4 = mysqli_query($conn, $sql4);
if (!$retval4) {
    echo mysqli_error($conn);
}

?>

<html>

<body>
<h2>Stock</h2>
    <br>
    <br>
    <form name="filter" method="post">
        <label>Item</label>
        <select name='item'>
            <option selected>All</option>
            <?php
            while($row = mysqli_fetch_assoc($retval2)){
            echo "
            <option>{$row['item']}</option>
            ";
            }
            ?>
        </select>
        <label>Design</label>
        <select name='design'>
            <option selected>All</option>
            <?php
            mysqli_data_seek($retval3, 0);
            while($row = mysqli_fetch_assoc($retval3)){
            echo "
            <option>{$row['design']}</option>
            ";
            }
            ?>
        </select>
        <label>Size</label>
        <select name='size'>
            <option selected>All</option>
            <?php
            mysqli_data_seek($retval4, 0);
            while($row = mysqli_fetch_assoc($retval4)){
            echo "
            <option>{$row['size']}</option>
            ";
            }
            ?>
        </select> &nbsp;
        <input type="submit" name="filter" value="Search">
    </form>

    <table style="border-spacing:30px;">
        <thead>
            <th>
                No.
            </th>
            <th>
                Code
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
        <tbody>
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