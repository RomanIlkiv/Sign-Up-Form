<?php
	
	class Message {

		public function messageSend($p1, $text, $p3 = "") {
			switch ($p1) {
				case 1: {
					$warn = "Error: ";
					$class = "Error";
					break; 
				}
				case 2: {
					$warn = "Warning: ";
					$class = "Warning";
					break; 
				} 
				case 3: {
					$warn = "Success: ";
					$class = "Success";
					break; 
				} 
				default: return false;
			}
			if ($p3) $_SERVER['HTTP_REFERER']  = $p3;
			echo "<div class='messageBlock $class col-lg-6 col-md-6 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-0'><b>$warn</b>$text</div>";
			
		}
		
	}
	
	$mess = new Message();
	//$str = $mess->messageSend(2, "sdfsdfdsf", "/lib/user_class.php");
	//echo $str;
	
	/*function MessageSend($p1, $p2, $p3 = '') {
	if ($p1 == 1) $p1 = 'Ошибка';
	else if ($p1 == 2) $p1 = 'Подсказка';
	else if ($p1 == 3) $p1 = 'Информация';
	$_SESSION['message'] = '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
	if ($p3) $_SERVER['HTTP_REFERER']  = $p3;
	exit(header('Location: '.$_SERVER['HTTP_REFERER']));
	}



	function MessageShow() {
	if ($_SESSION['message'])$Message = $_SESSION['message'];
	echo $Message;
	$_SESSION['message'] = array();
	
	MessageSend(1, "sfsdfsdfsdf");//, "/lib/user_class.php");
	MessageShow();*/

	
?>