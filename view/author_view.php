<?php
require_once "../controller/AuthorController.php";
// $author = new Author();
// if(isset($_POST['name']) && isset($_POST['date']))
//   AuthorController::create($author->construct($_POST['name'],$_POST['date']));
?>
<!DOCTYPE html>
<html lang="en">
 <?php include "../layouts/header.html"; ?>
<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include "../layouts/sidebar.html"; ?>
    <div id="content" class="p-4 p-md-5 pt-5">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Birth date</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach(AuthorController::index() as $author): ?>
                        <tr>
                        <th scope="row"><?php echo $author->get_id();  ?></th>
                        <td><?php echo $author->get_name();  ?></td>
                        <td><?php echo $author->get_birth();  ?></td>
                        </tr>
                <?php  endforeach ?>
                
            </tbody>
        </table>
        
        
    </div>
    </div>
    <?php include "../layouts/scripts.html"; ?>
</body>
</html>




<!-- <form action="#" method="POST">
    <input type="text" name="name" id="">
    <input type="date" name="date" id="">
    <input type="submit" value="insert">
</form> -->



