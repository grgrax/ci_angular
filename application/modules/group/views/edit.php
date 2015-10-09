<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Group Details</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="input" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($actions as $k => $v) {if($row['status']!=$group_m::PENDING && $k==$group_m::PENDING) continue?>
                        <option value="<?php echo $k ?>" <?php echo $k==$row['status']?'selected':'';?>><?php echo $v ?></option>
                        <?php } ?>
                    </select>
                </div>
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
                <input type="submit" name="update" value="Update" class="btn btn-success"/>
                <a href="<?= $url ?>" class="btn btn-warning"/>Cancel</a>
            </div>
        </div>
    </form>


