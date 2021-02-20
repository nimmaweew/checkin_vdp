<?php
	include('connect.php');
date_default_timezone_set("Asia/Bangkok");
								$timey = date('Y');
								$timem = date('m');
								$timed = date('d');
								$slad = "-";
								$time = $timey.$slad.$timem.$slad.$timed;
$strExcelFileName="Member-All.xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<strong>รายงานตำแหน่งพนักงาน</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
								<tr class="bg-info">
								<th align="center" class="text-black">แผนก</th>
								<th align="center" class="text-black">หน่วยงาน</th>
								<th align="center" class="text-black">กลุ่ม</th>
								<th align="center" class="text-black">รหัสพนักงาน</th>
								<th align="center" class="text-black">คำนำหน้าชื่อ</th>
								<th align="center" class="text-black">ชื่อ</th>
								<th align="center" class="text-black">นามสกุล</th>
								<th align="center" class="text-black">เบอร์มือถือ</th>
								<th align="center" class="text-black">ที่ตั้ง</th>
								<th align="center" class="text-black">วันที่</th>
								<th align="center" class="text-black">ครั้งที่</th>
								<th align="center" class="text-black">เวลา</th>
								<th align="center" class="text-black">ตำแหน่งที่อยู่ รอบเช้า</th>
								<th align="center" class="text-black">ตำบล</th>
								<th align="center" class="text-black">อำเภอ</th>
								<th align="center" class="text-balck">จังหวัด</th>
								<th align="center" class="text-balck">Google Map</th>
								<th align="center" class="text-black">ห่างจากที่ตั้ง (กม.)</th>
								<th align="center" class="text-black">หมายเหตุ</th>
								<th align="center" class="text-black">เวลา</th>
								<th align="center" class="text-black">ตำแหน่งที่อยู่ รอบบ่าย</th>
								<th align="center" class="text-black">ตำบล</th>
								<th align="center" class="text-black">อำเภอ</th>
								<th align="center" class="text-balck">จังหวัด</th>
								<th align="center" class="text-balck">Google Map</th>
								<th align="center" class="text-black">ห่างจากที่ตั้ง (กม.)</th>
								<th align="center" class="text-black">หมายเหตุ</th>
								<th align="center" class="text-black">เวลา</th>
								<th align="center" class="text-black">ตำแหน่งที่อยู่ รอบเย็น</th>
								<th align="center" class="text-black">ตำบล</th>
								<th align="center" class="text-black">อำเภอ</th>
								<th align="center" class="text-balck">จังหวัด</th>
								<th align="center" class="text-balck">Google Map</th>
								<th align="center" class="text-black">ห่างจากที่ตั้ง (กม.)</th>
								<th align="center" class="text-black">หมายเหตุ</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if(isset($_POST['date'])){
										$date = $_POST['date'];
										if($date == ''){
											$date = $time;
										}
										$result = mysqli_query($conn,"select * from tb_rep_all where date = '$date'");
										while($row = mysqli_fetch_assoc($result)){
											
								?>
								<tr>
									<td><?php echo $row['site_name'] ?></td>
									<td><?php echo $row['dept_name'] ?></td>
									<td><?php echo $row['grop_name'] ?></td>
									<td><?php echo $row['user_id'] ?></td>
									<td><?php echo $row['user_type'] ?></td>
									<td><?php echo $row['user_name'] ?></td>
									<td><?php echo $row['user_lname'] ?></td>
									<td><?php echo $row['user_tel'] ?></td>
									<td><a target="_blank" href="https://www.google.co.th/maps/place/<?php echo $row['user_lat'] ?> <?php echo $row['user_lon'] ?>"><?php echo $row['user_location'] ?></a></td>
									<td><?php echo $row['date']  ?></td>
									<td><?php echo $row['round'] ?></td>
									<td><?php echo $row['time_mon'] ?></td>
									<td><?php echo $row['location_mon'] ?></td>
									<td><?php echo $row['subdistrict_mon'] ?></td>
									<td><?php echo $row['district_mon'] ?></td>
									<td><?php echo $row['province_mon'] ?></td>
									<td><a target="_blank" href="https://www.google.co.th/maps/place/<?php echo $row['lat_mon'] ?> <?php echo $row['lon_mon'] ?>">Google Map</a></td>
									<td><?php echo $row['distance_mon'] ?></td>
									<td><?php echo $row['comment_mon'] ?></td>
									<td><?php echo $row['time_after'] ?></td>
									<td><?php echo $row['location_after'] ?></td>
									<td><?php echo $row['subdistrict_after'] ?></td>
									<td><?php echo $row['district_after'] ?></td>
									<td><?php echo $row['province_after'] ?></td>
									<td><a target="_blank" href="https://www.google.co.th/maps/place/<?php echo $row['lat_after'] ?> <?php echo $row['lon_after'] ?>">Google Map</a></td>
									<td><?php echo $row['distance_after'] ?></td>
									<td><?php echo $row['comment_after'] ?></td>
									<td><?php echo $row['time_eve'] ?></td>
									<td><?php echo $row['location_eve'] ?></td>
									<td><?php echo $row['subdistrict_eve'] ?></td>
									<td><?php echo $row['district_eve'] ?></td>
									<td><?php echo $row['province_eve'] ?></td>
									<td><a target="_blank" href="https://www.google.co.th/maps/place/<?php echo $row['lat_eve'] ?> <?php echo $row['lon_eve'] ?>">Google Map</a></td>
									<td><?php echo $row['distance_eve'] ?></td>
									<td><?php echo $row['comment_eve'] ?></td>
									
								</tr>
								<?php
										}
									}
								?>
								
							</tbody>
								
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>