<h1 style="position: absolute; text-indent: -99999px">Quay số chuẩn</h1>
<div class="title title-red">
    <div class="title-right">
        <ul class="tabs clearfix">
            <li<?php echo $c_func == 'index' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root ?>quay-so-may-man.html">Quay số cầu may</a></li>
            <li<?php echo $c_func == 'quaythu' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root ?>quay-thu.html">Quay số chuẩn</a></li>
            <li<?php echo $c_func == 'quaynhanh' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root ?>cung-quay-xo-so.html">Quay nhanh</a></li>
        </ul>
    </div>
</div>
<div class="box-result">
    <div class="select-provice">
        <form id="form_search" name="form_search" method="post" action="">
            <div class="clearfix rows datefrom">
                <label>Tỉnh / thành phố</label>
                <div class="left">
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
                <a class="read-more" href="javascript:;" onclick="runResult();"><span>Quay thử</span></a>
            </div>
        </form>
        <div class="bor-top" id="load_kq"></div>
    </div>
</div>
<div class="line-red">&nbsp;</div>
<br/>
<div class="banner">
    <?php
    $arr_banner_middle = array();
    foreach ($banner as $v) {
        if ($v->position == 'middle' && ($v->page == 'all' || $v->page == $c_module)) {
            $arr_banner_middle[] = '<div><a target="_blank" href="' . $v->url . '" title="' . view_title($v->name) . '"><img src="' . site_url($v->image) . '" width="566" alt="' . view_title($v->name) . '" /></a></div>';
        }
    }
    echo $arr_banner_middle[array_rand($arr_banner_middle)];
    ?>
</div>
<div id='div-gpt-ad-1378288615889-1' style='width:336px' class="mainmenu">
    <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378288615889-1'); });
    </script>
</div>
<br/>
<?php
$this->load->view($layout_sms);
?>
<script type="text/javascript">
    var t;
    var result = {<?php echo $str_result?>};
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