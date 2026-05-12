<?php 
function rebuild_date( $format, $time = 0 )
{
    if ( ! $time ) $time = time();

	$lang = array();
	$lang['sun'] = 'CN';
	$lang['mon'] = 'T2';
	$lang['tue'] = 'T3';
	$lang['wed'] = 'T4';
	$lang['thu'] = 'T5';
	$lang['fri'] = 'T6';
	$lang['sat'] = 'T7';
	$lang['sunday'] = 'Chủ nhật';
	$lang['monday'] = 'Thứ hai';
	$lang['tuesday'] = 'Thứ ba';
	$lang['wednesday'] = 'Thứ tư';
	$lang['thursday'] = 'Thứ năm';
	$lang['friday'] = 'Thứ sáu';
	$lang['saturday'] = 'Thứ bảy';
	$lang['january'] = 'Tháng Một';
	$lang['february'] = 'Tháng Hai';
	$lang['march'] = 'Tháng Ba';
	$lang['april'] = 'Tháng Tư';
	$lang['may'] = 'Tháng Năm';
	$lang['june'] = 'Tháng Sáu';
	$lang['july'] = 'Tháng Bảy';
	$lang['august'] = 'Tháng Tám';
	$lang['september'] = 'Tháng Chín';
	$lang['october'] = 'Tháng Mười';
	$lang['november'] = 'Tháng M. một';
	$lang['december'] = 'Tháng M. hai';
	$lang['jan'] = 'T01';
	$lang['feb'] = 'T02';
	$lang['mar'] = 'T03';
	$lang['apr'] = 'T04';
	$lang['may2'] = 'T05';
	$lang['jun'] = 'T06';
	$lang['jul'] = 'T07';
	$lang['aug'] = 'T08';
	$lang['sep'] = 'T09';
	$lang['oct'] = 'T10';
	$lang['nov'] = 'T11';
	$lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
    $return = date( $format, $time );

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1" );

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
}

