<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Add Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="student">User</label>
                <textarea name="testimonial" class="form-control"
                placeholder="Testimonial here"><?php echo set_value('testimonial'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="student">Username</label>
                <input name="user" type="text" class="form-control" placeholder="Student Name here"
                value="<?php echo set_value('std_name') ?>">
            </div>
            <div class="form-group">
                <label for="student">Student Email</label>
                <input name="std_email" type="text" class="form-control" placeholder="Student Email here"
                value="<?php echo set_value('std_email') ?>">
            </div>
            <div class="form-group">
                <label for="student">Student Addrress</label>
                <textarea name="std_add" class="form-control"
                placeholder="Testimonial here"><?php echo set_value('std_add') ?></textarea>
            </div>
            <div class="form-group">
                <label for="student">Student Picture</label>
                <input name="std_pic" type="file" class="form-input">
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="add" value="Add" class="btn btn-primary"/>
            <a href="<? //echo $link ?>" class="btn btn-default"/>Cancel</a>
        </div>
    </div>
</form>


