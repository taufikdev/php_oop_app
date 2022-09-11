<?php
require "../config/Db.php";


class User{

    private $id;
    private $username;
    private $email;
    private $password;
    private $admin;

    public function __construct(){}

    public function construct($id,$username,$email,$password,$admin){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->admin = $admin;
        return $this;
    }

    public function construct_for_insert($username,$email,$password,$admin){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->admin = $admin;
        return $this;
    }

    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}


    public function getUsername(){return $this->username;}
    public function setUsername($username){$this->username = $username;}

    
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;}


    public function getPassword(){return $this->password;}
    public function setPassword($password){$this->password = $password;}

    public function getAdmin(){return $this->admin;}
    public function setAdmin($admin){$this->admin = $admin;}

    function all(){
        $conn = new Db();
        $sql = "SELECT * FROM user";
        $stmt = $conn->connect()->query($sql);
        $stmt->execute();
        $users = [];

        while($row = $stmt->fetch()){
            $user =  new User(); 
            array_push($users,$user->construct($row['id'],$row['username'],$row['email'],sha1($row['password']),$row['admin']));
        }
        return $users;
    }
    

    public function find($email,$password){
        $conn = new Db();
        $user = new User();
        $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$email,sha1($password)]);
        $row = $stmt->fetch();
        $user->construct($row['id'],$row['username'],$row['email'],$row['password'],$row['admin']);
        return $user;
    }

    public function add($user){
        $conn = new Db();
        $sql = "INSERT INTO user(username, email, password,admin) VALUES(?, ?, ?, ?)";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$user->username,$user->email,sha1($user->password),$user->admin]);
    }

    public function delete($id){
        $conn = new Db();
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function update($user){
        $conn = new Db();
        $sql = "UPDATE user set username= ?, email = ?, password = ?, admin = ? where id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$user->username,$user->email,$user->password,$user->admin,$user->id]);  
    }



}