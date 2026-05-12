<div class="title-red title">
    <div class="title-right">
        <div class="pathway">
            <ul>
                <li><a href="<?php echo $uri_root ?>du-doan-xo-so.html">DỰ ĐOÁN KẾT QUẢ XỔ SỐ NGÀY <?php echo $date ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="box-result dudoan_block">
    <div class="box-news">
        <div class="box box-embeb">
            <h1 class="title-bor">DỰ ĐOÁN KẾT QUẢ XỔ SỐ NGÀY <?php echo $date ?></h1>
            <p class="pad5 mag-btt0">Các chuyên gia của chúng tôi đã sử dụng phần mềm chuyên nghiệp và khoa học nhất để tính ra những bộ số chắc ăn nhất trong ngày.<br /></p>
            <p class="mag0 pad5"><em>Chúc các bạn <strong class="clred">may mắn</strong>!</em></p>
        </div>
        <div class="box box-embeb">
            <h2 class="title-bor">DỰ ĐOÁN KẾT QUẢ XỔ SỐ MIỀN BẮC NGÀY <?php echo $date ?></h2>
            <div class="pad5">
                <p class="mag5-0">
                    Xổ số Miền Bắc mở thưởng vào lúc <strong><?php echo date('H\hi', strtotime($location_menu['MB'][0]->time)) ?></strong> hàng ngày. 
                    Hàng ngày các chuyên gia của <strong>xoso.com</strong> 
                    sẽ tính toán các bộ số có khả năng về nhiều nhất cho thành viên tham khảo. 
                    Lưu ý: Dữ liệu mang tính chất tham khảo. Chúc các bạn 
                    <strong class="clred">may mắn</strong>!
                </p>

                <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                    <tr>
                        <th>Xem dự đoán<br /><em class="cl6">Click vào link bên dưới</em></th>
                    </tr>
                    <tr>
                        <td>
                            <?php if (isset($dudoan[1])) { ?>
                                <a title="<?php echo view_title($dudoan[1]->title) ?>" href="<?php echo $uri_root ?>du-doan-xo-so-mien-bac/<?php echo $dudoan[1]->title_link ?>.html">
                                    <strong><?php echo $dudoan[1]->title ?></strong>
                                </a>
                            <?php } else { ?>
                                <em>Đang được cập nhật!</em>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <p><strong>Xem thống kê - Soi cầu Miền Bắc hôm nay</strong></p>
                <ul class="list-dot-red">
                    <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" /><a title="Thống kê loto Miền Bắc" href="<?php echo $uri_root ?>thong-ke-lo-gan.html">Thống kê loto Miền Bắc</a></li>
                    <li><img width="6" height="6" alt="icon ve so" src="<?php echo img_link('bullet-red.png') ?>" /><a title="Soi cầu loto Miền Bắc" href="<?php echo $uri_root ?>thongke-cau-bach-thu-mien-bac.html">Soi cầu loto Miền Bắc</a></li>

                </ul>
            </div>
        </div>
        <div class="box box-embeb">
            <h2 class="title-bor">DỰ ĐOÁN KẾT QUẢ XỔ SỐ MIỀN TRUNG NGÀY <?php echo $date ?></h2>
            <div class="pad5">
                <p class="mag5-0">
                    Xổ số Miền Trung mở thưởng vào lúc <strong><?php echo date('H\hi', strtotime($location_menu['MT'][0]->time)) ?></strong> hàng ngày. 
                    Các đài quay xổ số mở thưởng hôm nay của Miền Trung bao gồm: 
                    <em>
                        <?php
                        $thongke = '';
                        $soicau = '';
                        foreach ($location_today['MT'] as $i => $value) {
                            $thongke.='<li><img width="6" height="6" alt="icon ve so" src="' . img_link('bullet-red.png') . '" /><a title="Thống kê loto ' . $value->name . '" href="' . $uri_root . 'thong-ke-lo-gan-' . $value->alias . '.html">Thống kê loto ' . $value->name . '</a></li>';
                            $soicau.='<li><img width="6" height="6" alt="icon ve so" src="' . img_link('bullet-red.png') . '" /><a title="Soi cầu loto ' . $value->name . '" href="' . $uri_root . 'thongke-cau-' . $value->alias . '.html">Soi cầu loto ' . $value->name . '</a></li>';
                            if ($i == 0)
                                echo $value->name;
                            else
                                echo ', ' . $value->name;
                        }
                        ?>
                    </em>.
                    Hàng ngày các chuyên gia của <strong>xoso.com</strong> 
                    sẽ tính toán các bộ số có khả năng về nhiều nhất cho thành viên tham khảo. 
                    Lưu ý: Dữ liệu mang tính chất tham khảo. Chúc các bạn 
                    <strong class="clred">may mắn</strong>!
                </p>

                <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                    <tr>
                        <th width="20%">Tỉnh</th>
                        <th width="80%">Xem dự đoán<br /><em class="cl6">Click vào link bên dưới</em></th>
                    </tr>
                    <?php foreach ($location_today['MT'] as $i => $value) { ?>
                        <tr>
                            <td>
                                <strong class="cl-green"><?php echo $value->name ?></strong>
                            </td>
                            <td>
                                <?php if (isset($dudoan[$value->id])) { ?>
                                    <a title="<?php echo view_title($dudoan[$value->id]->title) ?>" href="<?php echo $uri_root ?>du-doan-xo-so-mien-trung/<?php echo $dudoan[$value->id]->title_link ?>.html">
                                        <strong><?php echo $dudoan[$value->id]->title ?></strong>
                                    </a>
                                <?php } else { ?>
                                    <em>Đang được cập nhật!</em>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <p><strong>Xem thống kê - Soi cầu Miền Trung hôm nay</strong></p>
                <ul class="list-dot-red">
                    <?php echo $thongke . $soicau ?>
                </ul>
            </div>
        </div>
        <div class="box box-embeb">
            <h2 class="title-bor">DỰ ĐOÁN KẾT QUẢ XỔ SỐ MIỀN NAM NGÀY <?php echo $date ?></h2>
            <div class="pad5">
                <p class="mag5-0">
                    Xổ số Miền Nam mở thưởng vào lúc <strong><?php echo date('H\hi', strtotime($location_menu['MN'][0]->time)) ?></strong> hàng ngày. 
                    Các đài quay xổ số mở thưởng hôm nay của Miền Nam bao gồm: 
                    <em>
                        <?php
                        $thongke = '';
                        $soicau = '';
                        foreach ($location_today['MN'] as $i => $value) {
                            $thongke.='<li><img width="6" height="6" alt="icon ve so" src="' . img_link('bullet-red.png') . '" /><a title="Thống kê loto ' . $value->name . '" href="' . $uri_root . 'thong-ke-lo-gan-' . $value->alias . '.html">Thống kê loto ' . $value->name . '</a></li>';
                            $soicau.='<li><img width="6" height="6" alt="icon ve so" src="' . img_link('bullet-red.png') . '" /><a title="Soi cầu loto ' . $value->name . '" href="' . $uri_root . 'thongke-cau-' . $value->alias . '.html">Soi cầu loto ' . $value->name . '</a></li>';
                            if ($i == 0)
                                echo $value->name;
                            else
                                echo ', ' . $value->name;
                        }
                        ?>
                    </em>.
                    Hàng ngày các chuyên gia của <strong>xoso.com</strong> 
                    sẽ tính toán các bộ số có khả năng về nhiều nhất cho thành viên tham khảo. 
                    Lưu ý: Dữ liệu mang tính chất tham khảo. Chúc các bạn 
                    <strong class="clred">may mắn</strong>!
                </p>

                <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                    <tr>
                        <th width="20%">Tỉnh</th>
                        <th width="80%">Xem dự đoán<br /><em class="cl6">Click vào link bên dưới</em></th>
                    </tr>
                    <?php foreach ($location_today['MN'] as $i => $value) { ?>
                        <tr>
                            <td>
                                <strong class="cl-green"><?php echo $value->name ?></strong>
                            </td>
                            <td>
                                <?php if (isset($dudoan[$value->id])) { ?>
                                    <a title="<?php echo view_title($dudoan[$value->id]->title) ?>" href="<?php echo $uri_root ?>du-doan-xo-so-mien-nam/<?php echo $dudoan[$value->id]->title_link ?>.html">
                                        <strong><?php echo $dudoan[$value->id]->title ?></strong>
                                    </a>
                                <?php } else { ?>
                                    <em>Đang được cập nhật!</em>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <p><strong>Xem thống kê - Soi cầu Miền Nam hôm nay</strong></p>
                <ul class="list-dot-red">
                    <?php echo $thongke . $soicau ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>