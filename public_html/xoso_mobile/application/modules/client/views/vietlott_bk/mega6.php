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
<div class="main-vietlot-page-m6">
            <h2 class="top-head">
                <strong><?php echo rebuild_date('l', $item->dateint);?></strong> - <input type="text" class="nobor hasDatepicker" value="<?php echo date('d/m/Y',time());?>" id="searchDate">
            </h2>
            
			<?php for($i=0; $i<count($vietlottmega); $i++) { $item = $vietlottmega[$i]?>
            <div class="box-ngay-detail">
                <div class="head-detail">
                    <div class="caption"><?php echo rebuild_date('l', $item->dateint);?><time><?php echo date('d-m-Y',$item->dateint)?></time></div>
                    <?php $data_mega_content = json_decode($item->content); ?>
					<div class="data">
                        <ul class="list-number">
                            <li><?php echo $data_mega_content->content->db[0]; ?></li>
							<li><?php echo $data_mega_content->content->db[1]; ?></li>
							<li><?php echo $data_mega_content->content->db[2]; ?></li>
							<li><?php echo $data_mega_content->content->db[3]; ?></li>
							<li><?php echo $data_mega_content->content->db[4]; ?></li>
							<li><?php echo $data_mega_content->content->db[5]; ?></li>
                        </ul>
                    </div>
                    <p class="txt-center">Giá trị Jackpot: <strong><?php echo $data_mega_content->content->nd->jp->gt;?> đồng</strong></p>
                </div>
                <table class="data2">
                    <tbody>
                        <tr>
                            <td>Giải thưởng</td><td>Trùng khớp</td><td>Số lượng giải</td><td>Giá trị giải (đồng)</td>
                        </tr>
                        <tr>
                            <td class="clnote">Jackpot</td><td>• • • • • •</td>
                            <td><?php echo $data_mega_content->content->nd->jp->sl;?></td>
                            <td class="clnote"><?php echo $data_mega_content->content->nd->jp->gt;?></td>
                        </tr>
                        <tr>
                            <td class="clnote">Giải nhất</td><td>• • • • •</td>
                            <td><?php echo $data_mega_content->content->nd->g1->sl;?></td>
                            <td><?php echo $data_mega_content->content->nd->g1->gt;?></td>
                        </tr>
                        <tr>
                            <td class="clnote">Giải nhì</td><td>• • • •</td>
                            <td><?php echo $data_mega_content->content->nd->g2->sl;?></td>
                            <td><?php echo $data_mega_content->content->nd->g2->gt;?></td>
                        </tr>
                        <tr>
                            <td class="clnote">Giải ba</td><td>• • •</td>
                            <td><?php echo $data_mega_content->content->nd->g3->sl;?></td>
                            <td><?php echo $data_mega_content->content->nd->g3->gt;?></td>
                        </tr>
                    </tbody>
				</table>
            </div>
            <?php } ?>
			<nav class="main-pagination">
				<?php echo $pagnav; ?>
            </nav>
			<div class="box-bottom-head">
                <h1 class="title-head-more"><span>Kết quả xổ số tự chọn Vietlott Mega 6/45</span></h1>
                <ul class="list-vl">
                    <li><a href="/tin-xo-so/co-cau-chuong-trinh-xo-so-tu-chon-mega-6-45.html">Cơ cấu chương trình xổ số tự chọn Mega 6/45</a></li>
                    <li><a href="/tin-xo-so/co-cau-giai-thuong-xo-so-mega-6-45---vietlott.html">Cơ cấu giải thưởng xổ số mega 6/45</a></li>
                    <li><a href="/tin-xo-so/cach-choi-vietlott---xo-so-dien-toan-tu-chon-jackpot-mega-6-45.html">Hướng dẫn cách chơi xổ số điện toán tự chọn Mega 6/45</a></li>
                </ul>
            </div>
			<br>
            <div class="box box-html">
                <p><a href="http://xoso.com/vietlott/mega6.html" title="Kết quả xổ số Mega 6/45"><strong><span style="color:#0000FF">Kết quả xổ số Mega 6/45</span></strong></a> – Xổ số Mega 6/45 được quay số mở thưởng trực tiếp tại trung tâm quay số mở thưởng xổ số tự chọn Vietlott có trụ sở tại tầng 19, tòa nhà VTC (số 23 Lạc Trung, Hai Bà Trưng, Hà Nội) vào lúc 18h10p và kết thúc vào 18h30p các ngày thứ 4, thứ 6 và chủ nhật hàng tuần.</p>

                <p>Mega 6/45 là kết quả bởi sự hợp tác của công ty Vietlott và Tập đoàn Berjaya (Malaysia) và chính thức đi vào hoạt động là ngày 18/7/2016.</p>

                <p>Jackpot Mega 6/45 có giá trị tối thiểu là 12 tỷ đồng và được cộng đồn tích lũy cho tới khi có người trúng thưởng.</p>

                <p>Để theo dõi và dò vé số Vietlott Mega 6/45 nhanh chóng và chínhh xác nhất hãy truy cập ngay vào <a href="http://xoso.com/" title="KQXS"><span style="color:#0000FF"><strong>KQXS</strong></span></a> để có được thông tin hàng ngay.</p>

                <p>Xoso.com cung cấp <span style="color:#FF0000"><strong>kết quả xổ số Mega 6/45 – KQXS Mega 6/45 – XS Mega 6/45 – SX Mega 6/45 – XS 6/45</strong></span> trực tiếp trên máy tính và smartphone một cách nhanh nhất và chuẩn nhất trên khắp mọi miền đất nước.</p>

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
