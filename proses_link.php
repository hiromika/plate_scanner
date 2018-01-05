<?php 

require_once 'koneksi.php';

$link = $_GET['action'];

switch ($link) {
	case 'get_user':
		$data = $proses->Get_user_all();
		echo json_encode(array('data' => $data));
		break;	
	case 'get_user_byid':
		$result = $proses->Get_user_byid();
		foreach($result as $row){
			$output["user_name"] = $row["user_name"];
			$output["user_email"] = $row["user_email"];
			$output["user_address"] = $row["user_address"];
			$output["user_phone"] = $row["user_phone"];
			$output["user_plate_number"] = $row["user_plate_number"];
			if($row["user_image"] != '')
			{
				$output['user_image'] = '<img src="'.$row["user_image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["user_image"].'" />';
			}
			else
			{
				$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
			}
		}
		echo json_encode($output);
		break;
	case 'in_user':
		if ($_POST['operation']=='Add') {
			$in = $proses->in_user();
			if ($in) {
			echo 'Data Inserted';
			}
		}else{
			$in = $proses->edit_user();
			if ($in) {
			echo 'Data Updated';
			}
		}
		break;
	case 'user_delete':
		$del = $proses->delete_user();
		if ($del) {
			echo "Data Deleted";
		}
		break;
	default:
		# code...
		break;
}

	
?>