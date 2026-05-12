<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $_meta['description'] ?>" />
        <meta name="keywords" content="<?php echo $_meta['keywords'] ?>" />
        <title><?php echo $_meta['title'] ?></title>
        <meta property="og:image" content="<?php echo img_link('logo.png') ?>" />
        <link type="image/x-icon" href="<?php echo img_link('favicon.ico') ?>" rel="shortcut icon" />
        <link type="text/css" rel="stylesheet" href="<?php echo css_link('jquery.datepick.css') ?>" />
        <script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
        <script type="text/javascript" src="<?php echo js_link('jquery.datepick.js') ?>"></script>
        <meta name="google-site-verification" content="_MdXAARqGNM7C1GRrfqgrQg59dJuCGxL_3E4tJf_se0" />
        <script type="text/javascript">
            function SoH_Mien(namecontrol,number){var hideshow=document.getElementById(namecontrol+ number);if(hideshow.style.display!="none"){hideshow.style.display="none";}else{hideshow.style.display="block";}return false;}
            function onlyTextNumber(evt){evt=(evt)?evt:window.event;var charCode=(evt.which)?evt.which:evt.keyCode;if(charCode>31&&(charCode<48||charCode>57)){return false;}return true;}
            var total="100";
            function changeCss(obj,classname){for(var i=0;i<total;i++){var obj1=document.getElementById('tr_'+ i);if(obj1){obj1.className='';}}obj.className=classname;}
            function on_over(obj,classname,classname2){if(obj.className==classname){return;}obj.className=classname2;}
            function on_out(obj,classname){if(obj.className==classname){return;}obj.className='';}
            function changeCss_td(classname,i,n){var td_current=document.getElementById('td_current');var vitri_current=td_current.innerHTML;if(vitri_current!=i){for(var j=0;j<n;j++){var obj1=document.getElementById('td_'+ j+'_'+ i);var obj2=document.getElementById('td_'+ j+'_'+ vitri_current);if(obj1){obj1.className=classname;}if(obj2){obj2.className='';}}if(td_current){td_current.innerHTML=i;}}}
            function changeCss_cb(obj){var span=document.getElementById("cl"+ obj.value);if(obj.checked){span.className='checked';}else{span.className='uncheck';}}
            function checkSwap(checkid,checkname){if(document.getElementById(checkid).checked){checkAll(checkname);}else{uncheckAll(checkname);}}
            function checkAll(checkname){var check=document.getElementsByName(checkname);for(i=0;i<=check.length;i++){if(check[i]!=null){check[i].checked=true;var span=document.getElementById("cl"+ check[i].value);span.className='checked';}}}
            function uncheckAll(checkname){var check=document.getElementsByName(checkname);for(i=0;i<=check.length;i++){if(check[i]!=null){check[i].checked=false;var span=document.getElementById("cl"+ check[i].value);span.className='uncheck';}}}
            function on_over_td(classname,classname2,i,n){for(var j=0;j<n;j++){var obj=document.getElementById('td_'+ j+'_'+ i);if(obj.className==classname){continue;}obj.className=classname2;}}
            function on_out_td(classname,i,n){for(var j=0;j<n;j++){var obj=document.getElementById('td_'+ j+'_'+ i);if(obj.className==classname){continue;}obj.className='';}}
        </script>
        <style type="text/css">
            body{margin:0px 0px 0px 0px;padding:10px;}.sred{color:#db0d1d;font-weight:bold;font-size:larger;}.tr_over{background-color:#F39C25;}.tr_over2{background-color:#F39C25;}.div_item{color:blue;background-color:gray;width:25px;height:100%;line-height:25px;font-weight:bold;}.tr_over .div_item{background-color:gray;font-weight:bold;}.tr_over2 .div_item{background-color:gray;font-weight:bold;}a{text-decoration:none;color:blue;}a:hover{text-decoration:none;color:#db0d1d;}.checked{font-weight:bold;color:#db0d1d;}.uncheck{color:black;}
            table.tkts_loto{border-collapse: collapse; border-color: #666; font-family: tahoma;font-size: 11px; color: #424242;}
            table.tkts_loto th,td.tkts_loto_total{border-right: 1; border-right-color: #666; border-bottom: 1; border-bottom-color: #666;}
            td.tkts_loto_number{padding: 4px; font-weight: bold; border-right: 1; border-right-color: #666; border-bottom: 1; border-bottom-color: #666;}
            td.tkts_loto_item{width: 25px; border-right: 1; border-right-color: #666; border-bottom: 1; border-bottom-color: #666;}
            .tkts_loto_so{color: rgb(0, 0, 0); width: 25px; height: 100%; line-height: 25px; font-weight: bold;}
            td.tkts_loto_date{padding: 2px; border-right: 1; border-right-color: #666; border-bottom: 1; border-bottom-color: #666;}
            .font700{font-weight:700}
        </style>
    </head>
    <body>
        <div class="space2" onclick="SoH_Mien('thongke', 1)" style="cursor: pointer;"><span class="sblue">Hướng dẫn sử dụng Thống Kê tần suất loto</span></div>
        <div class="alert space" id="thongke1" style="display: none;">
            Để xem thống kê tần suất loto bạn chọn biên ngày muốn xem, sau đó chọn khoảng ngày muốn xem đến biên ngày và cuối cùng chọn tỉnh muốn xem rồi click Xem kết quả.
            Hệ thông sẽ thống kê tần suất loto trong khoảng ngày đó.<br/>
            Bạn muốn xem con loto ở hàng nào thì bạn click vào hàng đó, lập tức hàng bạn muốn xem sẽ bôi da cam, tiện cho việc theo dõi.
        </div>
        <br/>
        <form method="post" name="frmMain" action="">
            <div class="space">
                Biên độ ngày: <input type="text" id="end_date" name="end_date" value="<?php echo $end_date ?>" size="10" maxlength="10"/>
                &nbsp;&nbsp;&nbsp;Khoảng ngày muốn xem: <input type="text" onkeypress="return onlyTextNumber(event)" name="txtNumber" value="<?php echo $txtNumber ?>" size="10" maxlength="3"/>
                <p class="tc space">
                    Chọn tỉnh:
                    <select name="slcTinh">
                        <?php
                        $lname = 'Miền Bắc';
                        foreach ($xs_location_menu as $value) {
                            $selected = '';
                            if ($lid == $value->id) {
                                $selected = ' selected=""';
                                $lname = $value->name;
                            }
                            echo '<option' . $selected . ' value="' . $value->id . '">' . $value->name . '</option>';
                        }
                        ?>
                    </select>
                    <br/><br/>Chọn số muốn xem:  <br/>
                    <a href="javascript:;" onclick="checkAll('check[]'); return false;">Chọn tất cả</a>&nbsp;&nbsp;&nbsp;|
                    &nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="uncheckAll('check[]'); return false;">Xóa tất cả</a>
                    <br/>
                    <?php
                    for ($i = 0; $i <= 99; $i++) {
                        $value = $i;
                        if ($i < 10)
                            $value = '0' . $i;
                        $selected = '';
                        $class = '';
                        if (!$check || in_array($value, $check)) {
                            $selected = ' checked="checked"';
                            $class = ' class="checked"';
                        }
                        echo '<input type="checkbox" onchange="changeCss_cb(this);" value="' . $value . '" name="check[]"' . $selected . ' /><span id="cl' . $value . '"' . $class . '>' . $value . '</span>&nbsp;&nbsp;&nbsp;';
                        if (($i + 1) % 10 == 0)
                            echo '<br/>';
                    }
                    ?>
                    <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="typeView" value="doc"<?php echo $typeView == 'doc' ? ' checked="checked"' : '' ?> />Xem theo chiều dọc<input type="radio" name="typeView" value="ngang"<?php echo $typeView == 'ngang' ? ' checked="checked"' : '' ?> />Xem theo chiều ngang
                    &nbsp;&nbsp;&nbsp;<input type="submit" name="cmdView" value="Xem kết quả" class="button"/>
                </p>
                Số lần xuất hiện có màu đỏ là trường hợp về ở giải đặc biệt<br/>
                Dữ liệu kết quả từ <b>01/01/2002</b> đến nay. <br/>
                <i>Chú ý: để sử dụng tốt nhất <b>Thống kê tần suất loto</b> bạn nên tải và cài đặc trình duyệt <a href="http://www.google.com/Chrome" target="_blank">Google Chrome</a> hoặc <a href="http://www.mozilla.com/vi/firefox/" target="_blank">Firefox</a></i>
            </div>
        </form>
        <br/>
        <div>Thống kê tần suất loto của <span class="sred">xổ số <?php echo $lname ?> trong <?php echo $txtNumber ?></span> ngày gần nhất:</div>
        <br/>
        <?php if ($typeView == 'doc') { ?>
            <table border="1" cellspacing="0" cellpadding="0" class="tkts_loto">
                <thead>
                    <tr>
                        <th>Ngày<br/>-<br/>tháng</th>
                        <?php foreach ($items as $date => $value) { ?>
                            <th><?php echo date('d', strtotime($date)) ?><br/>-<br/><?php echo date('m', strtotime($date)) ?></th>
                        <?php } ?>
                        <th>Tổng số lần về</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i <= 99; $i++) {
                        $value = $i;
                        if ($i < 10)
                            $value = '0' . $i;

                        if ($check && !in_array($value, $check)) {
                            continue;
                        }

                        $total = isset($count[$i]) ? $count[$i] : 0;
                        ?> 
                        <tr class="" id="tr_<?php echo $i ?>" onmouseover="on_over(this, 'tr_over2', 'tr_over');" onmouseout="on_out(this, 'tr_over2');" onclick="changeCss(this, 'tr_over2');">
                            <td class="tkts_loto_number"><?php echo $value ?></td>
                            <?php
                            foreach ($items as $date => $value) {
                                if (isset($db[$date][$i]))
                                    $items[$date][$i] = '<span class="sred">' . $items[$date][$i] . '</span>';
                                $item = isset($items[$date][$i]) ? '<div class="tkts_loto_so">' . $items[$date][$i] . '</div>' : '<div class="div_item">&nbsp;</div>';
                                ?>
                                <td class="tkts_loto_item" valign="middle" align="center"><?php echo $item ?></td>
                            <?php } ?>
                            <td class="tkts_loto_item" valign="middle" align="center"><div class="tkts_loto_so"><?php echo $total ?></div></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
        }else {
            $tkts_loto_number = '';
            $tkts_loto_item = '';
            for ($i = 0; $i <= 99; $i++) {
                $value = $i;
                if ($i < 10)
                    $value = '0' . $i;

                if ($check && !in_array($value, $check)) {
                    continue;
                }
                $tkts_loto_number .='<td valign="middle" align="center" class="tkts_loto_number">' . $value . '</td>';

                $item = isset($count[$i]) ? $count[$i] : 0;
                $tkts_loto_item .='<td class="tkts_loto_item" valign="middle" align="center"><div class="tkts_loto_so">' . $item . '</div></td>';
            }
            ?>
            <table border="1" cellspacing="0" cellpadding="0" class="tkts_loto">
                <thead>
                    <tr>
                        <td class="tkts_loto_date">Ngày\Cặp số</td>
                        <?php echo $tkts_loto_number ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = 0;
                    foreach ($items as $date => $value) {
                        ?>
                        <tr>
                            <td class="tkts_loto_date font700" valign="middle" align="center"><?php echo date('d/m/Y', strtotime($date)) ?></td>
                            <?php
                            for ($i = 0; $i <= 99; $i++) {
                                $value = $i;
                                if ($i < 10)
                                    $value = '0' . $i;

                                if ($check && !in_array($value, $check)) {
                                    continue;
                                }

                                if (isset($db[$date][$i]))
                                    $items[$date][$i] = '<span class="sred">' . $items[$date][$i] . '</span>';
                                $item = isset($items[$date][$i]) ? '<div class="tkts_loto_so">' . $items[$date][$i] . '</div>' : '<div class="div_item">&nbsp;</div>';
                                ?> 
                                <td id="<?php echo 'td_' . $row . '_' . $i ?>" onmouseover="on_over_td('tr_over2', 'tr_over', <?php echo $i ?>, <?php echo $txtNumber ?>);" onmouseout="on_out_td('tr_over2', <?php echo $i ?>, <?php echo $txtNumber ?>);" onclick="changeCss_td('tr_over2', <?php echo $i ?>, <?php echo $txtNumber ?>);" style="width: 25px; border-right: 1; border-right-color: #666; border-bottom: 1; border-bottom-color: #666;" valign="middle" align="center"><?php echo $item ?></td>
                            <?php } ?>
                        </tr>
                        <?php
                        $row++;
                    }
                    ?>
                    <tr>
                        <td class="tkts_loto_date">Cặp số</td>
                        <?php echo $tkts_loto_number ?>
                    </tr>
                    <tr>
                        <td class="tkts_loto_total">Tổng số lần về</td>
                        <?php echo $tkts_loto_item ?>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        <br />
        <div id="td_current" style="display: none;">-1</div><div style="border-bottom: 1; border-bottom-color: #666;"></div>

        <script type="text/javascript">/*<![CDATA[*/$("#end_date").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){}});/*]]>*/</script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-31260907-1', 'xoso.com');
            ga('require', 'displayfeatures');
            ga('send', 'pageview');
        </script>
    </body>
</html>