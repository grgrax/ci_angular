<form method="post" enctype="multipart/form-data" name="news_add" class="news_add form-horizontal">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Add new News</h4>
  </div>

  <div class="modal-body" id="news_add">

    <span id="add_error_success"></span>

    <?php 
    $news_category_id=get_setting_value('news_category_id'); 
    ?>

    <input type="hidden" value="<?php echo $news_category_id?>" name="category_id">
    <input type="hidden" value="<?php echo article_m::WIDGET_NEWS?>" name="widget_slug">

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">News Title</label>
      <div class="col-sm-10">
        <input name="name" type="text" placeholder="Tilte" id="name" class="form-control" value="e">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">News Content</label>
      <div class="col-sm-10 tinymce_wrapper">
      </div>
    </div>

    



    <div class="form-group">
      <label class="col-md-2 control-label">Select image</label>
      <div class="col-md-10">
        <span class="col-md-6">
          <span class="pull-left btn btn-default">
            <input type="file" name="news_file_input" id="news_file_input">
            <input type="hidden" name="news_uploaded_file" id="news_uploaded_file">
          </span>          
        </span>
        <span class="col-md-6">
          <ul>
            <li><b>Type: </b> gif | jpg | png </li>
            <li><b>Size: </b> < 1mb </li>
            <li><b>Dimension: </b> 1024 X 768 </li>
          </ul>
        </span>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label"></label>
      <div class="col-md-10">
        <span class="alert" id="ajax_upload_response"></span>
      </div>
    </div>



  </div>

  <div class="modal-footer">
    <input type="submit" name="add" value="Submit" class="btn btn-primary"/>
    <button type="reset" class="btn btn-default">Reset</button>
    <button data-dismiss="modal" class="btn btn-warning" type="button">Cancel</button>
  </div>

</form>

<script>
  $(function(){

    $('#ajax_upload_response').removeClass('alert-success');
    $('#ajax_upload_response').removeClass('alert-danger');
    $('#news_uploaded_file').val('');

    //file upload
    $('#news_file_input').on('change', function(e){
      $('#ajax_upload_response').removeClass('alert-success');
      $('#ajax_upload_response').removeClass('alert-danger');
      $('#news_uploaded_file').val('');
      e.preventDefault();
      var files=$('#news_file_input').prop('files');
      var data = new FormData();
      $.each(files, function(key, value)
      {
        data.append(key, value);
      });
      var widgettype="<?php echo article_m::WIDGET_NEWS;?>";
      var url='<?php echo base_url("article/widget/uploadfile/");?>'+'/'+widgettype;
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, 
        contentType: false, 
        beforeSend: function() { ajax_effect('news_add',1);},
        complete: function() { ajax_effect('news_add',0);},
        success: function(response)
        {
          console.log(response);
          if(response.success)
          {
            $('#ajax_upload_response').addClass('alert-success');
            $('#ajax_upload_response').html(response.data);
            $('#news_uploaded_file').val(response.filename);
          }
          else
          {
            $('#ajax_upload_response').addClass('alert-danger');
            $('#ajax_upload_response').html(response.data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          alert('ERRORS: ' + textStatus);
        }
      });
    });
    //file upload

    //add
    $('form[name="news_add"]').on('submit',function(e) {
      e.preventDefault();
      url = "<?php echo site_url('article/widget/add')?>";
      form_data = $(this).serialize();      
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'text',
        data: form_data,
        beforeSend: function() { ajax_effect('news_add',1);},
        complete: function() { ajax_effect('news_add',0);},
        success: function(response) {
          console.log(response);
          var response=jQuery.parseJSON(response);
          if(response.success==true){           
            error_success('add_error_success','success',response.data);
            load_news();
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


