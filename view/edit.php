<?php
session_start();

include_once "../database/DBConnect.php";
include_once "../Classes/UserDB.php";
include_once "../Classes/User.php";
include_once '../Classes/UserRegister.php';

$userRegister = new UserDB();
$user = $userRegister->showUserData($_SESSION['username']);

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
<form method="post" class="login-form" enctype="multipart/form-data" style="width: 500px; height: 800px"
      action="../action/update.php">
    <span onclick="location.href='profile.php'" class="close">&times;</span>
    <h1>Edit Profile</h1>
    <div class="txtb">
        <input type="text" value="<?php echo $user->getFullName() ?>" id="fullNameId" name="fullName"
               placeholder="Full Name" required>
    </div>

    <div class="txtb">
        <input type="text" name="username" id="usernameId"
               value="<?php echo $user->getUsername() ?>" placeholder="User Name" required>
    </div>

    <div class="txtb">
        <input type="text" id="emailId" name="email"
               value="<?php echo $user->getEmail() ?>" placeholder="Email" required>
    </div>

    <div class="txtb">
        <input type="text" class="form-control" id="phoneId" name="phone"
               value="<?php echo $user->getPhone() ?>" placeholder="Phone Number" required>
    </div>

    <div class="txtb">
        <input type="file" name="image" id="imageId">
    </div>

    <br>
    <br>
    <button type="submit" name="btn-submit" class="logbtn">Submit</button>
</form>
</body>
</html>
