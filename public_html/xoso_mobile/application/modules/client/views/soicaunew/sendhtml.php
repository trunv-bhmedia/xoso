<?php

function formatCau($giai, $arr_loto, $loto) {
    $pattern = array('/<span class=\'cau_vt1\'>' . $arr_loto[0] . '<\/span><span class=\'cau_vt1\'>' . $arr_loto[1] . '<\/span>-/i'
        , '/<span class=\'cau_vt1\'>' . $arr_loto[0] . '<\/span>' . $arr_loto[1] . '-/i'
        , '/' . $arr_loto[0] . '<span class=\'cau_vt1\'>' . $arr_loto[1] . '<\/span>-/i'
        , '/' . $loto . '-/i'
    );
    $replacement = array("<span class='cau_lo'><span class='cau_vt2'>" . $arr_loto[0] . "</span><span class='cau_vt2'>" . $arr_loto[1] . "</span></span>-"
        , "<span class='cau_lo'><span class='cau_vt2'>" . $arr_loto[0] . '</span>' . $arr_loto[1] . "</span>-"
        , "<span class='cau_lo'>" . $arr_loto[0] . "<span class='cau_vt2'>" . $arr_loto[1] . "</span></span>-"
        , "<span class='cau_lo'>" . $loto . "</span>-"
    );

    $giai = $giai . '-';
    $giai = preg_replace($pattern, $replacement, $giai);
    $giai = substr($giai, 0, -1);

    return $giai;
}

