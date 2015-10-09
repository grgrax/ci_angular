<form method="post" action="<?php echo base_url('user/manage/index/'.$row['id'])?>" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="student">Username</label>
                <input name="username" type="text" class="form-control" placeholder="Username here"
                value="<?php echo set_value('username',$row['username']) ?>">
            </div>
            <div class="form-group">
                <label for="student">Email Address</label>
                <input name="email" type="text" class="form-control" placeholder="Email here"
                value="<?php echo set_value('email',$row['email']) ?>">
            </div>
            <div class="form-group">
                <label for="student">New Password</label>
                <input name="password" type="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="student">Confirm Password</label>
                <input name="confirm_password" type="password" class="form-control">
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="edit" value="Edit" class="btn btn-primary"/>
            <a href="<? echo $url ?>" / class="btn btn-info">Cancel</a>            
        </div>
    </div>
</form>


