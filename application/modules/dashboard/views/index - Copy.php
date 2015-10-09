
<!--Tiles - Bright version-->
<!--===================================================-->
<div class="row">


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
  <a href="<?php echo base_url('campaign/admin'); ?>" style="display:block">
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

        <!--Comments-->
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



    <!--Modal body-->
    <span>
      <form method="post" enctype="multipart/form-data" class="col-md-12" id="ajax_form">
        <div class="form-group">
          <label class="col-sm-3 control-label" for="demo-hor-inputpass">Message Title</label>
          <div class="col-sm-9">
            <input name="name" type="text" placeholder="Tilte" id="demo-hor-inputpass" class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label" for="demo-hor-inputemail">By</label>
          <div class="col-sm-9">
            <input name="club_name" type="text" placeholder="By" id="club_name" class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label" for="demo-hor-inputemail">Post</label>
          <div class="col-sm-9">
            <input name="post" type="text" placeholder="Post here" id="post" class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label" for="demo-hor-inputemail">Working Year</label>
          <div class="col-sm-9">
            <input name="post" type="text" placeholder="Working Year here" id="post" class="form-control">
          </div>
        </div>
      </div>
      <input type="submit" name="add" value="Submit" class="btn btn-primary"/>
      <button data-dismiss="modal" class="btn btn-warning" type="button">Cancel</button>
    </form>
  </span>

  <script>
    $(function(){


      $("#ajax_form").submit(function(e) {
        e.preventDefault();
        url = "<?php echo base_url('api/pub/category')?>";
        // url = "<?php echo site_url('api/article/add')?>";
        form_data = $(this).serialize();
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
          data: form_data,
          success: function(data) {
            console.log(data);
            if(data.status=='success'){           
              $('#myModalGroupAdd').modal('hide');
              $('.alert-success span').html(data.message);
              $('.alert-success').show();
              get_groups();           
            }
            else if(data.status=='error'){
              div='<div class="alert alert-danger" alert-dismissible>';
              div+='<button type="button" class="close" data-dismiss="alert">';
              div+='<span aria-hidden="true">&times;</span>';
              div+='<span class="sr-only">Close</span>';
              div+='</button>';

              div+='<span id="error">'+data.message+'</span>';
              div+='</div>';
              $('#myModalGroupAdd #error').html(div);
            }
          },
          error: function(xhr,status,error){
            console.log("Error: " + xhr.status + ": " + xhr.statusText);
          }
        });
});

    //delete



    // $("#ajax_form").submit(function(e) {
    //   e.preventDefault();
    //   url = "<?php echo site_url('api/article/index')?>";
    //   form_data = $(this).serialize();
      
    //   $.ajax({ 

    //     type:"POST",  
    //     url: url,
    //     data: form_data,
    //     dataType: "json",
    //     success: function(data) {
    //       console.log(data)  
    //     },
    //     error: function(xhr,status,error){
    //       console.log("Error "+xhr.status+ ": "+xhr.statusText);
    //     }  
    //   }); 

    // });


  });
</script>

<style>
  form{
    background-color: white;
    width: 100%;
  }
</style>


<?php //$this->load->view("setting/partials/dashboard.php"); ?>







