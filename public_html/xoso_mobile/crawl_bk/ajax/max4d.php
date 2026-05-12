<?php

function get_cat($drawid) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 2 AND drawId = ".trim($drawid)." LIMIT 1";
    $rows = $db->get_rows($sql);

    return $rows;
}

function get_data($drawid) {

    $href = new href();
    $arr_cat = get_cat($drawid);    

    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);

    if (count($arr_cat)) { $obj_cat = $arr_cat[0]; 	?>    
       
		<div class="box-result-detail">
			<span class="arrow-result">
				<a href="javascript:void(0)" onclick="return prevNextResultGameMax4D(this, 0)" data-gameid-max4d="2" data-drawid-max4d="<?php echo $obj_cat->drawId - 1; ?>" data-dayprize-max4d="<?php echo date('n/j/Y', $obj_cat->dateint);?> 12:00:00 AM">
					<i class="icon-arrow-left my-file-vietlott"></i>
				</a>
			</span>
			<p class="time-result">Kỳ quay thưởng #000<?php echo $obj_cat->drawId; ?> | Ngày quay thưởng <?php echo date('d/m/Y', $obj_cat->dateint);?></p>
			<?php $data_max_content = json_decode($obj_cat->content); ?>
			<ul class="result-max4d">
				<li>
					<span class="name-result-max4d">Giải Nhất</span>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->g1[0]; ?></li>
						<li><?php echo $data_max_content->content->db->g1[1]; ?></li>
						<li><?php echo $data_max_content->content->db->g1[2]; ?></li>
						<li><?php echo $data_max_content->content->db->g1[3]; ?></li>  
					</ul>
					<span class="name-result-max4d">Giải Nhì</span>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->g2->s1[0]; ?></li>
							<li><?php echo $data_max_content->content->db->g2->s1[1]; ?></li>
							<li><?php echo $data_max_content->content->db->g2->s1[2]; ?></li>
							<li><?php echo $data_max_content->content->db->g2->s1[3]; ?></li>
					</ul>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->g2->s2[0]; ?></li>
							<li><?php echo $data_max_content->content->db->g2->s2[1]; ?></li>
							<li><?php echo $data_max_content->content->db->g2->s2[2]; ?></li>
							<li><?php echo $data_max_content->content->db->g2->s2[3]; ?></li>
					</ul>
				</li>
				<li>
					<span class="name-result-max4d">Giải Ba</span>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->g3->s1[0]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s1[1]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s1[2]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s1[3]; ?></li>
					</ul>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->g3->s2[0]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s2[1]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s2[2]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s2[3]; ?></li>
					</ul>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->g3->s3[0]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s3[1]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s3[2]; ?></li>
							<li><?php echo $data_max_content->content->db->g3->s3[3]; ?></li>
					</ul>
				</li>
				<li>
					<span class="name-result-max4d">Giải Khuyến Khích</span>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->kk1[0]; ?></li>
							<li><?php echo $data_max_content->content->db->kk1[1]; ?></li>
							<li><?php echo $data_max_content->content->db->kk1[2]; ?></li>
							<li><?php echo $data_max_content->content->db->kk1[3]; ?></li>  
					</ul>
					<ul class="num-result-max4d">
						<li><?php echo $data_max_content->content->db->kk2[0]; ?></li>
							<li><?php echo $data_max_content->content->db->kk2[1]; ?></li>
							<li><?php echo $data_max_content->content->db->kk2[2]; ?></li>
							<li><?php echo $data_max_content->content->db->kk2[3]; ?></li>
					</ul>
				</li>
			</ul>
			<span class="arrow-result arrow-right">
				<a href="javascript:void(0)" onclick="return prevNextResultGameMax4D(this, 1)" data-gameid-max4d="2" data-drawid-max4d="<?php echo $obj_cat->drawId + 1; ?>" data-dayprize-max4d="<?php echo date('n/j/Y', $obj_cat->dateint);?> 12:00:00 AM">
					<i class="icon-arrow-right my-file-vietlott"></i>
				</a>
			</span>
		</div>
					
	<?php } 
    @set_time_limit($defalutExecution);    
    die;
}


?>
