<script type="text/javascript">
    function load_projects(){
        $('.project_list_ajax').html('');
        url = "<?php echo base_url('article/widget/index/')?>"+"/<?php echo article_m::WIDGET_PROJECT; ?>";
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('.project_list_ajax').html(data);
            },
            error: function(xhr,status,error){
              console.log("Error: " + xhr.status + ": " + xhr.statusText);
          }
      });
    }
</script>
<div class="panel-body">
    <form action="" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="demo-hor-inputpass">No of Project to show</label>
            <div class="col-sm-3">
                <input name="no_of_projects_on_home_page" type="number" id="demo-hor-inputpass" class="form-control"
                value="<?php echo get_setting_value('no_of_projects_on_home_page')?>" >
            </div>
            <span class="col-offset-2 col-sm-4">
                <input name="project" class="btn btn-success" type="submit" value="Submit">
                <button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
                <a href="#" class="btn btn-success btn-labeled fa fa-plus"
                id="project_add_link"
                data-toggle="modal"
                data-target="#my_modal_project_add">New</a>
            </span>
        </div>
    </form>
</div>

<hr>
<span class="project_list_ajax"></span>

<!-- add Modal -->
<div class="modal fade" id="my_modal_project_add" tabindex="-1" role="dialog" aria-labelledby="my_modal_project_add" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-lg">
        <div class="modal-content">
            <?php $this->load->view("article/admin/widget/project/ajax/add.php"); ?>
        </div>
    </div>
</div>

<!-- add Modal -->
<div class="modal fade" id="my_modal_project_edit" tabindex="-2" role="dialog" aria-labelledby="my_modal_project_edit" aria-hidden="true">
    <div class="modal-dialog animated zoomInDown modal-lg">
        <div class="modal-content">
            <?php $this->load->view("article/admin/widget/project/ajax/edit.php"); ?>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(function(){

        load_projects();

        $('body').on('click','#project_add_link',function(e){
            clear_form('project_add');
            clear_ajax_error_success('project_add','add_error_success');
            $('.project_add .tinymce_wrapper').empty();
            var textarea='<textarea name="content" class="form-control textarea" rows="5" placeholder="content here"></textarea>';
            $('.project_add .tinymce_wrapper').append(textarea);
            $('.project_add .textarea').wysihtml5();
        });

        $('body').on('click','#edit_project_link',function(e){
            clear_form('project_edit');
            clear_ajax_error_success('project_edit','edit_error_success');
            e.preventDefault();
            slug = $(this).attr('data-slug');
            url='<?php echo base_url('article/get/')?>'+'/'+slug+'/json';
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { ajax_effect('project_edit',1);},
                complete: function() {ajax_effect('project_edit',0);},
                success: function(response) {
                    if(response.success){
                        $('.project_edit #id').val(response.data.id);
                        $('.project_edit #slug').val(response.data.slug);
                        $('.project_edit #name').val(response.data.name);
                        $('.project_edit #ckeditor').val(response.data.content);
                        $('.project_edit .tinymce_wrapper').empty();
                        var textarea='<textarea name="content" class="form-control textarea" id="ckeditor" rows="5" placeholder="content here">'+response.data.content+'</textarea>';
                        $('.project_edit .tinymce_wrapper').append(textarea);
                        $('.project_edit .textarea').wysihtml5();
                    }
                    else{
                        alert(response.data);
                    }
                },
                error: function(xhr,status,error){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
            });
});


$('body').on('click','#delete_project_link',function(e){
    e.preventDefault();
    url = $(this).attr('href');
    bootbox.confirm("Are you sure?", function(result) {
        if(result){
            url = url;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { ajax_effect('projects',1); },
                complete: function() { ajax_effect('projects',0); },
                success: function(response) {
                    if(response.success){
                        load_projects();
                        alert(response.data);
                        // error_success('project_error_success','danger','yes');
                    }else{
                        alert(response.data);
                    }
                },
                error: function(xhr,status,error){
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
            });
        }
    });
});
});

</script>