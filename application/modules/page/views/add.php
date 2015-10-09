<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Add Page Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="pages">Parent Page</label>
                <select name="pages" id="input" class="form-control capitalize">
                    <option value="">Select</option>
                    <?php foreach ($rows as $row) {?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="page_type">Type</label>
                <select name="page_type" id="input" class="form-control capitalize">
                    <option value="">Select</option>
                    <?php foreach (page_m::page_type() as $key=>$value) {?>
                    <option value="<?php echo $key ?>"><?php echo $value?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" placeholder="Page name here"
                value="<?php echo set_value('name') ?>">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control tinymce" 
                placeholder="Page content here"><?php echo set_value('content'); ?></textarea>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="add" value="Add" class="btn btn-primary"/>
            <a href="<? echo $link ?>" class="btn btn-default"/>Cancel</a>
        </div>
    </div>
</form>


