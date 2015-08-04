
<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        <h3>Articles</h3>
        <hr>
        <h4>Create Article</h4>
        <hr>
        <form role="form" ng-submit="addTask()">
            <div class="form-group">
                <input type="text" class="form-control" name="name" 
                ng-model="name" placeholder="Name here" required>
            </div>    
            <div class="form-group">
            <textarea name="content" class="form-control" id="" cols="30" rows="4" 
                placeholder="Content here"
                ng-model="content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add</button>
        </form>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th class="center">s.no</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="task in tasks">
                    <td>{{$index+1}}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.status}}</td>
                    <td>{{task.created_at}}</td>
                    <td style="text-align:center">
                        <input class="todo" type="checkbox" 
                        ng-cha
                        nge="updateTask(tasks[$index])"
                        ng-model="tasks[$index].status" 
                        ng-true-value="'1'" 
                        ng-false-value="'0'">
                    </td>
                    <td style="text-align:center">
                        <a class="btn btn-xs btn-default" 
                        ng-click="deleteTask(tasks[$index])"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        Fund Categories
        <span class="badge badge-info"><?=$total?></span>
        <a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th class="center">s.no</th>
                    <th>name</th>
                    <th>status</th>
                    <th>created at</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($rows && count($rows) > 0) {
                    $c = $offset;
                    foreach ($rows as $row) {
                        $c++;
                        $actions=array();
                        switch($row['status']){
                            case todo_m::UNPUBLISHED:
                            {
                                $actions[]='publish';
                                break;
                            }
                            case todo_m::PUBLISHED:
                            {
                                $actions[]='unpublish';
                                $actions[]='delete';
                                break;
                            }
                        }
                        ?>
                        <tr>
                            <td class="center"><?php echo $c?></td>
                            <td>
                                <a href="<?= $link ?>edit/<?= $row['slug'] ?>"/><?=$row['name'] ?></a>
                            </td>
                            <td>
                                <?php 
                                if($row['status']==todo_m::PUBLISHED){
                                    $class='success'; 
                                    $status='Active';                                  
                                }
                                elseif($row['status']==todo_m::UNPUBLISHED){
                                    $class='warning'; 
                                    $status='Unpublished';                                  
                                }
                                elseif($row['status']==todo_m::DELETED){
                                    $class='danger'; 
                                    $status='Deleted';                                  
                                }
                                ?>
                                <span class="label label-table label-<?=$class?>"><?=$status?></span>
                            </td>
                            <td><?=$row['created_at'] ?></td>
                            <td>
                                <?php if($row['image']!="") { ?>
                                <img src="<?php echo file_exists(todo_m::file_path.$row['image']);?>" 
                                class="img-responsive" width="70" height="30" title=<?php echo $row['image']?$row['image']:''?>>
                                <?php } ?>
                            </td>                            
                            <td>
                                <?php if($row['status']==todo_m::PUBLISHED) {?>
                                    <a class='btn-sm btn-success'
                                    href="<?= $link ?>edit/<?= $row['slug'] ?>" 
                                    data-original-title="Edit" >Edit</a>
                                    <?php }  
                                    foreach ($actions as $k=>$action) 
                                    { 
                                        switch ($action) 
                                        {
                                            case 'publish':
                                            $class='btn-success';
                                            break;
                                            case 'unpublish':
                                            $class='btn-warning';
                                            break;
                                            case 'delete':
                                            $class='btn-danger';
                                            break;
                                        }
                                        ?>                                    
                                        <a href="<?=$link.$action.'/'.$row['slug'] ?>" class="btn-sm <?=$class?>" 
                                            data-original-title="<?=ucfirst($action)?>"
                                            data-container="body"/>
                                            <?= ucfirst($action)?>
                                        </a>&nbsp;
                                        <?php 
                                    } 
                                    ?>
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
            <ul class="pagination">
                <?php if (!empty($pages)) echo $pages; ?>
            </ul>
        </div>
    </div>



