<?php
$time_area_mb = date('H\hi', strtotime($location_menu['MB'][0]->time));
$time_area_mt = date('H\hi', strtotime($location_menu['MT'][0]->time));
$time_area_mn = date('H\hi', strtotime($location_menu['MN'][0]->time));
?>
<div class="box-tt clearfix">
    <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
        Nhận kết quả nhanh siêu tốc</strong>
    <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
</div>
<h1 style="position: absolute; text-indent: -99999px">LỊCH QUAY SỐ MỞ THƯỞNG TOÀN QUỐC</h1>
<div class="title title-red">
    <div class="title-right clearfix"><strong class="left xsmb">LỊCH QUAY SỐ MỞ THƯỞNG TOÀN QUỐC</strong>
    </div>
</div>
<div class="box-result">
    <table class="tbl-tt">
        <tr>
            <th class="border-right bg-yelow1 t-cen"><span>Khu vực</span></th>
            <th class="border-right bg-yelow1 t-cen"><span>Miền Nam</span></th>
            <th class="border-right bg-yelow1 t-cen"><span>Miền Bắc</span></th>
            <th class="border-right bg-yelow1 t-cen"><span>Miền Trung</span></th>
        </tr>
        <tr>
            <td class="t-cen border-right"><strong>Giờ xổ số</strong></td>
            <td class="t-cen border-right"><strong class="red"><?php echo $time_area_mn . "'" ?></strong> </td>
            <td class="t-cen border-right"><strong class="red"><?php echo $time_area_mb . "'" ?></strong> </td>
            <td class="t-cen"><strong class="red"><?php echo $time_area_mt . "'" ?></strong> </td>
        </tr>
        <tr>
            <td class="border-right"><strong>Thứ 2</strong></td>
            <td class="border-right">Tp. Hồ Chí Minh - <strong>HCM</strong><br/>Cà Mau - <strong>CM</strong><br/>Đồng Tháp - <strong>DT</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Phú Yên - <strong>PY</strong><br/>Thừa Thiên Huế - <strong>TTH</strong></td>
        </tr>
        <tr>
            <td class="border-right"><strong>Thứ 3</strong></td>
            <td class="border-right">Bạc Liêu - <strong>BL</strong><br/>Bến Tre - <strong>BT</strong><br/>Vũng Tàu - <strong>VT</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Quảng Nam - <strong>QNM</strong><br/>Đắc Lắc - <strong>DLK</strong></td>
        </tr>
        <tr>
            <td class="border-right"><strong>Thứ 4</strong></td>
            <td class="border-right">Đồng Nai - <strong>DN</strong><br/>Sóc Trăng - <strong>ST</strong><br/>Cần Thơ - <strong>CT</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Đà Nẵng - <strong>DNG</strong><br/>Khánh Hòa - <strong>KH</strong></td>
        </tr>
        <tr>
            <td class="border-right"><strong>Thứ 5</strong></td>
            <td class="border-right">Bình Thuận - <strong>BTH</strong><br/>An Giang - <strong>AG</strong><br/>Tây Ninh - <strong>TN</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Bình Định - <strong>BDI</strong><br/>Quảng Bình - <strong>QB</strong><br/>Quảng Trị - <strong>QT</strong></td>
        </tr>
        <tr>
            <td class="border-right"><strong>Thứ 6</strong></td>
            <td class="border-right">Bình Dương - <strong>BD</strong><br/>Trà Vinh - <strong>TV</strong><br/>Vĩnh Long - <strong>VL</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Gia Lai - <strong>GL</strong><br/>Ninh Thuận - <strong>NT</strong></td>
        </tr>
        <tr>
            <td class="border-right"><strong>Thứ 7</strong></td>
            <td class="border-right">Tp. Hồ Chí Minh - <strong>HCM</strong>;<br/>Bình Phước - <strong>BP</strong><br/>Hậu Giang - <strong>HG</strong><br/>Long An - <strong>LA</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Đà Nẵng - <strong>DNG</strong><br/>Đắc Nông - <strong>DNO</strong><br/>Quảng Ngãi - <strong>QNI</strong></td>
        </tr>
        <tr>
            <td class="border-right"><strong>Chủ nhật</strong></td>
            <td class="border-right">Kiên Giang - <strong>KG</strong><br/>Lâm Đồng - <strong>LD</strong><br/>Tiền Giang - <strong>TG</strong></td>
            <td class="border-right">Miền Bắc</td>
            <td>Khánh Hòa - <strong>KH</strong><br/>Kon Tum - <strong>KT</strong></td>
        </tr>
    </table>							
</div>
<div class="line-red mb10">&nbsp;</div>
<?php $this->load->view($layout_sms) ?>