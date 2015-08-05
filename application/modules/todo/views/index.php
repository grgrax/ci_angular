<!-- <p>Remove icon: <span class="glyphicon glyphicon-remove"></span></p>    
-->      

<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        <h3>Articles</h3>
        <hr>        
        <h4>Create Article</h4>
        <hr>
        <form role="form" ng-submit="addArticle()">
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
                    <th class="center">#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Publish</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="article in articles">
                    <td>{{$index+1}}</td>
                    <td>{{article.name}}</td>
                    <td>
                        <span ng-if="article.status==1" class="label label-table label-warning">
                            Unpublished
                        </span>
                        <span ng-if="article.status==2" class="label label-table label-success">
                            Published
                        </span>
                        <span ng-if="article.status==3" class="label label-table label-danger">
                            Deleted
                        </span>
                        <!-- <span class="label label-table label-<?=$class?>"><?=$status?></span> -->
                    </td>
                    <td>{{article.created_at}}</td>
                    <td style="text-align:center">
                        <span ng-if="article.status!=3">
                            <input class="todo" type="checkbox" 
                            ng-cha
                            nge="publisharticle(articles[$index])"
                            ng-model="articles[$index].status" 
                            ng-true-value="'2'" 
                            ng-false-value="'1'">
                        </span>                    
                    </td>
                    <td style="text-align:center">
                        <span ng-if="article.status==2">
                            <a class="btn btn-xs btn-default" 
                            ng-click="editArticle(articles[$index])">Edit</a>
                            &nbsp;
                            <a class="btn btn-xs btn-danger" 
                            ng-click="removeArticle(articles[$index])">Delete</a>
                        </span>
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="panel-footer">
    <ul class="pagination">
        <?php if (!empty($pages)) echo $pages; ?>
    </ul>
</div>



