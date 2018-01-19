<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";

        $connect = mysqli_connect('localhost','root','','db_pro');

        $waktu = date('Y-m-d H:i:s');

        $json_data = exec('\openalpr_64\alpr -c id -p id '.$target_file.' -j -n 5');
        $data = json_decode($json_data,true);

        $plat = '';
        $rate = '';

        if(count($data['results'])>0){
            $plat = $data['results'][0]['plate'];
            $rate = $data['results'][0]['confidence'];
        }
        

        $query = "INSERT INTO tb_parkir VALUES ('','$plat','$rate','$target_file','$waktu')";
        $sql = mysqli_query($connect,$query);

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>