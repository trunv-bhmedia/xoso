<div class="page-title clearfix">
    <h1 class="left">In Vé Dò KQXS</h1>
</div>

<div class="box-sx" style="padding:5px;">
    <form id="form_search" method="get" target="_blank" action="<?php echo $uri_root ?>ve-do.html">
        <div>
            <label>Miền</label>
            <select name="l">
                <option value="1">Miền Bắc</option>
                <option value="2">Miền Trung</option>
                <option value="3">Miền Nam</option>
            </select>
        </div>        
        <p class="Fromdate" style="padding:10px;">
            <label>Ngày</label>
            <input type="text" id="date" name="d" value="<?php echo date('d-m-Y') ?>" />
        </p>
        <div>
            <label>
                <input type="radio" value="1" name="t" checked="" />
                In 4 bảng/A4
            </label>
            <label>
                <input type="radio" value="2" name="t" />
                In 1 bảng/A4 
            </label>
        </div>
        <p style="padding-left:10px;"><button class="btn" style="margin-left:10px;" ><span><span>In vé dò</span></span></button></p>
        <p  style="padding:20px;"></p>
    </form>
</div>
<script type="text/javascript">
    $("#date").datepick({dateFormat: 'dd-mm-yyyy', maxDate: +0});
</script>