 <script src="jquery.js"></script>

 <div class="row">
  <form method="post" action="" enctype="multipart/form-data" id="msform" class="form-inline">
    <div class="col-md-6">
      <div class="row">
        <label for="photo">Photo Upload:</label>
        <a href="#" id="add_more">Add more</a>
        <a href="#" id="remove_all">Remove all</a>        
      </div>
      <div class="form-group">
        <input type="file" class="file" name="photos[]">
      </div>
    </div>
    <input type="submit" class="submit action-button" value="Finish" name="submit">
  </form>
</div>

<script type="text/javascript">
  $(function(){

    $('#add_more').click(function(e){
      e.preventDefault();
      var section='<div class="form-group">';
      section+='<input type="file" class="file" name="photos[]">';
      section+='<a href="#" class="remove">remove</a>';
      section+='</div>';
      $('.form-group:last').after(section);
      console.log(this);
    });

    $('#remove_all').click(function(e){
      e.preventDefault();
      $("div.form-group:not(:first)").remove();
    });

    $( "body" ).on( "click", "a.remove", function(e) {
      e.preventDefault();
      $(this).parent().remove();
    });

  });
</script>
