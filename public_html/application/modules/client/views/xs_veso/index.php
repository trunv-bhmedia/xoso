<h1 style="position: absolute; text-indent: -99999px"><?php echo $row_news->title; ?></h1>
<div class="title-red title">
    <div class="title-right"><?php echo $row_news->title ?></div>
</div>
<div class="box-result">
    <div class="select-provice clearfix">
        <form id="form_search" method="post" action="">
            <div class="left">
                <label>Miền</label>
                <select name="lid" id="select_mien" tabindex="1" onchange="doSubmit('ve-so');">
                    <?php
                    $selected = '';
                    if ($xs_veso_catid == 1)
                        $selected = ' selected=""';
                    echo '<option' . $selected . ' value="mien-bac">Vé số Miền Bắc</option>';
                    $selected = '';
                    if ($xs_veso_catid == 2)
                        $selected = ' selected=""';
                    echo '<option' . $selected . ' value="mien-trung">Vé số Miền Trung</option>';
                    $selected = '';
                    if ($xs_veso_catid == 3)
                        $selected = ' selected=""';
                    echo '<option' . $selected . ' value="mien-nam">Vé số Miền Nam</option>';
                    ?>
                </select>
            </div>
        </form>
    </div>
    <div class="box-news">
        <div class="clearfix rows">
            <div class="news-infor">                
                <?php echo $row_news->content ?>
            </div>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<script type="text/javascript">
    $(function () {
        $("#select_mien").selectbox();
    });
</script>