<script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
<link href="<?php echo css_link('demoxs.css') ?>" rel="stylesheet" type="text/css" />
<h1 style="position: absolute; text-indent: -99999px">TẠO MÃ NHÚNG KẾT QUẢ XỔ SỐ</h1>
<div class="widget">
    <ul class="list-editor"><li>Kết quả hiển thị</li></ul>
    <?php
    foreach ($items as $value) {
        $str = '<script type="text/javascript">bgcolor="#9C0303";titlecolor="#FFFFFF";dbcolor="#A80804";fsize="12";kqwidth' . $value->id . '="' . $value->size . '";tt="true";</script><a href="' . $uri_root . 'ket-qua.html">Ket qua Xo So</a> tu <a href="' . $uri_root . '">XOSO.COM</a><script type="text/javascript" src="' . $uri_root . 'getkqxsdemo-xo-so-mien-bac.js?id=' . $value->id . '"></script>';

        $str2 = '<script type="text/javascript">bgcolor="#9C0303";titlecolor="#FFFFFF";dbcolor="#A80804";fsize="12";kqwidth="' . $value->size . '";tt="true";</script><a href="' . $uri_root . 'ket-qua.html">Ket qua Xo So</a> tu <a href="' . $uri_root . '">XOSO.COM</a><script type="text/javascript" src="' . $uri_root . 'getkqxs-xo-so-mien-bac.js"></script>';
        $manhung = '<script type="text/javascript" src="' . $uri_root . 'public/client/js/jquery-1.7.2.js"></script><link rel="stylesheet" type="text/css" href="' . $uri_root . 'public/client/css/demo.css"/><div id="box_kqxs">' . $str2 . '</div>';
        ?>
        <ul class="category-provide"><li><strong><a name="demo<?php echo $value->id ?>"><?php echo $value->title ?></a></strong></li></ul>
        <div class="border">
            <div class="box-result-widget"><div class="box_kqxs_demo" id="box_kqxs_<?php echo $value->id ?>"><?php echo $str ?></div></div>
        </div>
        <ul class="list-editor"><li>Nội dung code</li></ul>
        <div class="border"><textarea name="manhung" class="demo-manhung" onclick="this.select();"><?php echo str_replace(array('Ket qua Xo So', 'tu'), array('Kết quả Xổ Số', 'từ'), htmlentities($manhung)) ?></textarea></div>
        <?php
    }
    ?>
</div>
<?php
$this->load->view($layout_sms);
?>