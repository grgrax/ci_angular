<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Add New (API) -- <?php echo $api_url_string;?></div>
    <div class="panel-body">
      <div class="form-group">
        <label for="parent_id">Parent category</label>
        <select name="parent_id" id="input" class="form-control capitalize">
          <option value="">Select</option>
          <?php foreach ($parents as $row) {?>
          <option value="<?php echo $row['id'] ?>"><?php echo $row['name']?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" placeholder="category name here"
        value="<?php echo set_value('name') ?>">
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="ckeditor" 
        placeholder="category content here"><?php echo set_value('content'); ?></textarea>
      </div>
      <div class="form-group">
        <label for="image">Image</label>
        <input name="image" type="file" class="form-input">
      </div>
      <div class="form-group">
        <label for="image_title">Image title</label>
        <input name="image_title" type="text" class="form-control" placeholder="Image title here"
        value="<?php echo set_value('image_title') ?>">
      </div>
      <div class="form-group">
        <label for="url">URL</label>
        <input name="url" type="text" class="form-control" placeholder="url here"
        value="<?php echo set_value('url') ?>">
      </div>
      <div class="panel-footer">
        <input type="submit" name="add" value="Add" class="btn btn-primary"/>
        <a href="<? echo $link ?>" class="btn btn-default"/>Cancel</a>
      </div>
    </div>
  </form>



  <script>
    CKEDITOR.replace( 'ckeditor', {
      customConfig: 'web/custom/custom_config.js'
    } );
  </script>
