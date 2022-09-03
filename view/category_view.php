<?php
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
       <div><h3>List of categories</h3></div>  
       <div> <a class="btn btn-info btn-sm" href="" role="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Category</a></div>
        </div><br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach(CategoryController::index() as $category): ?>
                        <tr>
                        <th scope="row"><?php echo $category->get_id();  ?></th>
                        <td><?php echo $category->get_name();  ?></td>
                        <td><a name="" id="" class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $category->get_id();  ?>">Edit</a> <a name="" id="" class="btn btn-danger btn-sm" href="#" role="button">Delete</a></td>
                        </tr>
                <?php  endforeach ?>
                
            </tbody>
        </table>
        <!-- -------------------------------------------modal------------------------------------------------------------ -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category Name:</label>
            <input type="text" class="form-control" id="recipient-name" style="border: .5px solid lightgray ;">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit">Confirm</button>
      </div>
    </div>
  </div>
</div>
        <!-- -------------------------------------------modal script------------------------------------------------------------ -->
<script>
$(document).ready(function(){
    
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })


});
</script>
       
       
        <!-- -------------------------------------------modal------------------------------------------------------------ -->
    </div>
    </div>
    <?php include "../layouts/scripts.html"; ?>
</body>
</html>
