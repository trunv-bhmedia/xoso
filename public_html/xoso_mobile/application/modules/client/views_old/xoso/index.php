<div class="banner">
    <?php
    $arr_banner_middle = array();
    foreach ($banner as $v) {
        if ($v->position == 'middle' && ($v->page == 'all' || $v->page == $c_module)) {
            $arr_banner_middle[] = '<div><a target="_blank" href="' . $v->url . '" title="' . view_title($v->name) . '"><img src="' . site_url($v->image) . '" width="566" alt="' . view_title($v->name) . '" /></a></div>';
        } elseif ($v->position == 'top' && ($v->page == 'all' || $v->page == $c_module)) {
            ?>
            <div><a target="_blank" href="<?php echo $v->url; ?>" title="<?php echo view_title($v->name); ?>"><img src="<?php echo site_url($v->image); ?>" width="566" alt="<?php echo view_title($v->name); ?>" /></a></div>
            <?php
        }
    }
    ?>
</div>
<?php
$title_share = isset($_meta['title']) ? $_meta['title'] : '';
$title_share = urlencode($title_share);
if ($alias == $url_mienbac) {
    echo '<div class="box-tt clearfix">
            <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
                Nhận kết quả nhanh siêu tốc</strong>
            <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
        </div>';
    echo '<h1>KẾT QUẢ XỔ SỐ MIỀN BẮC</h1>';
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

        $alias_date = $v->alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . $title_share;
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . $_meta['title'] . '&amp;body=' . $curPageURL;
        if ($k == 1) {
            ?>
            <div class="banner"><?php echo $arr_banner_middle[array_rand($arr_banner_middle)] ?></div>
        <?php } ?>
        <div class="title title-red">
            <div class="title-right clearfix"><strong class="left xsmb">XỔ SỐ TRUYỀN THỐNG - <?php echo $v->date ?></strong>
                <div class="box-date-provide right">
                    <input name="kqxs_date_<?php echo $k ?>" type="text" id="kqxs_date_<?php echo $k ?>" value="<?php echo str_replace('/', '-', $v->date) ?>" />
                    <script type="text/javascript">$("#kqxs_date_<?php echo $k ?>").datepick({dateFormat: 'dd-mm-yyyy',maxDate: +0,onSelect: function() {var day=$("#kqxs_date_<?php echo $k ?>").val();document.location='<?php echo $uri_root . $v->alias ?>/'+day+'.html';}});</script>
                </div>
            </div>
        </div>
        <div class="box-result">
            <table class="tbl-tt tbl-main-tt">
                <tr>
                    <td colspan="2" class="bg-yelow1"><a href="<?php echo $uri_root . $alias_date ?>.html"><strong class="txt-red"><h2>Xổ Số <?php echo $v->name; ?> - <?php echo $v->dateOfWeek ?> ngày <?php echo $v->date ?></h2></strong></a></td>
                    <td class="td-sub" rowspan="8">
                        <table class="tbl-dd">
                            <tr>
                                <th class="first bg-yelow1">Đầu</th>
                                <th class="last bg-yelow1">Đuôi</th>
                            </tr>
                            <?php foreach ($v->extra as $k1 => $v1): ?>
                                <tr>
                                    <td class="first"><?php echo $k1 ?></td>
                                    <td class="<?php echo($k1 == 9 ? 'last' : ''); ?>"><?php echo $v1; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
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
    <?php } ?>
    <div id="kqxs_block"></div>
    <input type="hidden" id="kqxs_date_page" name="kqxs_date_page" value="<?php echo strtotime(str_replace('/', '-', $items[count($items) - 1]->date)) ?>" />
    <div class="box-view-more clearfix">
        <a class="read-more" href="javascript:;" onclick="loadKQXS('mb');"><span>Xem thêm</span></a> (5 kết quả)
    </div>
    <div class="msg-block"><?php echo $location_menu['MB'][0]->description ?></div>
    <?php
}else {
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
        echo '<div class="box-tt clearfix">
            <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
                Nhận kết quả nhanh siêu tốc</strong>
            <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
        </div>';
        echo '<h1>KẾT QUẢ XỔ SỐ ' . $l_area . '</h1>';
    } else {
        echo '<div class="box-tt clearfix">
            <strong class="strong-tt">Trực tiếp kết quả Xổ Số ' . $items[0]->name . '<br />
                Nhận kết quả nhanh siêu tốc</strong>
            <div class="box-editor">Soạn <strong class="red">TT ' . $items[0]->code . '</strong> gửi <strong class="red">8517</strong></div>
        </div>';
        echo '<h1>KẾT QUẢ XỔ SỐ ' . mb_strtoupper($items[0]->name, 'UTF-8') . '</h1>';
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

        $alias_date = $v->alias . '/' . $date_ve_do;
        $curPageURL = urlencode($uri_root . $alias_date . '.html');
        $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . $title_share;
        $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
        $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
        $url_email = 'mailto:?subject=' . $_meta['title'] . '&amp;body=' . $curPageURL;
        if ($k == 1) {
            ?>
            <div class="banner"><?php echo $arr_banner_middle[array_rand($arr_banner_middle)] ?></div>
        <?php } ?>
        <div class="title title-red">
            <div class="title-right clearfix"><strong class="left xsmb">XỔ SỐ <?php echo $l_area ?> - <?php echo $v->date ?></strong>
                <div class="right">
                    <div class="btn-arrow">
                        <a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday1) ?>.html" class="arrow-left">&nbsp;</a>
                        <a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday2) ?>.html" class="arrow-right">&nbsp;</a>
                    </div>
                    <a class="left view-table" href="<?php echo $uri_root . $url ?>.html">Xem bảng tính <span>&nbsp;</span></a>
                </div>
            </div>
        </div>
        <div class="box-result">
            <table class="tbl-tt tbl-main-tt kqmiennam">
                <tr>
                    <td colspan="2" class="bg-yelow1"><a href="<?php echo $uri_root . $alias_date ?>.html"><strong class="txt-red"><h2>Xổ Số <?php echo $v->name; ?> - <?php echo $v->dateOfWeek ?> ngày <?php echo $v->date ?></h2></strong></a></td>
                    <td class="td-sub" rowspan="9">
                        <table class="tbl-dd">
                            <tr>
                                <th class="first bg-yelow1">Đầu</th>
                                <th class="last bg-yelow1">Đuôi</th>
                            </tr>
                            <?php foreach ($v->extra as $k1 => $v1): ?>
                                <tr>
                                    <td class="first"><?php echo $k1 ?></td>
                                    <td class="<?php echo($k1 == 9 ? 'last' : ''); ?>"><?php echo $v1; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>


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
            <li>Để nhận kết quả xổ số <strong><?php echo $v->name ?></strong> sớm nhất, soạn tin <span>KQ <?php echo $v->code ?></span> gửi <span>8117</span></li>
        </ul>
        <div class="tabs-note space-pleft clearfix">
            <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=<?php echo $lid ?>&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
            <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
            <a class="span-vs" href="<?php echo $uri_root ?>ve-so-<?php echo $items[0]->area == 'MT' ? 'mien-trung' : 'mien-nam' ?>.html">Hình ảnh vé số </a>
            <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
            <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
        </div>
        <?php
    }
    echo '<div class="msg-block">' . $description . '</div>';
}
if (isset($statistics) && $statistics == true) {
    ?>
    <h4 class="box_tkdefault_title">Các cặp số xuất hiện nhiều nhất trong 5 lần quay:</h4>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="caccapsoxuathien">
        <?php
        foreach ($StatisticsAtMost5 as $value) {
            if ($value['count'] <= 2)
                break;

            $str = '';
            if ($value['count'] > $value['count_last']) {
                $str = 'Tăng ' . ($value['count'] - $value['count_last']);
            } elseif ($value['count'] < $value['count_last']) {
                $str = 'Giảm ' . ($value['count_last'] - $value['count']);
            } else {
                $str = 'Không tăng';
            }
            echo '<tr>
                <td width="30">' . $value['number'] . '</td>
                <td width="50">' . $value['count'] . ' Lần</td>
                <td width="100">' . $str . '</td>
            </tr>';
        }
        ?>
    </table>

    <h4 class="box_tkdefault_title">Các cặp số xuất hiện nhiều nhất trong 10 lần quay:</h4>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="caccapsoxuathien">
        <?php
        foreach ($StatisticsAtMost10 as $value) {
            if ($value['count'] <= 3)
                break;

            $str = '';
            if ($value['count'] > $value['count_last']) {
                $str = 'Tăng ' . ($value['count'] - $value['count_last']);
            } elseif ($value['count'] < $value['count_last']) {
                $str = 'Giảm ' . ($value['count_last'] - $value['count']);
            } else {
                $str = 'Không tăng';
            }
            echo '<tr>
                <td width="30">' . $value['number'] . '</td>
                <td width="50">' . $value['count'] . ' Lần</td>
                <td width="100">' . $str . '</td>
            </tr>';
        }
        ?>
    </table>

    <h4 class="box_tkdefault_title">Các cặp số xuất hiện nhiều nhất trong 30 lần quay:</h4>
    <table width="100%" border="0" cellspacing="0" cellpadding="2" id="caccapsoxuathien">
        <?php
        foreach ($StatisticsAtMost30 as $value) {
            if ($value['count'] <= 7)
                break;

            $str = '';
            if ($value['count'] > $value['count_last']) {
                $str = 'Tăng ' . ($value['count'] - $value['count_last']);
            } elseif ($value['count'] < $value['count_last']) {
                $str = 'Giảm ' . ($value['count_last'] - $value['count']);
            } else {
                $str = 'Không tăng';
            }
            echo '<tr>
                <td width="30">' . $value['number'] . '</td>
                <td width="50">' . $value['count'] . ' Lần</td>
                <td width="100">' . $str . '</td>
            </tr>';
        }
        ?>
    </table>
    <?php
}?>