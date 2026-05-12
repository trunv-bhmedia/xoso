<script type="text/javascript">
    var t;

    function timedCount(){	
        //giai dac biet
        var c= Math.floor(Math.random()*90000) + 10000;	 
        document.getElementById('db').value=c;
	
        //giai nhat
        var c1 = Math.floor(Math.random()*c) + 10000;
        document.getElementById('g1').value=c1;
	
        //giai hai
        var c2_1 = Math.floor(Math.random()*c1) + 10000;
        document.getElementById('g2_1').value=c2_1;
        var c2_2 = Math.floor(Math.random()*c2_1) + 10000;
        document.getElementById('g2_2').value=c2_2;
	
        //giai ba
        var c3_1 = Math.floor(Math.random()*c2_2) + 10000;
        document.getElementById('g3_1').value=c3_1;
        var c3_2 = Math.floor(Math.random()*c3_1) + 10000;
        document.getElementById('g3_2').value=c3_2;
        var c3_3 = Math.floor(Math.random()*c3_2) + 10000;
        document.getElementById('g3_3').value=c3_3;
        var c3_4 = Math.floor(Math.random()*c3_3) + 10000;
        document.getElementById('g3_4').value=c3_4;
        var c3_5 = Math.floor(Math.random()*c3_4) + 10000;
        document.getElementById('g3_5').value=c3_5;
        var c3_6 = Math.floor(Math.random()*c3_5) + 10000;
        document.getElementById('g3_6').value=c3_6;
	
        //giai tu	
        var c4_1 = Math.floor(Math.random()*9000) + 1000;
        document.getElementById('g4_1').value=c4_1;
        var c4_2 = Math.floor(Math.random()*c4_1) + 1000;
        document.getElementById('g4_2').value=c4_2;
        var c4_3 = Math.floor(Math.random()*c4_2) + 1000;
        document.getElementById('g4_3').value=c4_3;
        var c4_4 = Math.floor(Math.random()*c4_3) + 1000;
        document.getElementById('g4_4').value=c4_4;
	
        //giai 5
        var c5_1 = Math.floor(Math.random()*c4_4) + 1000;
        document.getElementById('g5_1').value=c5_1;
        var c5_2 = Math.floor(Math.random()*c5_1) + 1000;
        document.getElementById('g5_2').value=c5_2;
        var c5_3 = Math.floor(Math.random()*c5_2) + 1000;
        document.getElementById('g5_3').value=c5_3;
        var c5_4 = Math.floor(Math.random()*c5_3) + 1000;
        document.getElementById('g5_4').value=c5_4;
        var c5_5 = Math.floor(Math.random()*c5_4) + 1000;
        document.getElementById('g5_5').value=c5_5;
        var c5_6 = Math.floor(Math.random()*c5_5) + 1000;
        document.getElementById('g5_6').value=c5_6;
	
        //giai 6
        var c6_1 = Math.floor(Math.random()*900) + 100;
        document.getElementById('g6_1').value=c6_1;
        var c6_2 = Math.floor(Math.random()*c6_1) + 100;
        document.getElementById('g6_2').value=c6_2;
        var c6_3 = Math.floor(Math.random()*c6_2) + 100;
        document.getElementById('g6_3').value=c6_3;
	
        //giai 7
        var c7_1 = Math.floor(Math.random()*90) + 10;
        document.getElementById('g7_1').value=c7_1;
        var c7_2 = Math.floor(Math.random()*c7_1) + 10;
        document.getElementById('g7_2').value=c7_2;
        var c7_3 = Math.floor(Math.random()*c7_2) + 10;
        document.getElementById('g7_3').value=c7_3;
        var c7_4 = Math.floor(Math.random()*c7_3) + 10;
        document.getElementById('g7_4').value=c7_4;
        
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
<div class="title title-red">
    <div class="title-right">Cùng quay xổ số lấy lộc may mắn</div>
</div>
<div class="box-result">
    <div class="table-tkn">
        <table class='tblCollect'>									
            <tr>
                <td width='90' valign='top'>
                    <div class="block_quayxs">
                        <div class="block_quayxs_item">
                            <select name="tinhx" id="box_kqxs_tinhx">
                                <option value="1"<?php echo isset($_GET['t']) && $_GET['t'] == 1 ? ' selected=""' : ''; ?>>Miền Bắc</option>
                                <option value="2"<?php echo isset($_GET['t']) && $_GET['t'] == 2 ? ' selected=""' : ''; ?>>Miền Trung</option>
                                <option value="3"<?php echo isset($_GET['t']) && $_GET['t'] == 3 ? ' selected=""' : ''; ?>>Miền Nam</option>
                            </select>
                        </div>			
                        <div class="block_quayxs_item">
                            <input type='submit' value='Start' onclick='timedCount();' /> <input type='submit' value='Stop' onclick='stopCount();' />
                        </div>
                    </div>
                    <div class="block_quayxs_flash">
                        <embed width="90" height="130" allowscriptaccess="always" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="<?php echo img_link('longcau.swf'); ?>"/>
                    </div>
                </td>
                <td valign='top'>
                    <div >
                        <div class="title_quayxs">Xổ số kiến thiết Miền Bắc</div>
                        <div class="subtitle_quayxs">Ngày mở thưởng <?php echo date('d-m-Y') ?></div>
                        <table class='tbView'>
                            <tr>
                                <td width='70'>
                                    <div class="tbView_title">Đặc biệt</div>
                                </td>
                                <td>
                                    <div class='ctxs'><input type='text' id='db' readonly='true'></div>
                                </td>
                            </tr>	
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải nhất</div>
                                </td>
                                <td>
                                    <div class='ctxs'><input type='text' id='g1' readonly='true'></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải nhì</div>
                                </td>
                                <td>
                                    <div class='ctxs'><input type='text' id='g2_1' readonly='true'></div>
                                    <div class='ctxs'><input type='text' id='g2_2' readonly='true'></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải ba</div>
                                </td>
                                <td>
                                    <div class='ctxs' ><input type='text' id='g3_1' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g3_2' readonly='true'></div>
                                    <div class='ctxs' ><input type='text' id='g3_3' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g3_4' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g3_5' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g3_6' readonly='true'></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải tư</div>
                                </td>
                                <td>
                                    <div class='ctxs'><input type='text' id='g4_1' readonly='true'></div>
                                    <div class='ctxs'><input type='text' id='g4_2' readonly='true'></div>
                                    <div class='ctxs'><input type='text' id='g4_3' readonly='true'></div>
                                    <div class='ctxs'><input type='text' id='g4_4' readonly='true'></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải năm</div>
                                </td>
                                <td>
                                    <div  class='ctxs'><input type='text' id='g5_1' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g5_2' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g5_3' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g5_4' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g5_5' readonly='true'></div>
                                    <div  class='ctxs'><input type='text'id='g5_6' readonly='true'></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải sáu</div>
                                </td>
                                <td>
                                    <div  class='ctxs'><input type='text' id='g6_1' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g6_2' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g6_3' readonly='true'></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="tbView_title">Giải bảy</div>
                                </td>
                                <td>
                                    <div  class='ctxs'><input type='text' id='g7_1' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g7_2' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g7_3' readonly='true'></div>
                                    <div  class='ctxs'><input type='text' id='g7_4' readonly='true'></div>
                                </td>
                            </tr>                            
                        </table>
                    </div>
                </td>
            </tr>									
        </table>
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
<?php
$this->load->view($layout_sms);
?>
<script type="text/javascript">
    $('#box_kqxs_tinhx').change(function() {
        var tinh=$(this).val();
        if(tinh==1)
            window.location = "<?php echo $uri_root ?>cung-quay-xo-so.html";
        else
            window.location = "<?php echo $uri_root ?>cung-quay-xo-so.html?t=" + tinh;
    });
</script>