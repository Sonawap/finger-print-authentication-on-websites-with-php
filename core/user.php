<?php
session_start();
class User{
	


	public function register($surname, $firstname, $othername, $age, $sex, $nationality, $rstate, $rlga, $rtown, $occupation, $sbirth, $lgabirth, $disable, $work){
		$surname = $this->check_input($surname);
		$firstname = $this->check_input($firstname);
		$othername = $this->check_input($othername);
		$age = $this->check_input($age);
		$sex = $this->check_input($sex);
		$nationality = $this->check_input($nationality);
		$rstate = $this->check_input($rstate);
		$rlga = $this->check_input($rlga);
		$rtown = $this->check_input($rtown);
		$occupation = $this->check_input($occupation);
		$sbirth = $this->check_input($sbirth);
		$lgabirth = $this->check_input($lgabirth);
		$disable = $this->check_input($disable);
		$work= $this->check_input($work);
		$work= $this->check_input($work);
		$appNo = $_SESSION['enrollment_applicationnumber'];
		require('connect.php');
		$query = "INSERT INTO users (surname, firstname, othername, age, sex, nationality, rstate, rlga, rtown, occupation, sbirth, lgabirth, disable, work, biodata, Application_no) value ('$surname', '$firstname', '$othername', '$age', '$sex', '$nationality', '$rstate', '$rlga', '$rtown', '$occupation', '$sbirth', '$lgabirth', '$disable', '$work', '1','$appNo')";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);

		if ($run) {
			$_SESSION['enrollment_reg_id'] = $this->getLastInsertedId();
			return true;
		}
	}

	public function updateBio($surname, $firstname, $othername, $age, $sex, $nationality, $rstate, $rlga, $rtown, $occupation, $sbirth, $lgabirth, $disable, $work){
		$surname = $this->check_input($surname);
		$firstname = $this->check_input($firstname);
		$othername = $this->check_input($othername);
		$age = $this->check_input($age);
		$sex = $this->check_input($sex);
		$nationality = $this->check_input($nationality);
		$rstate = $this->check_input($rstate);
		$rlga = $this->check_input($rlga);
		$rtown = $this->check_input($rtown);
		$occupation = $this->check_input($occupation);
		$sbirth = $this->check_input($sbirth);
		$lgabirth = $this->check_input($lgabirth);
		$disable = $this->check_input($disable);
		$work= $this->check_input($work);
		$work= $this->check_input($work);
		$appNo = $_SESSION['enrollment_applicationnumber'];
		require('connect.php');
		$query = "UPDATE users set surname= '$surname', firstname = '$firstname', othername = '$othername', age = '$age', sex = '$sex', nationality = '$nationality', rstate = '$rstate', rlga = '$rlga', rtown = '$rtown', occupation = '$occupation', sbirth = '$sbirth', lgabirth = '$lgabirth', disable = '$disable', work = '$work' where Application_no = '$appNo' ";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);

		if ($run) {
			return true;
		}
	}

	public function getLastInsertedId(){
		require('connect.php');

		$query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		if($run){
			$row = mysqli_fetch_array($run);
			$id = $row['id'];
			return $id;
		}	
	}

	public function checkAppNo(){
		require('connect.php');
		$appNo = $_SESSION['enrollment_applicationnumber'];

		$query = "SELECT * FROM users where Application_no = '$appNo'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$count = $run->num_rows;
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function checkConAppNo($appNo){
		require('connect.php');

		$query = "SELECT * FROM users where Application_no = '$appNo'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$count = $run->num_rows;
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	

	public function update($email, $name){
		require('connect.php');
		$id = $this->getUserInfo()['id'];
		$query = "UPDATE users set email='$email', name='$name' where id= '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);

		if ($run) {
			return true;
		}
	}

	public function updatePhoto($pic){
		require('connect.php');
		$id = $this->getUserInfo()['id'];
		$query = "UPDATE users set photo='$pic', photoUp='1' where id= '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);

		if ($run) {
			return true;
		}
	}

	public function login($email, $password){
		require('connect.php');
		$newPassword = md5($password);

		$query = "SELECT * FROM users where email='$email' and password='$newPassword'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$getUser = $run->num_rows;
		if($getUser > 0){
			if($row=mysqli_fetch_array($run)){
	          $_SESSION['user_id']=$row["id"];
	          header("Location: index.php");
	        }		
	        else{
	          header("Location: login.php?error=Authentication failed");
	        } 
		}

	}

 	public function checkAuth(){
    	if ($_SESSION['user_id']) {
	      	return true;
	    }else{
	      	return false;
	    }
  	}

  	public function logout(){
		session_destroy();
		header("Location: index.php");
		exit();
  	}

  	public function getUserInfo(){
  		require 'connect.php';

  		$id = $_SESSION['enrollment_reg_id'];

  		$query = "SELECT * FROM users where id = '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$rows = mysqli_fetch_array($run);

		return $rows;

  	}

  	public function getStateName($id){
  		require 'connect.php';
  		$query = "SELECT * FROM states where id = '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$rows = mysqli_fetch_array($run);

		return $rows;
  	}

  	public function getUserInfoByApp(){
  		require 'connect.php';

  		$app = $_SESSION['enrollment_applicationnumber'];

  		$query = "SELECT * FROM users where Application_no = '$app'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$rows = mysqli_fetch_array($run);

		return $rows;

  	}

  	public function getUserById($id){
  		require 'connect.php';
  		$query = "SELECT * FROM users where id = '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$rows = mysqli_fetch_array($run);

		return $rows;

  	}

  	public function updatePrint(){
  		require 'connect.php';
  		$appNo = $_SESSION['enrollment_applicationnumber'];
  		$query = "UPDATE users set finger='1' where Application_no= '$appNo'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);

		if ($run) {
			return true;
		}
  	}

  	public function getUserByAppNo($id){
  		require 'connect.php';
  		$query = "SELECT * FROM users where Application_no = '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$rows = mysqli_fetch_array($run);

		return $rows;

  	}

  	public function getStates(){
		require('connect.php');
		$query = "SELECT * FROM states";
		$states = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $states;
	}

	public function getLGA($state_id){
		require('connect.php');
		$query = "SELECT name FROM local_governments where state_id = '$state_id'";
		$lga = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $lga;
	}

	function check_input($data){
	    //// validating inputs
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);

	    return $data;
	}

}

$user = new User();

