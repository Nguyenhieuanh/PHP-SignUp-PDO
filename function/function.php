<?php

function checkName($name)
{
    $pattern = '/^.+$/';
    if (preg_match($pattern, $name)) {
        return true;
    }
    return false;
}

function checkUserName($username)
{
    $pattern = '/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/';
    if (preg_match($pattern, $username)) {
        return true;
    }
    return false;
}

function checkEmail($email)
{
    $pattern = '/^[A-Za-z0-9]+[A-Za-z0-9.]*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)$/';
    if (preg_match($pattern, $email)) {
        return true;
    }
    return false;
}

function checkPhone($phone)
{
    $pattern = '/^0(32|33|34|35|36|37|38|39|96|97|98|86|81|82|83|84|85|88|91|94|70|76|77|78|79|89|90|93)+[0-9]{7}$/';
    if (preg_match($pattern, $phone)) {
        return true;
    }
    return false;
}

function checkPassword($password)
{
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/';
    if (preg_match($pattern, $password)) {
        return true;
    }
    return false;
}