<?php

	$connect = mysqli_connect('localhost','root','','db_pro');


	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$query = "SELECT a.*, b.user_name FROM tb_parkir a LEFT JOIN tb_user b ON a.nomor_plat = b.user_plate_number";

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}
	}


?>