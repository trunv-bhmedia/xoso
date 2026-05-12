<script type="text/javascript">
    var t;

    function timedCount(){	
        //giai dac biet
        var c= Math.floor(Math.random()*900000) + 100000;	 
        document.getElementById('db').value=c;
	
        //giai nhat
        var c1 = Math.floor(Math.random()*90000) + 10000;
        document.getElementById('g1').value=c1;
	
        //giai hai
        var c2 = Math.floor(Math.random()*c1) + 10000;
        document.getElementById('g2').value=c2;
	
        //giai ba
        var c3_1 = Math.floor(Math.random()*c2) + 10000;
        document.getElementById('g3_1').value=c3_1;
        var c3_2 = Math.floor(Math.random()*c3_1) + 10000;
        document.getElementById('g3_2').value=c3_2;
        
        //giai tu	
        var c4_1 = Math.floor(Math.random()*c3_2) + 10000;
        document.getElementById('g4_1').value=c4_1;
        var c4_2 = Math.floor(Math.random()*c4_1) + 10000;
        document.getElementById('g4_2').value=c4_2;
        var c4_3 = Math.floor(Math.random()*c4_2) + 10000;
        document.getElementById('g4_3').value=c4_3;
        var c4_4 = Math.floor(Math.random()*c4_3) + 10000;
        document.getElementById('g4_4').value=c4_4;
        var c4_5 = Math.floor(Math.random()*c4_4) + 10000;
        document.getElementById('g4_5').value=c4_5;
        var c4_6 = Math.floor(Math.random()*c4_5) + 10000;
        document.getElementById('g4_6').value=c4_6;
        var c4_7 = Math.floor(Math.random()*c4_6) + 10000;
        document.getElementById('g4_7').value=c4_7;
	
        //giai 5
        var c5 = Math.floor(Math.random()*9000) + 1000;
        document.getElementById('g5').value=c5;
	
        //giai 6
        var c6_1 = Math.floor(Math.random()*c5) + 1000;
        document.getElementById('g6_1').value=c6_1;
        var c6_2 = Math.floor(Math.random()*c6_1) + 1000;
        document.getElementById('g6_2').value=c6_2;
        var c6_3 = Math.floor(Math.random()*c6_2) + 1000;
        document.getElementById('g6_3').value=c6_3;
	
        //giai 7
        var c7 = Math.floor(Math.random()*900) + 100;
        document.getElementById('g7').value=c7;
        
        //giai 8
        var c8 = Math.floor(Math.random()*90) + 10;
        document.getElementById('g8').value=c8;
        
        t=setTimeout("timedCount()",15);
        timer.start(1000);
    }

    function stopCount(){
        clearTimeout(t);
    }
    
    // Timer library 1.0
    function _timer(callback)
    {
        var time = 0; 	//  The default time of the timer
        var mode = 1; 	//	Mode: count up or count down
        var status = 0;	//	Status: timer is running or stoped
        var timer_id;	//	This is used by setInterval function
	
        // this will start the timer ex. start the timer with 1 second interval timer.start(1000) 
        this.start = function(interval)
        {
            interval = (typeof(interval) !== 'undefined') ? interval : 1000;

            if(status == 0)
            {
                status = 1;
                timer_id = setInterval(function()
                {
                    switch(mode)
                    {
                        default:
                            if(time)
                            {
                                time--;
                                generateTime();
                                if(typeof(callback) === 'function') callback(time);
                            }
                            break;
					
                        case 1:
                            if(time < 86400)
                            {
                                time++;
                                generateTime();
                                if(typeof(callback) === 'function') callback(time);
                            }
                            break;
                    }
                }, interval);
            }
        }
	
        //  Same as the name, this will stop or pause the timer ex. timer.stop()
        this.stop =  function()
        {
            if(status == 1)
            {
                status = 0;
                clearInterval(timer_id);
            }
        }
	
        // Reset the timer to zero or reset it to your own custom time ex. reset to zero second timer.reset(0)
        this.reset =  function(sec)
        {
            sec = (typeof(sec) !== 'undefined') ? sec : 0;
            time = sec;
            generateTime(time);
        }
	
        // Change the mode of the timer, count-up (1) or countdown (0)
        this.mode = function(tmode)
        {
            mode = tmode;
        }
	
        // This methode return the current value of the timer
        this.getTime = function()
        {
            return time;
        }
	
        // This methode return the current mode of the timer count-up (1) or countdown (0)
        this.getMode = function()
        {
            return mode;
        }
	
        // This methode return the status of the timer running (1) or stoped (1)
        this.getStatus
        {
            return status;
        }
	
        // This methode will render the time variable to hour:minute:second format
        function generateTime()
        {
            //            var second = time % 60;
            //            var minute = Math.floor(time / 60) % 60;
            //            var hour = Math.floor(time / 3600) % 60;
            //		
            //            second = (second < 10) ? '0'+second : second;
            //            minute = (minute < 10) ? '0'+minute : minute;
            //            hour = (hour < 10) ? '0'+hour : hour;
            //		
            //            $('div.timer span.second').html(second);
            //            $('div.timer span.minute').html(minute);
            //            $('div.timer span.hour').html(hour);
        }
    }

    // example use
    var timer;

    $(document).ready(function(e) 
    {
        timer = new _timer
        (
        function(time)
        {
            if(time == 0)
            {
                timer.stop();
                clearTimeout(t);
                //                alert('time out');
            }
        }
    );
        timer.reset(10);
        timer.mode(0);
    });
