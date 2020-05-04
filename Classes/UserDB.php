<?php


class UserDB
{
    protected $conn;

    public function __construct()
    {
        $db = new DBConnect();
        $this->conn = $db->connect();
    }

    public function addNewUser($user)
    {
        $sql = "INSERT INTO users(fullName,username,email,phone,password,image) 
                VALUES (:fullName,:username,:email,:phone,:password,:image)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fullName", $user->getFullName());
        $stmt->bindParam(":username", $user->getUserName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":phone", $user->getPhone());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->bindParam(":image", $user->getImage());
        $stmt->execute();
    }

    public function updateUser($user,$user_id)
    {
        $sql = "UPDATE users 
                SET fullName=:fullName,
                    username=:username,
                    email=:email,
                    phone=:phone,
                    image=:image
                WHERE user_id='$user_id';";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fullName", $user->getFullName());
        $stmt->bindParam(":username", $user->getUsername());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":phone", $user->getPhone());
        $stmt->bindParam(":image", $user->getImage());
        $stmt->execute();
    }

    public function userLogin($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username=:username AND password=:password;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            array(
                'username' => $username,
                'password' => $password
            )
        );
        $count = $stmt->rowCount();
        if ($count > 0) {
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    }

    public function getUserId($username)
    {
        $sql = "SELECT user_id FROM users WHERE username = '$username';";
        $stmt = $this->conn->query($sql);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData['user_id'];
    }

    public function showUserData($username)
    {
        $sql = "SELECT * FROM users WHERE username = '$username';";
        $stmt = $this->conn->query($sql);
        $userData = $stmt->fetch();
        return new User(
            $userData['fullName'],
            $userData['username'],
            $userData['email'],
            $userData['phone'],
            $userData['password'],
            $userData['image']
        );
    }
}