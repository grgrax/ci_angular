<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="input" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($actions as $k => $v) {if($row['status']!=$page_m::PENDING && $k==$page_m::PENDING) continue?>
                        <option value="<?php echo $k ?>" <?php echo $k==$row['status']?'selected':'';?>><?php echo $v ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="name">Name</label>
                    <input name="name" class="form-control"
                    placeholder="page name here" value="<?php echo set_value('name', $row['name']); ?>"/>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control tinymice"
                    placeholder="page content here"><?php echo set_value('content', $row['content']); ?></textarea>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" name="update" value="Update" class="btn btn-primary"/>
                <a href="<?= $link ?>" class="btn btn-default"/>Cancel</a>
            </div>
        </div>
    </form>


