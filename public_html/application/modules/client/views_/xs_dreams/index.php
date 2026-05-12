<h1 style="position: absolute; text-indent: -99999px">GIẢI MỘNG - SỐ MƠ - THƠ ĐỀ</h1>
<div class="title title-red">
    <div class="title-right">GIẢI MỘNG - SỐ MƠ - THƠ ĐỀ</div>
</div>
<div class="box-result">								
    <div class="select-provice box-yellow clearfix">
        <p class="red">
            <strong>Giải mộng số mơ thơ đề, giải đáp những giấc mơ khó hiểu từ đó giúp bạn lựa chọn được những bộ số may mắn trong ngày</strong>
        </p>
        <form id="form_search" method="get" action="">
            <div class="rows some clearfix">
                <span class="span-input"><input type="text" name="title" value="<?php echo isset($_GET["title"]) ? $_GET["title"] : '' ?>" class="txt-input txt-inputor" /></span>
                <a class="read-more" href="javascript:;" onclick="document.getElementById('form_search').submit();"><span>Tìm kiếm</span></a>
            </div>
        </form>
    </div>
    <div class="title-tk clearfix">
        <span class="left">Nội dung giấc mơ</span>
        <div class="toolbar"><div class="pages"><?php echo $pagnav; ?></div></div>
    </div>
    <table class="tbl-ds">
        <tr>
            <td class="t-cen bg-gray"><strong>STT</strong></td>
            <td class="t-cen bg-gray"><strong>Nội dung giấc mơ</strong></td>
            <td class="last t-cen bg-gray"><strong>Bộ số tương ứng</strong></td>
        </tr>
        <?php
        foreach ($rows as $k => $row):
            $class = '';
            if ($k % 2 != 0)
                $class = 'bg-gray ';
            ?>
            <tr>
                <td class="<?php echo $class ?>t-cen"><strong><?php echo ($offset + $k + 1); ?></strong></td>
                <td class="<?php echo $class ?>t-cen"><?php echo $row->title ?></td>
                <td class="<?php echo $class ?>last t-cen"><?php echo $row->str_number ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="bg-gray last">
                <div class="left">Tổng số <strong><?php echo $count; ?></strong></div>
                <div class="toolbar"><div class="pages"><?php echo $pagnav; ?></div></div>
            </td>
        </tr>
    </table>

</div>
<div class="line-red">&nbsp;</div>
<br/>
<div id='div-gpt-ad-1378288615889-1' style='width:336px' class="mainmenu">
    <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378288615889-1'); });
    </script>
</div>