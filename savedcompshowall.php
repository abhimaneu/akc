<?php
include 'conn.php';
?>

<?php

$search = '';
$f = $_GET['f'];
if ($f != 0) {
    $search = $_GET['pns'];
}

//for table
$sql = "SELECT * from company where 1=1";

if (!empty($search)) {
    $sql .= " AND (name LIKE '%$search%' OR code LIKE '%$search%')";
}

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo "Error Occred";
}

?>

<html>

<body>
<h2>Saved Companys</h2>
    <br>
    <br>
    <form name="filter" method="post">
        Search by Keywords <br> <br>
            <input type="text" name="search" placeholder="Search Product Name/Code...">
            <input type="submit" name="filter" value="Search">
        
    </form>

    <table style="border-spacing:30px;">
        <thead>
            <th>
                No.
            </th>
            <th>
                Name
            </th>
            <th>
                Code
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
                </tr>";
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
    window.location.href = 'savedcompshowall.php?f=0';
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
    window.location.href = 'savedcompshowall.php?f=0';
    </script>";
    }
}

if (isset($_POST['filter'])) {
    $search = $_POST['search'];
    echo "<script type='text/javascript'>
            window.location.href = 'savedcompshowall.php?f=1&&pns=$search';
            </script>";
}
?>