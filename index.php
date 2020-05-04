<?php
session_start();

include_once "database/DBConnect.php";
include_once "Classes/UserDB.php";
include_once "Classes/User.php";
include_once "Classes/UserRegister.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userRegister = new UserRegister();
    if (isset($_REQUEST['btn-login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if (!empty($username) && !empty($password)) {
            $login = $userRegister->userLogin($username, $password);
            if ($login) {
                $_SESSION['username'] = $username;
                header("location:view/profile.php");
            } else {
                $msg = "Incorrect Username or Password!";
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<form class="login-form" method="post">
    <h1>Login</h1>

    <div class="txtb">
        <input type="text" name="username" required>
        <span data-placeholder="Username"></span>
    </div>

    <div class="txtb">
        <input type="password" name="password" required>
        <span data-placeholder="Password"></span>
    </div>

    <input type="submit" class="logbtn" name="btn-login" value="Login">

    <div class="bottom-text">
        Don't have account? <a href="action/add.php">Sign up</a>
    </div>

    <div class="bottom-text" style="color:red; font-style: italic; font-size: 15px">
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </div>

</form>
</body>
</html>