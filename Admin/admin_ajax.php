<?php 
include ('connect.php');
date_default_timezone_set("Asia/Bangkok");
								$timey = date('Y');
								$timem = date('m');
								$timed = date('d');
								$slad = "-";
								$time = $timey.$slad.$timem.$slad.$timed;
//from tb_site
		if(isset($_POST['date'])){
			$date = $_POST['date'];
		}else{
			$date = $time;
		}
		

if(isset($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'update_tb_all'){
		$job = $_POST['seljob'];
		$date = $_POST['date'];
		$arr_sitename = array();
		$result_site = mysqli_query($conn,"select * from tb_site");
		while($row_site = mysqli_fetch_assoc($result_site)){
			$arr_sitename[$row_site['id']] = $row_site['name'];
		}
		//from tb_dept
		$arr_deptname = array();
		$result_dept = mysqli_query($conn,"select * from tb_dept");
		while($row_dept = mysqli_fetch_assoc($result_dept)){
			$arr_deptname[$row_dept['id']] = $row_dept['name'];
		}
		//from tb_grop
		$arr_gropname = array();
		$result_grop = mysqli_query($conn,"select * from tb_grop");
		while($row_grop = mysqli_fetch_assoc($result_grop)){
			$arr_gropname[$row_grop['id']] = $row_grop['name'];
		}
		//from tb_rep_mon
		$arr_location_mon = array();
		$arr_subdistrict_mon = array();
		$arr_district_mon = array();
		$arr_province_mon = array();
		$arr_time_mon = array();
		$arr_distance_mon = array();
		$arr_comment_mon = array();
		$arr_lat_mon = array();
		$arr_lon_mon = array();
		$arr_mon = array();
		
		if($job == '1'){
			$result_mon = mysqli_query($conn,"select * from tb_rep_mon where date = '$date'");
			while($row_mon = mysqli_fetch_assoc($result_mon)){
				$arr_location_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['detail'];
				$arr_subdistrict_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['subdistrict'];
				$arr_district_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['district'];
				$arr_province_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['province'];
				$arr_time_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['time'];
				$arr_distance_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['distance'];
				$arr_comment_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['comment'];
				$arr_lat_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['lati'];
				$arr_lon_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['lon'];
			}
			//from_tb_rep_after
			$arr_location_after = array();
			$arr_subdistrict_after = array();
			$arr_district_after = array();
			$arr_province_after = array();
			$arr_time_after = array();
			$arr_distance_after = array();
			$arr_comment_after = array();
			$result_after = mysqli_query($conn,"select * from tb_rep_after where date = '$date'");
			while($row_after = mysqli_fetch_assoc($result_after)){
				$arr_location_after[$row_after['id'].''.$row_after['round']] = $row_after['detail'];
				$arr_subdistrict_after[$row_after['id'].''.$row_after['round']] = $row_after['subdistrict'];
				$arr_district_after[$row_after['id'].''.$row_after['round']] = $row_after['district'];
				$arr_province_after[$row_after['id'].''.$row_after['round']] = $row_after['province'];
				$arr_time_after[$row_after['id'].''.$row_after['round']] = $row_after['time'];
				$arr_distance_after[$row_after['id'].''.$row_after['round']] = $row_after['distance'];
				$arr_comment_after[$row_after['id'].''.$row_after['round']] = $row_after['comment'];
				$arr_lat_after[$row_after['id'].''.$row_after['round']] = $row_after['lati'];
				$arr_lon_after[$row_after['id'].''.$row_after['round']] = $row_after['lon'];
			}
			//from_tb_rep_eve
			$arr_location_eve = array();
			$arr_subdistrict_eve = array();
			$arr_district_eve = array();
			$arr_province_eve = array();
			$arr_time_eve = array();
			$arr_distance_eve = array();
			$arr_comment_eve = array();
			$result_eve = mysqli_query($conn,"select * from tb_rep_eve where date = '$date'");
			while($row_eve = mysqli_fetch_assoc($result_eve)){
				$arr_location_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['detail'];
				$arr_subdistrict_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['subdistrict'];
				$arr_district_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['district'];
				$arr_province_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['province'];
				$arr_time_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['time'];
				$arr_distance_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['distance'];
				$arr_comment_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['comment'];
				$arr_lat_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['lati'];
				$arr_lon_eve[$row_eve['id'].''.$row_eve['round']] = $row_eve['lon'];
			}
			$result_user = mysqli_query($conn,"select * from tb_user");
			while($row_user = mysqli_fetch_assoc($result_user)){
				$id = $row_user['id'];
				$type = $row_user['type'];
				$name = $row_user['name'];
				$lname = $row_user['lname'];
				$tel = $row_user['tel'];
				$grop = $row_user['grop'];
				$site = $row_user['site'];
				$dept = $row_user['dept'];
				$lati1 = $row_user['lati1'];
				$lon1 = $row_user['lon1'];
				$namegps1 = $row_user['namegps1'];

				$sitename = isset($arr_sitename[$site])?$arr_sitename[$site]:'';
				$deptname = isset($arr_deptname[$dept])?$arr_deptname[$dept]:'';
				$gropname = isset($arr_gropname[$grop])?$arr_gropname[$grop]:'';
				
				$sql_round = mysqli_query($conn,"SELECT distinct round from tb_rep_mon where date = '$date' and id = '$id' 
									UNION
									SELECT distinct round from tb_rep_after where date = '$date' and id = '$id'
									UNION
									SELECT distinct round from tb_rep_eve where date = '$date' and id = '$id'");
				$count_row_round = mysqli_num_rows($sql_round);
				if($count_row_round == 0){
					$round = 1;
				}
				else{
					$round = $count_row_round;
				}
				$i = 0;
				while($i < $round){
					$i++;
					$result = mysqli_query($conn,"select * from tb_rep_all where user_id = '$id' and date = '$date' and round = '$i'");
					$mon_lati = isset($arr_lat_mon[$id.''.$i])?$arr_lat_mon[$id.''.$i]:'';
						$mon_lon = isset($arr_lon_mon[$id.''.$i])?$arr_lon_mon[$id.''.$i]:'';
						$mon_detail = isset($arr_location_mon[$id.''.$i])?$arr_location_mon[$id.''.$i]:'';
						$mon_subdis = isset($arr_subdistrict_mon[$id.''.$i])?$arr_subdistrict_mon[$id.''.$i]:'';
						$mon_district = isset($arr_district_mon[$id.''.$i])?$arr_district_mon[$id.''.$i]:'';
						$mon_province = isset($arr_province_mon[$id.''.$i])?$arr_province_mon[$id.''.$i]:'';
						$mon_time = isset($arr_time_mon[$id.''.$i])?$arr_time_mon[$id.''.$i]:'';
						$mon_distance = isset($arr_distance_mon[$id.''.$i])?$arr_distance_mon[$id.''.$i]:'';
						$mon_comment = isset($arr_comment_mon[$id.''.$i])?$arr_comment_mon[$id.''.$i]:'';
						$after_lati = isset($arr_lat_after[$id.''.$i])?$arr_lat_after[$id.''.$i]:'';
						$after_lon = isset($arr_lon_after[$id.''.$i])?$arr_lon_after[$id.''.$i]:'';
						$after_detail = isset($arr_location_after[$id.''.$i])?$arr_location_after[$id.''.$i]:'';
						$after_subdis = isset($arr_subdistrict_after[$id.''.$i])?$arr_subdistrict_after[$id.''.$i]:'';
						$after_district = isset($arr_district_after[$id.''.$i])?$arr_district_after[$id.''.$i]:'';
						$after_province = isset($arr_province_after[$id.''.$i])?$arr_province_after[$id.''.$i]:'';
						$after_time = isset($arr_time_after[$id.''.$i])?$arr_time_after[$id.''.$i]:'';
						$after_distance = isset($arr_distance_after[$id.''.$i])?$arr_distance_after[$id.''.$i]:'';
						$after_comment = isset($arr_comment_after[$id.''.$i])?$arr_comment_after[$id.''.$i]:'';
						$eve_lati = isset($arr_lat_eve[$id.''.$i])?$arr_lat_eve[$id.''.$i]:'';
						$eve_lon = isset($arr_lon_eve[$id.''.$i])?$arr_lon_eve[$id.''.$i]:'';
						$eve_detail = isset($arr_location_eve[$id.''.$i])?$arr_location_eve[$id.''.$i]:'';
						$eve_subdis = isset($arr_subdistrict_eve[$id.''.$i])?$arr_subdistrict_eve[$id.''.$i]:'';
						$eve_district = isset($arr_district_eve[$id.''.$i])?$arr_district_eve[$id.''.$i]:'';
						$eve_province = isset($arr_province_eve[$id.''.$i])?$arr_province_eve[$id.''.$i]:'';
						$eve_time = isset($arr_time_eve[$id.''.$i])?$arr_time_eve[$id.''.$i]:'';
						$eve_distance = isset($arr_distance_eve[$id.''.$i])?$arr_distance_eve[$id.''.$i]:'';
						$eve_comment = isset($arr_comment_eve[$id.''.$i])?$arr_comment_eve[$id.''.$i]:'';
					$numrow = mysqli_num_rows($result);
					if($numrow == 0){
						$sql = "INSERT INTO `tb_rep_all`(`site_name`, `dept_name`, `grop_name`, `user_id`, `user_type`, `user_name`, `user_lname`, `user_tel`, `user_lat`, `user_lon`, `user_location`, `date`, `round`, `lat_mon`, `lon_mon`, `location_mon`, `subdistrict_mon`, `district_mon`, `province_mon`, `time_mon`, `distance_mon`, `comment_mon`, `lat_after`, `lon_after`, `location_after`, `subdistrict_after`, `district_after`, `province_after`, `time_after`, `distance_after`, `comment_after`, `lat_eve`, `lon_eve`, `location_eve`, `subdistrict_eve`, `district_eve`, `province_eve`, `time_eve`, `distance_eve`, `comment_eve`) 
						VALUES ('$sitename','$deptname','$gropname','$id','$type','$name','$lname','$tel','$lati1','$lon1','$namegps1','$date','$i','$mon_lati','$mon_lon','$mon_detail','$mon_subdis','$mon_district','$mon_province','$mon_time','$mon_distance','$mon_comment','$after_lati','$after_lon','$after_detail','$after_subdis','$after_district','$after_province','$after_time','$after_distance','$after_comment','$eve_lati','$eve_lon','$eve_detail','$eve_subdis','$eve_district','$eve_province','$eve_time','$eve_distance','$eve_comment')";
					}else{
						$sql = "UPDATE `tb_rep_all` SET `lat_mon`='$mon_lati',`lon_mon`='$mon_lon',`location_mon`='$mon_detail',`subdistrict_mon`='$mon_subdis',`district_mon`='$mon_district',`province_mon`='$mon_province',`time_mon`='$mon_time',`distance_mon`='$mon_distance',`comment_mon`='$mon_comment',`lat_after`='$after_lati',`lon_after`='$after_lon',`location_after`='$after_detail',`subdistrict_after`='$after_subdis',`district_after`='$after_district',`province_after`='$after_province',`time_after`='$after_time',`distance_after`='$after_distance',`comment_after`='$after_comment',`lat_eve`='$eve_lati',`lon_eve`='$eve_lon',`location_eve`='$eve_detail',`subdistrict_eve`='$eve_subdis',`district_eve`='$eve_district',`province_eve`='$eve_province',`time_eve`='$eve_time',`distance_eve`='$eve_distance',`comment_eve`= '$eve_comment' WHERE user_id = '$id' and date = '$date' and round = '$i'";
					}
					if($result = mysqli_query($conn,$sql)){

					}else{
						echo mysqli_error($conn);
					}
					
				}
			}
		}else if($job == '2'){
			$result_mon = mysqli_query($conn,"select * from tb_rep2_mon where date = '$date'");
			while($row_mon = mysqli_fetch_assoc($result_mon)){
				$arr_mon[] = $row_mon;
				$arr_location_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['detail'];
				$arr_subdistrict_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['subdistrict'];
				$arr_district_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['district'];
				$arr_province_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['province'];
				$arr_time_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['time'];
				$arr_distance_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['distance'];
				$arr_comment_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['comment'];
				$arr_lat_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['lati'];
				$arr_lon_mon[$row_mon['id'].''.$row_mon['round']] = $row_mon['lon'];
			}
			//from_tb_rep_after
			$arr_location_after = array();
			$arr_subdistrict_after = array();
			$arr_district_after = array();
			$arr_province_after = array();
			$arr_time_after = array();
			$arr_distance_after = array();
			$arr_comment_after = array();
			$result_after = mysqli_query($conn,"select * from tb_rep2_after where date = '$date'");
			while($row_after = mysqli_fetch_assoc($result_after)){
				$arr_location_after[$row_after['id'].''.$row_after['round']] = $row_after['detail'];
				$arr_subdistrict_after[$row_after['id'].''.$row_after['round']] = $row_after['subdistrict'];
				$arr_district_after[$row_after['id'].''.$row_after['round']] = $row_after['district'];
				$arr_province_after[$row_after['id'].''.$row_after['round']] = $row_after['province'];
				$arr_time_after[$row_after['id'].''.$row_after['round']] = $row_after['time'];
				$arr_distance_after[$row_after['id'].''.$row_after['round']] = $row_after['distance'];
				$arr_comment_after[$row_after['id'].''.$row_after['round']] = $row_after['comment'];
				$arr_lat_after[$row_after['id'].''.$row_after['round']] = $row_after['lati'];
				$arr_lon_after[$row_after['id'].''.$row_after['round']] = $row_after['lon'];
			}
			$result_user = mysqli_query($conn,"select * from tb_user");
			while($row_user = mysqli_fetch_assoc($result_user)){
				$id = $row_user['id'];
				$type = $row_user['type'];
				$name = $row_user['name'];
				$lname = $row_user['lname'];
				$tel = $row_user['tel'];
				$grop = $row_user['grop'];
				$site = $row_user['site'];
				$dept = $row_user['dept'];
				$lati1 = $row_user['lati1'];
				$lon1 = $row_user['lon1'];
				$namegps1 = $row_user['namegps1'];

				$sitename = isset($arr_sitename[$site])?$arr_sitename[$site]:'';
				$deptname = isset($arr_deptname[$dept])?$arr_deptname[$dept]:'';
				$gropname = isset($arr_gropname[$grop])?$arr_gropname[$grop]:'';
				
				$sql_round = mysqli_query($conn,"SELECT distinct round from tb_rep2_mon where date = '$date' and id = '$id'
									UNION
									SELECT distinct round from tb_rep2_after where date = '$date' and id = '$id'");
				$count_row_round = mysqli_num_rows($sql_round);
				if($count_row_round == 0){
					$round = 1;
				}
				else{
					$round = $count_row_round;
				}
				$i = 0;
				while($i < $round){
					$i++;
					$detail_mon = isset($arr_location_mon[$id.''.$i])?$arr_location_mon[$id.''.$i]:'';
					$subdistrict_mon = isset($arr_subdistrict_mon[$id.''.$i])?$arr_subdistrict_mon[$id.''.$i]:'';
					$district_mon = isset($arr_district_mon[$id.''.$i])?$arr_district_mon[$id.''.$i]:'';
					$province_mon = isset($arr_province_mon[$id.''.$i])?$arr_province_mon[$id.''.$i]:'';
					$time_mon = isset($arr_time_mon[$id.''.$i])?$arr_time_mon[$id.''.$i]:'';
					$distance_mon = isset($arr_distance_mon[$id.''.$i])?$arr_distance_mon[$id.''.$i]:'';
					$comment_mon = isset($arr_comment_mon[$id.''.$i])?$arr_comment_mon[$id.''.$i]:'';
					$lati_mon = isset($arr_lat_mon[$id.''.$i])?$arr_lat_mon[$id.''.$i]:'';
					$lon_mon = isset($arr_lon_mon[$id.''.$i])?$arr_lon_mon[$id.''.$i]:'';

					$detail_after = isset($arr_location_after[$id.''.$i])?$arr_location_after[$id.''.$i]:'';
					$subdistrict_after = isset($arr_subdistrict_after[$id.''.$i])?$arr_subdistrict_after[$id.''.$i]:'';
					$district_after = isset($arr_district_after[$id.''.$i])?$arr_district_after[$id.''.$i]:'';
					$province_after = isset($arr_province_after[$id.''.$i])?$arr_province_after[$id.''.$i]:'';
					$time_after = isset($arr_time_after[$id.''.$i])?$arr_time_after[$id.''.$i]:'';
					$distance_after = isset($arr_distance_after[$id.''.$i])?$arr_distance_after[$id.''.$i]:'';
					$comment_after = isset($arr_comment_after[$id.''.$i])?$arr_comment_after[$id.''.$i]:'';
					$lati_after = isset($arr_lat_after[$id.''.$i])?$arr_lat_after[$id.''.$i]:'';
					$lon_after = isset($arr_lon_after[$id.''.$i])?$arr_lon_after[$id.''.$i]:'';


					$result = mysqli_query($conn,"select * from tb_rep2_all where user_id = '$id' and date = '$date' and round = '$i'");
					$numrow = mysqli_num_rows($result);
					if($numrow > 0){
						$sql = "update tb_rep2_all set lat_mon = '$lati_mon' ,lon_mon = '$lon_mon' ,location_mon = '$detail_mon' ,subdistrict_mon = '$subdistrict_mon' ,district_mon = '$district_mon' ,province_mon = '$province_mon' ,time_mon = '$time_mon' ,distance_mon = '$distance_mon' ,comment_mon = '$comment_mon' ,lat_after = '$lati_after' ,lon_after = '$lon_after' ,location_after = '$detail_after' ,subdistrict_after = '$subdistrict_after' ,district_after = '$district_after' ,province_after = '$province_after' ,time_after = '$time_after' ,distance_after = '$distance_after' ,comment_after = '$comment_after' where date = '$date' and user_id = '$id' and round = '$i'";
					}else{
						$sql = "INSERT INTO `tb_rep2_all`(`site_name`, `dept_name`, `grop_name`, `user_id`, `user_type`, `user_name`, `user_lname`, `user_tel`, `user_location`, `user_lat`, `user_lon`, `date`, `lat_mon`, `lon_mon`, `location_mon`, `subdistrict_mon`, `district_mon`, `province_mon`, `time_mon`, `distance_mon`, `comment_mon`, `lat_after`, `lon_after`, `location_after`, `subdistrict_after`, `district_after`, `province_after`, `time_after`, `distance_after`, `comment_after`, `lat_eve`, `lon_eve`, `location_eve`, `subdistrict_eve`, `district_eve`, `province_eve`, `time_eve`, `distance_eve`, `comment_eve`, `round`) 
						VALUES ('$sitename','$deptname','$gropname','$id','$type','$name','$lname','$tel','$namegps1','$lati1','$lon1','$date','$lati_mon','$lon_mon','$detail_mon','$subdistrict_mon','$district_mon','$province_mon','$time_mon','$distance_mon','$comment_mon','$lati_after','$lon_after','$detail_after','$subdistrict_after','$district_after','$province_after','$time_after','$distance_after','$comment_after','','','','','','','','','','$i')";
					}
					if($result = mysqli_query($conn,$sql)){

					}else{
						echo mysqli_error($conn);
					}
				}

				
				//}
			}
		}
		


		
	}
}
?> 