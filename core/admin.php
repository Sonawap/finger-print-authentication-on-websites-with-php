<?php
session_start();
class Admin{
	public function login($username,$password){
		require('connect.php');

		$query ="SELECT * FROM admin where password='$password' and username='$username'";
		$result = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$getUser = $result->num_rows;

		if ($getUser > 0){
			if($row=mysqli_fetch_array($result)){
				$_SESSION['sidehustle_admin_id']=$row["id"];
				return true;
			}
		}
	}

	public function getUserInfo(){
  		require 'connect.php';

  		$id = $_SESSION['sidehustle_admin_id'];

  		$query = "SELECT * FROM admin where id = '$id'";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		$rows = mysqli_fetch_array($run);

		return $rows;

  	}

  	public function getUserInfoByApp($app){
  		require 'connect.php';
  		$query = "SELECT * FROM users where Application_no = '$app'";
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

  	public function getTotalUser(){
  		require 'connect.php';

		$query = "SELECT * FROM users ORDER BY id DESC";
		$users = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $users;
	}

	public function getTotalUserComplete(){
  		require 'connect.php';

		$query = "SELECT * FROM users where finger = 1 ORDER BY id DESC";
		$users = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $users;
	}

	public function checkUserComplete($id){
  		require 'connect.php';
		$query = "SELECT * FROM users where id = '$id' and finger = 1";
		$users = $sonawap->query($query) or die($sonawap->error.__LINE__);
		if ($users->num_rows > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function getQueryByLGA($lgaa){
  		require 'connect.php';
		$query = "SELECT * FROM users where rlga = '$lgaa'";
		$users = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $users;
	}

	public function getQueryByState($state_id){
  		require 'connect.php';
		$query = "SELECT * FROM users where rstate = '$state_id'";
		$users = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $users;
	}


	public function getTotalUserUnComplete(){
  		require 'connect.php';

		$query = "SELECT * FROM users where finger = 0 ORDER BY id DESC" ;
		$users = $sonawap->query($query) or die($sonawap->error.__LINE__);
		return $users;
	}

	public function delete($appNo){
		require 'connect.php';
		$query = "DELETE * FROM users where Application_no = '$appNo' ";
		$run = $sonawap->query($query) or die($sonawap->error.__LINE__);
		if ($run) {
			return true;
		}else{
			return false;
		}
	}

	
}

$admin = new Admin();