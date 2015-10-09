
<form method="post" enctype="multipart/form-data" name="message_edit" class="message_edit form-horizontal">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Edit messages</h4>
  </div>

  <div class="modal-body" id="edit_message">


    <span id="edit_error_success"></span>

    <?php 
    $message_category_id=get_setting_value('message_category_id'); 
    $category=get_categories(array('id'=>$message_category_id),1);
    ?>
    <input type="hidden" value="1" name="id" id="id">
    <input type="hidden" value="" name="slug" id="slug">
    <input type="hidden" value="<?php echo $category['slug']?>" name="widget_slug">

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Message Title</label>
      <div class="col-sm-10">
        <input name="name" type="text" placeholder="Tilte" id="name" class="form-control">
      </div>
    </div>

    <div class="form-group content">
      <label class="col-sm-2 control-label" for="demo-hor-inputpass">Message Content</label>
      <div class="col-sm-10 tinymce_wrapper">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">Order</label>
      <div class="col-sm-4">
        <input name="order" type="text" placeholder="order" id="order" class="form-control">
      </div>
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">By</label>
      <div class="col-sm-4">
        <input name="title" type="text" placeholder="By" id="title" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label">Select image</label>
      <div class="col-md-10">
        <span class="col-md-6">
          <span class="pull-left btn btn-default">
            <input type="file" name="message_file_input" class="message_file_input">
            <input type="hidden" name="uploaded_file" id="uploaded_file">
          </span>          
        </span>
        <span class="col-md-6">
          <img alt="" class="img-md" src="">
        </span>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label"></label>
      <div class="col-md-10">
        <ul>
          <li><b>Type: </b> gif | jpg | png </li>
          <li><b>Size: </b> < 1mb </li>
          <li><b>Dimension: </b> 1024 X 768 </li>
        </ul>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label"></label>
      <div class="col-md-10">
        <span class="alert" id="ajax_upload_response"></span>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">Post</label>
      <div class="col-sm-4">
        <input name="image_title" type="text" placeholder="Post here" id="image_title" class="form-control">
      </div>
      <label class="col-sm-2 control-label" for="demo-hor-inputemail">Working Year</label>
      <div class="col-sm-4">
        <input name="image_title_2" type="text" placeholder="Working Year here" id="image_title_2" class="form-control">
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

    $('.message_edit #ajax_upload_response').removeClass('alert-success');
    $('.message_edit #ajax_upload_response').removeClass('alert-danger');
    $('.message_edit #uploaded_file').val('');


    //file upload
    $('.message_edit .message_file_input').change(function(e){
      e.preventDefault();
      var files=$('.message_file_input').prop('files');
      var data = new FormData();
      $.each(files, function(key, value)
      {
        data.append(key, value);
      });
      var widgettype="<?php echo article_m::WIDGET_MESSAGE;?>";
      var url='<?php echo base_url("article/widget/uploadfile/");?>'+'/'+widgettype;
      console.log(url);
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, 
        contentType: false, 
        beforeSend: function() { 
          ajax_effect('edit_message',1);
        },
        success: function(data)
        {
          if(data.success==true)
          {
            $('.message_edit #ajax_upload_response').addClass('alert-success');
            $('.message_edit #ajax_upload_response').html(data.data);
            $('.message_edit #uploaded_file').val(data.filename);
          }
          else
          {
            $('.message_edit #ajax_upload_response').addClass('alert-danger');
            $('.message_edit #ajax_upload_response').html(data.data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          alert('ERRORS: ' + textStatus);
        },
        complete: function() {
          ajax_effect('edit_message',0);
        },
      });
    });
    // file upload

    //edit
    $('form[name="message_edit"]').on('submit',function(e) {
      e.preventDefault();
      slug = $('.message_edit #slug').val();
      url = "<?php echo site_url('article/widget/edit')?>"+'/'+slug;
      form_data = $(this).serialize();      
      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'text',
        data: form_data,
        beforeSend: function() { 
          ajax_effect('edit_message',1);
        },
        success: function(data) {
          var data=jQuery.parseJSON(data);
          // console.log(data);
          if(data.success==true){           
            error_success('edit_error_success','success',data.data);
            load_messages();
          }
          else if(data.success==false){
            error_success('edit_error_success','danger',data.data);
          }
        },
        error: function(xhr,status,error){
          alert("Error: " + xhr.status + ": " + xhr.statusText);
        },
        complete: function() {
          ajax_effect('edit_message',0);
        },
      });
    });
    //edit


  });
</script>


