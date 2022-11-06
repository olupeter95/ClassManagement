<?php

class GroupCat
{
    private $table = 'class_category';
    private $conn;
    public $id;
    public $category_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add()
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (`category_name`) VALUES(?)");
        $this->category_name = ucwords(htmlspecialchars(strip_tags($this->category_name)));
        $stmt->bind_param('s', $this->category_name);
        if($stmt->execute()){
            $response = [
                'success' => true,
                'message' => 'New Teacher Added',
            ]; 
            echo json_encode($response);
        }
        
    }

    public function view()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if($result->num_rows > 0){
            while($rows = $result->fetch_assoc()){
                $data[] = $rows;
            }
        }
        echo json_encode($data);
    }

    public function update()
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET `category_name` = ? WHERE id = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category_name = ucwords(htmlspecialchars(strip_tags($this->category_name)));
        $stmt->bind_param('si', $this->category_name, $this->id);
        if($stmt->execute()){
            header("location: ../class_category.php?message=updated successfully");
        }
    }

    public function delete()
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('i', $this->id);
        if($stmt->execute()){
            header("location: ../class_category.php?message=deleted successfully");
        }
    }
}