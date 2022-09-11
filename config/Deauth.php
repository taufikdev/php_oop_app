<?php

session_start();

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['admin']);
    header("location: /oop_php/view/index.php");
}