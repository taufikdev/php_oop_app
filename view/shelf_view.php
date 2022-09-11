<?php
require "../config/Auth.php";

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
       
        <?php foreach(ShelfController::index() as $shelf): ?>
            <div class="card rounded mb-4">

                <div class="card-header">
                  <h4>  Shelf : <?php echo $shelf->get_reference(); ?></h4>
                </div>
                <div class="card-body">
                        <div class="row gy-4" style="margin-left: 5em;">
                            <?php foreach($shelf->get_books() as $book): ?>
                                <img src="../images/<?php echo $book->get_image(); ?>" data-tilt width="140px" height="180px" alt="" style="border-radius: .3em; margin-left: -3em ;"> 
                            <?php endforeach ?>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div class="left">
                            <?php echo $shelf->get_max_capacity();  ?> --- <?php echo $shelf->get_number_of_books();  ?>
                        </div>
                        <div class="right">
                            <a name="" id="" class="btn btn-warning btn-sm" href="#" role="button">Edit</a>
                            <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php  endforeach ?>
    </div>
    </div>
    <?php include "../layouts/scripts.html"; ?>
    <script src="../node_modules/tilt.js/dest/tilt.jquery.js"></script>
</body>
</html>
