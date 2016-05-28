<?

	session_start();
	require_once "../lib/user_class.php";

if ($_POST["message"]) {
	$db->query("INSERT INTO `chat` VALUES ('', '$_POST[message]', '$_SESSION[login]', NOW())");
	$query = $db->query("SELECT * FROM `chat` WHERE `time` = NOW()");
	$row = mysqli_fetch_assoc($query);
	echo json_encode(array("1" => $row["login"], "2" => $row["text"], "3" => $row["time"]));
}

?>