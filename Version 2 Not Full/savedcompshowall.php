<?php
include 'conn.php';
include 'checkuserlogin.php';
?>

<?php

$f = $_GET['f'];
if ($f != 0) {

}

//for table
$sql = "SELECT * from company WHERE user_id = '".(string)$loggedin_session."'";

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    echo "Error Occred";
}

?>

<html>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Saved Companies</title>
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
        var table = document.getElementById("cbody");
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
        <h1 class="mt-2 ms-4">Saved Companies</h1>
        <div class="container-fluid">
            <div class="mt-4 w-50 ">
                <form method="post" class="bg-white rounded-5 shadow-2-strong ps-5 pb-5 pt-1  pt-2 mb-2">
                    <h4 class='mb-4 mt-4'>Add Product</h4>
                    <div class='row'>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="namefield" class="form-control" required name="name">
                                <label for="namefield" class='form-label'>Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="codefield" class="form-control" required name="code">
                                <label for="codefield" class='form-label'>Code</label>
                            </div>
                        </div>
                        <div class="col">
                            <button name="add_company" class="btn btn-outline-secondary text-nowrap"
                                    data-mdb-ripple-color="dark">Add Company</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row justify-content">
                <form name="filter" class="bg-white rounded-5 shadow-0-strong p-5" method="post">
                    <h5 class='mb-4'>Search By Keywords</h5>
                    <div class='col justify-content w-25'>
                        <div class="input-group">
                            <div class="form-outline">
                                <input type="text" name="search" id='search' class="form-control"
                                    placeholder="eg. Akshay Coir">
                                <label class="form-label" for="search">Search</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-fluid mb-2 p-2 bg-white rounded-5 shadow-5-strong p-4">
                <table class="table table-striped">
                    <thead class="table-light">
                        <th>
                            No.
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Code
                        </th>
                        <th>
                            
                        </th>
                    </thead>
                    <tbody id='cbody'>
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
                    <input type='submit'  class='btn btn-outline-danger btn-sm' data-mdb-ripple-color='dark' id='delete_company' name='delete_company' value='Delete'>
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
if (isset($_POST['delete_company']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!$conn) {
        echo "Error Occured";
    }

    $sql = "DELETE FROM company where code = '$id' AND user_id = '".(string)$loggedin_session."'";
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
    $sql = "INSERT into company(name,code,user_id) VALUES ('$company_name','$company_code','".(string)$loggedin_session."')";
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