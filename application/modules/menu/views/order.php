
<div class="panel panel-default">
    <div class="panel-heading">
        Order menus
        <span class="pull-right">
            <?php //if(permission_permit(array('add-menu'))){?>
            <a href="<?= $link ?>add" class="btn btn-primary"/>Add New  </a>
            <?php //} ?>
            <input type="button" name="sortable" value="Update" class="btn btn-success" id="save"/>
            <a href="<?= $link ?>" class="btn btn-warning" />Cancel</a>
        </span>
    </div>
    <div class="panel-body" id="orderResult">
    </div>
    <div class="panel-footer">
       <!--  <?php //if(permission_permit(array('add-menu'))){?>
        <a href="<?= $link ?>add" class="btn btn-primary"/>Add New  </a>
        <?php //} ?>
        <input type="button" name="sortable" value="Update" class="btn btn-success" id="save"/>
        <a href="<?= $link ?>" class="btn btn-warning" />Cancel</a> -->
    </div>
</div>
</div>
<script>
    $(function(){

        $.ajax({
            type : 'GET',
            url : '<?php echo site_url('menu/ajax/order_ajax'); ?>',
            success : function(data){
                console.log("1st time");
                $('#orderResult').html(data);
            }
        });



        $('#save').click(function(){
            oSortable = $('.sortable').nestedSortable('toArray');
            $('#orderResult').slideUp(function(){
                $.post('<?php echo site_url('menu/ajax/order_ajax'); ?>', { sortable: oSortable }, function(data){
                    response=jQuery.parseJSON(data);
                    console.log(response);
                    if(response.success){
                        window.location.replace('<?php echo base_url("menu/order")?>');
                    }
                    console.log(data);
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                });
            });
        });

    });
</script>
