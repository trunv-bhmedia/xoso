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
        . '<td colspan="2" class="bg-yelow1 t-left">'
        . '<div class="width-title left">' . $days[date('w', $strtotime_date)] . ', ' . date('d/m/Y', $strtotime_date) . '</div>'
        . '<div class="box-print right">'
        . '<a href="' . $uri_root . '" class="link-home">XOSO.com</a>'
        . '<a href="' . $uri_root . 've-do.html?l=' . $lid_ve_do . '&amp;d=' . date('d-m-Y', $strtotime_date) . '&amp;t=2" target="_blank" class="link-print">&nbsp;</a>'
        . '</div>'
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">ĐB</td>'
        . '<td class="bg-gray giaidb">'
        . '<strong>' . $item->a0 . '</strong>'
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Nhất</td>'
        . '<td class="giai1">'
        . $item->a1
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Nhì</td>'
        . '<td class="bg-gray giai2">'
        . $str2
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Ba</td>'
        . '<td class="giai3">'
        . $str3
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Tư</td>'
        . '<td class="bg-gray giai4">'
        . $str4
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Năm</td>'
        . '<td class="giai5">'
        . $str5
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="bg-gray border-right t-left">Sáu</td>'
        . '<td class="bg-gray giai6">'
        . $str6
        . '</td>'
        . '</tr>'
        . '<tr>'
        . '<td class="border-right t-left">Bảy</td>'
        . '<td class="giai7">'
        . $str7
        . '</td>'
        . '</tr>';
$class_tt = ' class="bg-gray"';
if ($item->area != 'MB') {
    $str .= '<tr>'
            . '<td class="bg-gray border-right t-left">Tám</td>'
            . '<td class="bg-gray giai8">'
            . $item->a8
            . '</td>'
            . '</tr>';
    $class_tt = '';
}

$link_tt = 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html';
$check = false;
foreach ($location_menu['MN'] as $value) {
    if ($item->lid == $value->id) {
        $link_tt = 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html';
        $check = true;
        break;
    }
}
if ($check == false) {
    foreach ($location_menu['MT'] as $value) {
        if ($item->lid == $value->id) {
            $link_tt = 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html';
            break;
        }
    }
}

$str.='<tr class="ttxs"><td colspan="2"' . $class_tt . '><a target="_blank" href="' . $uri_root . $link_tt . '">Trực tiếp xổ số ' . $lname . '</a></td></tr>';
$str .= '</table></div>';

$title_share = 'Xổ Số ' . $lname . ' - ' . $days[date('w', $strtotime_date)] . ' ngày ' . date('d/m/Y', $strtotime_date);

$shared_content = 'Xổ Số ' . $lname . ' ngày ' . date('d/m/Y', $strtotime_date) . ',';
$shared_content.=' giải DB: ' . $item->a0 . ',';
$shared_content.=' giải nhất: ' . $item->a1 . ',';
$shared_content.=' giải nhì: ' . $item->a2 . ',';
$shared_content.=' giải ba: ' . $item->a3 . ',';
$shared_content.=' giải tư: ' . $item->a4 . ',';
$shared_content.=' giải năm: ' . $item->a5 . ',';
$shared_content.=' giải sáu: ' . $item->a6 . ',';
$shared_content.=' giải bảy: ' . $item->a7;
if ($item->area != 'MB')
    $shared_content.=', giải tám: ' . $item->a8;

$alias_date = $item->alias . '/' . date('d-m-Y', strtotime($item->date));
$curPageURL = urlencode($uri_root . $alias_date . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share) . '&amp;annotation=' . $shared_content;
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '. ' . $shared_content . '&amp;type=page&amp;linkname=' . $title_share . '&amp;linknote=';
$url_email = 'mailto:?subject=' . formatMail($title_share) . '&amp;body=' . $curPageURL . '. ' . formatMail($shared_content);

$str .= '<div class="xoso-home left"><a target="_blank" href="' . $uri_root . 'ket-qua.html">Kết quả Xổ Số</a> từ <a target="_blank" href="' . $uri_root . '">XOSO.COM</a></div><div class="share-like share-like-demo clearfix">'
        . '<a rel="nofollow" href="' . $url_facebook . '" title="Facebook" target="_blank" class="share-f">&nbsp;</a>'
        . '<a rel="nofollow" href="' . $url_google . '" title="Google" target="_blank" class="share-g">&nbsp;</a>'        
        . '<a rel="nofollow" href="' . $url_yahoo . '" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>'
        . '<a rel="nofollow" href="' . $url_email . '" title="Email" target="_blank" class="share-email">&nbsp;</a>'
        . '</div><div class="clearfix"></div>';
?>
jQuery("#box_kqxs").html('');
jQuery("#box_kqxs").append('<div class="title clearfix">'
    +'<strong class="left xsmb">KQXS</strong>'
    +'<div class="right space-select">'
        +'<div class="box-select left"><?php echo $location ?></div>'
        +'<div class="box-select left" id="list_date"><?php echo $ngay ?></div>'
        +'</div>'
    +'</div>');
jQuery("#box_kqxs").append('<div class="box_kqxs_mini"><div class="contentxs"><?php echo $str ?></div></div>');
function getnew_boxkqxs(){
setTimeout(function(){
jQuery("#box_kqxs").append('<div class="onidprocess"><img src="<?php echo img_link('processing.gif'); ?>" /></div><script type="text/javascript" src="<?php echo $uri_root ?>getkqxswp-'+jQuery("#box_kqxs_tinh").val()+'.js"></script>');
},500);
}
function getnew_boxkqxs_ngay(){
setTimeout(function(){
jQuery("#box_kqxs").append('<div class="onidprocess"><img src="<?php echo img_link('processing.gif'); ?>" /></div><script type="text/javascript" src="<?php echo $uri_root ?>getkqxswp-'+jQuery("#box_kqxs_tinh").val()+'/'+jQuery("#box_kqxs_ngay").val()+'.js"></script>');
},500);
}
function jstrpos(haystack,needle,offset){var i=(haystack+'').indexOf(needle,(offset||0));return i===-1?false:i}
function updatecolor(){
if(jstrpos(kqwidth,'px')>0){
crong=kqwidth.replace('px','');
if(crong<220) jQuery("#box_kqxs a.link-home").css('display','none');
if(crong<215 && crong>=200) jQuery("#box_kqxs .space-select .box-select select").css('width','80px');
}
jQuery("#box_kqxs strong.xsmb").text(titlexs);
jQuery("#box_kqxs .title").css('background',bgcolor);
jQuery("#box_kqxs .title strong").css('color',titlecolor);
jQuery(".giaidb").css('color',dbcolor);
jQuery("#box_kqxs").css('width',kqwidth);
jQuery("#box_kqxs td,#box_kqxs div,#box_kqxs select,#box_kqxs a").css('font-size',fsize+'px');
jQuery("#box_kqxs div.xoso-home,#box_kqxs div.xoso-home a").css('font-size','9px');
if(tt==1) jQuery("#box_kqxs .ttxs").css('display','table-row');
else jQuery("#box_kqxs .ttxs").css('display','none');
if(cal==1) jQuery("#box_kqxs #list_date").css('display','table-row');
else jQuery("#box_kqxs #list_date").css('display','none');
}
updatecolor();