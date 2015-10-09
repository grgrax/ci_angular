
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo isset($category)?$category['name'].' :: ':'';?>Articles</div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="center">s.no</th>
                        <th>name</th>
                        <th>category</th>
                        <th>image</th>
                        <th>date</th>
                        <th>status</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rows && count($rows) > 0) {
                        $c = $offset;
                        foreach ($rows as $row) {
                            $c++;
                            $alertClass="";
                            $actions=array();
                            switch($row['status']){
                                case $article_m::UNPUBLISHED:
                                {
                                    $alertClass="warning";
                                    if(permission_permit(array('activate-article'))) 
                                        $actions=array('publish');
                                    break;
                                }
                                case $article_m::PUBLISHED:
                                {
                                    $alertClass="";
                                    if(permission_permit(array('block-article'))) 
                                        $actions[]='unpublish';
                                    if(permission_permit(array('delete-article'))) 
                                        $actions[]='delete';
                                    break;
                                }
                                case $article_m::BLOCKED:
                                {
                                    $alertClass="warning";
                                    if(permission_permit(array('activate-article'))) 
                                        $actions=array('publish');
                                    break;
                                }
                            }
                            ?>
                            <tr class="<?php echo $alertClass?>">
                                <td class="center"><?php echo $c?></td>
                                <td>
                                    <a href="<?= $link ?>edit/<?= $row['slug'] ?>"/><?= word_limiter(convert_accented_characters($row['name']), 5) ?></a>
                                </td>
                                <td><?php echo $row['category_id']?category_name($row['category_id']):'';?></td>
                                <td>
                                    <?php if($row['image']!="") { ?>
                                    <img src="<?php echo is_picture_exists($article_m::file_path.$row['image']);?>" 
                                    class="img-responsive" width="70" height="30" title=<?php echo $row['image_title']?$row['image_title']:''?>>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['updated_at']?format($row['updated_at'])."<br/>Updated":format($row['created_at'])."<br/>Published";?></td>
                                <td><?php echo $article_m::status($row['status']);?></td>
                                <td>
                                    <?php if(is_default($row['slug'])) continue; ?>
                                    <?php if(permission_permit(array('edit-article'))) { ?>
                                    <!-- <a href="<?= $link ?>view/<?= $row['slug'] ?>"/> View </a> -->
                                    <a href="<?= $link ?>edit/<?= $row['slug'] ?>"/> Edit </a>
                                    <?php if(count($actions)>0) echo "/" ?>
                                    <?php } ?>
                                    <?php foreach ($actions as $k=>$action) { ?>
                                    <a href="<?= $link ?><?= $action ?>/<?= $row['slug'] ?>"/> <?php if($k>0) echo "/"; ?> <?php echo $action?> </a>
                                    <?php } ?>
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
            <?php if(permission_permit(array('add-article'))){?>
            <?php if(isset($category)){?>
            <a href="<?php echo $link."add/category/".$category['slug'];?>" class="btn btn-primary"/>Add New  </a>
            <?php } else{?>
            <a href="<?= $link ?>add" class="btn btn-primary"/>Add New  </a>
            <?php }?>
            <?php } ?>
            <ul class="pagination">
                <?php if (!empty($pages)) echo $pages; ?>
            </ul>
        </div>
    </div>



