<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Add New</div>
    <div class="panel-body">
      <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="input" class="form-control capitalize"
        <?php echo isset($category)?'readonly':'';?>>
        <?php foreach ($categories as $cat) {?>
        <?php if(isset($category)){?>
        <option value="<?php echo $category['id'] ?>"><?php echo $category['name']?></option>
        <?php }else{ ?>
        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name']?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input name="name" type="text" class="form-control" placeholder="article name here"
      value="<?php echo set_value('name') ?>">
    </div>
    <div class="form-group">
      <label for="url">URL</label>
      <input name="url" type="text" class="form-control" placeholder="url here"
      value="<?php echo set_value('url') ?>">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" class="form-control" id="ckeditor" 
      placeholder="article content here"><?php echo set_value('content'); ?></textarea>
    </div>
    <span>        
      <div class="form-group">
        
        <div class="tab-head">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#image" data-toggle="tab">Image</a></li>
            <li><a href="#video" data-toggle="tab">Video</a></li>
            <li><a href="#meta" data-toggle="tab">Meta</a></li>
          </ul>
        </div>
        <div class="tab-content">
          <div id="image" class="tab-pane fade in active">
            <p>
              <div class="form-group">
                <label for="image">Image</label> (Max upload size: 5M)
                <input name="image" type="file" class="form-input">
              </div>
              <div class="form-group">
                <label for="image_title">Image title</label>
                <input name="image_title" type="text" class="form-control" placeholder="Image title here"
                value="<?php echo set_value('image_title') ?>">
              </div> 
            </p>
          </div>
          <div id="video" class="tab-pane fade">
            <p>
              <div class="form-group">
                <label for="video">Video</label> (Max upload size: 25M)
                <input name="video" type="file" class="form-input">
              </div>
              <div class="form-group">
                <label for="video_title">Video title</label>
                <input name="video_title" type="text" class="form-control" placeholder="video title here"
                value="<?php echo set_value('video_title') ?>">
              </div> 
              <div class="form-group">
                <label for="video_url">Video url</label>
                <input name="video_url" type="text" class="form-control" placeholder="url here"
                value="<?php echo set_value('video_url') ?>">
              </div>
              <div class="form-group">
                <label for="embed_code">Embed Video code</label>
                <textarea name="embed_code" class="form-control" id="" 
                placeholder="article content here"><?php echo set_value('embed_code'); ?></textarea>
              </div>
            </p>          
          </div>
          <div id="meta" class="tab-pane fade">
            <p>
              <div class="form-group">
                <label for="meta_description">Meta description</label>
                <input name="meta_description" type="text" class="form-control" placeholder="meta description here"
                value="<?php echo set_value('meta_description') ?>">
              </div> 
              <div class="form-group">
                <label for="meta_keywords">Meta keywords</label>
                <input name="meta_keywords" type="text" class="form-control" placeholder="meta keywords here"
                value="<?php echo set_value('meta_keywords') ?>">
              </div> 
              <div class="form-group">
                <label for="meta_robots">Meta robots</label>
                <input name="meta_robots" type="text" class="form-control" placeholder="meta robots here"
                value="<?php echo set_value('meta_robots') ?>">
              </div> 
            </p>          
          </div>
        </div> 
      </div>
    </span>



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
