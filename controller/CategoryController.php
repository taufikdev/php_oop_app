<?php
include "../model/Category.php";
include "../config/Controller.php";


class CategoryController implements Controller{

 static function index()
    {
        $category = new Category();
        return $category->all();
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