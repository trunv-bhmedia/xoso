<?php
$lalias = '';
if ($category->area == 'MB')
    $lalias = 'du-doan-xo-so-mien-bac';
elseif ($category->area == 'MT')
    $lalias = 'du-doan-xo-so-mien-trung';
elseif ($category->area == 'MN')
    $lalias = 'du-doan-xo-so-mien-nam';

$url = base_url() . $lalias . '/' . $row_news->title_link . '.html';
?>
<div class="title-red title">
    <div class="title-right">
        <div class="pathway">
            <ul>
                <li><a href="<?php echo $uri_root ?>du-doan-xo-so.html">Dự đoán xổ số</a></li>
                <li><span>&nbsp;</span></li>
                <li><strong><?php echo short_text($row_news->title, 100); ?></strong></li>
            </ul>
        </div>
    </div>
</div>
<div class="box-result">
    <div class="box-news">
        <div class="clearfix rows">
            <div class="news-infor">
                <h1><?php echo $row_news->title; ?></h1>
                <div class="date"><?php echo date('d/m/Y H:m', strtotime($row_news->created_date)); ?></div>
                <p><strong><?php echo $row_news->short_desc ?></strong></p>
                <?php echo $row_news->content ?>
            </div>
            <?php
            if ($row_news->tags != '') {
                $arr_tags = explode(',', $row_news->tags);
                echo '<div class="tags-list"><strong>Tags:</strong> ';
                foreach ($arr_tags as $i => $value) {
                    $url_value = urlencode(trim($value));
                    if ($i == 0)
                        echo '<a target="_blank" href="' . $uri_root . 'tags/' . $url_value . '">' . trim($value) . '</a>';
                    else
                        echo ', <a target="_blank" href="' . $uri_root . 'tags/' . $url_value . '">' . trim($value) . '</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="more-text">
        <?php if (count($related_news)) { ?>
            <div class="title-more">Tin liên quan</div>
            <ul class="ul-more">
                <?php
                foreach ($related_news as $v) {
                    $url = base_url() . $lalias . '/' . $v->title_link . '.html';
					if(!preg_match('/(ngay|ngày)/ism', $v->title, $matchs)){
						$v->title .= " ngày ".date('d-m-Y', strtotime($row_news->date));
					} 
                    ?>
                    <li><h3><a href="<?php echo $url ?>">&gg; <?php echo $v->title; ?></a></h3></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php if (count($new_news)) { ?>
            <div class="title-more">Tin mới nhất</div>
            <ul class="ul-more">
                <?php
                foreach ($new_news as $v) {
                    $url = base_url() . $lalias . '/' . $v->title_link . '.html';
                    ?>
                    <li><h3><a href="<?php echo $url ?>">&gg; <?php echo $v->title; ?></a></h3></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
    <div class="line-red">&nbsp;</div>
</div>