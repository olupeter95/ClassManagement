<?php

class Teacher
{
    private $table = 'teacher';
    private $conn;
    public $id;
    public $class_id;
    public $name;
    public $email;
    public $phone;
    public $address;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function view()
    {
        $stmt = $this->conn->prepare("SELECT {$this->table}.`id` as `id`, `name`,
        `email`, `phone`, `address`, `class_name` FROM  {$this->table} INNER JOIN class 
        ON {$this->table}.`class_id` = `class`.`id`");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if($stmt->execute()){
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