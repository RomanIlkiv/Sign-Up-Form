<?php
	class Config {
		var $sitename = "formphp";
		var $adress = "http://formphp/";
		var $secret_word = "roman";
		var $host = "localhost";
		var $db = "mysite";
		var $db_prefix = "test_";
		var $user = "root";
		var $password = "";
		
		var $min_login = 3;
		var $max_login = 30;
		
	}
	
	$config = new Config();
?>