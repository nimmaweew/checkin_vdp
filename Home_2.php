<!doctype html>
<?php 
include ('connect.php');
if(isset($_POST['tel'])){
	$tel = $_POST['tel'];
}else{
	header('Location:Home_1.php');
}
$sel_time = $_POST['time'];
$result_user = mysqli_query($conn,"select * from tb_user where tel = '$tel'");
$row_user = mysqli_fetch_assoc($result_user);
$user_lati = $row_user['lati1'];
$user_lon = $row_user['lon1'];
$id = $row_user['id'];
$type = $row_user['type'];
$name = $row_user['name'];
$lname = $row_user['lname'];
$grop_id = $row_user['grop'];
$loc_id = $row_user['loc'];
$com_id = $row_user['com'];
$site_id = $row_user['site'];
$dept_id = $row_user['dept'];
$namelocation = $row_user['namegps1'];

$row_grop = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_grop where id = '$grop_id'"));
$grop_name = $row_grop['name'];

$row_loc = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_location where id = '$loc_id'"));
$loc_name = $row_loc['name'];

$row_com = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_com where id = '$com_id'"));
$com_name = $row_com['name'];

$row_site = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_site where id = '$site_id'"));
$site_name = $row_site['name'];

$row_dept = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_dept where id = '$dept_id' and site_id = '$site_id'"));
$dept_name = $row_dept['name'];

$result = mysqli_query($conn,"select * from tb_label where name = 'result_company'");
$row = mysqli_fetch_assoc($result);

$row_dis_com = mysqli_fetch_array(mysqli_query($conn,"select * from tb_company where id = '1'"));
$com_lat = $row_dis_com['lat'];
$com_lon = $row_dis_com['lon'];
$label = $row['text'];

$result_api = mysqli_query($conn,"select * from tb_api where id = '1'");
$row_api = mysqli_fetch_assoc($result_api);
$api = $row_api['key_code'];
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://api.longdo.com/map/?key=<?php echo $api ?>"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
	$.ajax({
		url : 'count.php',
		method : 'post',
		success:function(dataReult){
			console.log(dataReult);
		}
	})
</script>
<style>
	.body {
	height: 640px;
	
	}	
	body {font-family: Arial, Helvetica, sans-serif;}

	.body {
		width: 100%;
	}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

	.chk{
		width: 33px;
		height: 33px;
	}
</style>


<title>Home</title>
</head>

