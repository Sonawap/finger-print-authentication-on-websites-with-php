<?php
error_reporting(0);
session_start();

require_once 'user.php';

class Middleware extends User{
    public function auth(){
        if ($_SESSION['sidehustle_admin_id']) {
            return true;
        }else{
            $this->bounce();
        }
    }

    public function bounce(){
        session_destroy();
		header("Location: index.php");
		exit();
    }
}

$middleware = new Middleware();