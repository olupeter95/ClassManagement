<?php

include_once '../../config/Database.php';
include_once '../../class/Group.php';

$database = new Database();
$db = $database->getConnection();

$group = new Group($db);

if(!empty($_POST['action']) && $_POST['action'] == 'viewClass'){
    $group->view();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateClass'){
    $group->id = $_GET['id'];
    $group->class_name = $_POST['class_name'];
    $group->category_id = $_POST['category_id'];
    $group->update();   
    exit;
}

if(isset($_GET['id']) && $_GET['name'] == 'delClass'){
    $group->id = $_GET['id'];
    $group->delete();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addClass'){
    $group->class_name = $_POST['class_name'];
    $group->category_id = $_POST['category_id'];
    $group->add();
}