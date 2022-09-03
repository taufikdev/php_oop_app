<?php
include_once "./config/Db.php";
class Category extends Db {

    private $id;
    private $name;

    public function __construct($id,$name)
    {
        $this->id =$id;
        $this->name = $name;
    }

    public function get_id(){return $this->id;}

    public function get_name(){return $this->name;} 

    public function set_name($name){$this->name = $name;} 


    public function __toString()
    {
        return "[Category --> ID: {$this->id}, Name: {$this->name} ";
    }

}
?>