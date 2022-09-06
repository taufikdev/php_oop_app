<?php
require_once "../controller/AuthorController.php";
if(isset($_POST['action'])){

    if(isset($_POST['name']) && isset($_POST['birth']) && $_POST['action'] === 'add')
        AuthorController::create($_POST);
    if(isset($_POST['name']) && isset($_POST['birth']) && $_POST['action'] === 'edit')
        AuthorController::update($_POST);
    if($_POST['action'] === 'delete')
        AuthorController::delete($_POST['id']);
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
        <div><h3>List of Authors:</h3></div>  
        <div> <a class="btn btn-info btn-sm" href="" role="button" data-toggle="modal" data-target="#exampleModal" data-action="add">Add Author</a></div>
        </div><br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Birth date</th>
                <th scope="col">Death date</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach(AuthorController::index() as $author): ?>
                        <tr>
                        <th scope="row"><?php echo $author->get_id();?></th>
                        <td><?php echo $author->get_name();  ?></td>
                        <td><?php echo date_create($author->get_birth())->format('Y-m-d');  ?></td>
                        <td><?php echo date_create($author->get_death())->format('Y-m-d');  ?></td>
                        <td>
                            <a name="" id="" class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-action="edit" data-id="<?php echo $author->get_id();?>" data-name="<?php echo $author->get_name();?>" data-birth="<?php echo $author->get_birth();?>" data-death="<?php echo $author->get_death();?>">Edit</a> 
                            <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-action="delete" data-id="<?php echo $author->get_id();?>" data-name="<?php echo $author->get_name();?>">Delete</a>
                        </td>
                        </tr>
                <?php  endforeach ?>
                
            </tbody>
        </table>
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
                <label for="auth-name" class="auth-label" class="col-form-label">Name:</label>
                <input type="text" name="name" class="form-control" id="auth-name" style="border: .5px solid lightgray ;">
            </div>
            <div class="form-group">
                <label for="auth-birth" class="auth-label" class="col-form-label">Birth date:</label>
                <input type="date" name="birth" class="form-control" id="auth-birth" style="border: .5px solid lightgray ;">
            </div>
            <div class="form-group">
                <label for="auth-death" class="auth-label" class="col-form-label">Death date:</label>
                <input type="date" name="death" class="form-control" id="auth-death" style="border: .5px solid lightgray ;">
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
        
    </div>
</div>
<?php include "../layouts/scripts.html"; ?>
</body>
</html>
