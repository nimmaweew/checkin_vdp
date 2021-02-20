<?php 
include ('connect.php');
if(isset($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'Map_Maker'){
		$date = $_POST['date'];
		$time = $_POST['seltime'];
		$fun = $_POST['selfun'];
		$grop = $_POST['selgrop'];
		$round = $_POST['selround'];
		$dis = $_POST['dis'];
		$seljob = $_POST['job'];
		if($grop <> 'all'){
								$result_grop = mysqli_query($conn,"select * from tb_grop where id = '$grop'");
								$row_grop = mysqli_fetch_assoc($result_grop);
								$grop_name = $row_grop['name'];
							}else{
								;
							}
						if($grop == 'all'){
								if($seljob == '1'){
								if($time == '1'){
								//ไม่เช็คชื่อ
								if($fun == '1'){
									$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')";
								}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep_mon where date = '$date' and round = '$round'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' ";
								}

								}
								//after
								if($time == '2'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' ";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' ";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_after where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' ";
									}

								}
								//eve
								if($time == '3'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_eve where distance > $dis and comment = '' and date = '$date' ";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_eve where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment FROM tb_rep_eve where distance > $dis AND date = '$date' ";
									}

								}
								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')
												UNION
												select * from tb_user where not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' 
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' 
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' ";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date' 
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' 
												UNION ALL
												select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date' ";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_mon where date = '$date' and round = '$round'
												UNION ALL
												select * from tb_rep_after where date = '$date' and round = '$round'
												UNION ALL
												select * from tb_rep_eve where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' 
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' 
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > $dis AND date = '$date'";
									}

								}
								
							}else if($seljob == '2'){
								if($time == '1'){
								//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')";
									}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' ";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep2_mon where date = '$date' and round = '$round' ";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' ";
								}

								}
								//after
								if($time == '2'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' ";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date' ";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_after where date = '$date' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' ";
									}

								}

								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' 
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' ";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date' 
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_mon where date = '$date' and round = '$round' 
												UNION ALL
												select * from tb_rep2_after where date = '$date' and round = '$round' ";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' 
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' ";
									}

								}
							}
							}
		else{
			
		
			if($seljob == '1'){
				if($time == '1'){
					//ไม่เช็คชื่อ
					if($fun == '1'){
						$sql = "select * from tb_user where grop = '$grop' and not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')";
					}
					//มากกว่า 5 ไม่มีหมายเหตุ
					else if($fun == '2'){
						$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
					}
					//มากกว่า 5 มีหมายเหตุ
					else if($fun == '3'){
						$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
					}
					//น้อยกว่า 5
						else if($fun == '4'){
					$sql = "select * from tb_rep_mon where date = '$date' and grop = '$grop_name' and round = '$round'";
					}
					//มากกว่า 5 หรือ ไม่เช็คชื่อ
					else if($fun == '5'){
						$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' and grop = '$grop_name'";
					}

				}
				//after
				if($time == '2'){
					//ไม่เช็คชื่อ
					if($fun == '1'){
						$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')";
					}
					//มากกว่า 5 ไม่มีหมายเหตุ
					else if($fun == '2'){
						$sql = "select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
					}
					//มากกว่า 5 มีหมายเหตุ
					else if($fun == '3'){
						$sql = "select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
					}
					//น้อยกว่า 5
					else if($fun == '4'){
						$sql = "select * from tb_rep_after where date = '$date' and grop = '$grop_name' and round = '$round'";
					}
					//มากกว่า 5 หรือ ไม่เช็คชื่อ
					else if($fun == '5'){
						$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' and grop = '$grop_name'";
					}

				}
				//eve
				if($time == '3'){
					//ไม่เช็คชื่อ
					if($fun == '1'){
						$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
					}
					//มากกว่า 5 ไม่มีหมายเหตุ
					else if($fun == '2'){
						$sql = "select * from tb_rep_eve where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
					}
					//มากกว่า 5 มีหมายเหตุ
					else if($fun == '3'){
						$sql = "select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
					}
					//น้อยกว่า 5
					else if($fun == '4'){
						$sql = "select * from tb_rep_eve where date = '$date' and grop = '$grop_name' and round = '$round'";
					}
					//มากกว่า 5 หรือ ไม่เช็คชื่อ
					else if($fun == '5'){
						$sql = "SELECT id,type,name,lname,tel,distance,comment FROM tb_user WHERE not tb_user.id in(SELECT id from tb_rep_eve where date = '$date' and grop = '$grop_name')
												UNION
												SELECT id,type,name,lname,tel,distance,comment FROM tb_rep_eve where distance > $dis AND date = '$date' and grop = '$grop_name'";
					}

				}
				//alltime
				if($time == 'all'){
					//ไม่เช็คชื่อ
					if($fun == '1'){
						$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_after where date = '$date' and round = '$round')
												UNION
												select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep_eve where date = '$date' and round = '$round')";
						}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep_eve where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep_mon where date = '$date' and grop = '$grop_name' and round = '$round'
												UNION ALL
												select * from tb_rep_after where date = '$date' and grop = '$grop_name' and round = '$round'
												UNION ALL
												select * from tb_rep_eve where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_mon where distance > $dis AND date = '$date' and grop = '$grop_name'
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_after where distance > $dis AND date = '$date' and grop = '$grop_name'
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep_eve where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon FROM tb_rep_eve where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}
								
							}else if($seljob == '2'){
								if($time == '1'){
								//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')";
									}
								//มากกว่า 5 ไม่มีหมายเหตุ
								else if($fun == '2'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
								}
								//มากกว่า 5 มีหมายเหตุ
								else if($fun == '3'){
									$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
								}
								//น้อยกว่า 5
								else if($fun == '4'){
									$sql = "select * from tb_rep2_mon where date = '$date' and grop = '$grop_name' and round = '$round'";
								}
								//มากกว่า 5 หรือ ไม่เช็คชื่อ
								else if($fun == '5'){
									$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
											UNION
											SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' and grop = '$grop_name'";
								}

								}
								//after
								if($time == '3'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";
									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_after where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}

								//alltime
								if($time == 'all'){
									//ไม่เช็คชื่อ
									if($fun == '1'){
										$sql = "select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep2_mon where date = '$date' and round = '$round')
												UNION
												select * from tb_user where grop = '$grop' and  not tb_user.id in(select id from tb_rep2_after where date = '$date' and round = '$round')";
									}
									//มากกว่า 5 ไม่มีหมายเหตุ
									else if($fun == '2'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment = '' and date = '$date' and grop = '$grop_name'";

									}
									//มากกว่า 5 มีหมายเหตุ
									else if($fun == '3'){
										$sql = "select * from tb_rep2_mon where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'
												UNION ALL
												select * from tb_rep2_after where distance > $dis and comment <> '' and date = '$date' and grop = '$grop_name'";
									}
									//น้อยกว่า 5
									else if($fun == '4'){
										$sql = "select * from tb_rep2_mon where date = '$date' and grop = '$grop_name' and round = '$round'
												UNION ALL
												select * from tb_rep2_after where date = '$date' and grop = '$grop_name' and round = '$round'";
									}
									//มากกว่า 5 หรือ ไม่เช็คชื่อ
									else if($fun == '5'){
										$sql = "SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_mon where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_mon where distance > $dis AND date = '$date' and grop = '$grop_name'
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_user WHERE grop = '$grop' and  not tb_user.id in(SELECT id from tb_rep2_after where date = '$date')
												UNION ALL
												SELECT id,type,name,lname,tel,distance,comment,lati,lon,dis_com FROM tb_rep2_after where distance > $dis AND date = '$date' and grop = '$grop_name'";
									}

								}
							}
		}
		$result = mysqli_query($conn,$sql);
		$arr_id = array();
		while($row = mysqli_fetch_assoc($result)){
			$arr_id[] = $row;
		}
		echo json_encode($arr_id,JSON_UNESCAPED_UNICODE);
	}
	else if($type = 'get_round'){
		$seltime = $_POST['seltime'];
		$seljob = $_POST['seljob'];
		$date = $_POST['date'];
		if($seljob == '1'){
			if($seltime == '1'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep_mon where date = '$date'");
			}else if($seltime == '2'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep_after where date = '$date'");
			}else if($seltime == '3'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep_eve where date = '$date'");
			}else if($seltime == 'all'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep_mon where date = '$date'
										UNION
										select DISTINCT round from tb_rep_after where date = '$date'
										UNION
										select DISTINCT round from tb_rep_eve where date = '$date'");
			}
		}else if($seljob == '2'){
			if($seltime == '1'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep2_mon where date = '$date'");
			}else if($seltime == '3'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep2_after where date = '$date'");
			}else if($seltime == 'all'){
				$result = mysqli_query($conn,"select DISTINCT round from tb_rep2_mon where date = '$date'
										UNION
										select DISTINCT round from tb_rep2_after where date = '$date'");
			}
		}
		$Arr = array();
		while($row = mysqli_fetch_assoc($result)){
			$Arr[] = $row;
		}
		echo json_encode($Arr,JSON_UNESCAPED_UNICODE);
	}
}
?>		
					
					