<?php

include_once '../../config/Database.php';
include_once '../../class/Teacher.php';

$database = new Database();
$db = $database->getConnection();

$teacher = new Teacher($db);

if(!empty($_POST['action']) && $_POST['action'] == 'viewTeacher'){
    $teacher->view();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateTeacher'){
    $teacher->id = $_GET['id'];
    $teacher->class_name = $_POST['class_name'];
    $teacher->class_id = $_POST['class_id'];
    $teacher->update();   
    exit;
}

if(isset($_GET['id']) && $_GET['name'] == 'delTeacher'){
    $teacher->id = $_GET['id'];
    $teacher->delete();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addTeacher'){
    $teacher->name = $_POST['name'];
    $teacher->email = $_POST['email'];
    $teacher->phone = $_POST['phone'];
    $teacher->address = $_POST['address'];
    $teacher->class_id = $_POST['class_id'];
    $teacher->add();
}