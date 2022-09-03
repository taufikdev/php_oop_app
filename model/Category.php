<?php
include_once "../config/Db.php";

class Category {

    private $id;
    private $name;

    public function __construct()
    {
    
    }

    public function construct($id,$name)
    {
        $this->id =$id;
        $this->name = $name;
        return $this;
    }

    public function get_id(){return $this->id;}
    public function set_id($id){$this->id = $id;}


    public function get_name(){return $this->name;} 
    public function set_name($name){$this->name = $name;} 

    public function all(){
        $conn = new Db();
        $sql = "SELECT * FROM category";
        $stmt = $conn->connect()->query($sql);
        $stmt->execute();
        $categories = [];

        while($row = $stmt->fetch()){
            $cat =  new Category(); 
            array_push($categories,$cat->construct($row['id'],$row['name']));
        }
    
        return $categories;
    }
    

    public function find($id){
        $conn = new Db();
        $sql = "SELECT * FROM category WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
        $category = $stmt->fetch();
        $this->set_id($category['id']);
        $this->set_name($category['name']);
        return $this;
    }

    public function add($category){
        $conn = new Db();
        $sql = "INSERT INTO category(name) VALUES(?)";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$category->name]);
        echo "inserted";
    }

    public function delete($id){
        $conn = new Db();
        $sql = "DELETE FROM category WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
        echo "Deleted";
    }

    public function update($category){
        $conn = new Db();
        $sql = "UPDATE category set name= ? where id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$category->name,$category->id]);
        echo "updated";
    }


    public function __toString()
    {
        return "[Category --> ID: {$this->id}, Name: {$this->name} ";
    }

}
?>