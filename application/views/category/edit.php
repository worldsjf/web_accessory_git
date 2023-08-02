<div class="container">
<div class="card">
  <div class="card-header">
    Edit Category
  </div>

  <div class="card-body">
  <a href="<?php echo base_url('category/create')?>" class="btn btn-primary">Add Category</a>
  <a href="<?php echo base_url('category/list')?>" class="btn btn-success">List Category</a>

  <?php
   if($this->session->flashdata('success')){
    ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
   <?php
  }elseif($this->session->flashdata('error')){
    ?>
    <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
    <?php
  }
   ?>  
        <form action="<?php echo base_url('category/update/'.$category->id)?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title" value="<?php echo $category->title ?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php echo '<span class="text text-danger">' .form_error('title'). '</span>' ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" name="slug" value="<?php echo $category->slug ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php echo '<span class="text text-danger">' .form_error('slug'). '</span>' ?>
          </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="text" class="form-control"  value="<?php echo $category->description ?>" name= "description" id="exampleInputPassword1">
            <?php echo '<span class="text text-danger">' .form_error('description'). '</span>' ?>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="file" name= "image" class="form-control-file" id="exampleInputPassword1">
            <img src="<?php echo base_url('uploads/category/' .$category->image) ?>" width="150" height="150">
            <small><?php if(isset($error)){ echo $error;} ?></small>
        </div>
        <div class="form-group">

        <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                <select name="status" class="form-control" id="exampleFormControlSelect2">
                <?php 
                if ($category->status == 1) { 
                ?>
                    <option selected value="1">Active</option>
                    <option value="0">Inactive</option>
                <?php
                } else { 
                ?>
                    <option value="1">Active</option>
                    <option selected value="0">Inactive</option>
                <?php 
                } 
                ?>
                </select>
              </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
  </div>
</div>
</div>