?>
<div class="main-vietlot-page-m6 main-vietlot-page-max4">
            <h2 class="top-head">
                <strong><?php echo rebuild_date('l', $item->dateint);?></strong> - <input type="text" class="nobor hasDatepicker" value="<?php echo date('d/m/Y',time());?>" id="searchDate">
            </h2>
            
			<?php
			
			for($i=0; $i<count($vietlottmax4d); $i++) { 
			$item = $vietlottmax4d[$i];
			$data_max_content = json_decode($item->content); 			
			?>
            <div class="box-ngay4d">
                <h2 class="title-bor clearfix">
                    <strong>Kết quả xổ số Max 4D <?php echo rebuild_date('l', $item->dateint);?> ngày <?php echo date('d/m/Y',$item->dateint)?></strong> 
                </h2>
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="kqmb colgiai"><tbody>
                        <tr class="bg_ef"><td class="txt-giai"><b>Giải</b></td><td colspan="12"><strong>Dãy số trúng</strong></td><td><b>SL</b></td><td><b>Giá trị</b></td></tr>
                        <tr class="db">
							<td class="txt-giai">Nhất</td>
							<td colspan="12" class="number"><strong><?php echo $data_max_content->content->nd->g1->kq; ?></strong></td>
							<td><?php echo $data_max_content->content->nd->g1->sl; ?></td>
							<td><?php echo $data_max_content->content->nd->g1->gt; ?></td>
						</tr>
                        <tr class="bg_ef">
							<td class="txt-giai">Nhì </td>
							<td colspan="12" class="number"><strong><?php echo $data_max_content->content->nd->g2->kq; ?></strong></td>
							<td><?php echo $data_max_content->content->nd->g2->sl; ?></td>
							<td><?php echo $data_max_content->content->nd->g2->gt; ?></td>
						</tr>
                        <tr class="giai3">
							<td class="txt-giai">Ba</td>
							<td class="number" colspan="12"><strong><?php echo $data_max_content->content->nd->g3->kq; ?></strong></td>
							<td><?php echo $data_max_content->content->nd->g3->sl; ?></td>
							<td><?php echo $data_max_content->content->nd->g3->gt; ?></td>
						</tr>
                        <tr class="bg_ef">
						<td>KK 1</td>
							<td colspan="12" class="number"><strong><?php echo $data_max_content->content->nd->kk1->kq; ?></strong></td>
							<td><?php echo $data_max_content->content->nd->kk1->sl; ?></td>
							<td><?php echo $data_max_content->content->nd->kk1->gt; ?></td>
						</tr>
                        <tr>
						<td>KK 2</td>
							<td colspan="12" class="number"><strong><?php echo $data_max_content->content->nd->kk2->kq; ?></strong></td>
							<td><?php echo $data_max_content->content->nd->kk2->sl; ?></td>
							<td><?php echo $data_max_content->content->nd->kk2->gt; ?></td>
						</tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>
			
            <nav class="main-pagination">
                <?php echo $pagnav; ?>                                     
            </nav>
			<!--<div class="box-cac-tinh">
                <div class="box mo-thuong-ngay">
                    <h2 class="title-bor"><strong>Các tỉnh mở thưởng hôm nay</strong></h2>
                    <table class="colgiai" cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tbody>
                            <tr>
                                <td><a href="#" title="XSCM">Cà Mau</a> </td>
                                <td><a href="#" title="XSPY">Phú Yên</a> </td>
                                <td><a href="#" title="XSMB">Miền Bắc</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" title="XSDT">Đồng Tháp</a> </td>
                                <td><a href="#" title="XSTTH">Thừa Thiên Huế</a> </td>
                                <td><a href="#" title="Điện toán">Điện toán</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" title="XSHCM">TP Hồ Chí Minh</a> </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>-->
            <div class="box-bottom-head">
                <ul class="list-vl">
                    <li><a href="/tin-xo-so/co-cau-chuong-trinh-xo-so-tu-chon-max-4d.html">Cơ cấu chương trình xổ số tự chọn MAX 4D - Vietlott</a></li>
                    <li><a href="/tin-xo-so/co-cau-giai-thuong-xo-so-max-4d---vietlott.html">Cơ cấu giải thưởng xổ số MAX 4D - Vietlott</a></li>
                    <li><a href="/tin-xo-so/huong-dan-cach-choi-xo-so-dien-toan-tu-chon-max-4d---vietlott.html">Hướng dẫn cách chơi xổ số điện toán tự chọn MAX 4D - Vietlott</a></li>
                </ul>
            </div><br>
            <div class="box box-html">

                <p><a href="http://xoso.com/vietlott/max4d.html" title="KQXS Max4D"><span style="color:#0000FF"><strong>KQXS Max4D</strong></span></a> – kết quả xổ số điện toán tự chọn số Max4D Vietlott hôm nay được quay số mở thưởng trực tiếp tại trung tâm quay số mở thưởng xổ số tự chọn Vietlott có trụ sở tại tầng 19, tòa nhà VTC (số 23 Lạc Trung, Hai Bà Trưng, Hà Nội) vào lúc 18h10p và kết thúc vào 18h30p các ngày thứ 3, thứ 5 và thứ 7 hàng tuần.</p>

                <p>Max 4D là trò chơi xổ số tự chọn có xác xuất trúng thưởng cao nhất hiện nay, đây là một trong những sản phẩm mới của Vietlott được phát hành từ ngày 18/11/2016 thu hút đông đảo người chơi. Theo ghi nhận thì Max4D đã có người trúng tới 750 triệu đồng.</p>

                <p>Để theo dõi kết quả xổ số Max4D nhanh chóng và chính xác nhất hãy truy cập ngay vào <a href="http://xoso.com/" title="KQXS"><span style="color:#0000FF"><strong>KQXS</strong></span></a> để có được thông tin hàng ngay.</p>

                <p>Xoso.com cung cấp kết quả xổ số Max4D – KQXS Max4D – XS Max4D – SX Max4D – XS 4D trực tiếp trên máy tính và smartphone một cách nhanh nhất và chuẩn nhất trên khắp mọi miền đất nước.</p>

                <p><strong>CÔNG TY TNHH MTV XỔ SỐ ĐIỆN TOÁN VIỆT NAM (VIETLOTT):</strong></p>

                <p><strong>Trụ sở chính:</strong></p>

                <p>Công ty Xổ Số Điện Toán Việt Nam</p>

                <p>Địa chỉ: Tầng 15, Tòa nhà CornerStone, 16 Phan Chu Trinh, Quận Hoàn Kiếm, Hà Nội (Xem bản đồ)</p>

                <p>Tel: 04.62.686.818 Fax: 04.62.686.800</p>

                <p><strong>Chi nhánh Hồ Chí Minh:</strong></p>

                <p>Địa chỉ: Số 93-95, Hàm Nghi, Quận 1, Tp. Hồ Chí Minh (Xem bản đồ)</p>

                <p>Tel: 08.38.212.629</p>

                <p><strong>Chi nhánh Cần Thơ:</strong></p>

                <p>Địa chỉ: 62 Lý Tự Trọng, phường An Cư, quận Ninh Kiều, thành phố Cần Thơ (Xem bản đồ)</p>

                <p>Tel: 0710.6 252 245</p>

                <p><strong>Chi nhánh Bà Rịa - Vũng Tàu:</strong></p>

                <p>Địa chỉ: Số 4 Trần Hưng Đạo, Phường 3, thành phố Vũng Tàu, tỉnh Bà Rịa - Vũng Tàu.</p>

                <p><strong>Chi nhánh Khánh Hòa:</strong></p>

                <p>Địa chỉ: Tầng 2, tòa nhà LienVietPostBank, số 69-71 Thống Nhất, thành phố Nha Trang, tỉnh Khánh Hòa.</p>

                <p><strong>Chi nhánh Hải Phòng:</strong></p>

                <p>Địa chỉ: Số 255/16D, Khu dân cư Trung Hành 5, phường Đằng Lâm, quận Hải An, thành phố Hải Phòng.</p>

                
            </div>
        </div>