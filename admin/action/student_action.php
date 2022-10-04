<?php

include_once '../../config/Database.php';
include_once '../../class/Student.php';

$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

if(!empty($_POST['action']) && $_POST['action'] == 'viewStudent'){
    $student->view();
    exit;
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateStudent'){
    $student->id = $_GET['id'];
    $student->name = $_POST['name'];
    $student->email = $_POST['email'];
    $student->phone = $_POST['phone'];
    $student->address = $_POST['address'];
    $student->class_id = $_POST['class_id'];
    $student->update();   
    exit;
}

if(isset($_GET['id']) && $_GET['name'] == 'delStudent'){
    $student->id = $_GET['id'];
    $student->delete();
    exit;
}

if(!empty($_POST['action']) && $_POST['action'] == 'addStudent'){
    $student->name = $_POST['name'];
    $student->email = $_POST['email'];
    $student->phone = $_POST['phone'];
    $student->address = $_POST['address'];
    $student->class_id = $_POST['class_id'];
    $student->add();
    exit;
}