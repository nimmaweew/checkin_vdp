<?php 
include('connect.php');

if(isset($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'updatelocationname1'){
		$id = $_POST['id'];
		$sql = "select * from tb_user where id = '$id'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$namelocation = $row['namegps1'];
		
		$myobj->namelocation = $namelocation;
		
		$myJson = json_encode($myobj,JSON_UNESCAPED_UNICODE);
		echo $myJson;
	}
	
	if($type == 'updatelocationname2'){
		$id = $_POST['id'];
		$namelocation = $_POST['namelocation'];
		$sql = "update tb_user set namegps1 = '$namelocation' where id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			$result = '200';
		}
		else{
			$result = '100';
		}
		
		$myobj->result = $result;
		
		$myJson = json_encode($myobj,JSON_UNESCAPED_UNICODE);
		echo $myJson;
	}
	
	if($type == 'updatelocationname3'){
		$id = $_POST['id'];
		$sql = "select * from tb_user where id = '$id'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$namelocation = $row['namegps2'];
		
		$myobj->namelocation = $namelocation;
		
		$myJson = json_encode($myobj,JSON_UNESCAPED_UNICODE);
		echo $myJson;
	}
	
	if($type == 'updatelocationname4'){
		$id = $_POST['id'];
		$namelocation = $_POST['namelocation'];
		$sql = "update tb_user set namegps2 = '$namelocation' where id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			$result = '200';
		}
		else{
			$result = '100';
		}
		
		$myobj->result = $result;
		
		$myJson = json_encode($myobj,JSON_UNESCAPED_UNICODE);
		echo $myJson;
	}
	
	if($type == 'updategeo'){
		$name = $_POST['name'];
		$lat = $_POST['Lat'];
		$lng = $_POST['Lng'];
		$id = $_POST['id'];
		$sql = "update tb_user set namegps2 = '$name' , lati2 = '$lat' , lon2 = '$lng' where id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			$result = '200';
		}
		else{
			$result = '100';
		}
		
		$myobj->result = $result;
		
		$myJson = json_encode($myobj,JSON_UNESCAPED_UNICODE);
		echo $myJson;
	}
	
	if($type == 'getnameandlatlng'){
		$id = $_POST['id'];
		$sql = "select * from tb_user where id = '$id'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$name = $row['namegps2'];
		$lat = $row['lati2'];
		$lon = $row['lon2'];
		
		$myobj->name = $name;
		$myobj->lat = $lat;
		$myobj->lng = $lon;
		
		$myJson = json_encode($myobj,JSON_UNESCAPED_UNICODE);
		echo $myJson;
	}
	
}

?>