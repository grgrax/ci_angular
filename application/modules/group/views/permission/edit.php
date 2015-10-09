<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Add Permission Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" placeholder="Name"
                value="<?php echo set_value('name',$row['name']) ?>">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="desc" class="form-control"
                placeholder="Description"><?php echo set_value('desc',$row['desc']) ?></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="update" value="Update" class="btn btn-primary"/>
            <a href="<?= $url ?>" class="btn btn-default"/>Cancel</a>
        </div>
    </div>
</form>


