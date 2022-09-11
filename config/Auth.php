<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['admin'])){

    header("location: /oop_php/view/index.php");
}