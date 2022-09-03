<?php
require "../controller/BookController.php";
?>

<!DOCTYPE html>
<html lang="en">
 <?php include "../layouts/header.html"; ?>
<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include "../layouts/sidebar.html"; ?>
    <div id="content" class="p-4 p-md-5 pt-5">
        <h3>Book list</h3> <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Publish date</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach(BookController::index() as $book): ?>
                        <tr>
                        <th scope="row"><?php echo $book->get_id();  ?></th>
                        <td><?php echo $book->get_title();  ?></td>
                        <td><?php echo $book->get_author()->get_name() ?></td>
                        <td><?php echo $book->get_category();  ?></td>
                        <td><?php echo $book->get_image();  ?></td>
                        <td><?php echo $book->get_publish_date();  ?></td>
                        </tr>
                <?php  endforeach ?>
                
            </tbody>
        </table>
        
        
    </div>
    </div>
    <?php include "../layouts/scripts.html"; ?>
</body>
</html>
