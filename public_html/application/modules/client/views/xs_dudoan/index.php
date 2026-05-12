<h1 style="position: absolute; text-indent: -99999px">Tin tức thông tin xổ số</h1>
<div class="title-red title">
    <div class="title-right">
        <div class="pathway">
            <ul>
                <li><a href="<?php echo $uri_root ?>du-doan-xo-so.html">Dự đoán xổ số</a></li>
                <?php echo isset($category_alias) ? '<li><span>&nbsp;</span></li><li><strong>Dự đoán xổ số ' . $news[0]->cname . '</strong></li>' : '' ?>
            </ul>
        </div>
    </div>
</div>
<div class="box-result">
    <div class="box-news">
        <ul class="ulnews">
            <?php
            foreach ($news as $k => $v) {
                $lalias = '';
                if ($v->area == 'MB')
                    $lalias = 'du-doan-xo-so-mien-bac';
                elseif ($v->area == 'MT')
                    $lalias = 'du-doan-xo-so-mien-trung';
                elseif ($v->area == 'MN')
                    $lalias = 'du-doan-xo-so-mien-nam';

                $url = base_url() . $lalias . '/' . $v->title_link . '.html';

                if ($v->image != '')
                    $img = base_url() . $v->image;
                else
                    $img = img_link('tin-xo-so.jpg');
                ?>
                <li class="clearfix">
                    <div class="imgs">
                        <a href="<?php echo $url ?>"><img src="<?php echo $img ?>" alt="<?php echo view_title($v->title); ?>" width="124" height="82" /></a>
                    </div>
                    <div class="news-infor">
                        <a href="<?php echo $url ?>" class="title-news"><?php echo $v->title; ?></a>
                        <div class="date"><?php echo date('d/m/Y', strtotime($v->created_date)); ?></div>
                        <?php echo $v->short_desc ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="toolbar"><div class="pages"><?php echo $pagnav; ?></div></div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<?php if ($lid_list) { ?>
    <h3 class="dudoan_h3">Dự đoán các tỉnh khác</h3>
    <div class="line-red">&nbsp;</div>
    <div class="box-result">
        <div class="box-news">
            <ul class="ulnews">
                <?php
                foreach ($lid_list as $k => $v) {
                    $lalias = '';
                    if ($v->area == 'MB')
                        $lalias = 'du-doan-xo-so-mien-bac';
                    elseif ($v->area == 'MT')
                        $lalias = 'du-doan-xo-so-mien-trung';
                    elseif ($v->area == 'MN')
                        $lalias = 'du-doan-xo-so-mien-nam';

                    $url = base_url() . $lalias . '/' . $v->title_link . '.html';

                    if ($v->image != '')
                        $img = base_url() . $v->image;
                    else
                        $img = img_link('tin-xo-so.jpg');
                    ?>
                    <li class="clearfix">
                        <div class="imgs">
                            <a href="<?php echo $url ?>"><img src="<?php echo $img ?>" alt="<?php echo view_title($v->title); ?>" width="124" height="82" /></a>
                        </div>
                        <div class="news-infor">
                            <a href="<?php echo $url ?>" class="title-news"><?php echo $v->title; ?></a>
                            <div class="date"><?php echo date('d/m/Y', strtotime($v->created_date)); ?></div>
                            <?php echo $v->short_desc ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="line-red">&nbsp;</div>
    </div>
<?php
}?>