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
    if (isset($date) && $date != '')
        echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ MIỀN BẮC NGÀY ' . str_replace('-', '/', $date) . '</h1>';
    else
        echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ MIỀN BẮC</h1>';
    foreach ($items as $k => $v) {
        $v->extra = json_decode($v->extension);
        $date_ve_do = str_replace('/', '-', $v->date);
        
        $v->data[0] = $v->a0;
        $v->data[1] = $v->a1;
        $v->data[2] = str_replace('-', ' - ', $v->a2);
        $v->data[3] = str_replace('-', ' - ', $v->a3);
        $v->data[4] = str_replace('-', ' - ', $v->a4);
        $v->data[5] = str_replace('-', ' - ', $v->a5);
        $v->data[6] = str_replace('-', ' - ', $v->a6);
        $v->data[7] = str_replace('-', ' - ', $v->a7);

        $select_day = date('d', strtotime($date_ve_do));
        $select_month = date('m', strtotime($date_ve_do));
        $select_year = date('Y', strtotime($date_ve_do));

        $title_share = 'Xổ Số ' . $v->name . ' - ' . $v->dateOfWeek . ' ngày ' . $v->date;
        $alias_date = $v->alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . formatMail($title_share) . '&amp;body=' . $curPageURL;
        ?>
        <div class="page-title-xs"><strong>XỔ SỐ TRUYỀN THỐNG - <?php echo $v->date ?></strong></div>
        <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Tường thuật trực tiếp >></a><a class="span-tkxs" href="#thong-ke">Thống kê xổ số</a></div></div>
        <div class="select-provice kqxs-block">
            <a class="button button-pre" href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday1) ?>.html"><span>&laquo;</span></a>
            <a class="button button-next" href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday2) ?>.html"><span>&raquo;</span></a>
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
                    <a href="javascript:;" class="read-more" onclick="kqSubmit('<?php echo $uri_root . $v->alias ?>');"><span>Xem</span></a>
                </div>
            </form>
        </div>
        <table class="tbl-xs">
            <tr>
                <td class="border-right">
                    Kí hiệu trúng:
                </td>
                <td class="bg-gray giaidb">
                    <b><?php echo $v->khtt; ?></b>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải đặc biệt</td>
                <td class="bg-gray giaidb">
                    <?php
                    echo '<strong class="red font18 span-space">' . $v->data[0] . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải nhất</td>
                <td class="giai1">
                    <?php
                    echo '<strong class="span-space">' . $v->data[1] . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải nhì</td>
                <td class="bg-gray giai2">
                    <?php
//                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[2]);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo $v->data[2];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải ba</td>
                <td class="giai3">
                    <?php
//                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[3]);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo $v->data[3];
                    ?>
                </td>

            </tr>
            <tr>
                <td class="bg-gray border-right">Giải tư</td>
                <td class="bg-gray giai4">
                    <?php
//                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[4]);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo $v->data[4];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải năm</td>
                <td class="giai5">
                    <?php
//                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[5]);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo $v->data[5];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải sáu</td>
                <td class="bg-gray giai6">
                    <?php
//                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[6]);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo $v->data[6];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right last">Giải bảy</td>
                <td class="giai7 last">
                    <?php
