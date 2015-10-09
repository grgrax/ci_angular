<form method="post" enctype="multipart/form-data" name="message_add" class="message_add form-horizontal">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Add new messages</h4>
  </div>

  <div class="modal-body" id="add_message">

    <span id="add_error_success"></span>

    <?php 
    $message_category_id=get_setting_value('message_category_id'); 
    $category=get_categories(array('id'=>$message_category_id),1);
    // show_pre($category);
    ?>
    <input type="hidden" value="<?php echo $message_category_id?>" name="category_id">
    <input type="hidden" value="<?php echo $category['slug']?>" name="widget_slug">

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Message Title</label>
      <div class="col-sm-10">
        <input name="name" type="text" placeholder="Tilte" id="demo-hor-inputpass" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Message Content</label>
      <div class="col-sm-10 tinymce_wrapper">
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">By</label>
      <div class="col-sm-10">
        <input name="title" type="text" placeholder="By" id="title" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label">Select image</label>
      <div class="col-md-6">
        <span class="btn btn-default">
          <input type="file" name="message_file_input" id="message_file_input">
          <input type="hidden" name="message_uploaded_file" id="message_uploaded_file">
        </span>
      </div>
      <div class="col-md-4">
        <ul>
          <li><b>Type: </b> gif | jpg | png </li>
          <li><b>Size: </b> < 1mb </li>
          <li><b>Dimension: </b> 1024 X 768 </li>
        </ul>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label"></label>
      <span class="alert" id="ajax_upload_response"></span>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">Post</label>
      <div class="col-sm-10">
        <input name="image_title" type="text" placeholder="Post here" id="image_title" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">Working Year</label>
      <div class="col-sm-10">
        <input name="image_title_2" type="text" placeholder="Working Year here" id="image_title_2" class="form-control">
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

    $('.message_add #ajax_upload_response').removeClass('alert-success');
    $('.message_add #ajax_upload_response').removeClass('alert-danger');
    $('.message_add #uploaded_file').val('');


    //file upload
    $('#message_file_input').on('change', function(e){
      $('#ajax_upload_response').removeClass('alert-success');
      $('#ajax_upload_response').removeClass('alert-danger');
      $('#message_uploaded_file').val('');
      e.preventDefault();
      var files=$('#message_file_input').prop('files');
      var data = new FormData();
      $.each(files, function(key, value)
      {
        data.append(key, value);
      });
      var widgettype="<?php echo article_m::WIDGET_MESSAGE;?>";
      var url='<?php echo base_url("article/widget/uploadfile/");?>'+'/'+widgettype;
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, 
        contentType: false,
        beforeSend: function() { ajax_effect('add_message',1);},        
        complete: function() { ajax_effect('add_message',0);},        
        success: function(response)
        {
          console.log(response);
          if(response.success)
          {
            $('.message_add #ajax_upload_response').addClass('alert-success');
            $('.message_add #ajax_upload_response').html(response.data);
            $('.message_add #message_uploaded_file').val(response.filename);
          }
          else
          {
            $('.message_add #ajax_upload_response').addClass('alert-danger');
            $('.message_add #ajax_upload_response').html(response.data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          alert('ERRORS: ' + textStatus);
        },
      });
    });
    //file upload

    //add
    $('form[name="message_add"]').on('submit',function(e) {
      e.preventDefault();
      url = "<?php echo site_url('article/widget/add')?>";
      form_data = $(this).serialize();      
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'text',
        data: form_data,
        beforeSend: function() {
          ajax_effect('add_message',1);
        },
        success: function(response) {
          var response=jQuery.parseJSON(response);
          // console.log(response);
          if(response.success==true){           
            error_success('add_error_success','success',response.data);
            load_messages();
          }
          else{
            error_success('add_error_success','danger',response.data);
          }
        },
        error: function(xhr,status,error){
          alert("Error: " + xhr.status + ": " + xhr.statusText);
        },
        complete: function() {
          ajax_effect('add_message',0);
        },
      });
    });
    //add

  });
</script>


