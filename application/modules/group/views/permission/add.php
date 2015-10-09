<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Add New</div>
        <div class="panel-body">
            <?php if(isset($parent_permission) && $parent_permission){?>
            <div class="form-group">
                <label for="name">Parent Permission</label>
                <input name="parent_permission_id" type="hidden" class="form-control" readonly
                value="<?php echo $parent_permission['id'] ?>">
                <input name="parent_permission_name" type="text" class="form-control" readonly
                value="<?php echo $parent_permission['name']?>">
            </div>
<!--             <div class="form-group">
                <label for="group">Parent Permission</label>
                <select name="group" id="input" class="form-control capitalize">
                    <option value="">Select</option>
                    <?php foreach ($permissions as $permission) {?>
                    <option value="<?php echo $permission['id'] ?>"><?php echo $permission['name']?></option>
                    <?php } ?>
                </select>
            </div>           
        -->            <?php } ?>
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
        <input type="submit" name="add" value="Add" class="btn btn-primary"/>
        <a href="<? echo $url ?>" class="btn btn-default"/>Cancel</a>
    </div>
</div>
</form>


