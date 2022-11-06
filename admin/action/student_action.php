<?php

include_once '../../config/Database.php';
include_once '../../class/Student.php';

$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

if(!empty($_POST['action']) && $_POST['action'] == 'viewStudent'){
    $student->class_id = $_POST['class_id'];
    $student->view();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateStudent'){
    $student->id = $_GET['id'];
    $student->name = $_POST['name'];
    $student->email = $_POST['email'];
    $student->phone = $_POST['phone'];
    $student->guardian_name = $_POST['guardian_name'];
    $student->address = $_POST['address'];
    $student->class_id = $_POST['class_id'];
    $student->teacher_id = $_POST['teacher_id'];
    $student->update();
    exit;
}

if(isset($_GET['id']) && $_GET['name'] == 'delStudent'){
    $student->id = $_GET['id'];
    $student->class_id = $_GET['class_id'];
    $student->delete();
}

if(isset($_POST['addStudent'])){
    $student->name = $_POST['name'];
    $student->email = $_POST['email'];
    $student->phone = $_POST['phone'];
    $student->guardian_name = $_POST['guardian_name'];
    $student->address = $_POST['address'];
    $student->class_id = $_POST['class_id'];
    $student->teacher_id = $_POST['teacher_id'];
    $student->profile_photo = $_FILES["profile_photo"];
    $student->add();
}

