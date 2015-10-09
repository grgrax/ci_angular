<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Add New</div>
    <div class="panel-body">

      <span class="col-md-6 col-lg-6">
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" class="form-control" placeholder="category name here"
          value="<?php echo set_value('name') ?>">
        </div>
      </span>

      <span class="col-md-6 col-lg-6">
        <div class="form-group">
          <label for="url">URL</label>
          <input name="url" type="text" class="form-control" placeholder="url here"
          value="<?php echo set_value('url') ?>">
        </div>
      </span>

      <span class="col-md-12 col-lg-12">
        <div class="form-group">
          <label for="content">Content</label>
          <textarea name="content" class="form-control textarea" 
          placeholder="category content here"><?php echo set_value('content'); ?></textarea>
        </div>
      </span>

      <span class="col-md-6 col-lg-6">
       <div class="col-md-6 col-lg-6">
        <label for="image">Image</label>
        <span class="btn btn-default">
          <input name="image" type="file" class="form-input">
        </span>
      </div>
      <div class="col-md-6 col-lg-6">
        <?php echo img_label()?>
      </div>
    </span>
    <span class="col-md-6 col-lg-6">
      <div class="form-group">
        <label for="image_title">Image title</label>
        <input name="image_title" type="text" class="form-control" placeholder="Image title here"
        value="<?php echo set_value('image_title') ?>">
      </div>
    </span>
  </div>
  <div class="panel-footer">
    <input type="submit" name="add" value="Add" class="btn btn-success"/>
    <a href="<? echo $link ?>" class="btn btn-warning"/>Cancel</a>
  </div>
</div>
</form>



