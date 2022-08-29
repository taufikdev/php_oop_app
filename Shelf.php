<?php

class Shelf {

    private $id;
    private $books;
    const MAX_CAPACITY = 20;
    private $number_of_books;

    function __construct($id,$books)
    {
        $this->id = $id;
        $this->books =  array();
        $this->books =  $books;
    }

    public function get_id(){return $this->id;}

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


    public function add_book($book){
        array_push($this->books,$book);
    }


    public function search_book($book){
        return $this->books[array_search($book,$this->books, true)];
    }

    public function remove_book($book,$strict = TRUE){
        if (($key = array_search($book,$this->books, $strict)) !== FALSE) {
            unset($array[$key]);
            return $this->books;
        }
        return null;
    }

    public function __toString()
    {
        $describe = "{Id : {$this->get_id()}, number of book in the shelf: {$this->get_number_of_books()} <br>[";

        foreach($this->books as $book){
           
            $describe .= "".$book." ] <br> ";
        }

        return  $describe;
    }

}


?>