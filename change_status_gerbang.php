<?php
	
	$connect = mysqli_connect('localhost','root','','db_pro');

	$query = "SELECT * FROM tb_gerbang";
	$sql = mysqli_query($connect,$query);

	$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	if($data['status']==1){
		$query = "UPDATE tb_gerbang SET status='0'";	
	}else{
		$query = "UPDATE tb_gerbang SET status='1'";	
	}

	$sql = mysqli_query($connect,$query);

	header("location:home.php?link=m_parkir");
?>