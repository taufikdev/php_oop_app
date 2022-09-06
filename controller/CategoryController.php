<?php
include "../model/Category.php";

class CategoryController{

    public static function index()
    {
        $category = new Category();
        return $category->all();
    }

    public static function create($req)
    {
        $category = new Category();
        $category->add($req['category']);
        header("location: category_view.php");
    }

    public static function show($id)
    {
        $category = new Category();
        return $category->find($id);
    }

    public static function update($req)
    {
        $category = new Category();
        $category->update($category->construct($req['id'],$req['category']));
        header("location: category_view.php");
    }

    public static function delete($id)
    {
        $category = new Category();
        $category->delete($id);
        header("location: category_view.php");
    }
}
