<?php 

include_once './Author';
include_once './Book.php';
include_once './Category.php';
include_once './Shelf.php';
include_once './Db.php';

$connection = new DB;
$connection->connect();


$category1 = new Category(1,"Fiction");
$category2 = new Category(1,"Classic");

$author1 = new Author(1,"Leo Tolstoy", new DateTime('11.4.1887'));
$author2 = new Author(2,"Paolo Cohelo", new DateTime('11.4.1957'));

$book1 = new Book(1,"War and peace",$author1,$category2,"",new DateTime('23.6.1900'));
$book2 = new Book(2,"The alchemist",$author2,$category1,"",new DateTime('23.6.1970'));


$shelf = new Shelf(11,"A1",array($book1,$book2));


echo $shelf;









?>
