<?php


	$connect = mysqli_connect('localhost','root','','db_pro');

	$id = $_GET['ig'];

	$query = "SELECT * FROM tb_gerbang WHERE id_gerbang='$id' LIMIT 1";
	$sql = mysqli_query($connect,$query);

	$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

	echo json_encode(array('status'=>$data['status']));

?>