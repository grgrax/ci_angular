<form method="post" action="" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">Edit Details</div>
        <div class="panel-body">

            <div class="row">                
                <span class="col-md-3 col-lg-3">
                    <div class="form-group">                    
                        <label for="name"><b class="text text-success">--- Name ---</b></label>
                        <input name="name" class="form-control" placeholder="menu name here" value="<?php echo set_value('name', $row['name']); ?>"/>
                    </div>   
                </span>
                <span class="col-md-3 col-lg-3">
                    <div class="form-group">                    
                        <label for="url">Url</label>
                        <input name="url" class="form-control" placeholder="url here" value="<?php echo set_value('url', $row['url']); ?>"/>
                    </div>   
                </span>
                <span class="col-md-3 col-lg-3">
                    <label for="parent_menu">Parent menu</label>
                    <select name="parent_menu" id="input" class="form-control capitalize">
                        <option value="0">Select</option>
                        <?php foreach ($rows as $menu) {?>
                        <option value="<?php echo $menu['id'] ?>"
                            <?php echo $menu['id']==$row['parent_id']?'selected':'';?>>
                            <?php echo $menu['name']?></option>
                            <?php 
                        } ?>
                    </select>
                </span>
                <span class="col-md-3 col-lg-3">
                    <div class="form-group">
                        <label for="page_type">Type</label>
                        <select name="page_type" id="input" class="form-control capitalize">
                            <option value="">Select</option>
                            <?php foreach ($page_types as $page_type) {?>
                            <option value="<?php echo $page_type['id'] ?>"                     
                                <?php echo $page_type['id']==$row['page_type_id']?'selected':'';?>>
                                <?php echo $page_type['name']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>   
                </span>
            </div>

            <div class="row">                
                <span class="col-md-3 col-lg-3">           
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="input" class="form-control capitalize">
                            <option value="">Select</option>
                            <?php foreach ($categories as $category) {?>
                            <option value="<?php echo $category['id'] ?>"
                                <?php echo $category['id']==$row['category_id']?'selected':'';?>>
                                <?php echo $category['name']?>
                            </option>
                            <?php } ?>
                        </select> 
                    </div> 
                </span>                      
                <span class="col-md-3 col-lg-3">           
                    <label for="article">Article</label>
                    <select name="article" id="input" class="form-control capitalize">
                        <option value="">Select</option>
                        <?php foreach ($articles as $article) {?>
                        <option value="<?php echo $article['id'] ?>"                     
                            <?php if(isset($row['article_id']))  ?>
                            <?php echo $article['id']==$row['article_id']?'selected':'';?>>
                            <?php echo $article['name']?>
                        </option>
                        <?php } ?>
                    </select>
                </span>
                <span class="col-md-3 col-lg-3">           
                    <label for="sidebar">Include Sidbars</label>
                    <select name="sidebar" id="input" class="form-control capitalize">
                        <?php foreach ($sidebars as $k => $value) {?>
                        <option value="<?php echo $k?>"                     
                            <?php echo $row['sidebar']==$this->input->post('sidebar')?'selected':'';?>
                            <?php echo $row['sidebar']==$k?'selected':'';?>
                            >
                            <?php echo $value?>
                        </option>
                        <?php } ?>
                    </select>
                </span>
                <span class="col-md-3 col-lg-3">
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select name="status" id="input" class="form-control">
                        <option value="">Select</option>
                        <?php foreach ($actions as $k => $v) { if($k==menu_m::DELETED) continue; ?>
                            <option value="<?php echo $k ?>" <?php echo $k==$row['status']?'selected':'';?>><?php echo $v ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </span>
            </div>

            <div class="row">                
                <div class="col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea name="desc" class="form-control tinymice"
                        placeholder="menu Description here"><?php echo set_value('desc', $row['desc']); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <input type="submit" name="update" value="Save" class="btn btn-success"/>
            <a href="<?= $link ?>" class="btn btn-warning"/>Cancel</a>
        </div>
    </div>
</form>


