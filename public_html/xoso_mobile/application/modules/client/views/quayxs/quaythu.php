<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<h1 style="position: absolute; text-indent: -99999px">Quay số chuẩn</h1>
<div class="page-title-ttxs t-cen">
    <div class="quayxs_menu">
        <ul class="tabs-provide clearfix">
            <li><a<?php echo $c_func == 'index' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>quay-so-may-man.html">Quay số cầu may</a></li>
            <li><a<?php echo $c_func == 'quaythu' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>quay-thu.html">Quay số chuẩn</a></li>
            <li><a<?php echo $c_func == 'quaynhanh' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>cung-quay-xo-so.html">Quay nhanh</a></li>
        </ul>
    </div>
</div>
<div class="box-result">
    <div class="marginauto">
        <div class="select-provice">
            <form id="form_search" name="form_search" method="post" action="">
                <div class="rows left clearfix">
                    <select name="lid" id="select_mien" tabindex="1" onchange="$('#form_search').submit();">
                        <?php
                        foreach ($location_today as $items) {
                            foreach ($items as $value) {
                                $selected = '';
                                if ($value->id == $lid)
                                    $selected = ' selected=""';
                                echo '<option' . $selected . ' value="' . $value->id . '">' . $value->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="rows right clearfix">
                    <a class="read-more" href="javascript:;" onclick="runResult();"><span>Quay thử</span></a>
                </div>  
                <div class="clear"></div>
            </form>
        </div>        
    </div>
    <div class="bor-top" id="load_kq"></div>
</div>
<script type="text/javascript">
    var t;
    var result = {<?php echo $str_result ?>};
    function randomMB(id)
    {   
        if(id <= 27){
            $("#g"+id).removeClass('imgloadig').html(result[id]);
            id++;
            t = setTimeout("randomMB("+id+")", 1500); 

        }else{
            clearTimeout(t);  
        }      
    }

    function randomMN(id)
    {   
        if(id <= 18){
            $("#g"+id).removeClass('imgloadig').html(result[id]);
            id++;
            t = setTimeout("randomMN("+id+")", 1500); 

        }else{
            clearTimeout(t);  
        }      
    }
    function randomMT(id)
    {   
        if(id <= 18){
            $("#g"+id).removeClass('imgloadig').html(result[id]);
            id++;
            t = setTimeout("randomMN("+id+")", 1500); 

        }else{
            clearTimeout(t);  
        }      
    }

    function runResult(){
        clearTimeout(t);
        var strUrl = '<?php echo $uri_root ?>quayso/loadKq';
        $.ajax({
            type:"POST",
            url:strUrl,
            data:{lid:<?php echo $lid ?>,name:'<?php echo $name ?>',alias:'<?php echo $alias ?>',area:'<?php echo $area ?>'},            
            success:function(msg){  
                $("#load_kq").html(msg);
                t = setTimeout("random<?php echo $area ?>(1)", 2000);
            }
        });

    }
    $(function(){$("#select_mien").selectbox()});
</script>