    <div class="panel panel-default">
        <div class="panel-heading">
            Categories
            <span class="pull-right">
                <?php if(permission_permit(array('add-fund-category'))){?>
                <span class="col-lg-3">
                    <a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
                </span>
                <?php } ?>
            </span>
        </div>
        <div class="panel-body">

            <!-- filter -->
            <form action="" method="GET" role="form">
                <table class="table filter">            
                    <tbody>
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <div class="controls">
                                        <input type="text" name="name" id="name"  data-required="1" 
                                        class="form-control" placeholder="Category Name here"
                                        value="<?=$this->input->get('name')?:''?>">
                                    </div>
                                </div>
                            </td>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label>Author</label>
                                    <select id="author" class="form-control" name="author">
                                        <option value="">Select</option>                                        
                                        <?php foreach (get_users_n() as $user) { ?>
                                        <option value="<?=$user['id']?>"
                                            <?php echo $this->input->get('author')==$user['id']?'selected':'';?>
                                            >
                                            <?=$user['username']?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td class="col-lg-2">
                                <div class="form-group pull-right">
                                    <br>
                                    <br>
                                    <div class="controls">
                                        <input type="submit" class="btn btn-info" name="filter" value="Filter">
                                        <a href="<?=$link?>" class="btn btn-warning">Reset</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <!-- filter -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>name</th>
                        <th width="35%">content</th>
                        <th>image</th>
                        <th>date</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($rows && count($rows) > 0) {
                        $c = $offset;
                        foreach ($rows as $row) {

                            if(is_default_category($row['slug'])) continue;
                            
                            $c++;
                            $alertClass="";
                            $actions=array();
                            switch($row['status']){
                                case category_m::UNPUBLISHED:
                                {
                                    $alertClass="warning";
                                    if(permission_permit(array('activate-category'))) 
                                        $actions=array('publish');
                                    break;
                                }
                                case category_m::PUBLISHED:
                                {
                                    $alertClass="";
                                    if(permission_permit(array('block-category'))) 
                                        $actions[]='unpublish';
                                    if(permission_permit(array('delete-category'))) 
                                        $actions[]='delete';
                                    break;
                                }
                            }
                            ?>
                            <tr class="<?php echo $alertClass?>">
                                <td class="center"><?php echo $row['id']?></td>
                                <td>
                                    <?= word_limiter(convert_accented_characters($row['name']), 5) ?>
                                    <br>
                                    <b>by <?php echo $row['username']?></b>
                                </td>
                                <td><?= word_limiter(convert_accented_characters($row['content']), 5) ?></td>
                                <td>
                                    <?php if($row['image']!="") { ?>
                                    <img src="<?php echo is_picture_exists(category_m::file_path.$row['image']);?>" 
                                    class="img-responsive" width="70" height="30" title=<?php echo $row['image_title']?$row['image_title']:''?>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['updated_at']?format($row['updated_at'])."<br/><b>Updated</b>":format($row['created_at']);?></td>
                                <td>
                                    <?php //if(is_default($row['slug'])) continue; ?>
                                    <a href="<?= $link ?>edit/<?= $row['slug'] ?>" 
                                        class="btn btn-sm btn-default btn-icon btn-hover-success add-tooltip fa fa-pencil" 
                                        data-toggle="tooltip" 
                                        data-original-title="Edit" >
                                    </a>
                                    <a href="<?=$link.'/delete/'.$row['slug'].'/1' ?>" 
                                        class="btn btn-sm btn-icon add-tooltip btn-danger fa fa-times delete" 
                                        data-toggle="tooltip" 
                                        data-original-title="Delete"
                                        data-container="body"/>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="td_no_data">No data</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
         <span class="pull-left">
            <?php if(permission_permit(array('add-fund-category'))){?>
            <span class="col-lg-3">
                <a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
            </span>
            <?php } ?>
        </span>
        <ul class="pagination">
            <?php if (!empty($pages)) echo $pages; ?>
        </ul>
    </div>
</div>



