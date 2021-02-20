<!doctype html>
<?php 
include('loginchecking.php')
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ZXing for JS">

  <title>Scan Line</title>

  <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null"
    href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
  <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null"
    href="https://unpkg.com/normalize.css@8.0.0/normalize.css">
  <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null"
    href="https://unpkg.com/milligram@1.3.0/dist/milligram.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" >
//disable back button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
  history.pushState(null, null, '');
});
</script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">

  							<a class="navbar-brand" href="#">Admin</a>

  							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

    							<span class="navbar-toggler-icon"></span>

  							</button>

  							<div class="collapse navbar-collapse" id="navbarNavAltMarkup">

    							<div class="navbar-nav">

      								<a class="nav-item nav-link active" href="admin.php">นำข้อมูลออกเป็นไฟล์ Excel</a>
									

									<a class="nav-item nav-link active" href="admincheck.php">ตรวจสอบการเช็คชื่อ</a>
									 <li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  ข้อมูลพนักงาน
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										  <a class="dropdown-item" href="registeruser.php">แก้ไขข้อมูลพนักงาน</a>
										  <a class="dropdown-item" href="qrmobile.php">อัพเดทไลน์จากมือถือ</a>
										</div>
									  </li>

    							</div>

  							</div>
							<div class="navbar-nav topnav-right">
								<a class="nav-item nav-link active" href="logout.php">ลงชื่อออก</a>
							  </div>

  							</div>

						</nav>
  <main class="wrapper" style="padding-top:2em">
	  <section class="container" id="demo-content">
		<div id="sourceSelectPanel" style="display:none">
        <label for="sourceSelect">Change video source:</label>
        <select id="sourceSelect" style="max-width:400px">
        </select>
      </div>
    	<br>
      <div>
        <a class="button" id="startButton">Start</a>
        <a class="button" id="resetButton">Reset</a>
      </div>

      <div>
        <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
      </div>

      
		
		<input type="checkbox" id="editid" name="editid">
		<label for="editid">กรอกรหัสเอง</label>
		  <br>
	  <input type="checkbox" id="chkid" name="chkid" checked>
		<label for="chkid">รหัสพนักงาน</label>
	  <input type="text" id="id" name="id" readonly>
		  <br><br>
	  <input type="checkbox" id="chkline" name="chkline">
		  
	  <label for="chkline">line Id</label>
	  <input type="text" id="line" name="line" readonly>
		  <br><br>
      <pre><code id="result"></code></pre>
	  
		
	  <div align="center">
		<input type="button" id="btnsave" value="บันทึก" >	
	</div>
    </section>

		<audio hidden="" controls id="audio">
  		<source src="sound/beep.mp3" type="audio/mpeg">
	</audio>
  </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$('#editid').on('click',function(){
		if(document.getElementById('editid').checked){
			document.getElementById('id').readOnly = false;
		}
		else{
			document.getElementById('id').readOnly = true;
		}
	})
	$('#chkline').on('click',function(){
		if(document.getElementById('chkline').checked){
			document.getElementById('chkid').checked = false;
		}
	});
	$('#chkid').on('click',function(){
		if(document.getElementById('chkid').checked){
			document.getElementById('chkline').checked = false;
		}
	});
	$('#btnsave').on('click',function(){
		var id = document.getElementById('id').value;
		var line = document.getElementById('line').value;
		
		if(id == 0){
			alert('ใส่ข้อมูลให้ครบ!!')
		}
		else if(line == 0){
			alert('ใส่ข้อมูลให้ครบ!!')
		}
		else{
			$.ajax({
				url:"updateline.php",
				type:"POST",
				cache:false,
				data:{
					id:id,
					line:line,
				},
				success:function(dataResult){
					var dataResult = JSON.parse(dataResult);
					console.log(dataResult);
					if(dataResult.statusCode==200){
						$.ajax({
							url:"updateline2.php",
							type:"POST",
							cache:false,
							data:{
								id:id,
								line:line,
							},
							success:function(dataResult){
								var dataResult = JSON.parse(dataResult);
								console.log(dataResult);
								if(dataResult.statusCode==200){
									alert('อัพเดทข้อมูลสำเร็จ');
								}
								else{
									alert('อัพเดทข้อมูลไม่สำเร็จ');
								}
							}
						});
					}
					else if(dataResult.statusCode==201){
						
						confirmupdate();
					}
					else if(dataResult.statusCode==199){
					
						alert('ไม่พบข้อมูลรหัสพนักงาน');
					}
				}
			});
		}
	});
	function confirmupdate(){
		var r = confirm('มีข้อมูลอยู่แล้วต้องการอัพเดท?');
	if(r == true){
		var id = document.getElementById('id').value;
		var line = document.getElementById('line').value;
		$.ajax({
							url:"updateline2.php",
							type:"POST",
							cache:false,
							data:{
								id:id,
								line:line,
							},
							success:function(dataResult){
								var dataResult = JSON.parse(dataResult);
								if(dataResult.statusCode==200){
									alert('อัพเดทข้อมูลสำเร็จ');
								}
								else{
									alert('อัพเดทข้อมูลไม่สำเร็จ');
								}
							}
						});
	}else{
		
	}
	}
</script>
  <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
  <script type="text/javascript">
    window.addEventListener('load', function () {
      let selectedDeviceId;
      const codeReader = new ZXing.BrowserMultiFormatReader()
      console.log('ZXing code reader initialized')
      codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
          const sourceSelect = document.getElementById('sourceSelect')
          selectedDeviceId = videoInputDevices[0].deviceId
          if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
              const sourceOption = document.createElement('option')
              sourceOption.text = element.label
              sourceOption.value = element.deviceId
              sourceSelect.appendChild(sourceOption)
            })

            sourceSelect.onchange = () => {
              selectedDeviceId = sourceSelect.value;
            };

            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
          }

          document.getElementById('startButton').addEventListener('click', () => {
            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
              if (result) {
                console.log(result)
                document.getElementById('result').textContent = result.text
				  if(document.getElementById('chkline').checked){
					  document.getElementById('line').value = result.text;
					  var x = document.getElementById('audio');
						x.play();
					
				  }
				  if(document.getElementById('chkid').checked){
					  document.getElementById('id').value = result.text;
					  var x = document.getElementById('audio');
						x.play();
				  }
              }
              if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err)
                document.getElementById('result').textContent = err
              }
            })
            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
          })

          document.getElementById('resetButton').addEventListener('click', () => {
            codeReader.reset()
            document.getElementById('result').textContent = '';
			document.getElementById('id').value = '';
			  document.getElementById('line').value = '';
            console.log('Reset.')
          })

        })
        .catch((err) => {
          console.error(err)
        })
    })
  </script>

</body>

</html>