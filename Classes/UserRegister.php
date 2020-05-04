<?php


class UserRegister
{
    protected $userDB;

    public function __construct()
    {
        $this->userDB = new UserDB();
    }

    public function addNewUser($user)
    {
        $this->userDB->addNewUser($user);
    }

    public function userLogin($username,$password)
    {
        return $this->userDB->userLogin($username,$password);
    }

    public function updateUser($id, $user)
    {
        $this->userDB->updateUser($id,$user);
    }

    public function showUserData($username)
    {
        return $this->userDB->showUserData($username);
    }

    public function getUserId($username)
    {
        return $this->userDB->getUserId($username);
    }

}