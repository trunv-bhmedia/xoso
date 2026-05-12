<script type="text/javascript" src="<?php echo js_link('jquery-1.7.2.js') ?>"></script>
<link href="<?php echo css_link('demo.css') ?>" rel="stylesheet" type="text/css" />
<h1 style="position: absolute; text-indent: -99999px">TẠO MÃ NHÚNG KẾT QUẢ XỔ SỐ</h1>
<?php
$str = '<script type="text/javascript">bgcolor="#9c0303";titlecolor="#ffffff";dbcolor="#A80804";fsize="12px";kqwidth="' . $kqwidth . '";</script><script type="text/javascript" src="' . $uri_root . 'getkqxs-xo-so-mien-bac.js"></script>';
$manhung = '<script type="text/javascript" src="' . $uri_root . 'public/client/js/jquery-1.7.2.js"></script><link rel="stylesheet" type="text/css" href="' . $uri_root . 'public/client/css/demo.css"/><div id="box_kqxs">' . $str . '</div>';
?>
<div class="widget">
    <ul class="list-editor"><li>Kết quả hiển thị</li></ul>
    <div class="border">
        <div class="box-result-widget"><div id="box_kqxs"><?php echo $str ?></div></div>
    </div>
    <ul class="list-editor"><li>Nội dung code</li></ul>
    <div class="border"><?php echo htmlentities($manhung) ?></div>
</div>
<?php $this->load->view($layout_sms) ?>