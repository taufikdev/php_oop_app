<?php
include "../model/Author.php";
include "../config/Controller.php";

class AuthorController implements Controller{

    static function index()
    {
        $authors = new Author();
        return $authors->all();
    }

    static function show($id){
        $authors = new Author();
        return $authors->find($id);
    }

    static function create($author)
    {
        $authors = new Author();
        return $authors->add($author);
    }

    static function update($id){

    }

    static function delete($id)
    {
        $authors = new Author();
        return $authors->delete($id);
    }

}

?>