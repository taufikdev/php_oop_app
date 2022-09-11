<?php
require "../config/Auth.php";
require_once "../controller/UserController.php";

if(isset($_POST['action'])){

    if(isset($_POST['username']) && isset($_POST['password']) && $_POST['action'] === 'add')
        UserController::create($_POST);
    if(isset($_POST['username']) && isset($_POST['password']) && $_POST['action'] === 'edit')
        UserController::update($_POST);
    if(isset($_POST['id']) && $_POST['action'] === 'delete')
        UserController::delete($_POST['id']);
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
        <div><h3>List of Users:</h3></div>  
        <div> <a class="btn btn-info btn-sm" href="" role="button" data-toggle="modal" data-target="#exampleModal" data-action="add">Add User</a></div>
        </div><br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Admin</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach(UserController::index() as $user): ?>
                        <tr>
                        <th scope="row"><?php echo $user->getId();?></th>
                        <td><?php echo $user->getUsername();  ?></td>
                        <td><?php echo $user->getEmail() ; ?></td>
                        <td><?php echo $user->getPassword();  ?></td>
                        <td><?php echo $user->getAdmin()=="1"?"admin":"user";  ?></td>
                        <td>
                            <a name="" id="" class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-action="edit" data-id="<?php echo $user->getId();?>" data-username="<?php echo $user->getUsername();?>" data-email="<?php echo $user->getEmail();?>" data-password="<?php echo $user->getPassword()?>" data-admin="<?php echo $user->getAdmin()?>">Edit</a> 
                            <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-action="delete" data-id="<?php echo $user->getId();?>" data-username="<?php echo $user->getUsername();?>">Delete</a>
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
                <input type="text" name="id" hidden id="user-id">
                <input type="text" name="action" hidden id="user-action">
                <label for="user-username" class="user-label" class="col-form-label">Username:</label>
                <input type="text" name="username" class="form-control" id="user-username" style="border: .5px solid lightgray ;">
            </div>
            <div class="form-group">
                <label for="user-email" class="user-label" class="col-form-label">Email:</label>
                <input type="email" name="email" class="form-control" id="user-email" style="border: .5px solid lightgray ;">
            </div>
            <div class="form-group">
                <label for="user-password" class="user-label" class="col-form-label">Password:</label>
                <input type="text" name="password" class="form-control" id="user-password" style="border: .5px solid lightgray ;">
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="admin" value="0" id="user-admin">
                <label class="custom-control-label" for="user-admin">Is Admin?</label>
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
            var username = button.data('username') 
            var id = button.data('id');
            var email = button.data('email');
            var password = button.data('death');
            var modal = $(this)
            if(action === 'delete'){
                modal.find('#user-username').hide();
                modal.find('#user-email').hide();
                modal.find('#user-password').hide();
                modal.find('#user-admin').hide();
                modal.find('.user-label').hide();
                modal.find('#delete_message').text("Are you sure you want to delete User : "+username+" ?");
                modal.find('.modal-title').text('Deleting User');
                modal.find('#user-id').val(id)
                modal.find('#user-action').val(action)
            }
            else{
                if(action === 'add'){
                    modal.find("#exampleModalLabel").text("Adding new User");
                    modal.find('#delete_message').text('');
                    modal.find('#user-username').show();
                    modal.find('#user-email').show();
                    modal.find('#user-password').show();
                    modal.find('#user-admin').show();
                    modal.find('.user-label').show();
                    modal.find('.user-label').text("User Name:");
                    modal.find('#user-username').val(username)
                    modal.find('#user-id').val(id);
                    modal.find('#user-action').val(action)
                }
                else{
                    modal.find("#exampleModalLabel").text("Edit User");
                    modal.find('#delete_message').text('');
                    modal.find('#user-username').show();
                    modal.find('#user-email').show();
                    modal.find('#user-password').show();
                    modal.find('#user-admin').show();
                    modal.find('.user-label').show();
                    modal.find('.user-label').text("User Name:");
                    modal.find('#user-username').val(username)
                    modal.find('#user-id').val(id);
                    modal.find('#user-email').val(email);
                    modal.find('#user-password').val(password)
                    modal.find('#user-action').val(action)
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
