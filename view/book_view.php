<?php
require "../controller/BookController.php";
require_once "../controller/AuthorController.php";
require_once "../controller/CategoryController.php";

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
                <thead style="background-color: lightslategray; color:whitesmoke">
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
                            <td><a name="" id="" class="btn btn-warning btn-sm" href="#" role="button">Edit</a> <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button" >Delete</a></td>
                            </tr>
                    <?php  endforeach ?>
                    
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
        <form action="" method="POST">
        <div class="modal-body">
            <h5 style="color: lightcoral;" id="delete_message"></h5>
            <div class="form-group">
                <input type="text" name="id" hidden id="auth-id">
                <input type="text" name="action" hidden id="auth-action">
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
                <!-- <input type="date" name="author" class="form-control" id="book-author" style="border: .5px solid lightgray ;"> -->
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
                <input type="date" name="image" class="form-control" id="book-publish" style="border: .5px solid lightgray ;">
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
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var action = button.data('action')
            var name = button.data('name') 
            var id = button.data('id');
            var birth = button.data('birth');
            var death = button.data('death');
            var modal = $(this)
            if(action === 'delete'){
                modal.find('#auth-name').hide();
                modal.find('#auth-birth').hide();
                modal.find('#auth-death').hide();
                modal.find('.auth-label').hide();
                modal.find('#delete_message').text("Are you sure you want to delete Author : "+name+" ?");
                modal.find('.modal-title').text('Deleting Author');
                modal.find('#auth-id').val(id)
                modal.find('#auth-action').val(action)
            }
            else{
                if(action === 'add'){
                    modal.find("#exampleModalLabel").text("Adding new author");
                    modal.find('#delete_message').text('');
                    modal.find('#auth-name').show();
                    modal.find('#auth-birth').show();
                    modal.find('#auth-death').show();
                    modal.find('.auth-label').show();
                    modal.find('.auth-label').text("Author Name:");
                    modal.find('#auth-name').val(name)
                    modal.find('#auth-id').val(id);
                    modal.find('#auth-action').val(action)
                }
                else{
                    modal.find("#exampleModalLabel").text("Edit author");
                    modal.find('#delete_message').text('');
                    modal.find('#auth-name').show();
                    modal.find('#auth-birth').show();
                    modal.find('#auth-death').show();
                    modal.find('.auth-label').show();
                    modal.find('.auth-label').text("Author Name:");
                    modal.find('#auth-name').val(name)
                    modal.find('#auth-id').val(id);
                    var dt = birth.split('-');
                    var date = dt[2].substr(0,2) +"/"+ dt[1] +"/"+ dt[0];
                    alert(date)
                    modal.find('#auth-birth').val(date);
                    modal.find('#auth-death').val(death)
                    modal.find('#auth-action').val(action)
                }
            }
        })

});  
</script>
<style>
    .tooltip-inner {
  background-color: #00acd6 !important;
  /*!important is not necessary if you place custom.css at the end of your css calls. For the purpose of this demo, it seems to be required in SO snippet*/
  color: #fff;
}


.tooltip.left .tooltip-arrow {
  border-left-color: #00acd6;
}
</style>
<?php include "../layouts/scripts.html"; ?>
</body>
</html>
