<?php
include_once "../config/Db.php";
include_once "../controller/BookController.php";
class Shelf {

    private $id;
    private $reference;
    private $books;
    const MAX_CAPACITY = 20;
    private $number_of_books;

    function __construct()
    {

    }

    function construct($id,$reference ,$books)
    {
        $this->id = $id;
        $this->reference = $reference;
        $this->books =  array();
        $this->books =  $books;
        return $this;
    }

    public function get_id(){return $this->id;}


    public function get_reference(){return $this->reference;}
    public function set_reference($reference){$this->reference = $reference;}

    function get_books(){
        return $this->books;
    }

    function set_books($books){
        $this->books = $books;
    }

    public static function get_max_capacity(){
        return self::MAX_CAPACITY;
    }

    function get_number_of_books(){
        return count($this->books);
    }


    // public function add_book($book){
    //     array_push($this->books,$book);
    // }


    // public function search_book($book){
    //     return $this->books[array_search($book,$this->books, true)];
    // }

    // public function remove_book($book,$strict = TRUE){
    //     if (($key = array_search($book,$this->books, $strict)) !== FALSE) {
    //         unset($array[$key]);
    //         return $this->books;
    //     }
    //     return null;
    // }

    public function all()
    {
        $conn = new Db();
        $sql = "SELECT * FROM shelf";
        $stmt = $conn->connect()->query($sql);
        $stmt->execute();
        $shelves = [];
        while($row = $stmt->fetch()){
            $shelf =  new Shelf(); 
            array_push($shelves,$shelf->construct($row['id'],$row['reference'],BookController::index()));
            
        }
        return $shelves;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function add($obj)
    {
        // TODO: Implement add() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($obj)
    {
        // TODO: Implement update() method.
    }

    public function __toString()
    {
        $describe = "{Id : {$this->get_id()},Ref: {$this->reference}, number of book in the shelf: {$this->get_number_of_books()} <br>[";
        foreach($this->books as $book){
            $describe .= "".$book." ] <br> ";
        }
        return  $describe;
    }

}


?>