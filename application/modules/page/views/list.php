<div class="panel panel-default">
    <div class="panel-heading">Pages</div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th class="center">s.no</th>
                    <th>name</th>
                    <th>parent menu</th>
                    <th>type</th>
                    <th width="10%">content</th>
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
                            case $page_m::PENDING:
                            {
                                $alertClass="";
                                if(permission_permit(array('activate-page'))) 
                                    $actions=array('activate');
                                break;
                            }
                            case $page_m::ACTIVE:
                            {
                                $alertClass="";
                                if(permission_permit(array('block-page'))) 
                                    $actions[]='block';
                                if(permission_permit(array('delete-page'))) 
                                    $actions[]='delete';
                                break;
                            }
                            case $page_m::BLOCKED:
                            {
                                $alertClass="warning";
                                if(permission_permit(array('activate-page'))) 
                                    $actions[]='activate';
                                if(permission_permit(array('delete-page'))) 
                                    $actions[]='delete';
                                break;
                            }
                            case $page_m::DELETED:
                            {
                                $alertClass="danger";
                                if(permission_permit(array('activate-page'))) 
                                    $actions=array('activate');
                                break;
                            }
                        }
                        ?>
                        <tr class="<?php echo $alertClass?>">
                            <td class="center"><?php echo $c?></td>
                            <td>
                                <a href="<?= $link ?>edit/<?= $row['id'] ?>"/><?= word_limiter(convert_accented_characters($row['name']), 5) ?></a>
                            </td>
                            <td><?php echo $row['parent_page_id']?$page_m->get_parent_name($row['parent_page_id']):'---';?></td>
                            <td><?php echo page_m::page_type($row['type']) ?></td>
                            <td><?= word_limiter(convert_accented_characters($row['content']), 5) ?></td>
                            <td><?php echo page_m::status($row['status']);?></td>
                            <td>
                                <?php if(permission_permit(array('edit-page'))) { ?>
                                    <a href="<?= $link ?>edit/<?= $row['id'] ?>"/>Edit </a>
                                    <?php if(count($actions)>0) echo "/" ?>
                                <?php } ?>
                                <?php foreach ($actions as $k=>$action) { ?>
                                <a href="<?= $link ?><?= $action ?>/<?= $row['id'] ?>"/> <?php if($k>0) echo "/"; ?> <?php echo $action?> </a>
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
        <?php if(permission_permit(array('add-page'))){?>
        <a href="<?= $link ?>add" class="btn btn-primary"/>Add New  </a>
        <?php } ?>
        <?php if(permission_permit(array('add-page'))){?>
            <a href="<?= $link ?>order" class="btn btn-primary"/>Order Pages</a>
        <?php } ?>
        <ul class="pagination">
            <? if (!empty($pages)) echo $pages; ?>
        </ul>
    </div>
</div>

