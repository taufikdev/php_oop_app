<?php
require_once "../model/Shelf.php";
require_once "../config/Controller.php";


class ShelfController implements Controller{

    public static function index()
    {
        $shelf = new Shelf();
        return $shelf->all();
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