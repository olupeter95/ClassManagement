<?php

class User
{
    private $conn;
    private $adminTable = 'admin';
    private $studentTable = 'student';
    private $teacherTable = 'teacher';

    public function __construct($db)
    {
        $this->conn = $db;    
    }

    public function login()
    {
        if($this->email && $this->password){
            $loginTable = '';
            if($this->loginType == 'admin'){
                $loginTable = 'admin';
            }else if($this->loginType == 'student'){
                $loginTable = 'student';
            }else{
                $loginTable = 'teacher';
            }
            $stmt = $this->conn->prepare("SELECT * FROM $loginTable WHERE `email` = ? AND `password` = ?");
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = md5($this->password);
            $stmt->bind_param('ss', $this->email, $this->password);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();
                $_SESSION['userid'] = $user['id'];
                $_SESSION['role'] = $this->loginType;
                $_SESSION['name'] = $user['email'];
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function loggedIn ()
    {
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}

    public function regAdmin()
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->adminTable} (`name`, `email`, `password`)
        VALUES(?,?,?)");
        $this->name = ucwords(htmlspecialchars(strip_tags($this->name)));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = md5($this->password);
        $stmt->bind_param("sss", $this->name, $this->email, $this->password);
        if($stmt->execute()){
            header("location: index.php");
        }
    }
}