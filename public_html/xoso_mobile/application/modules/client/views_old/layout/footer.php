<div class="footer-wrap">
    <div class="footer">
        <div class="facebook_block">
            <div>
                <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Ftoiyeuxoso&amp;width=990&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=true&amp;height=324" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:990px; height:324px;" allowTransparency="true"></iframe>
            </div>
            <div class="fanpage_block">
                Đây là Fanpage <a href="https://www.facebook.com/toiyeuxoso" >xoso.com</a> Nếu không vào được <a href="http://cachvaofacebook.com">Facebook</a> mời bạn xem <a href="http://cachvaofacebook.com/cach-vao-facebook-moi-nhat.html"> Cách vào facebook</a> nhé!
            </div>
        </div>
        <div class="fooer-top clearfix">
            <ul class="nav-footer left">
                <li class="nav-fhome"><a href="<?php echo $uri_root ?>">Trang chủ</a></li>
                <li><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so.html">Tường thuật trực tiếp</a></li>
                <li><a href="<?php echo $uri_root ?>ket-qua.html">Kết quả</a></li>
                <li><a href="<?php echo $uri_root ?>xo-so-mien-bac.html">Xổ số miền Bắc</a></li>
                <li><a href="<?php echo $uri_root ?>xo-so-tp-ho-chi-minh.html">Xổ số Tp.HCM</a></li>
                <li><a href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê quan trọng</a></li>
                <li><a href="<?php echo $uri_root ?>thongke-cau-xo-so.html">Thống kê Cầu Loto</a></li>
            </ul>
            <a href="#top" class="backtop">backtop</a>
        </div>
        <?php
        $banner_f = '';
        foreach ($banner as $v) {
            if ($v->position == 'bottom' && ($v->page == 'all' || $v->page == $c_module)) {
                $banner_f .= '<div><a target="_blank" href="' . $v->url . '" title="' . view_title($v->name) . '"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></div>';
            }
        }
        if ($banner_f != '')
            echo '<div class="footer-cen"><div class="mod-banner-bottom">' . $banner_f . '</div></div>';
        ?>
        <div class="footer-bot clearfix">
            Thông tin chỉ mang tính tham khảo, chúng tôi sẽ không chịu bất kỳ trách nhiệm gì về việc sử dụng thông tin của các bạn.<br /> 
            Theo nguồn từ các công ty xổ số trên toàn quốc<br /> 
            © 2012 <a href="<?php echo $uri_root ?>">xổ số</a>, All rights reserved.
        </div>
    </div>
</div>