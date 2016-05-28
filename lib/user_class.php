<?php
	
	require_once "database_class.php";
	
	class User extends DataBase {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function AddUser($login, $email, $name, $password, $gender, $avatar) {
			if(!$this->checkData($login, $password)) return false;
			return $this->query("INSERT INTO `test_users` (`id`, `login`, `email`, `confirm`, `name`, `password`, `gender`, `avatar`, `regdate`) VALUES ('', '$login', '$email', 0, '$name', '$password', '$gender', '$avatar', '".time()."')"); 
		}
		
		public function isExists($field, $value) {
			$data = $this->select("users", array("id"), "`$field` = '".addslashes($value)."'");
			if (count($data) === 0) {
				return false;
			}
			return true;
		}
		
		public function isExistsUser($value) {
			$data = $this->select("users", array("id"), "`login` = '".addslashes($value)."'");
			if (count($data) === 0) {
				return false;
			}
			return true;
		}

		private function checkData($login, $password) {
			if(!$this->valid->validLogin($login)) return false;
			if(!$this->valid->validHash($password)) return false;
			return true;
		}
		
		public function FormChars ($p1) {
			return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
		}
		
	}
	
	$user = new User();
	//$user->AddUser("lalala", "sdfsdfsdf", "dfdsf", md5("sdfsdf"), 1, 0);
	//echo $user->isExists("login", "lalala");
	//echo $user->isExistsUser("lalala");
	
?>