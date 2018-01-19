<?php

	$connect = mysqli_connect('localhost','root','','db_pro');


	if(isset($_POST['action'])){

		if($_POST['action']=='add'){

			$username = $_POST['username'];
			$password = $_POST['password'];
			$role = $_POST['role'];
			$id = $_POST['id'];

			if($id>0){

				if($password!=""){
					$password = md5($password);
					$query = "UPDATE tb_login SET username='$username', password = '$password', level='$role' WHERE id='$id'";
					
				}else{
					$query = "UPDATE tb_login SET username='$username', level='$role' WHERE id='$id'";
				}
				
				$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data berhasil diubah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data gagal diubah'));
				}

			}else{
				$password = md5($password);
				$query = "INSERT INTO tb_login VALUES('','$username','$password','$role')";
				$sql = mysqli_query($connect,$query);

				if($sql){
					echo json_encode(array('result' => true,'msg'=>'Data baru berhasil ditambah'));
				}else{
					echo json_encode(array('result' => false,'msg'=>'Data baru gagal ditambah'));
				}
			}

			

		}

	}

	if(isset($_GET['action'])){

		if($_GET['action']=='get'){

			$query = "SELECT * FROM tb_login";

			$sql = mysqli_query($connect,$query);

			$data = array();
			while($row = mysqli_fetch_assoc($sql)){
				$data[] = $row;
			}

			echo json_encode(array('data'=>$data));

		}elseif($_GET['action']=='del'){


			$id = $_GET['id'];

			$query = "DELETE FROM tb_login WHERE id='$id'";
			$sql = mysqli_query($connect,$query);

			
			if($sql){
				echo json_encode(array('result' => true,'msg'=>'Data berhasil dihapus'));
			}else{
				echo json_encode(array('result' => false,'msg'=>'Data  gagal dihapus'));
			}
		}
	}


?>