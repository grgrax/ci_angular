
<!--Tiles - Bright version-->
<!--===================================================-->
<div class="row">
<?php /*

  <a href="<?php echo base_url('user/donee'); ?>" style="display:block">

    <div class="col-md-6 col-lg-3">

      <!--Registered User-->
      <div class="panel media pad-all">
        <div class="media-left">
          <span class="icon-wrap icon-wrap-sm icon-circle bg-success">
            <i class="fa fa-user fa-2x"></i>
          </span>
        </div>

        <div class="media-body">
          <p class="text-2x mar-no text-thin">

            <?php 
            $param['module']='donee'; 
           // echo show_total($param);
            ?>


          </p>
          <p class="text-muted mar-no">Categories</p>
        </div>

      </div>

    </div>
  </a>
  <a href="<?php echo base_url('article'); ?>" style="display:block">
    <div class="col-md-6 col-lg-3">

      <!--New Order-->
      <div class="panel media pad-all">
        <div class="media-left">
          <span class="icon-wrap icon-wrap-sm icon-circle bg-info">
            <i class="fa fa-shopping-cart fa-2x"></i>
          </span>
        </div>

        <div class="media-body">

          <p class="text-2x mar-no text-thin"><?php 
            $param['module']='campaign'; 
          //  echo show_total($param);
            ?></p>
            <p class="text-muted mar-no">Articles</p>
          </div>
        </div>

      </div>
    </a>
    <a href="<?php echo base_url('campaign/admin'); ?>" style="display:block">
      <div class="col-md-6 col-lg-3">

        Comments
        <div class="panel media pad-all">
          <div class="media-left">
            <span class="icon-wrap icon-wrap-sm icon-circle bg-warning">
              <i class="fa fa-comment fa-2x"></i>
            </span>
          </div>

          <div class="media-body">
            <p class="text-2x mar-no text-thin"><?php 
              $param['module']='fund_category'; 
              //echo show_total($param);
              ?>
            </p>
            <p class="text-muted mar-no">Categories</p>

          </div>
        </div>

      </div>
    </a>
    <a href="<?php echo base_url('campaign/admin'); ?>" style="display:block">
      <div class="col-md-6 col-lg-3">

        <!--Sales-->
        <div class="panel media pad-all">
          <div class="media-left">
            <span class="icon-wrap icon-wrap-sm icon-circle bg-danger">
              <i class="fa fa-dollar fa-2x"></i>
            </span>
          </div>

          <div class="media-body">

            <p class="text-2x mar-no text-thin"><?php 
              $param['module']='donation'; 
              //echo show_total($param);
              ?></p>
              <p class="text-muted mar-no">Donation</p>

            </div>
          </div>

        </div>
      </div>
    </a>
    <!--===================================================-->
    <!--End Tiles - Bright version-->

    <br>


    <?php //$this->load->view("setting/partials/dashboard.php"); ?>
    */ ?>


    <form method="post" action="" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-body">         


          <div class="form-group">
            <textarea id="mytextarea"></textarea>
          </div>

        </div>

        <div class="panel-footer">
          <input type="submit" name="add" value="Add" class="btn btn-primary"/>
        </div>
      </div>
    </form>





    <script>
      // CKEDITOR.replace( 'ckeditor', {
      //   customConfig: 'web/custom/custom_config.js'
      // } );
    </script>


    <script type="text/javascript">
      tinymce.init({
        selector: "#mytextarea",
        fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 30pt 36pt 40pt",
        theme: "modern",
            // width: 300,
            height: 400,
            menubar: true,
            browser_spellcheck : true,
            codemirror: {
              path: '../../../codemirror',
              indentOnInit: true,
              extraKeys: {
                'Ctrl-Space': 'autocomplete'
              },
              config: {
                lineNumbers: true,
              }
            },
            image_advtab: true,
            // content_css: "css/tinymce.css",
            content_css: "<?php echo base_url('templates/assets/editor/css/tinymce.css')?>",
            plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code codemirror fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
            ],
            toolbar: "fullscreen | undo redo | fullpage | styleselect fontselect fontsizeselect | forecolor backcolor emoticons | bold italic underline | strikethrough superscript subscript | fontsize | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code preview print", 
            external_filemanager_path:"<?php echo base_url().'plugin/filemanager/'?>",
            // external_filemanager_path:"http://localhost/cel/2015/aug/prac/editor/filemanager/",
            filemanager_title:"Filemanager" ,
            // external_plugins: { "filemanager" : "http://localhost/cel/2015/aug/prac/editor/filemanager/plugin.min.js"},
            external_plugins: { "filemanager" : "<?php echo base_url().'templates/assets/editor/filemanager/plugin.min.js'?>" },

            style_formats: [
            {title: 'Heading 1', block: 'h1'},
            {title: 'Heading 2', block: 'h2'},
            {title: 'Heading 3', block: 'h3'},
            {title: 'Heading 4', block: 'h4'},
            {title: 'Heading 5', block: 'h5'},
            {title: 'Heading 6', block: 'h6'},
            {title: 'Blockquote', block: 'blockquote', styles: {color: '#333'}},
            {title: 'Pre Formatted', block: 'pre'},
            {title: 'code', block: 'pre', classes: 'code'},
            ],
            relative_urls: false,
            remove_script_host : true
          });

        </script>






