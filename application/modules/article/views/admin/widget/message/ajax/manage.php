<script type="text/javascript">
    function load_messages(){  
        $('.message_list_ajax').html('');
        url = "<?php echo base_url('article/widget/index/')?>"+"/<?php echo article_m::WIDGET_MESSAGE; ?>";
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {$('.message_list_ajax').html(data);},
            error: function(xhr,status,error){console.log("Error: " + xhr.status + ": " + xhr.statusText);},
        });
    }
</script>

<div class="panel-body">
    <form action="" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputpass">No of Message to show</label>
            <div class="col-sm-3">
                <input name="no_of_message_on_home_page" type="number" id="demo-hor-inputpass" class="form-control"
                value="<?php echo get_setting_value('no_of_message_on_home_page')?>" >
            </div>
            <span class="col-offset-2 col-sm-4">
                <input name="message" class="btn btn-success" type="submit" value="Submit">
                <button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
                <a href="#" class="btn btn-success btn-labeled fa fa-plus"
                id="message_add_link"
                data-toggle="modal"
                data-target="#my_modal_message_add">New</a>

            </span>
        </div>
    </form>
</div>

<hr>
<span class="message_list_ajax" id="message_list_ajax_id"></span>


<!-- add Modal -->
<div class="modal fade" id="my_modal_message_add" tabindex="-1" role="dialog" aria-labelledby="my_modal_message_add" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-lg">
        <div class="modal-content">
            <?php $this->load->view("article/admin/widget/message/ajax/add.php"); ?>
        </div>
    </div>
</div>

<!-- add Modal -->
<div class="modal fade" id="my_modal_message_edit" tabindex="-2" role="dialog" aria-labelledby="my_modal_message_edit" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-lg">
        <div class="modal-content">
            <?php $this->load->view("article/admin/widget/message/ajax/edit.php"); ?>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(function(){

        $('body').on('click','#message_add_link',function(e){
            clear_form('message_add');
            clear_ajax_error_success('message_add','add_error_success');
            $('.message_add .tinymce_wrapper').empty();
            var textarea='<textarea name="content" class="form-control textarea" rows="5" placeholder="content here"></textarea>';
            $('.message_add .tinymce_wrapper').append(textarea);
            $('.message_add .textarea').wysihtml5();
        });

        $('body').on('click','#edit_message_link',function(e){
            clear_form('message_edit');
            clear_ajax_error_success('message_edit','edit_error_success');
            e.preventDefault();
            slug = $(this).attr('data-slug');
            url='<?php echo base_url('article/get/')?>'+'/'+slug+'/json';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { ajax_effect('edit_message',1);},
                complete: function() {ajax_effect('edit_message',0);},
                success: function(response) {
                    if(response.success){
                        $('.message_edit #id').val(response.data.id);
                        $('.message_edit #slug').val(response.data.slug);
                        $('.message_edit #name').val(response.data.name);
                        $('.message_edit #order').val(response.data.order);
                        
                        image_path='<?php echo $image=is_picture_exists("articles/messages/");?>';
                        image=image_path+response.data.image;
                        $('.message_edit .img-md').attr('src',image);

                        $('.message_edit .tinymce_wrapper').empty();
                        var textarea='<textarea name="content" class="form-control textarea" id="ckeditor" rows="5" placeholder="content here">'+response.data.content+'</textarea>';
                        $('.message_edit .tinymce_wrapper').append(textarea);
                        $('.message_edit .textarea').wysihtml5();

                        $('.message_edit #title').val(response.data.title);
                        $('.message_edit #image_title').val(response.data.image_title);
                        $('.message_edit #image_title_2').val(response.data.image_title_2);
                    }
                    else{
                        alert(response.data);
                    }
                },
                error: function(xhr,status,error){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                },
            });
});


$('body').on('click','#delete_message_link',function(e){
    e.preventDefault();
    url = $(this).attr('href');
    bootbox.confirm("Are you sure?", function(result) {
        if(result){
            url = url;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { ajax_effect('messages',1); },
                complete: function() { ajax_effect('messages',0); },
                success: function(response) {
                    if(response.success){
                        alert(response.data);
                        load_messages();
                    }else{
                        alert(response.data);
                    }
                },
                error: function(xhr,status,error){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                },
            });
        }
    });
});

load_messages();



});
</script>