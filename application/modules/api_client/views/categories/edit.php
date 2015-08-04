<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="parent_id">Parent category</label>
                <select name="parent_id" id="input" class="form-control capitalize">
                    <option value="">Select</option>
                    <?php foreach ($rows as $r) {?>
                    <option value="<?php echo $r['id'] ?>" <?php echo $r['id'] == $row['parent_id']?"selected":'';?>><?php echo $r['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" placeholder="category name here"
                value="<?php echo set_value('name',$row['name']) ?>" <?php echo is_default($row['slug'])?'readonly':''?>>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="ckeditor" 
                placeholder="category content here"><?php echo set_value('content',$row['content']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <?php if($row['image']) { ?>
                <div class="thumbnail">
                    <img src="<?php echo is_picture_exists($category_m::file_path.$row['image']);?>" 
                    class="img-responsive" width="70" height="30" title=<?php echo $row['image_title']?$row['image_title']:''?>>
                </div>
                <?php } ?>
                <input name="image" type="file" class="form-input"><br/>
                <label for="image_title">Image title</label>
                <input name="image_title" type="text" class="form-control" placeholder="Image title here"
                value="<?php echo set_value('image_title', $row['image_title']); ?>"/>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input name="url" type="text" class="form-control" placeholder="url here"
                value="<?php echo set_value('url',$row['url']) ?>">
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="edit" value="Edit" class="btn btn-primary"/>
            <a href="<? echo $link ?>" class="btn btn-default"/>Cancel</a>
        </div>
    </div>
</form>


