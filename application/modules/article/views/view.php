<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Article Details</div>
    <div class="panel-body">
      <div class="form-group">
        <label for="category">Category</label> : <?php echo category_name($row['category_id'])?>
      </div>
      <div class="form-group">
        <label for="name">Name</label> : <?php echo $row['name'] ?>
      </div>
      <div class="form-group">
        <label for="content">Content</label> : <div class="html_output"><?php echo $row['content']?$row['content']:'' ?></div>
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
                    <label for="image">Image</label> :  
                  </div>
                  <div class="form-group">
                    <label for="image_title">Image title</label> : <?php echo $row['image_title']?$row['image_title']:'' ?>
                  </div> 
                </p>
              </div>
              <div id="video" class="tab-pane fade">
                <p>
                  <div class="form-group">
                    <label for="video">Video</label> : 
                  </div>
                  <div class="form-group">
                    <label for="video_title">Video title</label> : <?php echo $row['video_title']?$row['video_title']:'' ?>
                  </div> 
                  <div class="form-group">
                    <label for="video_url">Video url</label> : <?php echo $row['video_url']?$row['video_url']:'' ?>
                  </div>
                  <div class="form-group">
                    <label for="embed_code">Embed Video code</label> : <?php echo $row['embed_code']?$row['embed_code']:'' ?>
                  </div>
                </p>          
              </div>
              <div id="meta" class="tab-pane fade">
                <p>
                  <div class="form-group">
                    <label for="meta_description">Meta description</label> : <?php echo $row['meta_desc']?$row['meta_desc']:'' ?>
                  </div> 
                  <div class="form-group">
                    <label for="meta_keywords">Meta keywords</label> : <?php echo $row['meta_key']?$row['meta_key']:'' ?>
                  </div> 
                  <div class="form-group">
                    <label for="meta_robots">Meta robots</label> : <?php echo $row['meta_robots']?$row['meta_robots']:'' ?>
                  </div> 
                </p>          
              </div>
            </div> 
        </div>
      </span>



    </div>
  </div>
</form>





<script>
  CKEDITOR.replace( 'ckeditor', {
    customConfig: 'web/custom/custom_config.js'
  } );
</script>