//                    $str = str_replace('-', '</strong><strong class="span-space">', $v->data[7]);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo $v->data[7];
                    ?>
                </td>
            </tr>
        </table>

        <div class="sms_block">            
            <div>Soạn tin lấy số May Mắn: <strong class="red">BHX MM MB</strong> gửi <strong class="red">8588</strong></div>
            <a id="sms_mm" href="sms:8588?body=BHX MM MB">Click lấy số May Mắn XS Miền Bắc <?php echo $check_sms_mb ?></a>
            <div>Để nhận kết quả xổ số <tỉnh> 20 ngày, soạn tin : <strong class="red">BHX KQ MB</strong> gửi <strong class="red">8788</strong></div>
            <a id="sms_kq" href="sms:8588?body=BHX KQ MB">Click lấy kết quả XS Miền Bắc 20 ngày</a>
            <a href="<?php echo $uri_root ?>ma-tinh-thanh.html">Xem mã tỉnh khác</a>
        </div>
        <script type="text/javascript">var type=0;var userAgent=navigator.userAgent;switch(true){case (userAgent.match(/ipad/i)!=null):type=1;break;case (userAgent.match(/ipod/i)!=null||userAgent.match(/iphone/i)!=null):type=1;break;case userAgent.indexOf("iPad")>-1:type=1;break;case userAgent.indexOf("iPhone")>-1:type=1;break;case userAgent.indexOf("iPod")>-1:type=1;break;default:type=0;break}if(type==1){$("a#sms_mm").attr("href","sms:8588;body=BHX MM MB");$("a#sms_kq").attr("href","sms:8788;body=BHX KQ MB")};</script>

        <div class="gadgets arrow"><h3>Thống kê loto đầu đuôi</h3></div>
        <table class="tbl-xs">
            <tr>
                <td class="first"><strong>Đầu</strong></td>
                <td class="border-right"><strong>Đuôi</strong></td>
                <td class="border-right"><strong>Đầu</strong></td>
                <td><strong>Đuôi</strong></td>
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
            <div class="big-share-like">
                <div class="share-like clearfix">
                    <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
                    <a class="span-quayxs last" href="<?php echo $uri_root ?>cung-quay-xo-so.html">&nbsp;</a>                
                </div>
                <div class="share-like mt5 clearfix">
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email last">&nbsp;</a>
                </div>
            </div>
        </div>
        <div class="msg-block"><?php echo $location_menu['MB'][0]->description ?></div>
        <?php
    }
} else {
    $url = '';
    $lid = 1;
    $url_tttt = '';
    $check_sms = '';
    if ($items[0]->area == 'MT') {
        $l_area = 'MIỀN TRUNG';
        $url = $url_mientrung;
        $lid = 2;
        $check_sms = $check_sms_mt;
        $url_tttt = $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html';
    } else {
        $l_area = 'MIỀN NAM';
        $url = $url_miennam;
        $lid = 3;
        $check_sms = $check_sms_mn;
        $url_tttt = $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html';
    }

    $description = '';
    if ($alias == $url_mientrung || $alias == $url_miennam) {
        echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . '</h1>';
    } else {
        if (isset($date) && $date != '')
            echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . mb_strtoupper($items[0]->name, 'UTF-8') . ' NGÀY ' . str_replace('-', '/', $date) . '</h1>';
        else
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
        $url_email = 'mailto:?subject=' . formatMail($title_share) . '&amp;body=' . $curPageURL;
        ?>
        <div class="page-title-xs"><strong>XỔ SỐ <?php echo $l_area ?> - <?php echo $v->date ?></strong></div>
        <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $url_tttt ?>">Tường thuật trực tiếp >></a><a class="span-tkxs" href="#thong-ke">Thống kê xổ số</a></div></div>
        <div class="select-provice kqxs-block">
            <a class="button button-pre" href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday1) ?>.html"><span>&laquo;</span></a>
            <a class="button button-next" href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday2) ?>.html"><span>&raquo;</span></a>
            <form id="form_search" method="post" action="">
                <div class="box-fromto t-cen">
                    <div class="location-select">
                        <select name="lid" id="select_mien" tabindex="1">
                            <?php
                            $sms_code = '';
                            $sms_name = '';
                            foreach ($xs_location_menu as $value) {
                                $selected = '';
                                if ($v->lid == $value->id) {
                                    $selected = ' selected="selected"';
                                    $sms_code = $value->code;
                                    $sms_name = $value->name;
                                }
                                echo '<option' . $selected . ' value="' . $value->alias . '">' . $value->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
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
                    <a href="javascript:;" class="read-more" onclick="kqSubmit('<?php echo $uri_root ?>'+$('#select_mien option:selected').val());"><span>Xem</span></a>
                </div>
            </form>
        </div>
        <table class="tbl-xs kqmiennam">
            <tr>
                <td class="bg-gray border-right">Giải đặc biệt</td>
                <td class="bg-gray giaidb">
                    <?php
                    echo '<strong class="red font18 span-space">' . $v->a0 . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải nhất</td>
                <td class="giai1">
                    <?php
                    echo '<strong class="span-space">' . $v->a1 . '</strong>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải nhì</td>
                <td class="bg-gray giai2">
                    <?php
//                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a2);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo str_replace('-', ' - ', $v->a2);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải ba</td>
                <td class="giai3">
                    <?php
//                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a3);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo str_replace('-', ' - ', $v->a3);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải tư</td>
                <td class="bg-gray giai4">
                    <?php
//                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a4);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo str_replace('-', ' - ', $v->a4);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải năm</td>
                <td class="giai5">
                    <?php
//                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a5);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo str_replace('-', ' - ', $v->a5);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải sáu</td>
                <td class="bg-gray giai6">
                    <?php
//                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a6);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo str_replace('-', ' - ', $v->a6);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="border-right">Giải bảy</td>
                <td class="giai7">
                    <?php
//                    $str = str_replace(array('-'), array('</strong><strong class="span-space">'), $v->a7);
//                    echo '<strong class="span-space">' . $str . '</strong>';
                    echo str_replace('-', ' - ', $v->a7);
                    ?>
                </td>
            </tr>
            <tr>
                <td class="bg-gray border-right last">Giải tám</td>
                <td class="bg-gray giai8 last">
                    <?php
//                    echo '<strong class="span-space">' . $v->a8 . '</strong>';
                    echo $v->a8;
                    ?>
                </td>
            </tr>
        </table>

        <div class="sms_block">            
            <div>Soạn tin lấy số May Mắn: <strong class="red">BHX MM <?php echo $sms_code ?></strong> gửi <strong class="red">8588</strong></div>
            <a id="sms_mm" href="sms:8588?body=BHX MM <?php echo $sms_code ?>">Click lấy số May Mắn XS <?php echo $sms_name . ' ' . $check_sms ?></a>
            <div>Để nhận kết quả xổ số <tỉnh> 20 ngày, soạn tin : <strong class="red">BHX KQ <?php echo $sms_code ?></strong> gửi <strong class="red">8788</strong></div>
            <a id="sms_kq" href="sms:8788?body= BHX KQ <?php echo $sms_code ?>">Click lấy kết quả XS <?php echo $sms_name ?> 20 ngày</a>
            <a href="<?php echo $uri_root ?>ma-tinh-thanh.html">Xem mã tỉnh khác</a>
        </div>
        <script type="text/javascript">var type=0;var userAgent=navigator.userAgent;switch(true){case (userAgent.match(/ipad/i)!=null):type=1;break;case (userAgent.match(/ipod/i)!=null||userAgent.match(/iphone/i)!=null):type=1;break;case userAgent.indexOf("iPad")>-1:type=1;break;case userAgent.indexOf("iPhone")>-1:type=1;break;case userAgent.indexOf("iPod")>-1:type=1;break;default:type=0;break}if(type==1){$("a#sms_mm").attr("href","sms:8588;body=BHX MM <?php echo $sms_code ?>");$("a#sms_kq").attr("href","sms:8788;body=BHX KQ <?php echo $sms_code ?>")};</script>

        <div class="gadgets arrow"><h3>Thống kê loto đầu đuôi</h3></div>
        <table class="tbl-xs">
            <tr>
                <td class="first"><strong>Đầu</strong></td>
                <td class="border-right"><strong>Đuôi</strong></td>
                <td class="border-right"><strong>Đầu</strong></td>
                <td><strong>Đuôi</strong></td>
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
            <div class="big-share-like">
                <div class="share-like clearfix">
                    <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
                    <a class="span-quayxs last" href="<?php echo $uri_root ?>cung-quay-xo-so.html">&nbsp;</a>                
                </div>
                <div class="share-like mt5 clearfix">
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email last">&nbsp;</a>
                </div>
            </div>
        </div>
        <?php
    }
    echo '<br/><div class="msg-block">' . $description . '</div>';
}
?>
<br/>
<script type="text/javascript">$(function () {$("#select_mien").selectbox();$("#select_day").selectbox();$("#select_month").selectbox();$("#select_year").selectbox();});</script>