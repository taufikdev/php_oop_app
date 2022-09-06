<?php
include_once "../config/Db.php";
require_once "../config/Model.php";

class Author {

    private $id;
    private $name;
    private $birth;
    private $death;

    public function __construct(){}

    public function construct($id,$name,$birth,$death){
        
        $this->id = $id;
        $this->name = $name;
        $this->birth = $birth;
        $this->death = $death;
        return $this;
    }
    public function construct_for_insert($name,$birth,$death){
        $this->name = $name;
        $this->birth = $birth;
        $this->death = $death;
        return $this;
    }

    function get_id(){return $this->id;}
    function set_id($id){$this->id = $id;}

    function get_name(){return $this->name;}
    function set_name($name){$this->name = $name;}
    
    function get_birth(){return $this->birth;}
    function set_birth($birth){$this->birth = $birth;}
    
    function get_death(){return $this->death;}
    function set_death($death){$this->death = $death;}

    function all(){
        $conn = new Db();
        $sql = "SELECT * FROM author";
        $stmt = $conn->connect()->query($sql);
        $stmt->execute();
        $authors = [];

        while($row = $stmt->fetch()){
            $auth =  new Author(); 
            array_push($authors,$auth->construct($row['id'],$row['name'],$row['birth'],$row['death']));
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
        $sql = "INSERT INTO author(name, birth, death) VALUES(?, ?, ?)";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$author->name,$author->birth,$author->death]);
    }

    public function delete($id){
        $conn = new Db();
        $sql = "DELETE FROM author WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function update($author){
        $conn = new Db();
        $sql = "UPDATE author set name= ?, birth = ?, death = ? where id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$author->name, $author->birth,$author->death,$author->id]);  
    }
    
    public function __toString(){
        return empty($this->death)?"[ Author : {$this->name}, Born in {$this->birth->format('Y-m-d H:i:s')} ]": "[ Author : {$this->name}, Born in {$this->birth}, died in {$this->death} ]";
    }

}

?>