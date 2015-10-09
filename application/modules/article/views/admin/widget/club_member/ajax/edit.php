
<form method="post" enctype="multipart/form-data" name="project_edit" class="project_edit form-horizontal">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Edit project</h4>
  </div>

  <div class="modal-body">


    <span id="project_edit_error_success"></span>

    <?php 
    $project_category_id=get_setting_value('project_category_id'); 
    ?>
    <input type="hidden" value="" name="slug" id="slug">
    <input type="hidden" value="<?php echo article_m::WIDGET_PROJECT;?>" name="widget_slug">

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Project Title</label>
      <div class="col-sm-4">
        <input name="name" type="text" placeholder="Tilte" id="name" class="form-control">
      </div>
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">Order</label>
      <div class="col-sm-4">
        <input name="order" type="text" placeholder="order" id="order" class="form-control">
      </div>

    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Project Content</label>
      <div class="col-sm-10">
        <textarea name="content" class="form-control" id="ckeditor" rows="5" 
        placeholder="content here"></textarea>
      </div>
    </div>

  </div>

  <div class="modal-footer">
    <input type="submit" name="add" value="Submit" class="btn btn-primary"/>
    <button data-dismiss="modal" class="btn btn-warning" type="button">Cancel</button>
  </div>

</form>

<script>
  $(function(){

    $('.project_edit #project_edit_error_success').removeClass('alert-success');
    $('.project_edit #project_edit_error_success').removeClass('alert-danger');

    //edit
    $('form[name="project_edit"]').on('submit',function(e) {
      e.preventDefault();
      url = "<?php echo site_url('article/widget/edit')?>";
      form_data = $(this).serialize();      
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'text',
        data: form_data,
        beforeSend: function() {
          $('form[name="project_edit"] input[type="submit"]').val('Saving ...');
        },
        success: function(data) {
          console.log(data);
          var data=jQuery.parseJSON(data);
          if(data.success==true){           
            error_success('project_edit_error_success','success',data.data);
            load_projects();
          }
          else if(data.success==false){
            error_success('project_edit_error_success','danger',data.data);
          }
        },
        error: function(xhr,status,error){
          alert("Error: " + xhr.status + ": " + xhr.statusText);
        },
        complete: function() {
          $('form[name="project_edit"] input[type="submit"]').val('Submit');
        },
      });
    });
    //edit

  });
</script>


