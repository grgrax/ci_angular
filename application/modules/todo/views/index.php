<!-- <p>Remove icon: <span class="glyphicon glyphicon-remove"></span></p>    
-->      

<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        <h3>
            Articles 
            <span class="badge badge-info">{{articles.length}}</span>
            <a href="add" class="col-sm-offset-0 btn btn-sm btn-primary btn-labeled fa fa-plus" 
            data-toggle="modal" data-target="#add_form" />Add New  </a>
        </h3>
    </div>

    <div class="panel-body">
        <form role="form">
            <h4>
                Filter 
            </h4>
            <div class="checkbox">
                <label><input type="checkbox" ng-model="advanced_filter" checked="checked">Advanced Filter</label>
            </div>   
            <hr>
            <div class="col-sm-12 col-md-6 col-lg-3 form-group">
                <input type="text" class="form-control" name="name" 
                ng-model="filter_name" placeholder="By name" />
            </div>   
            <span ng-show="advanced_filter">
                <div class="col-sm-12 col-md-6 col-lg-3 form-group">
                    <input type="text" class="form-control" name="content" 
                    ng-model="filter_content" placeholder="By content" />
                </div>   
                <div class="col-sm-12 col-md-6 col-lg-3 form-group">
                    <input type="text" class="form-control" name="date" 
                    ng-model="filter_date" placeholder="By date" />
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 form-group">
                    <select class="form-control" ng-model="filter_status">
                        <option value="" selected="selected">-- Select Status --</option>                        
                        <option ng-repeat="status in all_status" value="{{status.key}}">{{status.value}}</option>
                    </select>
                </div>                
            </span> 
        </form>
       <!--  <form role="form" ng-submit="addArticle()" name="add_article_form">
            <div class="form-group">
                <input type="text" class="form-control" name="name" 
                ng-model="name" placeholder="Name here" required>
                <span style="color:red" ng-show="add_article_form.name.$dirty && add_article_form.name.$invalid">
                  <span ng-show="add_article_form.name.$error.required">Name is required.</span>
              </span>
          </div>    
          <div class="form-group">
            <textarea name="content" class="form-control" id="" cols="30" rows="4" 
            placeholder="Content here"
            ng-model="content" required></textarea>
            <span style="color:red" ng-show="add_article_form.content.$dirty && add_article_form.content.$invalid">
                <span ng-show="add_article_form.content.$error.required">Content is required.</span>
            </span>
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add</button>
    </form>    -->
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
            <tr ng-repeat="article in articles | filter:filter_name | filter:filter_content | filter:filter_date | orderBy : 'name'">
                <td>{{$index+1}}</td>
                <td>{{article.name | uppercase}}</td>
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
                        data-toggle="modal" 
                        data-target="#edit_form" 
                        ng-click="loadArticle(article.slug)"
                        >Edit</a>
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


<!-- Modal -->
<div class="modal fade" id="edit_form" tabindex="-1" role="dialog" aria-labelledby="edit_form" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Article</h3>
            </div>
            <div class="modal-body">
                <div class="form-group center-block">
                    <form role="form" ng-submit="editArticle()">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" 
                            ng-model="article.name" placeholder="Name here" required
                            value="{{article.name}}">
                            name : {{article.name}}

                        </div>    
                        <div class="form-group">
                            <textarea name="content" class="form-control" id="" cols="30" rows="4" 
                            placeholder="Content here"
                            ng-model="content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                    </form>
                </div>                      
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_form" tabindex="-1" role="dialog" aria-labelledby="add_form" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add Article</h3>
            </div>
            <div class="modal-body">
                <div class="form-group center-block">
                    <form role="form" ng-submit="addArticle()" name="add_article_form" >
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" 
                            ng-model="name" placeholder="Name here" required>
                            <span style="color:red" ng-show="add_article_form.name.$dirty && add_article_form.name.$invalid">
                              <span ng-show="add_article_form.name.$error.required">Name is required.</span>
                          </span>
                      </div>    
                      <div class="form-group">
                        <textarea name="content" class="form-control" id="" cols="30" rows="4" 
                        placeholder="Content here"
                        ng-model="content" required></textarea>
                        <span style="color:red" ng-show="add_article_form.content.$dirty && add_article_form.content.$invalid">
                            <span ng-show="add_article_form.content.$error.required">Content is required.</span>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                </form>            
            </div>                      
        </div>
    </div>
</div>
</div>


