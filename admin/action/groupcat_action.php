<?php

include_once '../../config/Database.php';
include_once '../../class/GroupCat.php';

$database = new Database();
$db = $database->getConnection();

$groupcat = new GroupCat($db);

if(!empty($_POST['action']) && $_POST['action'] == 'viewCat'){
    $groupcat->view();
}

if(isset($_POST['update'])){
    $groupcat->id = $_POST['id'];
    $groupcat->category_name = $_POST['category_name'];
    $groupcat->update();   
}

if(isset($_GET['id']) && $_GET['name'] == 'delCat'){
    $groupcat->id = $_GET['id'];
    $groupcat->delete();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addCat'){
    $groupcat->category_name = $_POST['category_name'];
    $groupcat->add();
}