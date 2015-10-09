<form method="post" action="" enctype="multipart/form-data" >
    <div class="panel panel-default">
        <div class="panel-heading">Add New</div>    
        <div class="panel-body">
            <div class="form-group">
                <label for="group">Parent Group</label>
                <select name="group" id="input" class="form-control capitalize">
                    <option value="">Select</option>
                    <?php foreach ($groups as $group) {?>
                    <option value="<?php echo $group['id'] ?>"><?php echo $group['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" placeholder="Name"
                value="<?php echo set_value('name') ?>">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea name="desc" class="form-control"
                placeholder="Description"><?php echo set_value('desc') ?></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="add" value="Add" class="btn btn-success"/>
            <a href="<? echo $url ?>" class="btn btn-warning"/>Cancel</a>
        </div>
    </div>
</form>





