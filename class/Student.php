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
        $this->name = ucwords(htmlspecialchars(strip_tags($this->name)));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->guardian_name = ucwords(htmlspecialchars(strip_tags($this->guardian_name)));
        $this->address = ucwords(htmlspecialchars(strip_tags($this->address)));
        $this->class_id = htmlspecialchars(strip_tags($this->class_id));
        $this->teacher_id = htmlspecialchars(strip_tags($this->teacher_id));
        if(!empty($this->profile_photo)){
            $target_dir = "/uploads/students/profile_photo";
            $target_file = $target_dir . basename($this->profile_photo["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($this->profile_photo["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($this->profile_photo["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG & PNG files are allowed.";
                $uploadOk = 0;
            }
       
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($this->profile_photo["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $this->profile_photo["name"])). " has been uploaded.";
                } else {
                echo "Sorry, there was an error uploading your file.";
                }
                $stmt = $this->conn->prepare("INSERT INTO {$this->table} (`name`, `phone`, `email`, `guardian_name`,
                `address`, `class_id`, `teacher_id`, `profile_photo`) VALUES(?,?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssiis", $this->name, $this->phone, $this->email, $this->address,
                $this->guardian_name, $this->class_id, $this->teacher_id, $this->profile_photo["name"]);
                if($stmt->execute()){
                    header("location: student.php?id= echo {$this->class_id}&message=student added with profile image");
                }
            }

        }else{
                $stmt = $this->conn->prepare("INSERT INTO {$this->table} (`name`, `phone`, `email`, `guardian_name`,
                `address`, `class_id`, `teacher_id`) VALUES(?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssii", $this->name, $this->phone, $this->email, $this->address,
                $this->class_id, $this->teacher_id);
                if($stmt->execute()){
                    header("location: student.php?id=.'{$this->class_id}'.&message=student added without profile image");
                }
        }
    }

    public function update()
    {
        
    }

    public function delete()
    {

    }
}