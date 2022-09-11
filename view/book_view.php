<?php
require "../config/Auth.php";
require "../controller/BookController.php";
require_once "../controller/AuthorController.php";
require_once "../controller/CategoryController.php";
if(isset($_POST['action'])){

    if(isset($_POST['title']) && $_POST['action'] === 'add')
        BookController::create($_POST);
    if(isset($_POST['title']) && isset($_POST['publish']) && $_POST['action'] === 'edit')
        BookController::update($_POST);
    if($_POST['action'] === 'delete')
        BookController::delete($_POST['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../layouts/header.html"; ?>
<body>
    <div class="wrapper d-flex align-items-stretch">
    <?php include "../layouts/sidebar.html"; ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="d-flex justify-content-between">
                <div><h3>List of Books:</h3></div>  
                <div> <a class="btn btn-info btn-sm" href="" role="button" data-toggle="modal" data-target="#exampleModal" data-action="add">Add Book</a></div>
            </div><br>
            <div class="table-responsive card" style="border-radius: 1em;">
            <table class="table table-striped table-hover">
                <thead style="background-color: #32373D; color:whitesmoke">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Publish date</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach(BookController::index() as $book): ?>
                            <tr>
                                <th scope="row"><?php echo $book->get_id();  ?></th>
                                <td><?php echo $book->get_title();  ?></td>
                                <td><span style="background-color: rgba(31, 255, 96, 0.22); padding: .5em;border-radius: .6em;" data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Date of Birth:'.date_create($book->get_author()->get_birth())->format('Y-m-d'); ?>"> <?php echo $book->get_author()->get_name(); ?></span></td>
                                <td><?php echo $book->get_category()->get_name();  ?></td>
                                <td><img src="../images/<?php echo $book->get_image();  ?>" alt="img" width="50px"></td>
                                <td><?php echo date_create($book->get_publish_date())->format('Y-m-d');  ?></td>
                                <td>
                                    <a name="" id="" class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-action="edit" data-id="<?php echo $book->get_id();?>" data-title="<?php echo $book->get_title();?>" data-author="<?php echo $book->get_author()->get_id();?>" data-category="<?php echo $book->get_category()->get_id();?>" data-publish="<?php echo $book->get_publish_date();?>">Edit</a> 
                                    <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-action="delete" data-id="<?php echo $book->get_id();?>" data-title="<?php echo $book->get_title();?>">Delete</a>
                                </td>
                            </tr>
                    <?php endforeach ?>
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
<!-- -------------------------------------------modal------------------------------------------------------------ -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Insert data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <h5 style="color: lightcoral;" id="delete_message"></h5>
            <div class="form-group">
                <input type="text" name="id" hidden id="book-id">
                <input type="text" name="action" hidden id="book-action">
                <label for="book-title" class="book-label" class="col-form-label">Title:</label>
                <input type="text" name="title" class="form-control" id="book-title" style="border: .5px solid lightgray ;">
            </div>
            <div class="form-group">
                <label for="book-author" class="book-label" class="col-form-label">Author: </label>
                <select name="author" id="book-author" class="form-control" style="border: .5px solid lightgray ;">
                    <?php foreach(AuthorController::index() as $author): ?>
                        <option value="<?php echo $author->get_id();?>"><?php echo $author->get_name();?></option>
                        <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="book-category" class="book-label" class="col-form-label">Category:</label>
                <select name="category" id="book-category" class="form-control" style="border: .5px solid lightgray ;">
                <?php foreach(CategoryController::index() as $category): ?>
                    <option value="<?php echo $category->get_id();?>"><?php echo $category->get_name();?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="book-image" class="book-label" class="col-form-label">Image:</label>
                <input type="file" name="image" class="form-control" id="book-image" style="border: .5px solid lightgray ;">
            </div>
            <div class="form-group">
                <label for="book-publish" class="book-label" class="col-form-label">Published :</label>
                <input type="date" name="publish" class="form-control" id="book-publish" style="border: .5px solid lightgray ;">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit">Confirm</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- -------------------------------------------modal script------------------------------------------------------------ -->
<script>
$(document).ready(function(){

        $(function () {$('[data-toggle="tooltip"]').tooltip() })

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var action = button.data('action')
            var id = button.data('id');
            var title = button.data('title') 
            var author = button.data('author');
            var category = button.data('category');
            var publish = button.data('publish');
            var modal = $(this)
            if(action === 'delete'){
                modal.find('#book-title').hide();
                modal.find('#book-author').hide();
                modal.find('#book-category').hide();
                modal.find('#book-image').hide();
                modal.find('#book-publish').hide();
                modal.find('.book-label').hide();
                modal.find('#delete_message').text("Are you sure you want to delete Book : "+title+" ?");
                modal.find('.modal-title').text('Deleting Book');
                modal.find('#book-id').val(id)
                modal.find('#book-action').val(action)
            }
            else{
                if(action === 'add'){
                    modal.find("#exampleModalLabel").text("Adding new Book");
                    modal.find('#delete_message').text('');
                    modal.find('#book-title').show();
                    modal.find('#book-author').show();
                    modal.find('#book-category').show();
                    modal.find('#book-image').show();
                    modal.find('#book-publish').show();
                    modal.find('.book-label').show();
                    modal.find('#book-title').val("")
                    modal.find('#book-action').val(action)
                }
                else if(action === 'edit') {
                    modal.find("#exampleModalLabel").text("Edit book");
                    modal.find('#delete_message').text('');
                    modal.find('#book-title').show();
                    modal.find('#book-author').show();
                    modal.find('#book-category').show();
                    modal.find('#book-image').show();
                    modal.find('#book-publish').show();
                    modal.find('.book-label').show();
                    modal.find('#book-id').val(id);
                    modal.find('#book-title').val(title)
                    modal.find('#book-author').val(author);
                    modal.find('#book-category').val(category);
                    var dt = publish.split('-');
                    var date = dt[2].substr(0,2) +"/"+ dt[1] +"/"+ dt[0];
                    modal.find('#book-publish').val(date);
                    modal.find('#book-action').val(action)
                }
            }
        })

});  
</script>
<style>
.tooltip-inner {
    background-color: #00acd6 !important;
    color: #fff;
}
.tooltip.left .tooltip-arrow {
    border-left-color: #00acd6;
}
</style>
<?php include "../layouts/scripts.html"; ?>
</body>
</html>
