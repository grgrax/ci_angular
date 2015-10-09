<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Add New</div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="text">Username</label>
                    <input name="username" type="text" class="form-control" placeholder="Username here"
                    value="<?php echo set_value('username') ?>">
                </div>
                <div class="form-group">
                    <label for="text">Email Address</label>
                    <input name="email" type="text" class="form-control" placeholder="Email here"
                    value="<?php echo set_value('email') ?>">
                </div>
                <div class="form-group">
                    <label for="text">First Name</label>
                    <input name="first_name" type="text" class="form-control" placeholder="First name here"
                    value="<?php echo set_value('first_name') ?>">
                </div>
                <div class="form-group">
                    <label for="text">Last Name</label>
                    <input name="last_name" type="text" class="form-control" placeholder="Last name here"
                    value="<?php echo set_value('last_name') ?>">
                </div>
                <div class="form-group">
                    <label for="text">Password</label>
                    <input name="password" type="password" class="form-control" >
                </div>
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                    <label for="text">Bank Information</label>
                    <label for="text" class="form-control text-success">Fill donee bank details</label>
                </div>
                <div class="form-group">
                    <label for="text">BSB</label>
                    <input name="bsb" type="text" class="form-control" placeholder="BSB here"
                    value="<?php echo set_value('bsb') ?>">
                </div>
                <div class="form-group">
                    <label for="text">Bank</label>
                    <input name="bank" type="text" class="form-control" placeholder="Bank here"
                    value="<?php echo set_value('bank') ?>">
                </div>
                <div class="form-group">
                    <label for="text">Account Number</label>
                    <input name="account_number" type="text" class="form-control" placeholder="Account Number here"
                    value="<?php echo set_value('account_number') ?>">
                </div>
                <div class="form-group">
                    <label for="text">Account Holder Name</label>
                    <input name="account_holder_name" type="text" class="form-control" placeholder="Account holder name here"
                    value="<?php echo set_value('account_holder_name') ?>">
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="add" value="Add" class="btn btn-success"/>
            <a href="<? echo $link ?>" class="btn btn-warning"/>Cancel</a>
        </div>
    </div>
</form>


