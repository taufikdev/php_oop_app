<?php
include_once "../config/Db.php";
require_once "../config/Model.php";

class Author {

    private $id;
    private $name;
    private $birth;
    private $death;

    public function __construct(){}

    public function construct($id,$name,$birth){
        
        $this->id = $id;
        $this->name = $name;
        $this->birth = $birth;
        return $this;
    }

    function get_id(){return $this->id;}
    function set_id($id){$this->id = $id;}

    function get_name(){return $this->name;}
    function set_name($name){$this->name = $name;}
    
    function get_birth(){return $this->birth;}
    function set_birth($birth){$this->birth = $birth;}

    function all(){
        $conn = new Db();
        $sql = "SELECT * FROM author";
        $stmt = $conn->connect()->query($sql);
        $stmt->execute();
        $authors = [];

        while($row = $stmt->fetch()){
            $auth =  new Author(); 
            array_push($authors,$auth->construct($row['id'],$row['name'],$row['birth']));
        }
    
        return $authors;
    }
    

    public function find($id){
        $conn = new Db();
        $sql = "SELECT * FROM author WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
        $authors = $stmt->fetch();
        $this->set_id($authors['id']);
        $this->set_name($authors['name']);
        $this->set_birth($authors['birth']);
        return $this;
    }

    public function add($author){
        $conn = new Db();
        $sql = "INSERT INTO author(name, birth, death) VALUES(?, ?, NULL)";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$author->name,$author->birth]);
        echo "inserted";
    }

    public function delete($id){
        $conn = new Db();
        $sql = "DELETE FROM author WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
        echo "Deleted";
    }

    public function update($author){
        $conn = new Db();
        $sql = "UPDATE author set name= ?, birth = ? where id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$author->name, $author->birth,$author->id]);
        echo "updated";
    }
    // public function update($name,$birth,$id){
    //     $conn = new Db();
    //     $sql = "UPDATE author set name= ?, birth = ? where id = ?";
    //     $stmt = $conn->connect()->prepare($sql);
    //     $stmt->execute([$name, $birth,$id]);
    //     echo "updated";
    // }

    public function __toString(){
        return empty($this->death)?"[ Author : {$this->name}, Born in {$this->birth->format('Y-m-d H:i:s')} ]": "[ Author : {$this->name}, Born in {$this->birth}, died in {$this->death} ]";
    }

}

?>