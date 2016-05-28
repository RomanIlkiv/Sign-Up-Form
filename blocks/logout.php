<?php	
	session_start();
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
		unset($_SESSION["auth"]);
		header("Location: ../login.php");
		exit();
?>