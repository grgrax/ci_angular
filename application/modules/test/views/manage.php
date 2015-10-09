<hr/>
<hr/>
<div role="tabpanel">


  <div class="alert alert-success" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span>Alert body ...</span>
  </div>


  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#user" class="class_user" aria-controls="user" role="tab" data-toggle="tab">Users</a></li>
    <li role="presentation"><a href="#group" class="class_group" aria-controls="group" role="tab" data-toggle="tab">Groups</a></li>
    <li role="presentation"><a href="#message" class="class_message" aria-controls="message" role="tab" data-toggle="tab">Messages</a></li>
  </ul>
  

  
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="user">

    </div>
    <div role="tabpanel" class="tab-pane" id="group">

    </div>
    <div role="tabpanel" class="tab-pane" id="message">

    </div>
  </div>

</div>


<script>

  function get_users(){
    url = "<?php echo base_url('test/ajax/user')?>";
    $.get(url, function(data){
      $('#user').html(data);
    });     
  }

  function get_groups(){
    url = "<?php echo base_url('test/ajax/group')?>";
    $.get(url, function(data){
      $('#group').html(data);
    });     
  }

  function get_messages(){
    console.log('get_messages');
    url = "<?php echo base_url('api/article')?>";
    $.get(url, function(data){
      console.log(data);
      $('#message').html(data);
    });     
  }

  $(function(){
    $('.class_user').on("click", function() {
      get_users();
    });

    $('.class_message').on("click", function() {
      get_messages();
    });

    $('.class_group').on("click", function() {
      url = "<?php echo base_url('test/ajax/group')?>";
      $.get(url, function(data){
        $('#group').html(data);
      });     
    });
    get_messages();
  });
</script>

