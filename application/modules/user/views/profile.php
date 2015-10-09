<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Change Profile Details</div>
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
                <label for="student">First Name</label>
                <input name="first_name" type="text" class="form-control" placeholder="First name here"
                value="<?php echo set_value('first_name',$row['first_name']) ?>">
            </div>
            <div class="form-group">
                <label for="student">Last Name</label>
                <input name="last_name" type="text" class="form-control" placeholder="Last name here"
                value="<?php echo set_value('last_name',$row['last_name']) ?>">
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
            <input type="submit" name="add" value="Edit" class="btn btn-success"/>
            <a href="<? echo $url ?>" class="btn btn-warning"/>Cancel</a>
        </div>
    </div>
</form>


