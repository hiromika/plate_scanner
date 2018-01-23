<?php

	$connect = mysqli_connect('localhost','root','','db_pro');


	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$query = "SELECT a.*, b.user_name, b.user_id FROM tb_parkir a LEFT JOIN tb_user b ON a.nomor_plat = b.user_plate_number";

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}

	}

	if (isset($_POST['action'])) {
		if ($_POST['action']=='add') {
			$no_plat = $_POST['no_plat'];
			$idp 	 = $_POST['idp'];
			$sql = mysqli_query($connect,"UPDATE tb_parkir SET nomor_plat = '$no_plat' WHERE id_parkir = '$idp'");

			if ($sql) {
				echo json_encode(array('result'=>true,'msg'=>'Data baru berhasil ditambah'));
			}else{
				echo mysqli_error($connect);
			}
		}else{

			$no_plat = $_POST['no_plat'];
			$sql = mysqli_query($connect,"SELECT * FROM tb_user WHERE user_plate_number = '$no_plat'");

			$data = mysqli_fetch_assoc($sql);

			echo json_encode($data);
		}
	}




?>