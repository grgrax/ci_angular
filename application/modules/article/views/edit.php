<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Edit details</div>
    <div class="panel-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" placeholder="fund category name here"
        value="<?php echo set_value('name',$row['name']) ?>">
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="ckeditor" 
        placeholder="fund category content here"><?php echo set_value('content',$row['content']); ?></textarea>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" name="add" value="Update" class="btn btn-success">
      <a href="<? echo $link ?>" class="btn btn-warning"/>Cancel</a>
    </div>
  </div>
</form>