<body style="body" id="bod1">
<form name="home" id="home" action="sent.php" method="post">
	<div class="container-fluid">
		<div id="myModal" class="modal">
				<div class="modal-content">
					<span class="close"></span>
					<div class="row-cols-12" align="center">
						<h3 class="text-danger">กรุณาอ่านข้อตกลง</h3>
						<br>
						<h4>ทุกครั้งที่ทำการเช็คชื่อให้กด "อนุญาต" ทุกครั้งที่มีการขอใช้ตำแหน่งที่ตั้งปัจจุบันของคุณ ไม่เช่นนั้นคุณจะไม่สามารถเช็คชื่อได้</h4>
						<br>
						<input type="button" class="btn-lg btn-success" value="ยอมรับ" id="close">
					</div>
				</div>
			</div>
		
		
		<div class="row">
			<div class="col-12" align="right">
				<div id="google_translate_element"></div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12" align="center">
				<br>
				<label class="text-primary"><?php echo $label ?></label>
				<br>
				<label class="bg-warning">กรุณาตรวจสอบเบอร์มือถือก่อนทำการส่งตำแหน่ง</label>
				<br>
				<div class="row">
			<div class="col-10" align="center">
				<input type="text" name="tel" id="tel" width="20" class="form-control" placeholder="เบอร์โทร" readonly required="required" maxlength="11" value="<?php echo $tel ?>" >
			</div>
			<div class="cols-1" align="center">
				<input class="btn-outline-primary btn-sm form-control" type="button" value="เช็คอิน" onClick="checklength()" id="btn_go">
				<input type="hidden" name="lati" id="lati">
				<input type="hidden" name="lon" id="lon">
				<input type="hidden" name="com_lat" id="com_lat" value="<?php echo $com_lat ?>">
				<input type="hidden" name="com_lon" id="com_lon" value="<?php echo $com_lon ?>">
				<input type="hidden" name="com_dis" id="com_dis">
				<input type="hidden" id="result">
				<input type="hidden" id="detail">
				<input type="hidden" id="subdistrict">
				<input type="hidden" id="district">
				<input type="hidden" id="province">
				<input type="hidden" id="country">
				<input type="hidden" id="code">
				<input type="hidden" id="user_loc" value="<?php echo $loc_name ?>">
				<input type="hidden" id="user_com" value="<?php echo $com_name  ?>">
				<input type="hidden" id="user_site" value="<?php echo $site_name ?>">
				<input type="hidden" id="user_dept_id" value="<?php echo $dept_id ?>">
				<input type="hidden" id="user_dept_name" value="<?php echo $dept_name ?>">
				<input type="hidden" id="user_grop" value="<?php echo $grop_name ?>">
				<input type="hidden" id="user_id" value="<?php echo $id ?>">
				<input type="hidden" id="user_type" value="<?php echo $type ?>">
				<input type="hidden" id="user_name" value="<?php echo $name ?>">
				<input type="hidden" id="user_lname" value="<?php echo $lname ?>">
				<input type="hidden" id="user_location_name" value="<?php echo $namelocation ?>">
				<input type="hidden" id="lati2" value="<?php echo $user_lati ?>">
				<input type="hidden" id="lon2" value="<?php echo $user_lon ?>">
				<input type="hidden" id="api" value="<?php echo $api ?>">
				<input type="hidden" id="sel_time" value="<?php echo $sel_time ?>">
				
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12" align="center">
				<input type="text" name="comment" id="comment" class="form-control" placeholder="หมายเหตุ">
				<br>
				<input type="text" hidden="" name="nameloc2" id="nameloc2" class="form-control" readonly placeholder="ที่ตั้ง">
				<br>
			</div>
		</div>
				
		<div class="row" hidden="">
			<div class="col-6">
				<input type="checkbox" name="chk_time1" id="chk_time1" class="chk" checked><br>
				<label for="chk_time1" class="text-black-50">จุดที่ 1</label>
			</div>
			<div class="col-6">
				<input type="checkbox" name="chk_time2" id="chk_time2" class="chk"><br>
				<label for="chk_time2" class="text-black-50">จุดที่ 2</label>
			</div>	
			<input type="hidden" id="Hsel_time" name="Hsel_time" value="1">
		</div>
			<script>
					$(document).ready(function(){
						$('#btn_go').disabled = true;
						$('#chk_time1').on('click',function(){
							if($('chk_time1').checked = true){
								document.getElementById('chk_time2').checked = false ;
								$('#Hsel_time').val('1');
							}
							if(document.getElementById('chk_time1').checked == false){
								document.getElementById('chk_time2').checked = true ;
								$('#Hsel_time').val('2');
							}
							
						})

						$('#chk_time2').on('click',function(){
							if($('#chk_time2').checked = true){
								document.getElementById('chk_time1').checked = false;
								$('#Hsel_time').val('2');
							}
							if(document.getElementById('chk_time2').checked == false){
								document.getElementById('chk_time1').checked = true;
								$('#Hsel_time').val('1');
							}
							
						})
					
					})
					
				</script>
		<div class="row-cols-12">
				<div id="map" style="width:100%;height:400px;"></div>
		</div>
				
				<br>
			</div>
		</div>
		
	</div>
	<br>
</form>
<form id="res1" action="results.php" method="post" hidden="">
	<input type="text" id="res1_id" name="id">	
	<input type="text" id="res1_round" name="round">
</form>
<form id="res2" action="results2.php" method="post" hidden="">
	<input type="text" id="res2_id" name="id">	
</form>
<form id="res3" action="results3.php" method="post" hidden="">
	<input type="text" id="res3_id" name="id">	
</form>
<form id="res4" action="results4.php" method="post" hidden="">
	<input type="text" id="res4_id" name="id">	
