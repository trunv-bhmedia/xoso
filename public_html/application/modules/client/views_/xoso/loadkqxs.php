<?php
foreach ($items as $k => $v) {
    $date = strtotime(str_replace('/', '-', $v->date));

    $date_ve_do = str_replace('/', '-', $v->date);
    $v->extra = json_decode($v->extension);

    $title_share = 'Xổ Số ' . $v->name . ' - ' . $v->dateOfWeek . ' ngày ' . $v->date;

    $shared_content = 'Xổ Số ' . $v->name . ' ngày ' . $v->date . ',';
    $shared_content.=' giải DB: ' . $v->a0 . ',';
    $shared_content.=' giải nhất: ' . $v->a1 . ',';
    $shared_content.=' giải nhì: ' . $v->a2 . ',';
    $shared_content.=' giải ba: ' . $v->a3 . ',';
    $shared_content.=' giải tư: ' . $v->a4 . ',';
    $shared_content.=' giải năm: ' . $v->a5 . ',';
    $shared_content.=' giải sáu: ' . $v->a6 . ',';
    $shared_content.=' giải bảy: ' . $v->a7;
    if ($v->area != 'MB')
        $shared_content.=', giải tám: ' . $v->a8;

    $alias_date = $v->alias . '/' . str_replace('/', '-', $v->date);
    $curPageURL = urlencode($uri_root . $alias_date . '.html');
    $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share) . '&amp;annotation=' . $shared_content;
    $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
    $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '. ' . $shared_content . '&amp;type=page&amp;linkname=' . $title_share . '&amp;linknote=';
    $url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL . '. ' . $shared_content;
    if ($v->area == 'MB') {
        $v->data[0] = $v->a0;
        $v->data[1] = $v->a1;
        $v->data[2] = $v->a2;
        $v->data[3] = $v->a3;
        $v->data[4] = $v->a4;
        $v->data[5] = $v->a5;
        $v->data[6] = $v->a6;
        $v->data[7] = $v->a7;
        ?>
        <div class="title title-red">
            <div class="title-right clearfix"><strong class="left xsmb">XỔ SỐ TRUYỀN THỐNG - <?php echo $v->date ?></strong>
                <div class="box-date-provide right">
                    <input name="kqxs_date_<?php echo $date . $k ?>" type="text" id="kqxs_date_<?php echo $date . $k ?>" value="<?php echo str_replace('/', '-', $v->date) ?>" />
                    <script type="text/javascript">$("#kqxs_date_<?php echo $date . $k ?>").datepick({dateFormat: 'dd-mm-yyyy',maxDate: +0,onSelect: function() {var day=$("#kqxs_date_<?php echo $date . $k ?>").val();document.location='<?php echo $uri_root . $v->alias ?>/'+day+'.html';}});</script>
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
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="line-red">&nbsp;</div>
        <ul class="list-editor space1">
            <li>Để nhận kết quả xổ số <strong>Miền Bắc</strong> sớm nhất, soạn tin <span>KQ MB</span> gửi <span>8117</span></li>
        </ul>
        <div class="tabs-note col3 clearfix">
            <a class="span-quayxs" href="<?php echo $uri_root ?>cung-quay-xo-so.html">&nbsp;</a>
            <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
            <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=1&amp;d=<?php echo $date_ve_do ?>&amp;t=2">&nbsp;</a>
            <a class="span-vs" href="<?php echo $uri_root ?>ve-so-mien-bac.html">&nbsp;</a>
        </div>
        <div class="view-result clearfix">
            <div class="big-share-like">
                <div class="share-like left">
                    <span>Chia sẻ</span>
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">Facebook</a>
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google+" target="_blank" class="share-g">Google+</a>                
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">Yahoo</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">Email</a>
                </div>
            </div>
        </div>        
        <?php
    }else {
        if ($v->area == 'MT') {
            $l_area = 'MIỀN TRUNG';
            $url = $url_mientrung;
            $lid = 2;
        } else {
            $l_area = 'MIỀN NAM';
            $url = $url_miennam;
            $lid = 3;
        }
        ?>
        <div class="title title-red">
            <div class="title-right clearfix"><strong class="left xsmb">XỔ SỐ <?php echo $l_area ?> - <?php echo $v->date ?></strong>
                <div class="right">
                    <div class="btn-arrow">
                        <a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday1) ?>.html" class="arrow-left">&nbsp;</a>
                        <a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $v->linkday2) ?>.html" class="arrow-right">&nbsp;</a>
                    </div>
                    <a class="left view-table" href="<?php echo $uri_root . $url ?>.html">Xem chi tiết <span>&nbsp;</span></a>
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
                    <td class="bg-gray"></td>
                </tr>
            </table>
        </div>
        <div class="line-red">&nbsp;</div>        
        <ul class="list-editor space1">
            <li>Để nhận kết quả xổ số <strong><?php echo $v->name ?></strong> sớm nhất, soạn tin <span>KQ <?php echo $v->code ?></span> gửi <span>8117</span></li>
        </ul>
        <div class="tabs-note col3 clearfix">
            <a class="span-quayxs" href="<?php echo $uri_root ?>cung-quay-xo-so.html<?php echo $v->area == 'MT' ? '?t=2' : '?t=3' ?>">&nbsp;</a>
            <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
            <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=<?php echo $lid ?>&amp;d=<?php echo $date_ve_do ?>&amp;t=2">&nbsp;</a>
            <a class="span-vs" href="<?php echo $uri_root ?>ve-so-<?php echo $v->area == 'MT' ? 'mien-trung' : 'mien-nam' ?>.html">&nbsp;</a>
        </div>
        <div class="view-result clearfix">
            <div class="big-share-like">
                <div class="share-like left">
                    <span>Chia sẻ</span>
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">Facebook</a>
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google+" target="_blank" class="share-g">Google+</a>                
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">Yahoo</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">Email</a>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<script type="text/javascript">
    function settime(){$("#kqxs_date_page").val('<?php echo $date ?>');}
    $(document).ready(function(e) {settime();});
</script>