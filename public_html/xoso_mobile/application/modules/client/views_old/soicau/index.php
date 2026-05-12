<div class="title title-red">
    <div class="title-right">Thống kê cầu lô tô</div>
</div>
<div class="box-result">
    <div class="select-provice rate-lo clearfix">
        <form id="form_search" method="post" action="">
            <div class="rows clearfix">
                <div class="left">
                    <select name="lid" id="select_mien" tabindex="1">
                        <?php
                        $area = 'MB';
                        $lname = '';
                        $statistics_alias = '';
                        $alias = '';
                        $code = '';
                        foreach ($xs_location_menu as $value) {
                            $selected = '';
                            if ($lid == $value->id) {
                                $selected = ' selected=""';
                                $lname = $value->name;
                                $statistics_alias = $value->alias;
                                $alias = $value->alias;
                                $area = $value->area;
                                $code = $value->code;
                            }
                            echo '<option' . $selected . ' value="' . $value->alias . '">' . $value->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="left numberbox">
                    <label>Chọn số biên độ cầu</label>
                    <span class="span-input">
                        <input name="amplitude" value="<?php echo $amplitude; ?>" class="txt-input txt-liver" />
                    </span>
                </div>
                <a class="read-more" href="javascript:;" onclick="doSubmit('thongke-cau');"><span>Xem kết quả</span></a>
            </div>
        </form>
    </div>
    <h1>Thống kê cầu lô tô <a href="<?php echo $statistics_alias ?>.html"><?php echo $lname ?></a></h1>
    <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function(){
<?php
foreach ($items['xoso_arr'] as $k => $v) {
    $date = $v['date'];
    $id_date = str_replace('-', '', $date);
    ?>
                for(var index = 0; index < A<?php echo $id_date ?>.length ; index++) {
                    $('#mb_' + String(index+1)+'_<?php echo $id_date ?>').html(A<?php echo $id_date ?> [index] );
                    if (Aloto[index] == 2)  { 
                        var IdLoto =  '#mb_dau' + A<?php echo $id_date ?> [index-1]+'_<?php echo $id_date ?>';
                        $(IdLoto).html($(IdLoto).html()+ A<?php echo $id_date ?> [index] + ',') 
                    }
                };  
<?php } ?>
        return;
    });
    //]]>
    </script>

    <div id="kqcaumb" style="margin: 0 5px; padding-left: 10px;"><br/><center><img src="<?php echo img_link('icon-xs/007.gif'); ?>" width="145" height="15" alt="" /></center><br/></div>
    <br/>
    <?php
    $Axoso = '';
    $days = array(
        '0' => 'Chủ nhật',
        '1' => 'Thứ 2',
        '2' => 'Thứ 3',
        '3' => 'Thứ 4',
        '4' => 'Thứ 5',
        '5' => 'Thứ 6',
        '6' => 'Thứ 7'
    );
    $title_share = isset($_meta['title']) ? $_meta['title'] : '';
    $title_share = urlencode($title_share);
    foreach ($items['xoso_arr'] as $k => $v) {
        $date = $v['date'];
        $value = $v['value'];
        $id_date = str_replace('-', '', $date);

//        $alias_date = $alias . '/' . str_replace('/', '-', $date);
        $dateOfWeek = strtotime(str_replace('/', '-', $date));

        $date_ve_do = str_replace('/', '-', $date);
        $alias_date = $alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . $title_share;
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . $_meta['title'] . '&amp;body=' . $curPageURL;
        if ($area == 'MB') {
            ?>
            <div class="box-result clear" style="border-top:2px solid #E1E1E1;border-left:0;border-right:0">
                <table class="tbl-tt tbl-main-tt"> 
                    <tr>
                        <td colspan="2" class="bg-yelow1"><a href="<?php echo $uri_root . $alias_date ?>.html"><strong class="txt-red"><h2><?php echo $k + 1 ?> - Xổ Số <?php echo $lname ?> - <?php echo $days[date('w', $dateOfWeek)] ?> ngày <?php echo str_replace('-', '/', $date) ?></h2></strong></a></td>
                        <td class="td-sub" rowspan="8">
                            <table class="tbl-dd">
                                <tr>
                                    <th class="first bg-yelow1">Đầu</th>
                                    <th class="last bg-yelow1">Đuôi</th>
                                </tr>
                                <?php for ($i = 0; $i <= 9; $i++) { ?>
                                    <tr>
                                        <td class="first"><?php echo $i ?></td>
                                        <td class="<?php echo($i == 9 ? 'last' : ''); ?>"><?php echo '<span  class="caumb" id="mb_dau' . $i . '_' . $id_date . '">&nbsp;</span>'; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải đặc biệt</td>
                        <td class="bg-gray border-right giaidb">
                            <strong class="red font18 span-space">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải nhất</td>
                        <td class="border-right giai1">
                            <strong class="span-space">
                                <?php
                                for ($i = 6; $i <= 10; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải nhì</td>
                        <td class="bg-gray border-right giai2">
                            <strong class="span-space">
                                <?php
                                for ($i = 11; $i <= 15; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 16; $i <= 20; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải ba</td>
                        <td class="border-right giai3">
                            <strong class="span-space">
                                <?php
                                for ($i = 21; $i <= 25; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 26; $i <= 30; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 31; $i <= 35; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 36; $i <= 40; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 41; $i <= 45; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 46; $i <= 50; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải tư</td>
                        <td class="bg-gray border-right giai4">
                            <strong class="span-space">
                                <?php
                                for ($i = 51; $i <= 54; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 55; $i <= 58; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 59; $i <= 62; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 63; $i <= 66; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải năm</td>
                        <td class="border-right giai5">
                            <strong class="span-space">
                                <?php
                                for ($i = 67; $i <= 70; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 71; $i <= 74; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 75; $i <= 78; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 79; $i <= 82; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 83; $i <= 86; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 87; $i <= 90; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải sáu</td>
                        <td class="bg-gray border-right giai6">
                            <strong class="span-space">
                                <?php
                                for ($i = 91; $i <= 93; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 94; $i <= 96; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 97; $i <= 99; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải bảy</td>
                        <td class="border-right giai7">                               
                            <strong class="span-space"><span class="caumb" id="mb_100_<?php echo $id_date ?>"></span><span class="caumb" id="mb_101_<?php echo $id_date ?>"></span></strong>
                            <strong class="span-space"><span class="caumb" id="mb_102_<?php echo $id_date ?>"></span><span class="caumb" id="mb_103_<?php echo $id_date ?>"></span></strong>
                            <strong class="span-space"><span class="caumb" id="mb_104_<?php echo $id_date ?>"></span><span class="caumb" id="mb_105_<?php echo $id_date ?>"></span></strong>
                            <strong class="span-space"><span class="caumb" id="mb_106_<?php echo $id_date ?>"></span><span class="caumb" id="mb_107_<?php echo $id_date ?>"></span></strong>
                        </td>
                        <td>
                            <div class="share-like clearfix">
                                <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                                <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                                <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                                <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="line-red mb10">&nbsp;</div>
            <ul class="list-editor space1">
                <li>Để nhận kết quả xổ số <strong>Miền Bắc</strong> sớm nhất, soạn tin <span>KQ MB</span> gửi <span>8117</span></li>
            </ul>
            <div class="tabs-note space-pleft clearfix">
                <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=1&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
                <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
                <a class="span-vs" href="<?php echo $uri_root ?>ve-so-mien-bac.html">Hình ảnh vé số </a>
                <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
                <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
            </div>
        <?php } else { ?>
            <div class="box-result clear" style="border-top:2px solid #E1E1E1;border-left:0;border-right:0">
                <table class="tbl-tt tbl-main-tt kqmiennam">
                    <tr>
                        <td colspan="2" class="bg-yelow1"><a href="<?php echo $uri_root . $alias_date ?>.html"><strong class="txt-red"><h2><?php echo $k + 1 ?> - Xổ Số <?php echo $lname ?> - <?php echo $days[date('w', $dateOfWeek)] ?> ngày <?php echo str_replace('-', '/', $date) ?></h2></strong></a></td>
                        <td class="td-sub" rowspan="9">
                            <table class="tbl-dd">
                                <tr>
                                    <th class="first bg-yelow1">Đầu</th>
                                    <th class="last bg-yelow1">Đuôi</th>
                                </tr>
                                <?php for ($i = 0; $i <= 9; $i++) { ?>
                                    <tr>
                                        <td class="first"><?php echo $i ?></td>
                                        <td class="<?php echo($i == 9 ? 'last' : ''); ?>"><?php echo '<span  class="caumb" id="mb_dau' . $i . '_' . $id_date . '">&nbsp;</span>'; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải đặc biệt</td>
                        <td class="bg-gray border-right giaidb">
                            <strong class="red font18 span-space">
                                <?php
                                for ($i = 77; $i <= 82; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải nhất</td>
                        <td class="border-right giai1">
                            <strong class="span-space">
                                <?php
                                for ($i = 72; $i <= 76; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải nhì</td>
                        <td class="bg-gray border-right giai2">
                            <strong class="span-space">
                                <?php
                                for ($i = 67; $i <= 71; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải ba</td>
                        <td class="border-right giai3">
                            <strong class="span-space">
                                <?php
                                for ($i = 57; $i <= 61; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 62; $i <= 66; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải tư</td>
                        <td class="bg-gray border-right giai4">
                            <strong class="span-space">
                                <?php
                                for ($i = 22; $i <= 26; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 27; $i <= 31; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 32; $i <= 36; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 37; $i <= 41; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 42; $i <= 46; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 47; $i <= 51; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 52; $i <= 56; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải năm</td>
                        <td class="border-right giai5">
                            <strong class="span-space">
                                <?php
                                for ($i = 18; $i <= 21; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải sáu</td>
                        <td class="bg-gray border-right giai6">
                            <strong class="span-space">
                                <?php
                                for ($i = 6; $i <= 9; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 10; $i <= 13; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                            <strong class="span-space">
                                <?php
                                for ($i = 14; $i <= 17; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right">Giải bảy</td>
                        <td class="border-right giai7">
                            <strong class="span-space">
                                <?php
                                for ($i = 3; $i <= 5; $i++) {
                                    echo '<span class="caumb" id="mb_' . $i . '_' . $id_date . '"></span>';
                                }
                                ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-gray border-right">Giải tám</td>
                        <td class="bg-gray border-right giai8">
                            <strong class="span-space"><span class="caumb" id="mb_1_<?php echo $id_date ?>"></span><span class="caumb" id="mb_2_<?php echo $id_date ?>"></span></strong>
                        </td>
                        <td class="t-cen">
                            <div class="share-like clearfix">
                                <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                                <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                                <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                                <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="line-red mb10">&nbsp;</div>
            <ul class="list-editor space1">
                <li>Để nhận kết quả xổ số <strong><?php echo $lname ?></strong> sớm nhất, soạn tin <span>KQ <?php echo $code ?></span> gửi <span>8117</span></li>
            </ul>
            <div class="tabs-note space-pleft clearfix">
                <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=<?php echo $area == 'MT' ? 2 : 3 ?>&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
                <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
                <a class="span-vs" href="<?php echo $uri_root ?>ve-so-<?php echo $area == 'MT' ? 'mien-trung' : 'mien-nam' ?>.html">Hình ảnh vé số </a>
                <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
                <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
            </div>
            <?php
        }
        $arr = str_split($value);
        $str = '';
        foreach ($arr as $i => $v) {
            if ($i == 0)
                $str .= "'" . $v . "'";
            else
                $str .= ",'" . $v . "'";
        }
        $Axoso .= 'var A' . $id_date . ' = new Array(' . $str . ');' . "\n";
    }

    $valuelt = '';
    $lifetime = '';
    $positionOne = '';
    $positionTwo = '';
    for ($i = 0; $i <= 9; $i++) {
        for ($j = 0; $j <= 9; $j++) {
            if (isset($items['result'][$i . $j])) {
                if ($valuelt == '') {
                    $valuelt .= "'" . $i . $j . "'";
                    $lifetime .= $amplitude;
                    $positionOne .= $items['result'][$i . $j][0][0];
                    $positionTwo .= $items['result'][$i . $j][0][1];
                } else {
                    $valuelt .= ",'" . $i . $j . "'";
                    $lifetime .= ',' . $amplitude;
                    $positionOne .= "," . $items['result'][$i . $j][0][0];
                    $positionTwo .= "," . $items['result'][$i . $j][0][1];
                }
            }
        }
    }
    ?>

    <script type="text/javascript">
        var lifetime = new Array(<?php echo $lifetime ?>);
        var valuelt = new Array(<?php echo $valuelt ?>);
        var positionOne = new Array(<?php echo $positionOne ?>);
        var positionTwo = new Array(<?php echo $positionTwo ?>);
    
<?php echo $Axoso ?>
     
<?php if ($area == 'MB') { ?>
        var Aloto = new Array(0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,1,2,0,1,2,0,1,2,1,2,1,2,1,2,1,2); 
<?php } elseif ($area == 'MT') { ?>
        var Aloto = new Array(1,2,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2);
<?php } elseif ($area == 'MN') { ?>
        var Aloto = new Array(1,2,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,1,2,0,0,0,0,1,2);
<?php } ?>
        
    var pos1 = 0;
    var pos2 = 0;
    var flag = 0;
    function setlotocolor(pos) {
        var lt1='10'; var lt2='10'; setFlag();  setloto(pos);
        
<?php
foreach ($items['xoso_arr'] as $k => $v) {
    $date = $v['date'];
    $id_date = str_replace('-', '', $date);
    $before_date = '';
    if (isset($items['xoso_arr'][$k + 1]))
        $before_date = str_replace('-', '', $items['xoso_arr'][$k + 1]['date']);
    ?>
                $('#mb_' + String(pos)+'_<?php echo $id_date ?>').removeClass("caumb");$('#mb_' + String(pos)+'_<?php echo $id_date ?>').addClass("caumbchon"); 
    <?php if ($before_date) { ?>
                    if (pos1 > 0) lt1=A<?php echo $before_date ?>[pos1 - 1]; 
                    else lt1='10'; 
                    if (pos2 > 0) lt2=A<?php echo $before_date ?>[pos2 - 1]; 
                    else lt2='10'; 
                    if (( lt1 !='10') && ( lt2 !='10')) {  
                        for(var index=0;index < A<?php echo $before_date ?>.length;index++)  {  
                            if (Aloto[index]==1)  {  
                                if ((A<?php echo $id_date ?>[index]==lt1) && (A<?php echo $id_date ?>[index+1]==lt2) || (A<?php echo $id_date ?>[index]==lt2) && (A<?php echo $id_date ?>[index+1]==lt1)) {  
                                    $('#mb_' + String(index+1)+ '_<?php echo $id_date ?>').removeClass("caumb") ; 
                                    $('#mb_' + String(index+1)+ '_<?php echo $id_date ?>').removeClass("caumbchon") ; 
                                    $('#mb_' + String(index+1)+ '_<?php echo $id_date ?>').addClass("caumbresult") ;
                                    $('#mb_' + String(index+2)+ '_<?php echo $id_date ?>').removeClass("caumb") ; 
                                    $('#mb_' + String(index+2)+ '_<?php echo $id_date ?>').removeClass("caumbchon") ; 
                                    $('#mb_' + String(index+2)+ '_<?php echo $id_date ?>').addClass("caumbresult") ; 
                                }  
                            }  
                        }  
                    } 
    <?php } ?>
<?php } ?>
    };
<?php if (strlen($valuelt) > 4) { ?>
        $(document).ready(function(){writeCau()});
        function writeCau(){setTimeout("writeListCoupleValue();",2000)}
        function writeListCoupleValue(){var strHtml;strHtml=writeCouplevalueAll();strHtml+="<div style=\"padding:10px 0px 0px 10px;\">* Bấm vào số trong danh sách lô tô để xem thống kê cụ thể.</div>";strHtml+="<div style=\"padding:10px 0px 0px 10px;\">* Cặp số màu đỏ chỉ cặp lô tô đã về, cặp số màu xanh chỉ vị trí thống kê.</div>";strHtml+="<div style=\"padding:10px 0px 0px 10px;\">* Lô tô sẽ hiển thị trong danh sách kết quả xổ số ở dưới đây.</div>";strHtml+="  <div style=\"clear: both\"></div> ";$("#kqcaumb").html(strHtml);return};
<?php } else { ?>
        var strHtml;strHtml='<br/><div style="float:left;font-weight:bold;color:blue"> + Biên độ <font color="color:red;"><?php echo $amplitude ?></font> ngày: </div><div style="float:left;padding-left:5px;"><font color =\"color:red;\">Không tìm thấy</font></div><div style="clear:both;"><div><div style="padding:10px 0px 0px 10px;">* Bấm vào số trong danh sách lô tô để xem thống kê cụ thể.</div><div style="padding:10px 0px 0px 10px;">* Cặp số màu đỏ chỉ cặp lô tô đã về, cặp số màu xanh chỉ vị trí thống kê.</div><div style="padding:10px 0px 0px 10px;">* Lô tô sẽ hiển thị trong danh sách kết quả xổ số ở dưới đây, bạn cũng có thể click chuột vào danh sách này để tự thành lập cho lựa chọn của mình.</div>  <div style="clear: both"></div> </div></div>';$("#kqcaumb").html(strHtml);
<?php } ?>
    function writeCouplevalueAll(){var life=0;var result="";var lifetimelimit=3;if(lifetime.length>0)lifetimelimit=lifetime.length-1;for(var idx=lifetimelimit;idx>=0;idx--){life=lifetime[idx];result=result+"<br/><div style=\"float:left;font-weight:bold;color:blue\"> + Biên độ <font color =\"color:red;\">"+String(life)+"</font> ngày: </div><div style=\"float:left;padding-left:5px;\">"+writeCouplevaluebylife(life)+"</div>";for(var index=lifetime.length-1;index>=idx;index--){if(lifetime[index]==life)idx=idx-1}idx++;result=result+"<div style=\"clear:both;\"><div>"}return result};
    function writeCouplevaluebylife(life){var result="";var count=0;for(var idx=0;idx<lifetime.length;idx++){if(lifetime[idx]==life){count=count+1;result=result+"<span  onclick =\"setcolortoloto("+String(positionOne[idx])+","+String(positionTwo[idx])+");\" class=\"caumb\" ><font color =\"red\"><b>"+valuelt[idx]+"</b></font></span>";if(count==20){result=result+"<br />";count=0}else{result=result+"&nbsp;&nbsp;"}}}return result};
    function setcolortoloto(mpos1,mpos2){pos1=0;pos2=0;setlotocolor(mpos1);setlotocolor(mpos2);return};
    function setFlag(){flag=flag+1;if(flag==3)flag=0;if(flag==0){flag=flag+1;resetColor()}return};
    function setloto(pos){if(pos1==0)pos1=pos;else if(pos2==0)pos2=pos;else{pos1=pos;pos2=0}if(pos2==pos1)pos1=0;return};
    function resetColor(){$(".caumbchon").removeClass().addClass("caumb");$(".caumbresult").removeClass().addClass("caumb")};
    $(function(){$("#select_mien").selectbox()});
    </script>
</div>
<br/>
<div class="msg-block">Thống kê cầu loto: Tìm ra các cặp cầu dựa nào ghép nối các vị trí khác nhau trong bảng kết quả. Mục đích trợ giúp bạn trong việc chọn các cặp số loto may mắn và có xác suất cao ra trong lần quay tiếp theo.</div>
<br/>
<?php
$this->load->view($layout_sms);
$statistics_content = str_replace('[TINH]', '<a href="' . $statistics_alias . '.html">' . $lname . '</a>', $statistics_content);
echo '<br/><div class="msg-block">' . $statistics_content . '</div>';
?>