<?php
	
	$connect = mysqli_connect('localhost','root','','db_pro');

	$id = $_GET['ig'];

	$query = "SELECT * FROM tb_gerbang WHERE id_gerbang='$id' LIMIT";
	$sql = mysqli_query($connect,$query);

	$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	if($data['status']==1){
		$query = "UPDATE tb_gerbang SET status='0' WHERE id_gerbang='$id'";	
	}else{
		$query = "UPDATE tb_gerbang SET status='1' WHERE id_gerbang='$id'";	
	}

	$sql = mysqli_query($connect,$query);

	header("location:home.php?link=m_parkir");
?>