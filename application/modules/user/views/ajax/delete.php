<form method="post" action="<?php echo base_url('user/manage/delete/'.$row['id'])?>" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Delete Details</div>
        <div class="panel-footer">
            <input type="submit" name="delete" value="Yes" class="btn btn-danger"/>
            <a href="<? echo $url ?>" / class="btn btn-info">Cancel</a>            
        </div>
    </div>
</form>


