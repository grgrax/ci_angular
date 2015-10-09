<form method="post" enctype="multipart/form-data" name="project_add" class="project_add form-horizontal">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Add new project</h4>
  </div>

  <div class="modal-body" id="project_add">

    <span id="add_error_success"></span>

    <?php 
    $project_category_id=get_setting_value('project_category_id'); 
    ?>

    <input type="hidden" value="<?php echo $project_category_id?>" name="category_id">
    <input type="hidden" value="<?php echo article_m::WIDGET_PROJECT?>" name="widget_slug">

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Project Title</label>
      <div class="col-sm-10">
        <input name="name" type="text" placeholder="Tilte" id="demo-hor-inputpass" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Project Content</label>
      <div class="col-sm-10 tinymce_wrapper">
      </div>
    </div>

  </div>

  <div class="modal-footer">
    <input type="submit" name="add" value="Submit" class="btn btn-primary"/>
    <input type="reset" name="reset" value="Reset" class="btn btn-default"/>
    <button data-dismiss="modal" class="btn btn-warning" type="button">Cancel</button>
  </div>

</form>

<script>
  $(function(){

    //add
    $('form[name="project_add"]').on('submit',function(e) {
      e.preventDefault();
      url = "<?php echo site_url('article/widget/add')?>";
      form_data = $(this).serialize();      
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'text',
        data: form_data,
        beforeSend: function() { ajax_effect('project_add',1);},
        complete: function() {ajax_effect('project_add',0);},
        success: function(response) {
          console.log(response);
          var response=jQuery.parseJSON(response);
          if(response.success==true){           
            error_success('add_error_success','success',response.data);
            load_projects();
          }
          else{
            error_success('add_error_success','danger',response.data);
          }
        },
        error: function(xhr,status,error){
          alert("Error: " + xhr.status + ": " + xhr.statusText);
        },
      });
    });
    //add

  });
</script>