$days = array('0' => 'Chủ Nhật', '1' => 'Thứ Hai', '2' => 'Thứ Ba', '3' => 'Thứ Tư', '4' => 'Thứ Năm', '5' => 'Thứ Sáu', '6' => 'Thứ Bảy');
$ngay_format = str_replace('-', '/', $ngay);
?>
<div id='showcaucontent'>
    <div style='text-align: center;color:#069; font-size:15px; font-weight:bold'>Cầu <?php echo $db == 0 ? 'lotto' : 'giải Đặc biệt' ?> ngày <?php echo $ngay_format ?> tại vị trí <?php echo $vt ?></div>
    <div style='text-align: center;padding-top:10px; color:#007500; font-size:12px'>Theo cầu này, dự đoán ngày <?php echo $ngay_format ?> <?php echo $db == 0 ? 'Lotto' : 'Đặc biệt' ?> sẽ về <b style='font-size:15px; font-weight:bold; color:red'><?php echo str_replace(',', "</b> hoặc <b style='font-size:15px; font-weight:bold; color:red'>", $so) ?></b></div>
    <?php
    $ma_nhung = '';
    foreach ($list as $ii => $item) {
        $date = date('d/m/Y', strtotime($item->date));
        $datew = date('w', strtotime($item->date));

        $arr_str = str_split($item->str);
        $arr_str[$arr_vitri[0]] = "<span class='cau_vt1'>" . $arr_str[$arr_vitri[0]] . "</span>";
        $arr_str[$arr_vitri[1]] = "<span class='cau_vt1'>" . $arr_str[$arr_vitri[1]] . "</span>";

        $giaidb = '';
        $giai1 = '';
        $giai2 = '';
        $giai31 = '';
        $giai32 = '';
        $giai4 = '';
        $giai51 = '';
        $giai52 = '';
        $giai6 = '';
        $giai7 = '';
        foreach ($arr_str as $i => $value) {
            if ($i <= 4) {
                $giaidb .= $value;
            } elseif ($i >= 5 && $i <= 9) {
                $giai1 .= $value;
            } elseif ($i >= 10 && $i <= 19) {
                if ($i == 15)
                    $giai2 .= '-';
                $giai2 .= $value;
            }elseif ($i >= 20 && $i <= 34) {
                if ($i == 25 || $i == 30)
                    $giai31 .= '-';
                $giai31 .= $value;
            }elseif ($i >= 35 && $i <= 49) {
                if ($i == 40 || $i == 45)
                    $giai32 .= '-';
                $giai32 .= $value;
            }elseif ($i >= 50 && $i <= 65) {
                if ($i == 54 || $i == 58 || $i == 62)
                    $giai4 .= '-';
                $giai4 .= $value;
            }elseif ($i >= 66 && $i <= 77) {
                if ($i == 70 || $i == 74)
                    $giai51 .= '-';
                $giai51 .= $value;
            }elseif ($i >= 78 && $i <= 89) {
                if ($i == 82 || $i == 86)
                    $giai52 .= '-';
                $giai52 .= $value;
            }elseif ($i >= 90 && $i <= 98) {
                if ($i == 93 || $i == 96)
                    $giai6 .= '-';
                $giai6 .= $value;
            }elseif ($i >= 99) {
                if ($i == 101 || $i == 103 || $i == 105)
                    $giai7 .= '-';
                $giai7 .= $value;
            }
        }

        $loto = '';
        if (isset($list[$ii + 1])) {
            if ($lon == 0) {
                $loto = substr($list[$ii + 1]->str, $arr_vitri[0], 1) . substr($list[$ii + 1]->str, $arr_vitri[1], 1);
            } else {
                $so_vitri1 = substr($list[$ii + 1]->str, $arr_vitri[0], 1);
                $so_vitri2 = substr($list[$ii + 1]->str, $arr_vitri[1], 1);
                if ($so_vitri1 != $so_vitri2) {
                    if ($so_vitri1 > $so_vitri2)
                        $loto = $so_vitri2 . $so_vitri1 . ',' . $so_vitri1 . $so_vitri2;
                    else
                        $loto = $so_vitri1 . $so_vitri2 . ',' . $so_vitri2 . $so_vitri1;
                } else {
                    $loto = $so_vitri1 . $so_vitri2;
                }
            }
        }

        if ($loto != '') {
            if ($lon == 0) {
                $arr_loto = str_split($loto);
            } else {
                $lotos = explode(',', $loto);
                if (isset($lotos[0])) {
                    $arr_loto = str_split($lotos[0]);
                    $loto = $lotos[0];
                }
            }

            $giaidb = formatCau($giaidb, $arr_loto, $loto);
            $giai1 = formatCau($giai1, $arr_loto, $loto);
            $giai2 = formatCau($giai2, $arr_loto, $loto);
            $giai31 = formatCau($giai31, $arr_loto, $loto);
            $giai32 = formatCau($giai32, $arr_loto, $loto);
            $giai4 = formatCau($giai4, $arr_loto, $loto);
            $giai51 = formatCau($giai51, $arr_loto, $loto);
            $giai52 = formatCau($giai52, $arr_loto, $loto);
            $giai6 = formatCau($giai6, $arr_loto, $loto);
            $giai7 = formatCau($giai7, $arr_loto, $loto);

            if ($lon == 1 && isset($lotos[1])) {
                $arr_loto = str_split($lotos[1]);
                $loto = $lotos[1];

                $giaidb = formatCau($giaidb, $arr_loto, $loto);
                $giai1 = formatCau($giai1, $arr_loto, $loto);
                $giai2 = formatCau($giai2, $arr_loto, $loto);
                $giai31 = formatCau($giai31, $arr_loto, $loto);
                $giai32 = formatCau($giai32, $arr_loto, $loto);
                $giai4 = formatCau($giai4, $arr_loto, $loto);
                $giai51 = formatCau($giai51, $arr_loto, $loto);
                $giai52 = formatCau($giai52, $arr_loto, $loto);
                $giai6 = formatCau($giai6, $arr_loto, $loto);
                $giai7 = formatCau($giai7, $arr_loto, $loto);
            }
        }

        $ma_nhung .= '<br>[color=#C9C9C9][size=200]▲[/size][/color]
        <br>[size=100][b]Mở thưởng ' . $days[$datew] . ' ngày ' . $date . '[/b][/size]
        <br>Đặc Biệt: ' . $giaidb . '
        <br>Giải Nhất: ' . $giai1 . '
        <br>Giải Nhì: ' . $giai2 . '
        <br>Giải Ba: ' . $giai31 . '-' . $giai32 . '
        <br>Giải Tư: ' . $giai4 . '
        <br>Giải Năm: ' . $giai51 . '-' . $giai52 . '
        <br>Giải Sáu: ' . $giai6 . '
        <br>Giải Bảy: ' . $giai7;

        $pattern = array('/<span class=\'cau_vt2\'>(.*?)<\/span>/i'
            , '/<span class=\'cau_vt1\'>(.*?)<\/span>/i'
            , '/<span class=\'cau_lo\'>(.*?)<\/span>/i'
        );
        $replacement = array('[size=200][color=#0005DD]$1[/color][/size]'
            , '[size=150][color=#0005DD]$1[/color][/size]'
            , '[color=#FF0000][size=150][u]$1[/u][/size][/color]'
        );

        $ma_nhung = preg_replace($pattern, $replacement, $ma_nhung);
        ?>
        <div style='font-size:20px; color:#C9C9C9;text-align: center; clear:both'>▲</div>
        <table class=ketquacau cellspacing=1 cellpadding=5px style='margin:0 auto'>
            <thead>
                <tr>
                    <th colspan=13>Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date ?></th>
                </tr>
            </thead>
            <tr>
                <td>Đặc Biệt</td>
                <td colspan=12><?php echo $giaidb ?></td>
            </tr>
            <tr>
                <td>Giải Nhất</td>
                <td colspan=12><?php echo $giai1 ?></td>
            </tr>
            <tr>
                <td>Giải Nhì</td>
                <td colspan=6><?php echo str_replace('-', '</td><td colspan=6>', $giai2) ?></td>
            </tr>
            <tr>
                <td rowspan=2>Giải Ba</td>
                <td colspan=4><?php echo str_replace('-', '</td><td colspan=4>', $giai31) ?></td>
            </tr>
            <tr>
                <td colspan=4><?php echo str_replace('-', '</td><td colspan=4>', $giai32) ?></td>
            </tr>
            <tr>
                <td>Giải Tư</td>
                <td colspan=3><?php echo str_replace('-', '</td><td colspan=3>', $giai4) ?></td>
            </tr>
            <tr>
                <td rowspan=2>Giải Năm</td>
                <td colspan=4><?php echo str_replace('-', '</td><td colspan=4>', $giai51) ?></td>
            </tr>
            <tr>
                <td colspan=4><?php echo str_replace('-', '</td><td colspan=4>', $giai52) ?></td>
            </tr>
            <tr>
                <td>Giải Sáu</td>
                <td colspan=4><?php echo str_replace('-', '</td><td colspan=4>', $giai6) ?></td>
            </tr>
            <tr>
                <td>Giải Bảy</td>
                <td colspan=3><?php echo str_replace('-', '</td><td colspan=3>', $giai7) ?></td>
            </tr>
            <tr class=lastrow>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        </table>
        <?php
    }
    ?>
