<?php


	$connect = mysqli_connect('localhost','root','','db_pro');

	$query = "SELECT * FROM tb_gerbang";
	$sql = mysqli_query($connect,$query);

	$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	echo json_encode(array('status'=>$data['status']));

?>