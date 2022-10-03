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
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (`name`, `email`, `phone`, `address`, 
        `class_id`) VALUES(?,?,?,?,?)");
        $this->name = ucwords(htmlspecialchars(strip_tags($this->name)));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = ucwords(htmlspecialchars(strip_tags($this->address)));
        $this->class_id = htmlspecialchars(strip_tags($this->class_id));
        $stmt->bind_param('ssssi', $this->name, $this->email, $this->phone, $this->address, $this->class_id);
        if($stmt->execute()){
            $response = [
                'success' => true,
                'message' => 'New Teacher Added Successfully',
            ];
            echo json_encode($response);
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}