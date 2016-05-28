<?php
	if (isset($_POST['send'])) {
		
		$login = $user->FormChars($_POST["login"]);
		
		$email = $user->FormChars($_POST["email"]);
		$reg = "/[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z0-9]*/i";
		if (!preg_match($reg, $email)) {
			$str = $mess->messageSend(1, "You wrote incorrect email");
			echo $str;
			return false;
		}
		$name = $user->FormChars($_POST["name"]);
		$password = $user->FormChars(md5($config->secret_word.$_POST["password_1"]));
		$password_2 = $user->FormChars(md5($config->secret_word.$_POST["password_2"]));
		$capcha = $user->FormChars($_POST["capcha"]);
		
		if ($_SESSION['rand'] != $capcha) {
			$str = $mess->messageSend(1, "You wrote wrong capcha");
			echo $str;
			return false;
		}
		
		if (strlen($login) < $config->min_login) {
			$str = $mess->messageSend(1, "Login is too short");
			echo $str;
			return false;
		}
		else if (strlen($login) > $config->max_login) {
			$str = $mess->messageSend(1, "Login is too long");
			echo $str;
			return false;
		}
		
		$array = $db->select("users", array("id"), "`login` = '".$login."'"); 
		if (count($array) > 0) {
			$str = $mess->messageSend(1, "User with such login already exists");
			echo $str;
			return false;
		}
		
		$array = $db->select("users", array("id"), "`email` = '".$email."'"); 
		if (count($array) > 0) {
			$str = $mess->messageSend(1, "User with such email already exists");
			echo $str;
			return false;
		}
		
		if ($password != $password_2) {
			$str = $mess->messageSend(1, "You wrote difference passwords");
			echo $str;
			return false;
		}
		
		$gender = $_POST["gender"];
		
		if ($_FILES["avatar"]["tmp_name"]) {
			$image = imagecreatefromjpeg($_FILES["avatar"]["tmp_name"]);
			$size = getimagesize($_FILES["avatar"]["tmp_name"]);
			$tmp = imagecreatetruecolor(120, 150);
			imagecopyresampled($tmp, $image, 0, 0, 0, 0, 120, 150, $size[0], $size[1]);
			$download = "img/avatars/".$login;
			imagejpeg($tmp, $download.".jpg");
			imagedestroy($image);
			imagedestroy($tmp);
			$avatar = 2;
		}
		else {
			$avatar = $gender;
		}
		
		/*if (!$_POST["file"]) {
			if ($gender == 1) $avatar = 1;
			else if ($gender == 0) $avatar = 0;
			//else return false;	
		}
		else*/ 
		//$avatar = $gender;

		$user->AddUser($login, $email, $name, $password, $gender, $avatar);
		$str = $mess->messageSend(3, "Please, confirm your email.");
		echo $str;
		
		/*Відправлення емейлу на почту для підтвердження*/
		$code = substr(base64_encode($email), 0, -1);//має питатись в користувача додатковим полем в формі для емейлу
		$shufr = substr($code, -5).substr($code, 0, -5);
		$decode = base64_decode(substr($shufr, 5).substr($shufr, 0, 5));//розкодовую те шо отримав в посиланні
		$_SESSION["decode"] = $decode;
		$_SESSION["email"] = $email;//мало би братись з поля форми
		mail("$email", "Реєстрація на сайті", "Посилання для активації: formphp/blocks/accept.php?code=".substr($code, -5).substr($code, 0, -5), "From: lala@gmail.com");
	}
?>