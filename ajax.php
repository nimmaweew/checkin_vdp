<?php 
include ('connect.php');
date_default_timezone_set("Asia/Bangkok");
		$timenowh = date("G");
		$timenowm = date("i");
		$dot = ".";
		$timenowa = $timenowh.$dot.$timenowm ;
		$timenow = number_format($timenowa,2,'.','');
		$date = date('Y-m-d');
		//ดึงข้อมูลเวลา
		$result_time_morning = mysqli_query($conn,"select * from tb_time where name = 'morning'");
		$row_time_morning = mysqli_fetch_assoc($result_time_morning);
		$time_morning_st = $row_time_morning['st_time'];
		$time_morning_en = $row_time_morning['en_time'];
		//ช่วงบ่าย
		$result_time_afternoon = mysqli_query($conn,"select * from tb_time where name = 'afternoon'");
		$row_time_afternoon = mysqli_fetch_assoc($result_time_afternoon);
		$time_afternoon_st = $row_time_afternoon['st_time'];
		$time_afternoon_en = $row_time_afternoon['en_time'];
		//ช่วงเย็น
		$result_time_evening = mysqli_query($conn,"select * from tb_time where name = 'evening'");
		$row_time_evening = mysqli_fetch_assoc($result_time_evening);
		$time_evening_st = $row_time_evening['st_time'];
		$time_evening_en = $row_time_evening['en_time'];

		//กะดึก
		//รอบ1
		$result_time_mon2 = mysqli_query($conn,"select * from tb_time where id = '4'");
		$row_mon2 = mysqli_fetch_assoc($result_time_mon2);
		$time_mon2_st = $row_mon2['st_time'];
		$time_mon2_en = $row_mon2['en_time'];
		//รอบ2
		$result_time_after2 = mysqli_query($conn,"select * from tb_time where id = '5'");
		$row_after2 = mysqli_fetch_assoc($result_time_after2);
		$time_after2_st = $row_after2['st_time'];
		$time_after2_en = $row_after2['en_time'];

