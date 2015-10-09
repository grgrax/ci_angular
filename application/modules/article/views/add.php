<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Add article<?php echo (isset($category)?'Help':'')?></div>
    
    <div class="panel-body">

      <span class="col-md-4 col-lg-4">
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" class="form-control" placeholder="name here"
          value="<?php echo set_value('name') ?>">
        </div>
      </span>

      <span class="col-md-4 col-lg-4">
        <div class="form-group">
          <label for="category">Category</label>
          <select name="category" id="input" class="form-control capitalize">
            <?php if(isset($category)){?>
            <option value="<?php echo $category['id'] ?>"><?php echo $category['name']?></option>
            <?php } else{?>
            <?php foreach ($categories as $cat) {?>
            <?php if(is_default_category($cat['slug'])) continue; ?>
            <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name']?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </span>

      <span class="col-md-4 col-lg-4">
        <div class="form-group">
          <?php if(!isset($category)){?>
          <label for="url">URL</label>
          <input name="url" type="text" class="form-control" placeholder="url here"
          value="<?php echo set_value('url') ?>">
          <?php } ?>   
        </div>       
      </span> 

      <span class="col-md-12 col-lg-12">
        <div class="form-group">
          <label for="content">Content</label>
          <textarea name="content" class="form-control" id="mytextarea" 
          placeholder="content here"><?php echo set_value('content'); ?></textarea>
        </div>
      </span>

      <?php if(!isset($category)){?>
      <span class="col-md-6 col-lg-6">
        <p>
          <h5>Image Info.</h5>          
          <div class="form-group">
            <label for="image">Image</label> (Max upload size: 5M)
            <input name="image" type="file" class="form-input">
          </div>
          <div class="form-group">
            <label for="image_title">Image title</label>
            <input name="image_title" type="text" class="form-control" placeholder="Image title here"
            value="<?php echo set_value('image_title') ?>">
          </div> 
          <h5>Meta Info.</h5> 
          <div class="form-group">
            <label for="meta_desc">Meta description</label>
            <input name="meta_desc" type="text" class="form-control" placeholder="meta description here"
            value="<?php echo set_value('meta_desc') ?>">
          </div> 
          <div class="form-group">
            <label for="meta_key">Meta keywords</label>
            <input name="meta_key" type="text" class="form-control" placeholder="meta keywords here"
            value="<?php echo set_value('meta_key') ?>">
          </div> 
          <div class="form-group">
            <label for="meta_robots">Meta robots</label>
            <input name="meta_robots" type="text" class="form-control" placeholder="meta robots here"
            value="<?php echo set_value('meta_robots') ?>">
          </div> 
        </p>
      </span>
      <span class="col-md-6 col-lg-6">
        <p>
          <h5>Video Info.</h5>          
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
            <textarea name="embed_code" class="form-control" id="" rows="7" 
            placeholder="article content here"><?php echo set_value('embed_code'); ?></textarea>
          </div>
        </p>   
      </span>
      <?php } ?>


    </div>

    <div class="panel-footer">
      <input type="submit" name="add" value="Add" class="btn btn-success"/>
      <a href="<? echo $link ?>" class="btn btn-warning"/>Cancel</a>
    </div>
    
  </form>





  <script>
    // CKEDITOR.replace( 'ckeditor', {
    //   customConfig: 'web/custom/custom_config.js'
    // } );
  </script>
