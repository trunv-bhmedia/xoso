<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<?php
$cur_year = date('Y');
$min_year = $cur_year - 10;
$yearList = array();
for ($i = $min_year; $i <= $cur_year; $i++) {
    $tmp = sprintf('%02d', $i);
    $yearList[] = $tmp;
}

if ($alias == $url_mienbac) {
    echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ MIỀN BẮC</h1>';
    foreach ($items as $k => $v) {
        $v->extra = json_decode($v->extension);
        $date_ve_do = str_replace('/', '-', $v->date);

        $v->data[0] = $v->a0;
        $v->data[1] = $v->a1;
        $v->data[2] = $v->a2;
        $v->data[3] = $v->a3;
        $v->data[4] = $v->a4;
        $v->data[5] = $v->a5;
        $v->data[6] = $v->a6;
        $v->data[7] = $v->a7;

        $select_day = date('d', strtotime($date_ve_do));
        $select_month = date('m', strtotime($date_ve_do));
        $select_year = date('Y', strtotime($date_ve_do));

        $title_share = 'Xổ Số ' . $v->name . ' - ' . $v->dateOfWeek . ' ngày ' . $v->date;

        $alias_date = $v->alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL;
        ?>
        <div class="tit-xs clearfix">
            <strong class="title-xs">XỔ SỐ TRUYỀN THỐNG - <?php echo $v->date ?></strong>
            <div class="menuRight">
                <a href="<?php echo $uri_root . $v->alias; ?>.html"><img src="<?php echo img_link('date.png'); ?>" width="15" height="16" alt="" /></a>
            </div>
        </div>
        <table class="tbl-xs">
            <tr>
                <td class="bg-gray border-right">Giải đặc biệt</td>
                <td class="bg-gray border-right giaidb">
                    <?php
                    echo '<strong class="red font18 span-space">' . $v->data[0] . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải nhất</td>
                <td class="border-right giai1">
                    <?php
                    echo '<strong class="span-space">' . $v->data[1] . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải nhì</td>
                <td class="bg-gray border-right giai2">
                    <?php
                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[2]);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải ba</td>
                <td class="border-right giai3">
                    <?php
                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[3]);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>

            </tr>
            <tr>
                <td class="bg-gray border-right">Giải tư</td>
                <td class="bg-gray border-right giai4">
                    <?php
                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[4]);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải năm</td>
                <td class="border-right giai5">
                    <?php
                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[5]);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải sáu</td>
                <td class="bg-gray border-right giai6">
                    <?php
                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[6]);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải bảy</td>
                <td class="border-right giai7">
                    <?php
                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[7]);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
        </table>
        <table class="tbl-xs">
            <tr>
                <th class="red">Đầu</th>
                <th class="red border-right">Đuôi</th>
                <th class="red border-right">Đầu</th>
                <th class="red">Đuôi</th>
            </tr>
            <tr>
                <td class="bg-gray first"><strong>0</strong></td>
                <td class="bg-gray border-right"><?php echo $v->extra[0] ?></td>
                <td class="bg-gray border-right"><strong>5</strong></td>
                <td class="bg-gray"><?php echo $v->extra[5] ?></td>
            </tr>
            <tr>
                <td class="first"><strong>1</strong></td>
                <td class="border-right"><?php echo $v->extra[1] ?></td>
                <td class="border-right"><strong>6</strong></td>
                <td><?php echo $v->extra[6] ?></td>
            </tr>
            <tr>
                <td class="bg-gray first"><strong>2</strong></td>
                <td class="bg-gray border-right"><?php echo $v->extra[2] ?></td>
                <td class="bg-gray border-right"><strong>7</strong></td>
                <td class="bg-gray"><?php echo $v->extra[7] ?></td>
            </tr>
            <tr>
                <td class="first"><strong>3</strong></td>
                <td class="border-right"><?php echo $v->extra[3] ?></td>
                <td class="border-right"><strong>8</strong></td>
                <td><?php echo $v->extra[8] ?></td>
            </tr>
            <tr>
                <td class="bg-gray first"><strong>4</strong></td>
                <td class="bg-gray border-right"><?php echo $v->extra[4] ?></td>
                <td class="bg-gray border-right"><strong>9</strong></td>
                <td class="bg-gray"><?php echo $v->extra[9] ?></td>
            </tr>
        </table>
        <div class="view-result clearfix">
            <div class="right share-right">
                <div class="share-like left">
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
                </div>
            </div>
        </div>
        <div class="select-provice bg-shadow">
            <div class="pn rows clearfix">
                <span class="span-input left"><a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday1) ?>.html">« Trước</a></span>
                <span class="span-input right"><a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday2) ?>.html">Sau »</a></span>
            </div>
            <div class="view-day">Xem theo ngày</div>
            <form id="form_search" method="post" action="">
                <div class="box-fromto t-cen">
                    <select name="select_day" id="select_day" tabindex="1">
                        <option value="">Ngày</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            $selected = '';
                            if ($select_day == $i) {
                                $selected = ' selected=""';
                            }
                            echo '<option' . $selected . ' value="' . $i . '">' . sprintf('%02d', $i) . '</option>';
                        }
                        ?>
                    </select>
                    <select name="select_month" id="select_month" tabindex="1">
                        <option value="">Tháng</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = '';
                            if ($select_month == $i) {
                                $selected = ' selected=""';
                            }
                            echo '<option' . $selected . ' value="' . $i . '">' . sprintf('%02d', $i) . '</option>';
                        }
                        ?>
                    </select>
                    <select name="select_year" id="select_year" tabindex="1">
                        <option value="">Năm</option>
                        <?php
                        foreach ($yearList as $value) {
                            $selected = '';
                            if ($select_year == $value) {
                                $selected = ' selected=""';
                            }
                            echo '<option' . $selected . ' value="' . $value . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="t-cen">
                    <a href="javascript:;" class="read-more" onclick="kqSubmit('<?php echo $uri_root . $v->alias ?>');"><span>Xem kết quả</span></a>
                </div>
            </form>
            <div class="tabs-note t-cen">
                <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
                <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
            </div>
        </div>
        <div class="msg-block"><?php echo $location_menu['MB'][0]->description ?></div>
        <?php
    }
} else {
    $url = '';
    $lid = 1;
    if ($items[0]->area == 'MT') {
        $l_area = 'MIỀN TRUNG';
        $url = $url_mientrung;
        $lid = 2;
    } else {
        $l_area = 'MIỀN NAM';
        $url = $url_miennam;
        $lid = 3;
    }

    $description = '';
    if ($alias == $url_mientrung || $alias == $url_miennam) {
        echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . '</h1>';
    } else {
        echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . mb_strtoupper($items[0]->name, 'UTF-8') . '</h1>';
        foreach ($location_menu[$items[0]->area] as $key => $value) {
            if ($value->id == $items[0]->lid) {
                $description = $value->description;
                break;
            }
        }
    }
    foreach ($items as $k => $v) {
        $v->extra = json_decode($v->extension);
        $date_ve_do = str_replace('/', '-', $v->date);

        $select_day = date('d', strtotime($date_ve_do));
        $select_month = date('m', strtotime($date_ve_do));
        $select_year = date('Y', strtotime($date_ve_do));

        $title_share = 'Xổ Số ' . $v->name . ' - ' . $v->dateOfWeek . ' ngày ' . $v->date;

        $alias_date = $v->alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL;
        ?>
        <div class="tit-xs clearfix">
            <strong class="title-xs">XỔ SỐ <?php echo $l_area ?> - <?php echo $v->date ?></strong>
            <div class="menuRight">
                <a href="<?php echo $uri_root . $url ?>.html"><img src="<?php echo img_link('date.png'); ?>" width="15" height="16" alt="" /></a>
            </div>
        </div>
        <div class="page-title">
            <a href="<?php echo $uri_root . $alias_date ?>.html"><strong class="txt-red"><h2>Xổ Số <?php echo $v->name; ?> - <?php echo $v->dateOfWeek ?> ngày <?php echo $v->date ?></h2></strong></a>
        </div>
        <table class="tbl-xs kqmiennam">
            <tr>
                <td class="bg-gray border-right">Giải đặc biệt</td>
                <td class="bg-gray border-right giaidb">
                    <?php
                    echo '<strong class="red font18 span-space">' . $v->a0 . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải nhất</td>
                <td class="border-right giai1">
                    <?php
                    echo '<strong class="span-space">' . $v->a1 . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải nhì</td>
                <td class="bg-gray border-right giai2">
                    <?php
                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a2);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải ba</td>
                <td class="border-right giai3">
                    <?php
                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a3);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải tư</td>
                <td class="bg-gray border-right giai4">
                    <?php
                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a4);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải năm</td>
                <td class="border-right giai5">
                    <?php
                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a5);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải sáu</td>
                <td class="bg-gray border-right giai6">
                    <?php
                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a6);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải bảy</td>
                <td class="border-right giai7">
                    <?php
                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a7);
                    echo '<strong class="span-space">' . $str . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải tám</td>
                <td class="bg-gray border-right giai8">
                    <?php
                    echo '<strong class="span-space">' . $v->a8 . '</strong>';
                    ?>
                </td>
            </tr>
        </table>
        <table class="tbl-xs">
            <tr>
                <th class="red">Đầu</th>
                <th class="red border-right">Đuôi</th>
                <th class="red border-right">Đầu</th>
                <th class="red">Đuôi</th>
            </tr>
            <tr>
                <td class="bg-gray first"><strong>0</strong></td>
                <td class="bg-gray border-right"><?php echo $v->extra[0] ?></td>
                <td class="bg-gray border-right"><strong>5</strong></td>
                <td class="bg-gray"><?php echo $v->extra[5] ?></td>
            </tr>
            <tr>
                <td class="first"><strong>1</strong></td>
                <td class="border-right"><?php echo $v->extra[1] ?></td>
                <td class="border-right"><strong>6</strong></td>
                <td><?php echo $v->extra[6] ?></td>
            </tr>
            <tr>
                <td class="bg-gray first"><strong>2</strong></td>
                <td class="bg-gray border-right"><?php echo $v->extra[2] ?></td>
                <td class="bg-gray border-right"><strong>7</strong></td>
                <td class="bg-gray"><?php echo $v->extra[7] ?></td>
            </tr>
            <tr>
                <td class="first"><strong>3</strong></td>
                <td class="border-right"><?php echo $v->extra[3] ?></td>
                <td class="border-right"><strong>8</strong></td>
                <td><?php echo $v->extra[8] ?></td>
            </tr>
            <tr>
                <td class="bg-gray first"><strong>4</strong></td>
                <td class="bg-gray border-right"><?php echo $v->extra[4] ?></td>
                <td class="bg-gray border-right"><strong>9</strong></td>
                <td class="bg-gray"><?php echo $v->extra[9] ?></td>
            </tr>
        </table>
        <div class="view-result clearfix">
            <div class="right share-right">
                <div class="share-like left">
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
                </div>
            </div>
        </div>
        <div class="select-provice bg-shadow">
            <div class="pn rows clearfix">
                <span class="span-input left"><a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday1) ?>.html">« Trước</a></span>
                <span class="span-input right"><a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday2) ?>.html">Sau »</a></span>
            </div>
            <div class="view-day">Xem theo ngày</div>
            <form id="form_search" method="post" action="">
                <div class="box-fromto t-cen">
                    <select name="select_day" id="select_day" tabindex="1">
                        <option value="">Ngày</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            $selected = '';
                            if ($select_day == $i) {
                                $selected = ' selected=""';
                            }
                            echo '<option' . $selected . ' value="' . $i . '">' . sprintf('%02d', $i) . '</option>';
                        }
                        ?>
                    </select>
                    <select name="select_month" id="select_month" tabindex="1">
                        <option value="">Tháng</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = '';
                            if ($select_month == $i) {
                                $selected = ' selected=""';
                            }
                            echo '<option' . $selected . ' value="' . $i . '">' . sprintf('%02d', $i) . '</option>';
                        }
                        ?>
                    </select>
                    <select name="select_year" id="select_year" tabindex="1">
                        <option value="">Năm</option>
                        <?php
                        foreach ($yearList as $value) {
                            $selected = '';
                            if ($select_year == $value) {
                                $selected = ' selected=""';
                            }
                            echo '<option' . $selected . ' value="' . $value . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="t-cen">
                    <a href="javascript:;" class="read-more" onclick="kqSubmit('<?php echo $uri_root . $v->alias ?>');"><span>Xem kết quả</span></a>
                </div>
            </form>
            <div class="tabs-note t-cen">
                <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
                <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
            </div>
        </div>
        <?php
    }
    echo '<div class="msg-block">' . $description . '</div>';
}
?>
<script type="text/javascript">$(function () {$("#select_day").selectbox();$("#select_month").selectbox();$("#select_year").selectbox();});</script>