<?php
$lname = '';
$statistics_alias = '';
$location = '<select name="tinh" id="box_kqxs_tinh" onchange="getnew_boxkqxs();">';
foreach ($xs_location_menu as $value) {
    $selected = '';
    if ($lid == $value->id) {
        $selected = ' selected=""';
        $lname = $value->name;
        $statistics_alias = $value->alias;
    }
    $location .= '<option' . $selected . ' value="' . $value->alias . '">' . $value->name . '</option>';
}
$location .= '</select>';

$ngay = '<select name="ngay" id="box_kqxs_ngay" onchange="getnew_boxkqxs_ngay();">';
foreach ($demo_date as $value) {
    $value->date = date('d-m-Y', strtotime($value->date));
    $selected = '';
    if ($date == $value->date) {
        $selected = ' selected=""';
    }
    $ngay .= '<option' . $selected . ' value="' . $value->date . '">' . str_replace('-', '/', $value->date) . '</option>';
}
$ngay .= '</select>';

$lid_ve_do = 1;
$class = 'bkqtinhmienbac_mini';
if ($item->area == 'MT') {
    $lid_ve_do = 2;
    $class = 'bkqtinhmiennam_mini';
} elseif ($item->area == 'MN') {
    $lid_ve_do = 3;
    $class = 'bkqtinhmiennam_mini';
}

$days = array(
    '0' => 'Chủ nhật',
    '1' => 'Thứ 2',
    '2' => 'Thứ 3',
    '3' => 'Thứ 4',
    '4' => 'Thứ 5',
    '5' => 'Thứ 6',
    '6' => 'Thứ 7'
);
$strtotime_date = strtotime($date);

$str2 = str_replace('-', ' - ', $item->a2);
$str3 = str_replace('-', ' - ', $item->a3);
$str4 = str_replace('-', ' - ', $item->a4);
$str5 = str_replace('-', ' - ', $item->a5);
$str6 = str_replace('-', ' - ', $item->a6);
$str7 = str_replace('-', ' - ', $item->a7);

$str = '<div class="box-result">'
        . '<table class="tbl-tt tbl-main-tt ' . $class . '">'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Giải đặc biệt</td>'
        . '<td class="bg-gray border-right giaidb">'
        . '<strong>' . $item->a0 . '</strong>'
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Giải nhất</td>'
        . '<td class="border-right giai1">'
        . $item->a1
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Giải nhì</td>'
        . '<td class="bg-gray border-right giai2">'
        . $str2
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Giải ba</td>'
        . '<td class="border-right giai3">'
        . $str3
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Giải tư</td>'
        . '<td class="bg-gray border-right giai4">'
        . $str4
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Giải năm</td>'
        . '<td class="border-right giai5">'
        . $str5
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Giải sáu</td>'
        . '<td class="bg-gray border-right giai6">'
        . $str6
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Giải bảy</td>'
        . '<td class="border-right giai7">'
        . $str7
        . '</td>'
        . '</tr>';
if ($item->area != 'MB') {
    $str .= '<tr>'
            . '<td class="bg-gray border-right t-left">Giải tám</td>'
            . '<td class="bg-gray border-right giai8">'
            . $item->a8
            . '</td>'
            . '</tr>';
}
$str .= '</table></div><div class="line-red mb10">&nbsp;</div>';

$title_share = isset($_meta['title']) ? $_meta['title'] : '';
$title_share = urlencode($title_share);
$alias_date = $item->alias . '/' . date('d-m-Y', strtotime($item->date));
$curPageURL = urlencode($uri_root . $alias_date . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . $title_share;
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
$url_email = 'mailto:?subject=' . $_meta['title'] . '&amp;body=' . $curPageURL;

$str .= '<div class="share-like share-like-demo clearfix">'
        . '<a rel="nofollow" href="' . $url_google . '" title="Google" target="_blank" class="share-g">&nbsp;</a>'
        . '<a rel="nofollow" href="' . $url_facebook . '" title="Facebook" target="_blank" class="share-f">&nbsp;</a>'
        . '<a rel="nofollow" href="' . $url_yahoo . '" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>'
        . '<a rel="nofollow" href="' . $url_email . '" title="Email" target="_blank" class="share-email">&nbsp;</a>'
        . '</div><div class="clearfix"></div>';
?>
$("#box_kqxs").html('');
$("#box_kqxs").append('<div class="title clearfix">'
    +'<strong class="left xsmb">KQXS <?php echo $lname ?></strong>'
    +'<div class="right space-select">'
        +'<div class="box-select left"><?php echo $location ?></div>'
        +'<div class="box-select left"><?php echo $ngay ?></div>'
        +'</div>'
    +'</div>'
+'<div class="bg-yelow1 clearfix">'
    +'<strong class="txt-red width-title left"><h2><?php echo $days[date('w', $strtotime_date)] ?>, <?php echo date('d/m/Y', $strtotime_date) ?></h2></strong>'
    +'<div class="box-print right">'
        +'<a href="<?php echo $uri_root ?>" class="link-home">XOSO.com</a>'
        +'<a href="<?php echo $uri_root ?>ve-do.html?l=<?php echo $lid_ve_do ?>&amp;d=<?php echo date('d-m-Y', $strtotime_date) ?>&amp;t=2" target="_blank" class="link-print">&nbsp;</a>'
        +'</div>'
    +'</div>');
$("#box_kqxs").append('<div class="box_kqxs_mini"><div class="contentxs"><?php echo $str ?></div></div>');
function getnew_boxkqxs(){
setTimeout(function(){
$("#box_kqxs").append('<div class="onidprocess"><img src="<?php echo img_link('processing.gif'); ?>" /></div><script type="text/javascript" src="<?php echo $uri_root ?>getkqxs-'+$("#box_kqxs_tinh").val()+'.js"></script>');
},500);
}
function getnew_boxkqxs_ngay(){
setTimeout(function(){
$("#box_kqxs").append('<div class="onidprocess"><img src="<?php echo img_link('processing.gif'); ?>" /></div><script type="text/javascript" src="<?php echo $uri_root ?>getkqxs-'+$("#box_kqxs_tinh").val()+'/'+$("#box_kqxs_ngay").val()+'.js"></script>');
},500);
}
function updatecolor(){
$("#box_kqxs .title").css('background',bgcolor);
$("#box_kqxs .title strong").css('color',titlecolor);
$(".giaidb").css('color',dbcolor);
$("#box_kqxs").css('width',kqwidth);
$("#box_kqxs td, #box_kqxs div,#box_kqxs select").css('font-size',fsize);
}
updatecolor();