<script type="text/javascript">
    function load_news(){
        $('.news_list_ajax').html('');
        url = "<?php echo base_url('article/widget/index/')?>"+"/<?php echo article_m::WIDGET_NEWS; ?>";
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {$('.news_list_ajax').html(data);},
            error: function(xhr,status,error){console.log("Error: " + xhr.status + ": " + xhr.statusText);}
        });
    }
</script>
<div class="panel-body">
    <form action="" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputpass">No of News to show</label>
            <div class="col-sm-3">
                <input name="no_of_news_on_home_page" type="number" id="demo-hor-inputpass" class="form-control"
                value="<?php echo get_setting_value('no_of_news_on_home_page')?>" >
            </div>
            <span class="col-offset-2 col-sm-4">
                <input name="news" class="btn btn-success" type="submit" value="Submit">
                <button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
                <a href="#" class="btn btn-success btn-labeled fa fa-plus"
                id="news_add_link"                
                data-toggle="modal"
                data-target="#my_modal_news_add">New</a>
            </span>
        </div>
    </form>
</div>

<hr>
<span class="news_list_ajax"></span>


<!-- add Modal -->
<div class="modal fade" id="my_modal_news_add" tabindex="-1" role="dialog" aria-labelledby="my_modal_news_add" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-lg">
        <div class="modal-content">
            <?php $this->load->view("article/admin/widget/news/ajax/add.php"); ?>
        </div>
    </div>
</div>

<!-- add Modal -->
<div class="modal fade" id="my_modal_news_edit" tabindex="-2" role="dialog" aria-labelledby="my_modal_news_edit" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-lg">
        <div class="modal-content">
            <?php $this->load->view("article/admin/widget/news/ajax/edit.php"); ?>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(function(){

        load_news();

        $('body').on('click','#news_add_link',function(e){
            clear_form('news_add');
            clear_ajax_error_success('news_add','add_error_success');
            $('.news_add .tinymce_wrapper').empty();
            var textarea='<textarea name="content" class="form-control textarea" rows="5" placeholder="content here"></textarea>';
            $('.news_add .tinymce_wrapper').append(textarea);
            $('.news_add .textarea').wysihtml5();

        });

        $('body').on('click','#edit_news_link',function(e){
            e.preventDefault();
            clear_form('news_edit');
            clear_ajax_error_success('news_edit','edit_error_success');
            slug = $(this).attr('data-slug');
            url='<?php echo base_url('article/get/')?>'+'/'+slug+'/json';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { 
                    ajax_effect('news_edit',1);
                },
                success: function(response) {
                    if(response.success){
                        $('.news_edit #id').val(response.data.id);
                        $('.news_edit #slug').val(response.data.slug);
                        $('.news_edit #name').val(response.data.name);
                        $('.news_edit #ckeditor').val(response.data.content);
                        $('.news_edit .tinymce_wrapper').empty();
                        var textarea='<textarea name="content" class="form-control textarea" id="ckeditor" rows="5" placeholder="content here">'+response.data.content+'</textarea>';
                        $('.news_edit .tinymce_wrapper').append(textarea);
                        $('.news_edit .textarea').wysihtml5();
                        //image upload
                        image_path='<?php echo $image=is_picture_exists("articles/".article_m::WIDGET_NEWS."/");?>';
                        image=image_path+response.data.image;
                        $('.news_edit .img-md').attr('src',image);
                    }
                    else{
                        alert(response.data);
                    }
                },
                error: function(xhr,status,error){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                },
                complete: function() { 
                    ajax_effect('news_edit',0);
                },

            });
});


$('body').on('click','#delete_news_link',function(e){
    e.preventDefault();
    url = $(this).attr('href');
    bootbox.confirm("Are you sure?", function(result) {
        if(result){
            url = url;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { ajax_effect('news',1); },
                success: function(response) {
                    if(response.success){
                        alert(response.data);
                        load_news();
                        error_success('news_error_success','danger','yes');
                    }else{
                        alert(response.data);
                    }
                },
                error: function(xhr,status,error){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                },
                complete: function() { ajax_effect('news',0); },

            });
        }
    });
});

});
</script>