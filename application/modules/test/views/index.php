<hr/>
<hr/>
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#user" class="class_user" aria-controls="user" role="tab" data-toggle="tab">Users</a></li>
    <li role="presentation"><a href="#group" class="class_group" aria-controls="group" role="tab" data-toggle="tab">Groups</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="user">

    </div>
    <div role="tabpanel" class="tab-pane" id="group">

    </div>
  </div>

</div>


<script>
  $(function(){
    $('.class_user').on("click", function() {
      get_users();
    });

    get_users();

    function get_users(){
      url = "<?php echo base_url('test/ajax/user')?>";
      $.post(url, function(data){
        console.log(data);
        $('#user').html(data);
      });     
    }
    
  });
</script>