</form>
<script>
	var no = 0;
	function checklength()
	{

		var lenlati = document.getElementById('lati').value;
		var nlati = lenlati.length;
		var lenlon = document.getElementById('lon').value;
		var nlon = lenlon.length;
		var nameloc = document.getElementById('nameloc2').value;
		var lennameloc = nameloc.length;

		
		if (nlati < 5 && nlon <5)
		{
			alert('ไม่สามารถระบุตำแหน่งได้กรุณาลองอีกครั้ง');
			modal.style.display = "block";
			return;
		}
		/*else if (lennameloc < 5)
		{
			alert('ไม่สามารถระบุชื่อที่อยู่ได้กรุณาลองอีกครั้ง')
			var getloc = $('#nameloc').val();
			var getloc = getloc.split("undefined");
			$('#nameloc2').val(getloc);
			return;
		}*/
		else
		{	
			savedata();
		}
	};

	//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
	
	var modal = document.getElementById("myModal");
	var close = document.getElementById('close');
	var frm = document.getElementById('bod1');
	frm.onload = function(){
		modal.style.display = "block";
	}
	close.onclick = function(){
		modal.style.display = "none";
		if (navigator.geolocation) {
    		navigator.geolocation.getCurrentPosition(showPosition, showError);
  		} else { 
    		alert('บราวเซอร์ของคุณไม่รองรับฟังชั่นการแชร์ตำแหน่ง');
  		}
	}
	
	
	
	function showPosition(position) {
  		document.getElementById('lati').setAttribute("value",position.coords.latitude);
		document.getElementById('lon').setAttribute("value",position.coords.longitude);
		
		var lat = $('#lat').val();
		var lng = $('#lon').val();
		setTimeout(function(){
			getDis();
		},1000)
		
		var map;
		map = new longdo.Map({
    	placeholder: document.getElementById('map')
		});
			map.Ui.DPad.visible(false);
            map.Ui.Zoombar.visible(false);
            map.Ui.Geolocation.visible(false);
            map.Ui.Toolbar.visible(false);
            map.Ui.LayerSelector.visible(false);
            map.Ui.Fullscreen.visible(false);
            map.Ui.Crosshair.visible(false);
            map.Ui.Scale.visible(false);
			map.Ui.Keyboard.enable(false);
            map.Ui.Keyboard.enableInertia(false);
            map.Ui.Mouse.enableClick(false);
			map.Ui.Mouse.enableWheel(false);
			map.location(longdo.LocationMode.Geolocation,true)
			map.zoom(16,true)

	}
	function showError(error) {
  		switch(error.code) {
    case error.PERMISSION_DENIED:
      alert('ผู้ใช้ปฏิเสธคำขออนุญาต');
      break;
    case error.POSITION_UNAVAILABLE:
      alert('ไม่มีข้อมูลตำแหน่ง')
      break;
    case error.TIMEOUT:
      alert('คำขอตำแหน่งผู้ใช้หมดเวลา')
      break;
    case error.UNKNOWN_ERROR:
      alert('เกิดข้อผิดพลาดในการขอตำแหน่ง โปรดติดต่อแอดมิน')
      break;
  }
	}
 function getDis() {
	
	 
	var geo1 = $("#lati").val();

	var geo2 = $("#lon").val();

	var geo3 = $("#lati2").val();

	var geo4 = $("#lon2").val();
	if(geo3 == ''){
		if(geo4 == ''){
			var geo3 = $("#lati").val();
			var geo4 = $("#lon").val();
		}
	}

    var distance = distanceBetween(geo1, geo2, geo3, geo4, "K");
	 var distance = distance.toFixed(2);
	 if(distance == ''){
		 distance = '0';
	 }
    $("#result").val(distance).html;
	 
	getDis2()
	rerverseGeocoding();
	  
  }
	function getDis2() {
	
	  
	var geo1 = $("#lati").val();

	var geo2 = $("#lon").val();

	var geo3 = $("#com_lat").val();

	var geo4 = $("#com_lon").val();
	if(geo3 == ''){
		if(geo4 == ''){
			var geo3 = $("#lati").val();
			var geo4 = $("#lon").val();
		}
	}

    var distance = distanceBetween2(geo1, geo2, geo3, geo4, "K");
		var distance = distance.toFixed(2);
		if(distance == ''){
		 distance = '0';
	 }
    $("#com_dis").val(distance).html;
	  
	
	  
  }
	  
  function distanceBetween(lat1, lon1, lat2, lon2, unit) {

    var rlat1 = Math.PI * lat1 / 180

    var rlat2 = Math.PI * lat2 / 180

    var rlon1 = Math.PI * lon1 / 180

    var rlon2 = Math.PI * lon2 / 180

    var theta = lon1 - lon2

    var rtheta = Math.PI * theta / 180

    var dist = Math.sin(rlat1) * Math.sin(rlat2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.cos(rtheta);

    dist = Math.acos(dist)

    dist = dist * 180 / Math.PI

    dist = dist * 60 * 1.1515

    if (unit == "K") {

      dist = dist * 1.609344

    }

    if (unit == "N") {

      dist = dist * 0.8684

    }

    return dist

  }
	function distanceBetween2(lat1, lon1, lat2, lon2, unit) {

    var rlat1 = Math.PI * lat1 / 180

    var rlat2 = Math.PI * lat2 / 180

    var rlon1 = Math.PI * lon1 / 180

    var rlon2 = Math.PI * lon2 / 180

    var theta = lon1 - lon2

    var rtheta = Math.PI * theta / 180

    var dist = Math.sin(rlat1) * Math.sin(rlat2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.cos(rtheta);

    dist = Math.acos(dist)

    dist = dist * 180 / Math.PI

    dist = dist * 60 * 1.1515

    if (unit == "K") {

      dist = dist * 1.609344

    }

    if (unit == "N") {

      dist = dist * 0.8684

    }

    return dist

  }
		

 function rerverseGeocoding() {
	var key = $('#api').val();
	var Lat = $('#lati').val();
	var Lng = $('#lon').val() ;
	$.ajax({
		url : 'https://api.longdo.com/map/services/address',
		method : 'get',
					data : {lon:Lng,
						   lat:Lat,
						   key:key,
						   },
					success:function(dataResult){
						var aoi = dataResult.aoi;
						var road = dataResult.road;
						var subdistrict = dataResult.subdistrict;
						var district = dataResult.district;
						var province = dataResult.province;
						var country = dataResult.country;
						var postcode = dataResult.postcode;
						if(aoi == undefined){
							aoi = '';
						}
						if(road == undefined){
							road = '';
						}
						if(subdistrict == undefined){
							subdistrict = '';
						}
						if(district == undefined){
							district = '';
						}
						if(province == undefined){
							province = '';
						}
						if(country == undefined){
							country = '';
						}
						if(postcode == undefined){
							postcode = '';
						}
						var detail = aoi+' '+road;
						var subdistrict = subdistrict;
						var district = district;
						var province = province 
						var country = country;
						var code = postcode;
						
						$('#detail').val(detail);
						$('#subdistrict').val(subdistrict);
						$('#district').val(district);
						$('#province').val(province);
						$('#country').val(country);
						$('#code').val(postcode);
					}
				});
 }
	
	function savedata(){
		var type = 'save_data';
		var user_loc = $('#user_loc').val();
		var user_com = $('#user_com').val();
		var user_site = $('#user_site').val();
		var user_dept_id = $('#user_dept_id').val();
		var user_dept_name = $('#user_dept_name').val();
		var user_grop = $('#user_grop').val();
		var user_id = $('#user_id').val();
		var user_type = $('#user_type').val();
		var user_name = $('#user_name').val();
		var user_lname = $('#user_lname').val();
		var user_tel = $('#tel').val();
		var user_location = $('#user_location_name').val();
		var user_lati = $('#lati2').val();
		var user_lon = $('#lon2').val();
		var lati = $('#lati').val();
		var lon = $('#lon').val();
		var detail = $('#detail').val();
		var subdistrict = $('#subdistrict').val();
		var district = $('#district').val();
		var province = $('#province').val();
		var code = $('#code').val();
		var distance = $('#result').val();
		var com_dis = $('#com_dis').val();
		var comment = $('#comment').val();
		var sel_time = $('#sel_time').val();
		if(user_lati == ''){
			if(user_lon == ''){
			var update = 'true';
			}
		}
		else{
				var update = 'false';
			}
		
		$.ajax({
			url : 'ajax.php',
			method : 'post',
			data : {type:type,
				   user_loc:user_loc,
				   user_com:user_com,
				   user_site:user_site,
				   user_dept_id:user_dept_id,
				   user_dept_name:user_dept_name,
				   user_grop:user_grop,
				   user_id:user_id,
				   user_type:user_type,
				   user_name:user_name,
				   user_lname:user_lname,
				   user_tel:user_tel,
				   user_location:user_location,
				   user_lati:user_lati,
				   user_lon:user_lon,
				   lati:lati,
				   lon:lon,
				   detail:detail,
				   subdistrict:subdistrict,
				   district:district,
				   province:province,
				   code:code,
				   distance:distance,
				   com_dis:com_dis,
				   update:update,
				   comment:comment,
				   seltime:sel_time},
			success:function(result){
				var data = JSON.parse(result);
				var status = data.statusCode;
				if(status == 200){
					var round = data.round;
					$('#res1_id').val(user_id);
					$('#res1_round').val(round);
					$('#res1').submit();
				}
				else if(status == 201){
					//ยังไม่ถึงเวลา
					$('#res3_id').val(user_id);
					$('#res3').submit();
				}else if(status == 202){
					//เลยเวลา
					$('#res4_id').val(user_id);
					$('#res4').submit();
				}else if(status == 203){
					alert('ระบบผิดพลาดกรูณาแจ้งผู้ดูแลระบบ');
				}else if(status == 204){
					$('#res2_id').val(user_id);
					$('#res2').submit();
				}
			}
		})
	}
 
</script>


</body>
</html>
