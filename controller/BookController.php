<?php
include_once "../model/Book.php";
include_once "../Controller/AuthorController.php";
include_once "../Controller/CategoryController.php";

class BookController{


    static function index()
    {
        $books = new Book();
        return $books->all();
    }

    public static function show($id)
    {
        $book = new Book();
        return $book->find($id);
    }

    public static function create($req)
    {
        $book = new Book();
        $author = AuthorController::show($req['author']);
        $category = CategoryController::show($req['category']);
        $book->add($book->construct_for_insert($req['title'],$author,$category,"",$req['publish']));
        header("location: book_view.php");
    }


    public static function update($req)
    {
        $book = new Book();
        $author = AuthorController::show($req['author']);
        $category = CategoryController::show($req['category']);
        $book->update($book->construct($req['id'],$req['title'],$author,$category,"",$req['publish']));
        header("location: book_view.php");
    }

    public static function delete($id)
    {
        $book = new Book();
        $book->delete($id);
        header("location: book_view.php");
    }
}