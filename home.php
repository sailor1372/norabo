<?php
	session_start();
	if (empty($_SESSION['email'])){
		echo "<script> parent.location.href='sign_in.php'; </script>";
	}else{        
		$id = $_SESSION['id'];
		$email = $_SESSION['email'];
		$nick_name = $_SESSION['nick_name'];
        $age = $_SESSION['age'];
        $gender = $_SESSION['gender'];
        $img =  $_SESSION['img'];   
	} 
?>