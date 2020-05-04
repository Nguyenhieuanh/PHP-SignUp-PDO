<?php
session_start();

include_once "../database/DBConnect.php";
include_once "../Classes/UserDB.php";
include_once "../Classes/User.php";
include_once '../Classes/UserRegister.php';

if (!isset($_SESSION['username'])) {
    header("Location:../index.php");
}

if ($_SERVER['REQUEST_METHOD']) {
    if (isset($_REQUEST['btn-logout'])) {
        session_destroy();
        header("Location:../index.php");
    }
}

$userDB = new UserRegister();
$user = $userDB->showUserData($_SESSION['username']);
$_SESSION['userID'] = $userDB->getUserId($_SESSION['username']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<form action="#" method="post" class="login-form" style="padding-top: 40px;">
    <h1 style="margin-bottom: 20px">Profile</h1>
    <div class="imgcontainer">
        <img src="<?php echo "../upload/" . $user->getImage() ?>" width="30px" alt="Avatar" class="avatar">
    </div>

    <?php
    echo "<br><br>";
    echo 'Full Name: ' . $user->getFullName();
    echo "<br><br>";
    echo 'User Name: ' . $user->getUsername();
    echo "<br><br>";
    echo 'Email: ' . $user->getEmail();
    echo "<br><br>";
    echo 'Phone Number: ' . $user->getPhone();
    echo "<br><br>";
    echo "<input type='hidden' name='ID' value=''>"
    ?>
    <button type="submit" name="btn-logout" class="logbtn">Log out</button>

    <div class="bottom-text">
        <a href="edit.php">Edit your profile</a>
    </div>
</form>

</body>
</html>
