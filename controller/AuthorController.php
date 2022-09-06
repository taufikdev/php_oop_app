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

    static function create($req)
    {
        $authors = new Author();
        $authors->add($authors->construct_for_insert($req['name'],$req['birth'],$req['death']));
        header("location: author_view.php");

    }

    static function update($req){
        $author = new Author();
        $author->update($author->construct($req['id'],$req['name'],$req['birth'],$req['death']));
        header("location: author_view.php");
    }

    static function delete($id)
    {
        $authors = new Author();
        $authors->delete($id);
        header("location: author_view.php");
    }
}
