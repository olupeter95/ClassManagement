<?php

include_once 'class/User.php';
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!empty($_POST['action']) && $_POST['action'] == 'login') {
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->loginType = $_POST['loginType'];
    $user->login();
}