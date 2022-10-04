<?php

class Student
{
    private $table = 'student';
    private $conn;
    public $id;
    public $class_id;
    public $teacher_id;
    public $profile_photo;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $guardian_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function view()
    {
        $stmt = $this->conn->prepare("SELECT {$this->table}.`id` as id, {$this->table}.`name` as `sn`,  
        {$this->table}.`email` as `se`, {$this->table}.`phone` as `sp`, {$this->table}.`address` as `sa`, 
        `guardian`, `profile_photo`, `class_name`, `teacher`.`name` as `tn` ((FROM {$this->table} INNER JOIN
        `teacher` ON {$this->table}.`teacher_id` = teacher.id) INNER JOIN `class` ON 
        {$this->table}.`class_id` = `class`.id)");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if($result->num_rows > 0){
            while($rows = $result->fetch_assoc()){
                $data[] = $rows;
            }
            echo json_encode($data);
        }

    }

    public function add()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}