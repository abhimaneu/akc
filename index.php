<?php
include 'conn.php';
?>

<?php
session_start();
if (isset($_POST['signin_user'])) {
    $username_login = mysqli_real_escape_string($conn, $_POST['login_username']);
    $password_login = mysqli_real_escape_string($conn, $_POST['login_password']);
    $sql1 = "SELECT * FROM profile WHERE user_id = '" . $username_login . "'";
    $res = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($res);


    if (mysqli_num_rows($res) > 0) {
        $user = $row['user_id'];
        $password = $row['password'];
        if (password_verify($password_login, $password)) {
            $_SESSION['is_login'] = true;
            $_SESSION['username'] = $row['user_id'];
            $flag = 0;
            sleep(1);
            header('location:inpass.php');
        } else {
            echo "<center><p class='text-danger pt-2'>Invalid Password or Username!</p></center>";
        }



    } else {
        echo "<center><p class='text-danger pt-2'>User Not Registered</p></center>";
    }

}

if (isset($_POST['register_user'])) {
    $register_name = $_POST['register_name'];
    $register_username = $_POST['register_username'];
    $register_password = $_POST['register_password'];
    $register_v_password = $_POST['register_v_password'];
    if ($register_password == $register_v_password) {

        $encr_pass = password_hash($register_password, PASSWORD_BCRYPT);

        $check_user = mysqli_query($conn, "SELECT user_id FROM profile where user_id = '$register_username' ");
        if (mysqli_num_rows($check_user) > 0) {
            echo "<center><p class='text-danger pt-2'>User Already Exists</p></center>";
        } else {
            $query = "INSERT into profile (name, user_id, password) VALUES ('$register_name', '$register_username', '$encr_pass');";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION['is_login'] = true;
                $_SESSION['username'] = $register_username;
                $flag = 0;
                sleep(1);
                header('Location:profile.php');
            }
        }
    } else {
        echo "Password Does Not Match";
    }
}
?>

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


<body>
    <div
        class="container-fluid bg-light rounded shadow-5-strong w-50 d-flex justify-content-center align-items-center mt-5 p-5">
        <div class="col-md-8">
            <h1>&nbsp; </h1>
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                        aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                        aria-controls="pills-register" aria-selected="false">Register</a>
                </li>
            </ul>

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form id='signin_user' onsubmit="return validation()" method="post">
                        <h1 class='fs-4 pb-4 pt-2'>Enter Credentials</h1>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="loginName" pattern="[A-Za-z0-9]+" onkeydown="if(['Space'].includes(arguments[0].code)){return false;}" required name="login_username" class="form-control" />
                            <label class="form-label" for="loginName">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="loginPassword" required name='login_password'
                                class="form-control" />
                            <label class="form-label" for="loginPassword">Password</label>
                        </div>

                        <!-- 2 column grid layout -->
                        <!-- <div class="row mb-4">
                        <div class="col-md-6 d-flex justify-content-center">
                            
                            <div class="form-check mb-3 mb-md-0">
                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                <label class="form-check-label" for="loginCheck"> Remember me </label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center">
                 
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div> -->

                        <!-- Submit button -->
                        <div class="pt-2">
                            <button type="submit" name="signin_user" class="btn btn-primary btn-block mb-4">Sign
                                in</button>
                        </div>
                    </form>
                </div>

                <!--- Register --->
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <form id='register_user' method='post'>
                        <h1 class='fs-4 pb-4 pt-2'>Enter Credentials</h1>
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="registerName" name='register_name' class="form-control" />
                            <label class="form-label" for="registerName">Name</label>
                        </div>

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="registerUsername" pattern="[A-Za-z0-9]+" onkeydown="if(['Space'].includes(arguments[0].code)){return false;}" name='register_username' class="form-control" />
                            <label class="form-label" for="registerUsername">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="registerPassword"  name='register_password'
                                class="form-control" />
                            <label class="form-label" for="registerPassword">Password</label>
                        </div>

                        <!-- Repeat Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="registerRepeatPassword"  name='register_v_password'
                                class="form-control" />
                            <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                        </div>

                        <!-- Submit button -->
                        <div class="pt-2">
                            <button type="submit" name="register_user"
                                class="btn btn-primary btn-block mb-3">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <h1>&nbsp;</h1>
            <!-- Pills content -->
        </div>
    </div>



    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>