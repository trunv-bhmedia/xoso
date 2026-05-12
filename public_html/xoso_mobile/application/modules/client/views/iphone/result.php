<?php
header("Content-type: text/xml; charset=utf-8");
$start_date = str_replace('-', '/', $start_date);
$end_date = str_replace('-', '/', $end_date);
$mang = array(
    array('a0', 'Giải Đặc Biệt'),
    array('a1', 'Giải Nhất'),
    array('a2', 'Giải Nhì'),
    array('a3', 'Giải Ba'),
    array('a4', 'Giải Tư'),
    array('a5', 'Giải Năm'),
    array('a6', 'Giải Sáu'),
    array('a7', 'Giải Bảy'),
    array('a8', 'Giải Tám')
);
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
if ($items):
    ?>
    <chanel>
        <result startDate="<?php echo $start_date; ?>" endDate="<?php echo $end_date; ?>" idlocal="<?php echo $items[0]->code; ?>" namelocal="<?php echo $items[0]->name; ?>">
            <?php
            foreach ($items as $k => $v):
                ?> 
                <XoSo data="<?php echo date('d/m/Y', strtotime($v->date)); ?>">
                    <?php foreach ($mang as $km => $vm): ?>
                        <item rankName="<?php echo $km; ?>" value="<?php echo $v->$vm[0]; ?>" rankNumber="<?php echo $vm[1]; ?>"/>
                    <?php endforeach; ?>
                </XoSo>
                <?php
                $lo = json_decode($v->extension);
                ?>
                <Lo>
                    <?php foreach ($lo as $kl => $vl): ?>
                        <itemLo name="<?php echo $kl; ?>" valueLo="<?php echo str_replace("&nbsp;", "", $vl); ?>"/>
                    <?php endforeach; ?>
                </Lo>
            <?php endforeach; ?>
        </result>
    </chanel>
<?php endif; ?>
<?php die(); ?>