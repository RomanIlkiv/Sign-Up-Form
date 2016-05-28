<?php

	if(isset($_POST["send"])) {
		$login = $user->FormChars($_POST["login"]);
		$password = $user->FormChars(md5($config->secret_word.$_POST["password"]));
		
		$array = $db->select("users", array('id'), "`login` = '$login' AND `password` = '$password'");
		if (count($array) === 0) {
				$str = $mess->messageSend(1, "You wrote incorrect login or password");
				echo $str;
				return false;
			}
		$_SESSION["login"] = $login;
		$_SESSION["password"] = $password;
		$_SESSION["auth"] = 1;
		header("Location: profile.php");
		exit();
	}

?>