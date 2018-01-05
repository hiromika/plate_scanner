<?php 
/**
* prosess
*/
class Proses{
	private $db;
	
	function __construct($conn){
		$this->db = $conn;

	}

	public function login($uname,$upass){
    $pass = md5($upass);
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM tb_login WHERE username=:uname AND password=:pass LIMIT 1");
          $stmt->execute(array(':uname'=>$uname, ':pass'=>$pass));
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0){
             
            $_SESSION['user'] = array( 
            	'id' 		    => $userRow['id'],
            	'username'	=> $userRow['username'],
            	'level'		  => $userRow['level'],
            	);
            return true;
             
          }else{
            return false;
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin(){
      if(isset($_SESSION['user'])){
         return true;
      }
   }
 
   public function redirect($url){
       header("Location: $url");
   }
 
   public function logout(){
        session_destroy();
        unset($_SESSION['user']);
        return true;
   }


   /* USERS */
   public function Get_user_all(){
      try {
        
        $stmt = $this->db->prepare("SELECT * FROM tb_user WHERE status = 1");
        $stmt->execute();
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $userData;

      } catch (Exception $e) {
        echo $e->getMessage();
      }

   }
  public function Get_user_byid(){
      try {
        
        $stmt = $this->db->prepare("SELECT * FROM tb_user WHERE user_id=:user_id");
        $stmt->execute( array(':user_id' => $_POST['user_id'], ));
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $userData;

      } catch (Exception $e) {
        echo $e->getMessage();
      }

   }

  function upload_image(){
      if(isset($_FILES["user_image"])){
        $extension = explode('.', $_FILES['user_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = './assets/img/' . $new_name;
        move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
        return $destination;
      }
    }

  public function in_user(){
    try {
      $image = '';
      if($_FILES["user_image"]["name"] != ''){
        $image = self::upload_image();
      }
      $statement = $this->db->prepare("
        INSERT INTO tb_user (user_id, user_name, user_email, user_address, user_phone, user_image, user_plate_number) 
        VALUES ('',:user_name, :user_email, :user_address, :user_phone, :user_image, :user_plate_number)
      ");
      $result = $statement->execute(
        array(
          ':user_name'        =>  $_POST["user_name"],
          ':user_email'       =>  $_POST["user_email"],
          ':user_address'     =>  $_POST["user_address"],
          ':user_phone'       =>  $_POST["user_phone"],
          ':user_image'       =>  $image,
          ':user_plate_number'=>  $_POST["user_plate_number"],
        )
      );
      if(!empty($result)){
        return true;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
 
   }

  public function edit_user(){
    try {
      $image = '';
      if($_FILES["user_image"]["name"] != ''){
        $image = self::upload_image();
      }else{
        $image = $_POST["hidden_user_image"];
      }
      $statement = $this->db->prepare("
        UPDATE tb_user SET user_name=:user_name, user_email=:user_email, user_address=:user_address, user_phone=:user_phone, user_image=:user_image, user_plate_number=:user_plate_number WHERE user_id=:user_id
      ");
      $result = $statement->execute(
        array(
          ':user_id'          =>  $_POST['user_id'],
          ':user_name'        =>  $_POST["user_name"],
          ':user_email'       =>  $_POST["user_email"],
          ':user_address'     =>  $_POST["user_address"],
          ':user_phone'       =>  $_POST["user_phone"],
          ':user_image'       =>  $image,
          ':user_plate_number'=>  $_POST["user_plate_number"],
        )
      );
      if(!empty($result)){
        return true;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
 
  }

  public function delete_user(){
    try {
      $stmt = $this->db->prepare("UPDATE tb_user SET status = 0 WHERE user_id=:user_id");
      $stmt->execute(array(':user_id' => $_POST['user_id']));
      return true;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
   
}?>