</script>
<h1 style="position: absolute; text-indent: -99999px">Quay nhanh Xổ số kiến thiết Miền <?php echo isset($_GET['t']) && $_GET['t'] == 2 ? 'Trung' : 'Nam'; ?></h1>
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
    <div class="select-provice kqxs-block clearfix">
        <div class="quayxs_block clearfix">
            <div class="location-select clearfix">
                <select name="tinhx" id="box_kqxs_tinhx" tabindex="1">
                    <option value="1"<?php echo isset($_GET['t']) && $_GET['t'] == 1 ? ' selected=""' : ''; ?>>Miền Bắc</option>
                    <option value="2"<?php echo isset($_GET['t']) && $_GET['t'] == 2 ? ' selected=""' : ''; ?>>Miền Trung</option>
                    <option value="3"<?php echo isset($_GET['t']) && $_GET['t'] == 3 ? ' selected=""' : ''; ?>>Miền Nam</option>
                </select>
            </div>
            <a onclick="timedCount();" href="javascript:;" class="quayxs_start"><span>&nbsp;</span></a>
            <a onclick="stopCount();" href="javascript:;" class="quayxs_stop"><span>&nbsp;</span></a>
        </div>
        <div class="title_quayxs_block">
            <div class="title_quayxs">Xổ số kiến thiết Miền <?php echo isset($_GET['t']) && $_GET['t'] == 2 ? 'Trung' : 'Nam'; ?></div>
            <div class="subtitle_quayxs">Ngày mở thưởng <?php echo date('d-m-Y') ?></div>
        </div>
    </div>
    <table class='tbl-tt kqmiennam'>
        <tr>
            <td class="bg-gray border-right">
                <div class="tbView_title">Giải tám</div>
            </td>
            <td class="bg-gray">
                <div class='ctxs'><input type='text' id='g8' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="border-right">
                <div class="tbView_title">Giải bảy</div>
            </td>
            <td>
                <div class='ctxs'><input type='text' id='g7' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">
                <div class="tbView_title">Giải sáu</div>
            </td>
            <td class="bg-gray">
                <div class='ctxs'><input type='text' id='g6_1' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g6_2' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g6_3' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="border-right">
                <div class="tbView_title">Giải năm</div>
            </td>
            <td>
                <div class='ctxs'><input type='text' id='g5' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">
                <div class="tbView_title">Giải tư</div>
            </td>
            <td class="bg-gray">
                <div class='ctxs'><input type='text' id='g4_1' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g4_2' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g4_3' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g4_4' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g4_5' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g4_6' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g4_7' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="border-right">
                <div class="tbView_title">Giải ba</div>
            </td>
            <td>
                <div class='ctxs'><input type='text' id='g3_1' readonly='true'></div>
                <div class='ctxs'><input type='text' id='g3_2' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right">
                <div class="tbView_title">Giải nhì</div>
            </td>
            <td class="bg-gray">
                <div class='ctxs'><input type='text' id='g2' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="border-right">
                <div class="tbView_title">Giải nhất</div>
            </td>
            <td class="giai1">
                <div class='ctxs'><input type='text' id='g1' readonly='true'></div>
            </td>
        </tr>
        <tr>
            <td class="bg-gray border-right" width="1%" nowrap>
                <div class="tbView_title">Giải đặc biệt</div>
            </td>
            <td class="bg-gray giaidb">
                <div class='ctxs'><input type='text' id='db' readonly='true'></div>
            </td>
        </tr>
    </table>
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
    $(function(){$("#box_kqxs_tinhx").selectbox()});
    $('#box_kqxs_tinhx').change(function() {
        var tinh=$(this).val();
        if(tinh==1)
            window.location = "<?php echo $uri_root ?>cung-quay-xo-so.html";
        else
            window.location = "<?php echo $uri_root ?>cung-quay-xo-so.html?t=" + tinh;
    });
</script>