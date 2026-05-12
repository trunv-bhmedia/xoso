<div class="tksite_block">
    <div class="tksite_title">
        <span class="left">Chọn ngày</span>
        <div class="box-date-provide left">
            <input name="kqxs_date" type="text" id="kqxs_date" value="<?php echo str_replace('/', '-', $date) ?>" />
            <script type="text/javascript">/*<![CDATA[*/$("#kqxs_date").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){ loadloc() }});/*]]>*/</script>
        </div>
        <span class="left">Chọn miền</span>
        <div class="left" id="loadloc"></div>
        <div class="xem-ket-qua"><a href="javascript:;" onclick="submitVIP()"><span>Xem kết quả</span></a></div>
    </div>
    <div class="box-result">
        <h3>Thống kê số đẹp từ các diễn đàn xổ số : <strong class="red"><?php echo str_replace('-', '/', $date) ?></strong></h3>
        <div class="tksite_content">
            <?php
            if ($xs_vip->content != '')
                echo $xs_vip->content;
            else
                echo '<em>Đang được cập nhật!</em>';
            ?>
        </div>
    </div>
    <br/>
    <?php $this->load->view($layout_sms);?>
</div>
<script type="text/javascript">
    function submitVIP(){
        var a=$("#kqxs_date").val();var loc=$("#select_loc").val();
        document.location="<?php echo $uri_root ?>thong-ke-so-dep-tu-cac-dien-dan-xo-so/"+loc+"/"+a+".html";
    }
    function loadloc(){
        var a=$("#kqxs_date").val();
        $.ajax({type:"GET",url:"<?php echo $uri_root ?>loadloc/<?php echo $alias ?>/"+a,success:function(b){$("#loadloc").html(b);}})
    }
    $(document).ready(function(a){ loadloc() });
</script>