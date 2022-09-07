<?php 
include_once "../config/Db.php";
include_once "../config/Model.php";
include_once "../controller/AuthorController.php";
include_once "../controller/CategoryController.php";
include_once "Author.php";
class Book{

    private $id;
    private $title;
    private $author;
    private $category;
    private $image;
    private $publish_date;

    public function __construct(){}

    public function construct($id,$title,$author,$category,$image = "",$publish_date)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->image = $image;
        $this->publish_date = $publish_date;
        return $this;
    }
    public function construct_for_insert($title,$author,$category,$image = "",$publish_date)
    {
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->image = $image;
        $this->publish_date = $publish_date;
        return $this;
    }

    public function get_id(){return $this->id;}
    public function set_id($id){$this->id = $id;}


    public function get_title(){return $this->title;}
    public function set_title($title){$this->title = $title;}

    public function get_author(){return $this->author;}
    public function set_author($author){$this->author = $author;}
    
    public function get_category(){return $this->category;}
    public function set_category($category){$this->category = $category;}

    public function get_image(){return $this->image;}
    public function set_image($image){$this->image =$image;}

    public function get_publish_date(){return $this->publish_date;}
    public function set_publish_date($publish_date){$this->publish_date = $publish_date;}


    public function all()
    {
        $conn = new Db();
        $sql = "SELECT * FROM book";
        $stmt = $conn->connect()->query($sql);
        $stmt->execute();
        $books = [];
        while($row = $stmt->fetch()){
            $book =  new Book(); 
            array_push($books,$book->construct($row['id'],$row['title'],AuthorController::show($row['author_id']),CategoryController::show($row['category_id']),$row["image"],$row['publish_date']));
            
        } 
        return $books;
    }

    public function find($id)
    {
        $conn = new Db();
        $sql = "SELECT * FROM book WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
        $book = $stmt->fetch();
        $this->set_id($book['id']);
        $this->set_title($book['title']);
        $this->set_author(AuthorController::show($book['author_id']));
        $this->set_category(CategoryController::show($book['category_id']));
        $this->set_image($book['image']);
        $this->set_publish_date($book['publish_date']);
        return $this;
    }

    public function add($book)
    {   
        $conn = new Db();
        $sql = "INSERT INTO book(title, author_id, category_id, image, publish_date) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$book->title,$book->author->get_id(),$book->category->get_id(), $book->image,$book->publish_date]);
    }

    public function delete($id)
    {
        $conn = new Db();
        $sql = "DELETE FROM book WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    public function update($book)
    {
        $conn = new Db();
        $sql = "UPDATE book set title = ?, author_id = ?, category_id = ?, image = ?, publish_date = ? WHERE id = ?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute([$book->title,$book->author->get_id(),$book->category->get_id(), $book->image,$book->publish_date,$book->id]);
    }


    public function __toString()
    {
        return "[ID: {$this->id}, Title: {$this->title}, Author: ({$this->author}), Category: {$this->category}, Publish date: {$this->publish_date->format('Y-m-d H:i:s')}]"; 
    }
}

?>