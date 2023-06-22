<?php
include 'conn.php';
?>

<?php

$p_name = 'All';
$design = 'All';
$size = 'All';
$feature = 'All';
$search = '';
$code = '';
$f = $_GET['f'];
if ($f != 0) {
    $item = $_GET['i'];
    $design = $_GET['d'];
    $size = $_GET['s'];

    $search = $_GET['pns'];
    $code = $_GET['pc'];
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

if($p_name!='All'){
    $sql .= " AND item = '$p_name'";
}

if($design!='All'){
    $sql .= " AND design = '$design'";
}

if($size!='All'){
    $sql .= " AND size = '$size'";
}

if (!empty($search)) {
    $sql .= " AND (name LIKE '%$search%' OR design LIKE '%$search%' OR size LIKE '%$search%' OR features LIKE '%$search%')";
}
if (!empty($code)) {
    $sql .= " AND (code LIKE '%$code%')";
}

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo "Error Occred";
}

?>

<html>

<body>
<h2>Stock</h2>
    <br>
    <br>
    <form name="filter" method="post">
        <label>Name</label>
        <select name='name'>
            <option selected>All</option>
            <?php
            while($row = mysqli_fetch_assoc($retval2)){
            echo "
            <option>{$row['name']}</option>
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
        <input type="submit" name="filter" value="Search"> <br> <br>
        Search by Keywords <br> <br>
            <input type="text" name="code" placeholder="Enter Product Code No.">
            <input type="text" name="search" placeholder="Search Product Name/Code...">
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
                Name
            </th>
            <th>
                Design
            </th>
            <th>
                Size
            </th>
            <th>
                Feature
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
    $pro_fil = $_POST['name'];
    $design_fil = $_POST['design'];
    $size_fil = $_POST['size'];

    $search = $_POST['search'];
    $code = $_POST['code'];
    echo "<script type='text/javascript'>
            window.location.href = 'compproductshowall.php?f=1&i=$pro_fil&d=$design_fil&s=$size_fil&pns=$search&pc=$code';
            </script>";
}
?>