if(isset($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'chk_time'){
		$sel_time = $_POST['time'];
		if($sel_time == '1'){
			if($timenow < $time_morning_st){
			//ยังไม่ถึงรอบเช้า
			//201 แทนการแจ้งไม่ถึงเวลา
				echo json_encode(array("statusCode"=>201));
			}else if($timenow >= $time_morning_st && $timenow < $time_morning_en){
				echo json_encode(array("statusCode"=>200));
			}else if($timenow >= $time_afternoon_st && $timenow < $time_afternoon_en){
				echo json_encode(array("statusCode"=>200));
			}else if($timenow >= $time_evening_st && $timenow <= $time_evening_en){
				echo json_encode(array("statusCode"=>200));
			}else if($timenow > $time_evening_en){
				//เลยรอบเย็น
				//202 แทนการแจ้งเลยเวลา
				echo json_encode(array("statusCode"=>201));
			}else{
				//ไม่เข้ารอบ
				//201 แทนการแจ้งไม่ถึงเวลา
				echo json_encode(array("statusCode"=>201));
			}
		}else if($sel_time == '2'){
			if($timenow < $time_mon2_st){
				echo json_encode(array("statusCode"=>201));
			}else if($timenow >= $time_mon2_st && $timenow < $time_mon2_en){
				echo json_encode(array("statusCode"=>200));
			}else if($timenow >= $time_after2_st && $timenow < $time_after2_en){
				echo json_encode(array("statusCode"=>200));
			}else if($timenow > $time_after2_en){
				echo json_encode(array("statusCode"=>201));
			}else{
				echo json_encode(array("statusCode"=>201));
			}
		}
		
	}
	
	
	if($type == 'tel_check'){
		$tel = $_POST['tel'];
		$result = mysqli_query($conn,"select * from tb_user where tel = '$tel'");
		$numrow = mysqli_num_rows($result);
		if($numrow > 0){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	if($type == 'save_data'){
		//รับค่า
		$user_loc = $_POST['user_loc'];
		$user_com = $_POST['user_com'];
		$user_site = $_POST['user_site'];
		$user_dept_id = $_POST['user_dept_id'];
		$user_dept_name = $_POST['user_dept_name'];
		$user_grop = $_POST['user_grop'];
		$user_id = $_POST['user_id'];
		$user_type = $_POST['user_type'];
		$user_name = $_POST['user_name'];
		$user_lname = $_POST['user_lname'];
		$user_tel = $_POST['user_tel'];
		$user_location = $_POST['user_location'];
		$user_lati = $_POST['user_lati'];
		$user_lon = $_POST['user_lon'];
		$lati = $_POST['lati'];
		$lon = $_POST['lon'];
		$detail = $_POST['detail'];
		$subdistrict = $_POST['subdistrict'];
		$district = $_POST['district'];
		$province = $_POST['province'];
		$code = $_POST['code'];
		$distance = $_POST['distance'];
		$com_dis = $_POST['com_dis'];
		$comment = $_POST['comment'];
		$update = $_POST['update'];
		$sel_time = $_POST['seltime'];
		$namelocation = $detail.' '.$subdistrict.' '.$district.' '.$province;
		if($update == 'true'){
			mysqli_query($conn,"update tb_user set lati1 = '$lati' , lon1 = '$lon' , namegps1 = '$namelocation' where id = '$user_id'");
		}
		$round = 1;
		//ตั้งเงื่อนไขเวลา
		if($sel_time == '1'){
			if($timenow < $time_morning_st){
				//ยังไม่ถึงรอบเช้า
				//201 แทนการแจ้งไม่ถึงเวลา
				echo json_encode(array("statusCode"=>201));
			}
			else if($timenow >= $time_morning_st && $timenow < $time_morning_en){
					//ช่วงเช้า;
				$numrow = mysqli_num_rows(mysqli_query($conn,"select * from tb_rep_mon where id = '$user_id' and date = '$date'"));
				if($numrow > 0){
					//204 Duplicate
					$round = $numrow+1;
				}
				
				$sql = "INSERT INTO `tb_rep_mon`(`location`, `company`, `site`, `dept_code`, `dept_name`, `grop`, `id`, `type`, `name`, `lname`, `tel`, `location_user`, `lati_user`, `lon_user`, `date`, `round`, `lati`, `lon`, `detail`, `subdistrict`, `district`, `province`, `code`, `time`, `distance`, `dis_com`, `comment`) 
				VALUES ('$user_loc','$user_com','$user_site','$user_dept_id','$user_dept_name','$user_grop','$user_id','$user_type','$user_name','$user_lname','$user_tel','$user_location','$user_lati','$user_lon','$date','$round','$lati','$lon','$detail','$subdistrict','$district','$province','$code','$timenow','$distance','$com_dis','$comment')";
				
				if($result = mysqli_query($conn,$sql)){
						echo json_encode(array("statusCode"=>200,"round"=>0));
					}else{
						//203 Error Insert
						echo json_encode(array("statusCode"=>203));
					}

			}
			else if($timenow >= $time_afternoon_st && $timenow < $time_afternoon_en){
				//ช่วงบ่าย
				$numrow = mysqli_num_rows(mysqli_query($conn,"select * from tb_rep_after where id = '$user_id' and date = '$date'"));
				if($numrow > 0){
					//204 Duplicate
					$round = $numrow+1;
				}
				$sql = "INSERT INTO `tb_rep_after`(`location`, `company`, `site`, `dept_code`, `dept_name`, `grop`, `id`, `type`, `name`, `lname`, `tel`, `location_user`, `lati_user`, `lon_user`, `date`, `round`, `lati`, `lon`, `detail`, `subdistrict`, `district`, `province`, `code`, `time`, `distance`, `dis_com`, `comment`) 
				VALUES ('$user_loc','$user_com','$user_site','$user_dept_id','$user_dept_name','$user_grop','$user_id','$user_type','$user_name','$user_lname','$user_tel','$user_location','$user_lati','$user_lon','$date','$round','$lati','$lon','$detail','$subdistrict','$district','$province','$code','$timenow','$distance','$com_dis','$comment')";
				$numrow = mysqli_num_rows(mysqli_query($conn,"select * from tb_rep_after where id = '$user_id' and date = '$date'"));
				
					if($result = mysqli_query($conn,$sql)){
						echo json_encode(array("statusCode"=>200,"round"=>1));
					}else{
						//203 Error Insert
						echo json_encode(array("statusCode"=>203));
					}
				

			}
			else if($timenow >= $time_evening_st && $timenow <= $time_evening_en){
				$numrow = mysqli_num_rows(mysqli_query($conn,"select * from tb_rep_eve where id = '$user_id' and date = '$date'"));
				if($numrow > 0){
					//204 Duplicate
					$round = $numrow+1;
				}
				//ช่วงเย็น
				$sql = "INSERT INTO `tb_rep_eve`(`location`, `company`, `site`, `dept_code`, `dept_name`, `grop`, `id`, `type`, `name`, `lname`, `tel`, `location_user`, `lati_user`, `lon_user`, `date`, `round`, `lati`, `lon`, `detail`, `subdistrict`, `district`, `province`, `code`, `time`, `distance`, `dis_com`, `comment`) 
				VALUES ('$user_loc','$user_com','$user_site','$user_dept_id','$user_dept_name','$user_grop','$user_id','$user_type','$user_name','$user_lname','$user_tel','$user_location','$user_lati','$user_lon','$date','$round','$lati','$lon','$detail','$subdistrict','$district','$province','$code','$timenow','$distance','$com_dis','$comment')";
				
					if($result = mysqli_query($conn,$sql)){
						echo json_encode(array("statusCode"=>200,"round"=>2));
					}else{
						//203 Error Insert
						echo json_encode(array("statusCode"=>203));
					}
				
			}
			else if($timenow > $time_evening_en){
				//เลยรอบเย็น
				//202 แทนการแจ้งเลยเวลา
				echo json_encode(array("statusCode"=>202));
			}else{
				//ไม่เข้ารอบ
				//201 แทนการแจ้งไม่ถึงเวลา
				echo json_encode(array("statusCode"=>201));
			}
			
			
		}else if($sel_time == '2'){
			if($timenow < $time_mon2_st){
				echo json_encode(array("statusCode"=>201));
			}else if($timenow >= $time_mon2_st && $timenow < $time_mon2_en){
				$numrow = mysqli_num_rows(mysqli_query($conn,"select * from tb_rep2_mon where id = '$user_id' and date = '$date'"));
				if($numrow > 0){
					//204 Duplicate
					$round = $numrow+1;
				}
				$sql = "INSERT INTO `tb_rep2_mon`(`location`, `company`, `site`, `dept_code`, `dept_name`, `grop`, `id`, `type`, `name`, `lname`, `tel`, `location_user`, `lati_user`, `lon_user`, `date`, `round`, `lati`, `lon`, `detail`, `subdistrict`, `district`, `province`, `code`, `time`, `distance`, `dis_com`, `comment`) 
				VALUES ('$user_loc','$user_com','$user_site','$user_dept_id','$user_dept_name','$user_grop','$user_id','$user_type','$user_name','$user_lname','$user_tel','$user_location','$user_lati','$user_lon','$date','$round','$lati','$lon','$detail','$subdistrict','$district','$province','$code','$timenow','$distance','$com_dis','$comment')";
				
					if($result = mysqli_query($conn,$sql)){
						echo json_encode(array("statusCode"=>200,"round"=>2));
					}else{
						//203 Error Insert
						echo json_encode(array("statusCode"=>203));
					}
				
				
			}else if($timenow >= $time_after2_st && $timenow < $time_after2_en){
				$numrow = mysqli_num_rows(mysqli_query($conn,"select * from tb_rep2_after where id = '$user_id' and date = '$date'"));
				if($numrow > 0){
					//204 Duplicate
					$round = $numrow+1;
				}
				$sql = "INSERT INTO `tb_rep2_after`(`location`, `company`, `site`, `dept_code`, `dept_name`, `grop`, `id`, `type`, `name`, `lname`, `tel`, `location_user`, `lati_user`, `lon_user`, `date`, `round`, `lati`, `lon`, `detail`, `subdistrict`, `district`, `province`, `code`, `time`, `distance`, `dis_com`, `comment`) 
				VALUES ('$user_loc','$user_com','$user_site','$user_dept_id','$user_dept_name','$user_grop','$user_id','$user_type','$user_name','$user_lname','$user_tel','$user_location','$user_lati','$user_lon','$date','$round','$lati','$lon','$detail','$subdistrict','$district','$province','$code','$timenow','$distance','$com_dis','$comment')";
				
					if($result = mysqli_query($conn,$sql)){
						echo json_encode(array("statusCode"=>200,"round"=>2));
					}else{
						//203 Error Insert
						echo json_encode(array("statusCode"=>203));
					}
				
			}else if($timenow > $time_after2_en){
				echo json_encode(array("statusCode"=>202));
			}else{
				echo json_encode(array("statusCode"=>201));
			}
		}
		
	}
}
		
?>