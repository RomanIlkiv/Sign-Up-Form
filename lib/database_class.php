<?php
	
	require_once "config.php";
	require_once "checkvalid_class.php";
	
	class DataBase {
		protected $config;
		protected $mysqli;
		protected $valid;
		
		public function __construct() {
			$this->config = new Config();
			$this->valid = new CheckValid();
			$this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
			$this->mysqli->query("SET NAMES 'utf-8'");
		}
		
		public function query($query) {
			return $this->mysqli->query($query);
		}
		
		public function select($table_name, $fields, $where = "") {
			for ($i = 0; $i < count($fields); $i++) {
				if ((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) {
					$fields[$i] = "`".$fields[$i]."`";
				}
			}
			$fields = implode(",", $fields);
			$table_name = $this->config->db_prefix.$table_name;
			
			if ($where) $query = "SELECT $fields FROM $table_name WHERE $where";
			else $query = "SELECT $fields FROM $table_name";
			
			$result_set = $this->query($query);
			if (!$result_set) return false;
			$i = 0;
			while ($row = $result_set->fetch_assoc()) {
				$data[$i] = $row;
				$i++;
			}	
			$result_set->close();
			return $data;
		}
		
		public function insert($table_name, $new_values) {
			$table_name = $this->config->db_prefix.$table_name;
			$query = "INSERT INTO $table_name (";
			foreach ($new_values as $fields => $value) {
				$query .= "`".$fields."`, ";
			}	
			$query = substr($query, 0, -1);
			$query .= ") VALUES ("; 
			foreach ($new_values as $value) {
				$query .= "'".addslashes($value)."', ";
			}	
			$query = substr($query, 0, -1);
			$query .= ")";
			return $this->query($query);
		}
		
		public function update($table_name, $field, $value, $where) {
			$table_name = $this->config->db_prefix.$table_name;
			$query = "UPDATE $table_name SET `$field` = '$value'";
			if ($where) {
				$query .= " WHERE $where";
				return $this->query($query);
			}
			else return false;
		}

		public function deleteSQL($table_name, $where = "") {
			$table_name = $this->config->db_prefix.$table_name;
			if ($where) {
				$query = "DELETE FROM $table_name WHERE $where";
				return $this->query($query);
			}
			else return false;
		}
			
		public function getElementOnID($table_name, $id) {
			if (!$this->existsID($table_name, $id)) return false;
			$arr = $this->select($table_name, array("*"), "`id` = '$id'");
			return $arr[0];
		}
		
		public function getCount($table_name) {
			$data = $this->select($table_name, array("COUNT(`id`)"));
			return $data[0]["COUNT(`id`)"];
		}
		
		public function isExists($table_name, $field, $value) {
			$data= $this->select($table_name, array("id"), "`$field` = '".addslashes($value)."'");
			if (count($date) === 0) {
				return false;
			}
			return true;
		}
		
		private function existsID($table_name, $id) {
			if (!$this->valid->validID($id)) return false;
			$data= $this->select($table_name, array("id"), "`id` = '".addslashes($id)."'");
			if (count($data) === 0) {
			return false;
			}
			return true;

		}
		
		public function __destruct() {
			if($this->mysqli) $this->mysqli->close();
		}
		
		/*public function test($login) {
			if(!$this->valid->validLogin($login)) return false;
			else echo "norm";
		}*/
		
	}

	$db = new DataBase();
	//$test->Insert("test", array("id" => "", "text" => "lala", "test" => "ddfsdf"));
	//$test->query("INSERT INTO `test_test` (`id`, `text`, `test`) VALUES ('', 'vxcv', 'sfsdf')");
	//$test->test("roman");
	//$data = $test->Select("test", array("text"), "`id` = '3'");
	//print_r($data);
	//$test->Update("test", "text", "aaaaa", "`id` = 1");
	//$test->query("UPDATE `test_test` SET `text` = 'bbbbbbbb' WHERE `id` = 1");
	/*$data = $test->select("users", array("id"));
	print_r($data);
	if (count($date) === 0) {
		return false;
			}
	return true;*/
	/*$value = "lalala";
	$data = $test->select("users", array("id"), "`login` = '".addslashes($value)."'");
	print_r($data);*/
	
	
?>