<?php
include 'checkuserlogin.php';
?>

<!DOCTYPE html>
<html>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<!-- MDB icon -->
<!-- <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" /> -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
<!-- MDB -->
<link rel="stylesheet" href="css/mdb.min.css" />


<style>
    /* .navbar {
            background-color: brown;
        } */
</style>
<?php 
$company_name = '';
if(isset($loggedin_session)){
$userName = mysqli_fetch_assoc(mysqli_query($conn,"select name from profile where user_id = '".(string)$loggedin_session."'"))['name'];
}
?>
<script>
    function logout() {
        session_destroy();
    }
</script>

<body>
    <div id='dontprintnav'>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="profile.php"><?php echo $userName;?></a>
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="inpass.php">Inpass</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="outpass.php">Outpass</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="workorder.php">Work Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stock.php?f=0">Stock</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ledger.php?f=0">Ledger</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="billing_workorder.php">Billing</a>
                        </li>
                    </ul>
                </div>
                <?php
                if((date('m') >= 3 && date('d') >= 24 ) && (date('m') <= 4 && date('d') < 7 ))
                echo "<div class='text-danger pe-5'>
                    Dont Forget To Register for New Financial Year if Not Done
                </div>"
                ?>
                <ul class="navbar-nav">
                    <div class="d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </div>
                </ul>
            </div>
    </div>
    </nav>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>