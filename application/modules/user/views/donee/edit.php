<?php 
$this->load->helper('signup/signup');
$bank_details=get_bank_details(array('user_id'=>$row['id']));
// show_pre($bank_details);
$bank_details['id']=isset($bank_details['id'])?$bank_details['id']:'';
$bank_details['bsb']=isset($bank_details['bsb'])?$bank_details['bsb']:'';
$bank_details['bank_name']=isset($bank_details['bank_name'])?$bank_details['bank_name']:'';
$bank_details['acc_no']=isset($bank_details['acc_no'])?$bank_details['acc_no']:'';
$bank_details['acc_holder_name']=isset($bank_details['acc_holder_name'])?$bank_details['acc_holder_name']:'';

?>

<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Details</div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="text">Username</label>
                    <input name="username" type="text" class="form-control" placeholder="Username here"
                    value="<?php echo set_value('username',$row['username']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">Email Address</label>
                    <input name="email" type="text" class="form-control" placeholder="Email here"
                    value="<?php echo set_value('email',$row['email']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">First Name</label>
                    <input name="first_name" type="text" class="form-control" placeholder="First name here"
                    value="<?php echo set_value('first_name',$row['first_name']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">Last Name</label>
                    <input name="last_name" type="text" class="form-control" placeholder="Last name here"
                    value="<?php echo set_value('last_name',$row['last_name']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">New Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="text">Confirm Password</label>
                    <input name="confirm_password" type="password" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="text">Bank Information</label>
                    <span class="form-control disabled"># 
                        <?php echo $bank_details['id']?$bank_details['id']:'N/A'; ?>
                    </span>
                </div>
                <div class="form-group">
                    <input type="hidden" name="bank_id" value="<?php echo set_value('bank_id',$bank_details['id']) ?>">
                    <label for="text">BSB</label>
                    <input name="bsb" type="text" class="form-control" placeholder="BSB here"
                    value="<?php echo set_value('bsb',$bank_details['bsb']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">Bank</label>
                    <input name="bank" type="text" class="form-control" placeholder="Bank here"
                    value="<?php echo set_value('bank',$bank_details['bank_name']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">Account Number</label>
                    <input name="account_number" type="text" class="form-control" placeholder="Account Number here"
                    value="<?php echo set_value('account_number',$bank_details['acc_no']) ?>">
                </div>
                <div class="form-group">
                    <label for="text">Account Holder Name</label>
                    <input name="account_holder_name" type="text" class="form-control" placeholder="Account holder name here"
                    value="<?php echo set_value('account_holder_name',$bank_details['acc_holder_name']) ?>">
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="add" value="Edit" class="btn btn-success"/>
            <a href="<? echo $link ?>" class="btn btn-warning"/>Cancel</a>
        </div>
    </div>
</form>


