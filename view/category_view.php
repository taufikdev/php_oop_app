<?php
require_once "../controller/CategoryController.php";

if(isset($_POST['action'])){

    if(isset($_POST['category']) && $_POST['action'] === 'add')
        CategoryController::create($_POST);
    if(isset($_POST['category']) && $_POST['action'] === 'edit')
        CategoryController::update($_POST);
    if($_POST['action'] === 'delete')
        CategoryController::delete($_POST['id']);
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
        <div><h3>List of categories</h3></div>  
        <div> <a class="btn btn-info btn-sm" href="" role="button" data-toggle="modal" data-target="#exampleModal" data-action="add">Add Category</a></div>
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
                        <td><a name="" id="" class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#exampleModal" data-name="<?php echo $category->get_name();  ?>" data-action="edit" data-id="<?php echo $category->get_id(); ?>">Edit</a> <a name="" id="" data-toggle="modal" data-target="#exampleModal" data-action="delete" data-id="<?php echo $category->get_id(); ?>"  data-name="<?php echo $category->get_name();  ?>" class="btn btn-danger btn-sm" href="#" role="button">Delete</a></td>
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
          <div class="form-group">
            <input type="text" name="id" hidden id="cat-id">
            <input type="text" name="action" hidden id="cat-action">
            <label for="recipient-name" id="cat-label" class="col-form-label">Category Name:</label>
            <input type="text" name="category" class="form-control" id="cat-name" style="border: .5px solid lightgray ;">
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
            var category = button.data('name') 
            var id = button.data('id');
            var modal = $(this)
            if(action === 'delete'){
                modal.find('#cat-name').hide();
                modal.find('#cat-label').text("Are you sure you want to delete category : "+category+" ?");
                modal.find('.modal-title').text('Deleting Category');
                modal.find('#cat-id').val(id)
                modal.find('#cat-action').val(action)
            }
            else{
                if(action === 'add')
                    modal.find("#exampleModalLabel").text("Adding new category");
                else
                    modal.find("#exampleModalLabel").text("Edit category");
                modal.find('#cat-name').show();
                modal.find('#cat-label').text("Category Name:");
                modal.find('#cat-name').val(category)
                modal.find('#cat-id').val(id)
                modal.find('#cat-action').val(action)
            }
        })

});
</script>
        <!-- -------------------------------------------modal------------------------------------------------------------ -->
    </div>
    </div>
    <?php include "../layouts/scripts.html"; ?>
</body>
</html>
