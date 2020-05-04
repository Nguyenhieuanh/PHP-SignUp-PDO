<?php
include_once "../database/DBConnect.php";
include_once "../Classes/UserDB.php";
include_once "../Classes/User.php";
include_once "../Classes/UserRegister.php";
include_once "../function/function.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new DBConnect();
    $conn = $db->connect();
    if (isset($_REQUEST['btn-submit'])) {
        $fullName = $_REQUEST['fullName'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $password = ($_REQUEST['password']);
        $re_password = ($_REQUEST['re-psw']);

        $isError = false;

        $fullNameErr = $usernameErr = $emailErr = $phoneErr = $passwordErr = '';

        if (!checkName($fullName)) {
            $fullNameErr = 'Wrong format';
            $isError = true;
        }

        if (!checkUserName($username)) {
            $usernameErr = 'Username from 8 - 20 characters not include special characters';
            $isError = true;
        }

        if (!checkEmail($email)) {
            $emailErr = 'Email is required john.smith@example.com';
            $isError = true;
        }

        if (!checkPhone($phone)) {
            $phoneErr = 'Your phone number is not from Viettel, Vinaphone or Mobiphone';
            $isError = true;
        }

        if (!checkPassword($password)) {
            $passwordErr = 'The password uses 8 or more characters and combines letters, numbers and symbols';
            $isError = true;
        }

        if ($isError == false) {
            $sql = "SELECT username FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $user_check = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user_check) {
                $msg = "* Username already exists *";
            } else {
                $userRegister = new UserRegister();
                $md5 = md5($password);
                $user = new User($fullName, $username, $email, $phone, $md5);
                $userRegister->addNewUser($user);
                header("Location: ../");
            }
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Register</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<form method="post" class="login-form" style="width: 600px; height: 800px">
    <span onclick="location.href='../index.php'" class="close">&times;</span>
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <div class="txtb">
        <input type="text" placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo $fullNameErr;
        } ?>" value="<?php if (isset($_REQUEST['btn-submit']) && checkName($fullName)) {
            echo $fullName;
        } ?>" id="fullNameId" name="fullName" required>
        <span data-placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo '';
        } else echo "Full Name" ?>"></span>
    </div>

    <div class="txtb">
        <input type="text" name="username" placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo "$usernameErr" ;
        } elseif (isset($msg)) {
            echo $msg;
        }
        ?>" id="usernameId"
               value="<?php if (isset($_REQUEST['btn-submit']) && checkUserName($username)) {
                   echo $username;
               } ?>" required>
        <span data-placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo '';
        } else echo "User Name" ?>"></span>
    </div>

    <div class="txtb">
        <input type="text" id="emailId" placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo $emailErr;
        } ?>" name="email" value="<?php if (isset($_REQUEST['btn-submit']) && checkEmail($email)) {
            echo $email;
        } ?>" required>
        <span data-placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo '';
        } else echo "Email" ?>"></span>
    </div>

    <div class="txtb">
        <input type="text" class="form-control" placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo $phoneErr;
        } ?>" id="phoneId" name="phone"
               value="<?php if (isset($_REQUEST['btn-submit']) && checkPhone($phone)) {
                   echo $phone;
               } ?>" required>
        <span data-placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo '';
        } else echo "Phone Number" ?>"></span>
    </div>

    <div class="txtb">
        <input type="password" name="password" placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo $passwordErr;
        } ?>" id="passwordId" required>
        <span data-placeholder="<?php if (isset($_REQUEST['btn-submit'])) {
            echo '';
        } else echo "Password" ?>"></span>
    </div>

    <div class="txtb">
        <input type="password" id="psw-repeat"
               placeholder="<?php if (isset($_REQUEST['btn-submit']) && $password !== $re_password) {
                   echo "Password mismatch!";
               } ?>" name="re-psw" required>
        <span data-placeholder="<?php if (isset($_REQUEST['btn-submit']) && $password !== $re_password) {
            echo "";
        } else echo "Re-password"; ?>"></span>

    </div>

    <label>
        <input type="checkbox" required>
        <span>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</span>
    </label>

    <br>
    <br>
    <button type="submit" name="btn-submit" class="logbtn">Register</button>
</form>
</body>
</html>
