
<!--Tiles - Bright version-->
<!--===================================================-->
<div class="row">

  <a href="<?php echo base_url('category'); ?>" style="display:block">
    <div class="col-md-6 col-lg-3">
      <!--Registered User-->
      <div class="panel media pad-all">
        <div class="media-left">
          <span class="icon-wrap icon-wrap-sm icon-circle bg-success">
            <i class="fa  fa-list-ul  fa-2x"></i>
          </span>
        </div>
        <div class="media-body">
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
            <i class="fa fa-newspaper-o fa-2x"></i>
          </span>
        </div>
        <div class="media-body">
          <p class="text-muted mar-no">Articles</p>
        </div>
      </div>
    </div>
  </a>



  <a href="<?php echo base_url('menu'); ?>" style="display:block">
    <div class="col-md-6 col-lg-3">
      <!--New Order-->
      <div class="panel media pad-all">
        <div class="media-left">
          <span class="icon-wrap icon-wrap-sm icon-circle bg-info">
            <i class="fa fa-navicon fa-2x"></i>
          </span>
        </div>
        <div class="media-body">
          <p class="text-muted mar-no">Menu</p>
        </div>
      </div>
    </div>
  </a>


  <a href="<?php echo base_url('plugin/filemanager'); ?>" style="display:block" target="_blank">
    <div class="col-md-6 col-lg-3" id="ram">
      <!--Sales-->
      <div class="panel media pad-all">
        <div class="media-left">
          <span class="icon-wrap icon-wrap-sm icon-circle bg-success">
            <i class="fa fa-file-image-o fa-2x"></i>
          </span>
        </div>
        <div class="media-body">
          <p class="text-muted mar-no">File Manager</p>
        </div>
      </div>
    </div>
  </div>
</a>


<!-- add Modal -->
<div class="modal fade" id="my_modal_filemanager" tabindex="-1" role="dialog" aria-labelledby="my_modal_filemanager" aria-hidden="true">
  <div class="modal-dialog animated zoomInDown modal-lg">
    <div class="modal-content">
    </div>
  </div>
</div>
<!--===================================================-->
<!--End Tiles - Bright version-->


<?php $this->load->view("setting/partials/dashboard.php"); ?>


