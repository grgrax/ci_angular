<?php 
$CI =& get_instance();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Menus
        <span class="pull-right">
            <?php if(permission_permit(array('add-fund-category'))){?>
            <span class="col-md-12 col-lg-12">
                <a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
                <a href="<?= $link ?>order" class="btn btn-default"/>Order menus</a>
            </span>
            <?php } ?>
        </span>
    </div>
    <div class="panel-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>type</th>
                    <th>url</th>
                    <th width="20%">content</th>
                    <th>sidebar</th>
                    <th>status</th>
                    <th>date</th>
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
                        ?>
                        <tr class="<?php echo $alertClass?>">
                            <td class="center"><?php echo $row['id']; //echo '--'.menu_m::status($row['status'])?></td>
                            <td>
                                <?= word_limiter(convert_accented_characters($row['name']), 5) ?>                               
                            </td>
                            <td><?php echo ucfirst($row['page_type'])?></td>                            
                            <td><?php echo $row['url']?></td>                            
                            <td>
                                <b><i>                                
                                    <?php 
                                    if($row['category_id'] && $row['page_type']=='category'){
                                        $category=get_categories(array('id'=>$row['category_id']),1);
                                        if($category){
                                        // show_pre($category);
                                            echo anchor(base_url('category/edit/'.$category['slug']), $category['name'], array('title'=>'Edit category '.$category['name'],'class'=>'text text-success'));                                        
                                        }
                                    }elseif($row['article_id'] && $row['page_type']=='article'){
                                        $article=get_article(array('id'=>$row['article_id']),1);
                                        if($article){
                                        // show_pre($article);
                                            echo anchor(base_url('article/edit/'.$article['slug']),  $article['name'], array('title'=>'Edit article '.$article['name'],'class'=>'text text-success'));
                                        }
                                    }
                                    ?>
                                </i></b>
                            </td>                            
                            <td>
                                <?php 
                                if(isset($row['sidebar']) && $row['sidebar']){
                                    echo $row['sidebar']==menu_m::SIDEBAR_YES?'Yes':'No';
                                }else{
                                    echo 'N/A';
                                }
                                ?>                                
                            </td>
                            <td>
                                <?php 
                                $class='';
                                switch($row['status']){
                                    case menu_m::PENDING:
                                    case menu_m::BLOCKED:
                                    {
                                        $class="danger";
                                        break;
                                    }
                                }
                                ?>
                                <span class="text text-<?php echo $class;?>"><?php echo menu_m::status($row['status']);?></span>
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
                        $child_menus=get_child_menus($row['id']);
                        if(count($child_menus)>0){
                            foreach ($child_menus as $child_menu) { 
                                if(is_array($child_menu) && array_key_exists('id', $child_menu)){
                                    generate_tds($child_menu,1,$link);                                    
                                }
                            }
                        }
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
        <?php if(permission_permit(array('add-fund-category'))){?>
        <span class="col-md-6 col-lg-6">
            <a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
            <a href="<?= $link ?>order" class="btn btn-default"/>Order menus</a>
        </span>
        <?php } ?>
        <ul class="pagination">
            <?php  if (!empty($menus)) echo $menus; ?>
        </ul>
    </div>
</div>

<?php
function generate_tds($menu=null,$level,$link){ ?>
<tr>
    <td></td>
    <?php
    $px=$level*35;
    $style="padding-left:".$px."px";
    ?>
    <td style="<?php echo $style?>">
        <?php
        echo (isset($menu['name']) && $menu['name'])?$menu['name']:'N/A'; 
        // echo '--'.menu_m::status($menu['status']);   
        ?>
    </td>
    <td>
        <?php 
        if(isset($menu['page_type_id']) && $menu['page_type_id']){
            $page=get_page_type(array('id'=>$menu['page_type_id']));
            echo (isset($menu['page_type_id']) && $menu['page_type_id'])?ucfirst($page['name']):'N/A';    
        }
        ?>
    </td>
    <td><?php echo $menu['url']?></td>                            
    <td>
        <?php
        if(isset($menu['category_id']) && $menu['category_id']){
            // echo 'category_id'.$menu['category_id'];
            $category=get_categories(array('id'=>$menu['category_id']),1);
            if($category){
                // show_pre($category);
                echo "<b><i>";
                echo anchor(base_url('category/edit/'.$category['slug']), $category['name'], array('title'=>'Edit category '.$category['name'],'class'=>'text text-success'));
                echo "</i></b>";
            }
        }elseif(isset($menu['article_id']) &&  $menu['article_id']){
            // echo 'article_id'.$menu['article_id'];
            $article=get_article(array('id'=>$menu['article_id']),1);
            if($article){
                // show_pre($article);
                echo "<b><i>";
                echo anchor(base_url('article/edit/'.$article['slug']),  $article['name'], array('title'=>'Edit article '.$article['name'],'class'=>'text text-success'));
                echo "</i></b>";
            }
        }
        ?>
    </td>
    <td>
        <?php 
        if(isset($menu['sidebar']) && $menu['sidebar']){
            echo $menu['sidebar']==menu_m::SIDEBAR_YES?'Yes':'No';
        }else{
            echo 'N/A';
        }
        ?>                                
    </td>
    <td>
        <?php 
        $class='';
        switch($menu['status']){
            case menu_m::PENDING:
            case menu_m::BLOCKED:
            {
                $class="danger";
                break;
            }
        }
        ?>
        <span class="text text-<?php echo $class;?>"><?php echo menu_m::status($menu['status']);?></span>
    </td>
    <td>
        <?php 
        echo (isset($menu['created_at']) && $menu['created_at'])?format($menu['created_at']):'N/A';    
        ?>
    </td>
    <td>
        <?php 
        generate_td_action($menu,$link);
        $child_menus=get_child_menus($menu['id']);
        // show_pre($child_menus);
        // echo count($child_menus);
        ?>
    </td>    
</tr>
<?php 
if(count($child_menus)>0){
    foreach ($child_menus as $child_menu) { 
        if(is_array($child_menu) && array_key_exists('id', $child_menu)){
            generate_tds($child_menu,2,$link);                                    
        }
    }
}
} 
?>


<?php 
function generate_td_action($row=null,$link=null){?>
<?php //if(is_default($row['slug'])) continue; ?>
<?php if($link && $row){ ?>
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
<?php } ?>
<? } ?>



<style>
    .text-success{
        text-decoration: underline;
        font-size: 13px;
    }
    a.text-success:hover{
        color: black !important;
        text-decoration: underline;
    }
</style>