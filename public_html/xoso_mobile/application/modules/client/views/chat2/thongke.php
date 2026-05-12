<style type="text/css">
    .tk-home .content-2, .tk-home .content-3 {
        margin-bottom: 10px;
    }
    .tk-home .content-2 h3,.tk_block h3,.tkvip_block h3,.tksite_block .tksite_title{
        background:url(<?php echo $uri_root?>public/client/images/module_h3.gif) repeat 0 0;
        border:1px solid #7a050d;
        color:#fff;
        padding:4px 0;
        text-align:center;
    }
    .tk-home .content-2 .module h3{
        background:url(<?php echo $uri_root?>public/client/images/module_h4.gif) repeat-x 0 0;
        height:29px;
        border:1px solid #e4e4e4;
        line-height:29px;
        font-weight:700;
        padding:0 0 0 10px;
        color:#111;
        font-size:12px;
    }
    .tk-home .content-2 .module span{font-size:12px;float:left;display:block;width:86px;height:32px;line-height:32px;background:#f0f0f0;color:#111;overflow:hidden;margin:0 7px;text-align:center;border-bottom:2px solid #d0d0d0}
    .tk-home .content-2 .module span strong{font-size:12px;color:#b30b0b;background:url(<?php echo $uri_root?>public/client/images/li_space.gif) no-repeat right center;padding-right:5px;margin-right:5px}
</style>
<h1 style="position: absolute; text-indent: -99999px">Thống kê hôm nay</h1>
<div class="page-title-xs"><strong>Thống kê hôm nay</strong></div>
<div class="tk-home">
    <div class="content-2">
        <h3>Thống kê nhanh cho xổ số Miền Bắc đến ngày <?php echo date('d/m/Y') ?></h3>
        <div class="module">
            <h3>Loto lâu chưa ra (loto gan):</h3>
            <div style="padding:15px 3px;overflow:hidden">
                <?php
                foreach ($itemsImportant['cautious'] as $k => $v) {
                    echo '<span><strong>' . $v['number'] . '</strong>' . $v['not_count'] . ' ngày</span>';
                }
                ?>
            </div>
        </div>
        <div class="clear"></div>
        <div class="module">
            <h3>Loto ra nhiều trong tháng qua:</h3>
            <div style="padding:15px 3px;overflow:hidden">
                <?php
                foreach ($items_30['nhieu_nhat'] as $k => $v) {
                    echo '<span><strong>' . $v['number'] . '</strong>' . $v['count'] . ' lần</span>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>