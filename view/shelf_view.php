<?php
require_once "../controller/ShelfController.php";
?>

<!DOCTYPE html>
<html lang="en">
 <?php include "../layouts/header.html"; ?>
<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include "../layouts/sidebar.html"; ?>
    <div id="content" class="p-4 p-md-5 pt-5">
        <h3>Shelves list</h3> <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Reference</th>
                <th scope="col">Books</th>
                <th scope="col">Max capacity</th>
                <th scope="col">Number of books</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach(ShelfController::index() as $shelf): ?>
                        <tr>
                        <th scope="row"><?php echo htmlentities($shelf->get_id());  ?></th>
                        <td><?php echo $shelf->get_reference();  ?></td>
                        <td><?php echo $shelf->get_books() ?></td>
                        <td><?php echo $shelf->get_max_capacity();  ?></td>
                        <td><?php echo $shelf->get_number_of_books();  ?></td>
                        <td><a name="" id="" class="btn btn-warning btn-sm" href="#" role="button">Edit</a> <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button">Delete</a></td>
                        </tr>
                <?php  endforeach ?>
                
            </tbody>
        </table>
        
        
    </div>
    </div>
    <?php include "../layouts/scripts.html"; ?>
</body>
</html>
