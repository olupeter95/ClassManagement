<?php

class Group
{
    private $table = 'class';
    private $conn;
    public $id;
    public $category_id; 
    public $class_name;
    public $category_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function view()
    {
        $stmt = $this->conn->prepare("SELECT {$this->table}.id as id, class_name, category_name  
        FROM class INNER JOIN class_category ON  {$this->table}.category_id = class_category.id");
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
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} ( `category_id`, `class_name`)
        VALUES(?,?)");
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->class_name = ucwords(htmlspecialchars(strip_tags($this->class_name)));
        $stmt->bind_param('is', $this->category_id, $this->class_name);
        if($stmt->execute()){
            $response = [
                'success' => true,
                'message' => 'New Class Added Successfully',
            ];
            echo json_encode($response);
        }
    }

    public function update()
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET `category_id` = ?, `class_name` = ? 
        WHERE id = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->class_name = ucwords(htmlspecialchars(strip_tags($this->class_name)));
        $stmt->bind_param('isi', $this->category_id, $this->class_name, $this->id);
        if($stmt->execute()){
            $response = [
                'success' => true,
                'message' => 'Class Updated Successfully',
            ];
            echo json_encode($response);
        }
    }

    public function delete()
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('i', $this->id);
        if($stmt->execute()){
            header("location: ../class.php?message=deleted successfully");
        }
    }
}