<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">Add Setting Details</div>
    <div class="panel-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" placeholder="name here"
        value="<?php echo set_value('name') ?>">
      </div>
      <div class="form-group">
        <label for="value">Value</label>
        <input name="value" type="text" class="form-control" placeholder="value here"
        value="<?php echo set_value('name') ?>">
      </div>
      <div class="panel-footer">
        <input type="submit" name="add" value="Add" class="btn btn-primary"/>
        <a href="<? echo $link ?>" class="btn btn-default"/>Cancel</a>
      </div>
    </div>
  </form>



