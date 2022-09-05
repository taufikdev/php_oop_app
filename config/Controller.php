<?php

interface Controller{

    public static function index();

    public static function create($obj);

    public static function show($id);

    public static function update($id);

    public static function delete($id);

}

?>
