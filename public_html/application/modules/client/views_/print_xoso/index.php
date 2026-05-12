<h1 style="position: absolute; text-indent: -99999px">IN VÉ DÒ - (IN BẢNG KẾT QUẢ XỔ SỐ)</h1>
<div class="title title-red">
    <div class="title-right">In Vé Dò KQXS</div>
</div>
<div class="box-result">								
    <div class="select-provice select-provice-num clearfix">
        <form id="form_search" method="get" target="_blank" action="<?php echo $uri_root ?>ve-do.html">
            <div class="rows clearfix">
                <div class="left left-space">
                    <label>Miền</label>
                    <select name="l" id="select_mien" tabindex="1">
                        <option value="1">Miền Bắc</option>
                        <option value="2">Miền Trung</option>
                        <option value="3">Miền Nam</option>
                    </select>
                </div>
                <div class="left numberbox">
                    <label>Ngày</label>
                    <span class="span-input">
                        <input class="txt-input txt-inputor" style="width:100px" type="text" id="date" name="d" value="<?php echo date('d-m-Y') ?>" />
                    </span>
                </div>
            </div>
            <div class="rows">
                <label class="label-title">&nbsp;</label>
                <span class="span-lookup"><input type="radio" value="1" name="t" checked="" /> In 4 bảng/A4</span>
                <input type="radio" value="2" name="t" /> In 1 bảng/A4 
            </div>
            <div class="rows clearfix t-cen">
                <a class="read-more" href="javascript:;" onclick="document.getElementById('form_search').submit();"><span>In vé dò</span></a>
            </div>	
        </form>
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
<script type="text/javascript">
    $(function(){$("#select_mien").selectbox()});
    $("#date").datepick({dateFormat: 'dd-mm-yyyy', maxDate: +0});
</script>