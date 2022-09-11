<?php

require  "../model/User.php";


class UserController{

    static function index()
    {
        $users = new User();
        return $users->all();
    }

    static function show($email,$password){
        $user = new User();
        return $user->find($email,$password);
    }

    static function create($req)
    {
        $user = new User();
        $user->add($user->construct_for_insert($req['username'],$req['email'],$req['password'],$req['admin']=="1"?"1":"0"));
        header("location: user_view.php");

    }

    static function update($req){
        $user = new User();
        $user->update($user->construct($req['id'],$req['username'],$req['email'],$req['password'],$req['admin']));
        header("location: user_view.php");
    }

    static function delete($id)
    {
        $user = new User();
        $user->delete($id);
        header("location: user_view.php");
    }

}


