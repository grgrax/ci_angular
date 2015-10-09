<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Add New</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="group">Group</label>
                <select name="group" id="input" class="form-control capitalize">
                    <option value="">Select</option>
                    <?php foreach ($groups as $group) {?>
                    <option value="<?php echo $group['id'] ?>"><?php echo $group['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="student">Username</label>
                <input name="username" type="text" class="form-control" placeholder="Username here"
                value="<?php echo set_value('username') ?>">
            </div>
            <div class="form-group">
                <label for="student">Email Address</label>
                <input name="email" type="text" class="form-control" placeholder="Email here"
                value="<?php echo set_value('email') ?>">
            </div>
            <div class="form-group">
                <label for="student">New Password</label>
                <input name="password" type="password" class="form-control" >
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="add" value="Add" class="btn btn-primary"/>
            <a href="<? echo $url ?>" / class="btn btn-info">Cancel</a>            
        </div>
    </div>
</form>


