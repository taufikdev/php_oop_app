<?php
include_once "../model/Book.php";
include_once "../config/Controller.php";

class BookController implements Controller{


    static function index()
    {
        $books = new Book();
        return $books->all();
    }

    public static function create($obj)
    {
        // TODO: Implement create() method.
    }

    public static function show($id)
    {
        // TODO: Implement show() method.
    }

    public static function update($id)
    {
        // TODO: Implement update() method.
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }
}