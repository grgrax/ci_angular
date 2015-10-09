<div class="panel panel-default table-responsive">
    <div class="panel-heading">
        Today's Campaigns
        <span class="badge badge-info"><?=count($rows)?></span>
    </div>
    <div class="panel-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="center">s.no</th>
                                <th width="20%">name</th>
                                <th width="15%">status</th>
                                <th width="15%">fund category name</th>
                                <th width="10%">Amount (AUD) </th>
                                <th width="15%">Pictures</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $link = base_url('campaign/admin/');
                            if ($rows && count($rows) > 0) {
                                $c = 0;
                                foreach ($rows as $row) {
                                    $c++;
                                    $alertClass="";
                                    
                                    $donation_amount = get_donation_amount($row['id'] );
                                    $target_percent = $donation_amount/$row['target_amount']*100;
                                    ?>
                                    <tr class="<?php echo $alertClass?>">
                                        <td class="center"><?php echo $c?></td>
                                        <td>
                                            <a href="<?= $link ?>/edit/<?= $row['slug'] ?>"/><?= word_limiter(convert_accented_characters($row['campaign_title']), 5) ?>
                                            </a>
                                            <hr>
                                            <?php
                                            echo "Starting at: ";
                                            echo "<label><b>".$row['starting_at']."</b></label>";
                                            echo "<br/>Ending at</label>: ";
                                            echo "<label><b>".$row['ending_at']."</b></label>";
                                            echo "<hr/><label><b>".days_left($row['ending_at'])."</b></label>";                            
                                            echo "<hr/><label>Donee</label>: ";
                                            echo "<b>".$row['username']."</b>";
                                            ?>                         
                                        </td>
                                        <td class="center">
                                            <?php 
                                            if($row['status']==campaign_m::PENDING)
                                                echo "pending";
                                            elseif($row['status']==campaign_m::ACTIVE)
                                                echo "active";
                                            elseif($row['status']==campaign_m::SUCCESS)
                                                echo "success";
                                            elseif($row['status']==campaign_m::FAIL)
                                                echo "failed";
                                            elseif($row['status']==campaign_m::BLOCKED)
                                                echo "Blocked";
                                            $percent=$target_percent<100?number_format($target_percent):'100';
                                            ?>
                                            <div class="progress progress-lg">
                                                <div style="width: <?=$percent?>%;" class="progress-bar progress-bar-success">
                                                    <?=$percent?>%
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <?php
                                            // $fund_category=get_fund_category($row['name']);
                                            echo word_limiter(convert_accented_characters($row['name']), 5);
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            echo "$ ".$donation_amount = get_donation_amount($row['id'] );
                                            echo " of ";
                                            echo "$ ".$row['target_amount'];
                                            ?>
                                        </td>
                                        <td>
                                            <div id="carousel-example-generic-<?php echo $row['id']?>" class="carousel slide col-lg-12">
                                                <?php if($row['pic']!="") {
                                                    $pics=unserialize($row['pic']);
                                                    if(count($pics)>0){ ?>
                                                    <ol class="carousel-indicators">
                                                        <?php foreach ($pics as $key=>$pic) { 
                                                            if(is_picture_exists(campaign_m::file_path.$pic)){ ?>
                                                            <li data-target="#carousel-example-generic-<?php echo $row['id']?>" data-slide-to="<?php echo $key?>" <?php echo ($key==1)?'class="active"':'';?>></li>
                                                            <?php } 
                                                        } ?>
                                                    </ol>
                                                    <?php } 
                                                } ?>
                                                <div class="carousel-inner">
                                                    <?php if($row['pic']!="") {
                                                        $pics=unserialize($row['pic']);
                                                        if(count($pics)>0){ 
                                                            foreach ($pics as $key=>$pic) { 
                                                                if(is_picture_exists(campaign_m::file_path.$pic)){ ?>
                                                                <div class="item <?php echo ($key==1)?"active":'';?>">
                                                                    <img alt="" src="<?php echo is_picture_exists(campaign_m::file_path.$pic);?>">
                                                                </div>                                                        
                                                                <?php } 
                                                            } 
                                                        } 
                                                    } ?>
                                                </div>
                                            </div>
                                        </td>  
                                        
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="td_no_data">No data</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>

                    <?php //show_pre($rows) ?>

                    <script>
                        $(function(){

                            $("#filter_starting_at").datepicker({
                                dateFormat: 'dd-mm-yy',
                                changeMonth: true,
                                changeYear: true,
                                onClose: function( selectedDate ) {
                                    $( "#ending_at" ).datepicker( "option", "minDate", selectedDate );
                                    $( "#ending_at" ).focus();                                    
                                }
                            });
                            $("#ending_at").datepicker({
                                dateFormat: 'dd-mm-yy',
                                changeMonth: true,
                                changeYear: true,
                                minDate: $('#filter_starting_at').val()
                            });


                            var amount_option=$("select[name=amount_option]").val();
                            show_amount_section(amount_option);

                            $("select[name=amount_option]").change(function(){
                                show_amount_section($(this).val());
                            });

                            function show_amount_section(option){
                                hide_amount_secton();
                                var amount_option="amount_"+option;
                                $("."+amount_option).show();
                            }

                            function hide_amount_secton(){
                                $(".amount_1").hide();
                                $(".amount_2").hide();
                                $(".amount_3").hide();
                                $(".amount_4").hide();
                            }

                        })
                    </script>

                    <style>
                        .filter{
                            margin-bottom: 10px;
                            border-top: none !important;
                            /*border-bottom: 1px dotted rgba(182, 184, 184, 0.99);*/
                        }
                    </style>



