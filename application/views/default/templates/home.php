<?php $data_slider=get_category_and_aritcles(HOME_PAGE_SLIDER); ?>
<?php if($data_slider) { ?>
<!--Slider-->
<section id="slide-show">
    <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">


            <?php foreach ($data_slider['rows'] as $key => $row) { ?>
            <div class="sl-slide item1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="container">
                        <?php if($row['image'] && is_article_picture_exists($row['image'])){?>
                        <img class="pull-right img-slider" src="<?php echo is_article_picture_exists($row['image'])?>" />
                        <?php } else {?>
                        <img class="pull-right img-slider" src="<?php echo is_article_picture_exists('default.png')?>" />
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <nav id="nav-arrows" class="nav-arrows">
                <span class="nav-arrow-prev"><i class="icon-angle-left"></i></span>
                <span class="nav-arrow-next"><i class="icon-angle-right"></i></span> 
            </nav>
        </div>
    </div>   
</section>
<!--/Slider-->
<?php } ?>

<!-- <section class="main-info">
    <div class="container">
        <div class="row-fluid">
            <div class="span9">
                <h4>WHAT'S NEXT? CONNECTING THE IT WORLD</h4>
                <p class="no-margin">Joing IT Courses at THE IIT & Change the your Life & World.</p>
            </div>
            <div class="span3">
                <a class="btn btn-success btn-large pull-right" href="#">Best Institue @ RAPTI</a>
            </div>
        </div>
    </div>
</section> -->

<?php $data_course=get_category_and_aritcles(HOME_PAGE_COURSE); ?>

<!-- courses starts  -->
<section id="services">
    <div class="container">
        <div class="center" id="courses">
            <h3><?php echo isset($data_course['row']['name'])?$data_course['row']['name']:''?> We Offer</h3>
            <?php echo isset($data_course['row']['content'])?$data_course['row']['content']:''?>
        </div>

        <!-- articles  starts -->
        <?php foreach ($data_course['rows'] as $key => $row) { ?>
        <?php if($key==0 or $key%3 ==0) {?>
        <!-- row starts -->
        <div class="row-fluid">
            <?php } ?>
            <div class="span4">
                <div class="media">
                    <div class="pull-left">
                        <i class="icon-globe icon-medium"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo isset($row['name'])?$row['name']:''?></h4>
                        <?php echo isset($row['content'])?$row['content']:''?>
                    </div>
                </div>
            </div>            
            <?php if($key>0 && ($key+1)%3 ==0) { ?>
        </div>
        <!-- row ends -->
        <?php } ?>
        <?php } ?>
        <!-- articles  ends -->

    </div>
</section>
<!-- courses ends -->

<!--partners-->
<?php $data=get_partners_widget(HOME_PAGE_PARTNER); ?>
<?php if($data) { ?>
<section id="clients" class="main">
    <div class="container">
        <div class="row-fluid">
            <div class="span2">
                <div class="clearfix">
                    <h4 class="pull-left"><?php echo $data['row']['name']?></h4>
                    <div class="pull-right">
                        <a class="prev" href="#myCarousel" data-slide="prev"><i class="icon-angle-left icon-large"></i></a> <a class="next" href="#myCarousel" data-slide="next"><i class="icon-angle-right icon-large"></i></a>
                    </div>
                </div>
                <p><?php echo $data['row']['content']?></p>
            </div>
            <div class="span10">
                <div id="myCarousel" class="carousel slide clients">
                    <!-- items -->
                    <div class="carousel-inner">

                        <?php 
                        foreach ($data['rows'] as $key=>$row) { 
                            // echo $key;
                            if($key==0 or ($key>0 && $key%3==0 && !$need_closing) or (isset($need_starting) and $need_starting)){$need_closing=true;//echo "start at $key";?>
                            <div class="<?php echo $key<4?'active':'';?> item">
                                <div class="row-fluid">
                                    <ul class="thumbnails">
                                        <?php }?>
                                        <li class="span3">
                                            <a href="#">
                                                <?php if($row['image'] && is_article_picture_exists($row['image'])){?>
                                                <img class="img-circle" src="<?php echo is_article_picture_exists($row['image'])?>"
                                                <?php } else {?>
                                                <img class="img-circle" src="<?php echo is_article_picture_exists('default.png')?>"
                                                <?php } ?>
                                                ?>
                                            </a>
                                        </li>
                                        <?php if(($need_closing && $key>0 && $key%3==0 ) or count($data['rows'])-1==$key){$need_closing=false;$need_starting=true;//echo "close at $key";?>
                                    </ul>
                                </div>
                            </div>
                            <?php } 
                        } ?>

                    </div>
                    <!-- / items -->

                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>
<!--partners-->