</div>
<!--<div style='margin:10px 0 5px 0; color:#535353;text-align: center'>
    <a href='#' title='Bấm vào đây để in cầu' onclick="printSelection(document.getElementById('showcaucontent'),'');return false" style='font-weight:bold'>&gt;&gt; In cầu</a> &nbsp;&nbsp;  <a href='#' style='font-weight:bold' onclick='$(".caubb").show("fast"); return false'>&gt;&gt; Mã nhúng Forum</a> <span class='caubb' style='display:none'>(Copy đoạn mã này để post cầu lên các diễn đàn)</span>
</div>
<div style='border:#B4BFD3 1px solid; display:none;text-align: center' class=caubb>
    <div id='caubbholder' style='text-align: left; height:120px; overflow:auto; font-family:tahoma,arial; font-size:11px; color:#A3A3A3' onclick='selectText("caubbholder")'>[color=#014BA7][size=130][b]Cầu <?php echo $db == 0 ? 'lotto' : 'giải Đặc biệt' ?> ngày <?php echo $ngay_format ?> tại vị trí <?php echo $vt ?>[/b][/size][/color]
        <br>[color=#007500]Theo cầu này, dự đoán ngày <?php echo $ngay_format ?> <?php echo $db == 0 ? 'lô' : 'đề' ?> sẽ về [/color] [b][size=150][color=#FF0000]<?php echo str_replace(',', "[/color][/size][/b][color=#007500] hoặc [/color][b][size=150][color=#FF0000]", $so) ?>[/color][/size][/b]
        <?php echo $ma_nhung ?>
        <br>
        <br> [url=<?php echo $uri_root . 'soi-cau.html' ?>][b]Xem các cầu khác hôm nay[/b][/url]
    </div>
</div>-->