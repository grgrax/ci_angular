<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        Articles
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
                        <td class="col-lg-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select id="category_id" class="form-control" name="category_id">
                                    <option value="">Select</option>
                                    <?php foreach ($categories as $category) { ?>
                                    <?php if(is_default_category($category['slug'])) continue; ?>
                                    <option value="<?=$category['id']?>"<?php echo $this->input->get('category_id')==$category['id']?'selected':'';?>>
                                        <?=my_word_limiter($category['name'])?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                        <td class="col-lg-3">
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
                        <td class="col-lg-3">
                            <div class="form-group">
                                <label>Article Name</label>
                                <div class="controls">
                                    <input type="text" name="name" id="name"  data-required="1" 
                                    class="form-control" placeholder="Article Name here"
                                    value="<?=$this->input->get('name')?:''?>">
                                </div>
                            </div>
                        </td>
                        <td class="col-lg-3">
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
                    <th>category</th>
                    <?php echo !isset($category)?'':"<th>image</th>";?>
                    <th>Order</th>                    
                    <th>date</th>
                    <!-- <th>status</th> -->
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rows && count($rows) > 0) {
                    $c = $offset;
                    foreach ($rows as $row) {
                        if(is_default_category($row['category_slug'])) continue;
                        $c++;
                        $alertClass="";
                        $actions=array();
                        switch($row['status']){
                            case article_m::UNPUBLISHED:
                            {
                                $alertClass="warning";
                                if(permission_permit(array('activate-article'))) 
                                    $actions=array('publish');
                                break;
                            }
                            case article_m::PUBLISHED:
                            {
                                $alertClass="";
                                if(permission_permit(array('block-article'))) 
                                    $actions[]='unpublish';
                                if(permission_permit(array('delete-article'))) 
                                    $actions[]='delete';
                                break;
                            }
                            case article_m::BLOCKED:
                            {
                                $alertClass="warning";
                                if(permission_permit(array('activate-article'))) 
                                    $actions=array('publish');
                                break;
                            }
                        }
                        ?>
                        <tr class="<?php echo $alertClass?>">
                            <td class="center"><?php echo $row['id']?></td>
                            <td>
                                <?= word_limiter(convert_accented_characters($row['name']), 5) ?>
                                <br><br>
                                <b>by <?php echo $row['username'];?> </b>
                            </td>
                            <td><?php echo $row['category_name'];?></td>
                            <td>
                                <?php if($row['image']!="") { ?>
                                <?php $image=is_picture_exists(article_m::file_path.$row['image']); ?>
                                <?php if($image){?>
                                <img src="<?php echo is_picture_exists(article_m::file_path.$row['image']);?>" 
                                class="img-responsive" width="70" height="30" title=<?php echo $row['image_title']?$row['image_title']:''?>>
                                <?php } else{ ?>
                                <?php /*
                                <img src="<?php echo base_url('templates/assets/media/images/no_image_found.jpg')?>" 
                                class="img-responsive" width="70" height="30" title=<?php echo $row['image_title']?$row['image_title']:''?>>
                                <?php */ ?>
                                <?php } ?>
                                <?php } ?>
                            </td>
                            <td class="center"><?php echo $row['order']?:'N/A'?></td>
                            <td><?php echo $row['updated_at']?format($row['updated_at'])."<br/>Updated":format($row['created_at']);?></td>
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



