<?php
	session_start();
	require_once "lib/user_class.php";
	require_once "lib/message_class.php";
	require_once "blocks/registration.php";
	
	$array = $db->select("users", array("login"), "`login` = '$_SESSION[login]'");
	
	
	
	
	if(isset($_POST["change"])) {
		
		if ($_FILES["avatar"]["tmp_name"]) {
		
			$image = imagecreatefromjpeg($_FILES["avatar"]["tmp_name"]);
			$size = getimagesize($_FILES["avatar"]["tmp_name"]);
			$tmp = imagecreatetruecolor(120, 150);
			imagecopyresampled($tmp, $image, 0, 0, 0, 0, 120, 150, $size[0], $size[1]);
			
			$download = "img/avatars/".$array[0]["login"];
			imagejpeg($tmp, $download.".jpg");
			imagedestroy($image);
			imagedestroy($tmp);
			$db->update("users", "avatar", 2, "`login` = '".$_SESSION["login"]."'");
		}
	}
	
	$array = $db->select("users", array("*"), "`login` = '$_SESSION[login]'");
	
	if ($array[0]["avatar"] < 2) {
		$avatar = $array[0]["avatar"];
	}
	else {
		$avatar = "avatars/".$array[0]["login"];
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Form for task</title>

        <!-- Bootstrap -->
        
        <link href="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/main_page.css">
        <link rel="stylesheet" href="css/profile.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="menu">
            <div class="menu navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#contain-button">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand brand hidden-xs hidden-sm hidden-md" href="#">Site for Portfolio with PHP and Bootstrap</a>
						<form name="sear" id="sear" action="search.php" method="post" class="col-lg-5 col-md-5 col-sm-5 col-xs-9 col-lg-offset-4 col-md-offset-3 col-sm-offset-0 col-lg-offset-4">
							<input type="text" name="word" class="my_input search">
							<input type="submit" name="search" value="Search" class="search_button">
						</form>	
                    </div>
                    <div class="collapse navbar-collapse hidden-xs">
                        <ul class="nav navbar-nav list">
                            <li><a href="index.php">Main</a></li>
                            <? if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])) {?>
                            <li><a href="registr.php">Registration</a></li>
                            <li><a href="login.php">Log In</a></li>
                            <? } else {?>
                            <li><a href="profile.php">Your profile</a></li>
                            <? } ?>
                            <li class="dropdown"><a href="#" class=" dropdown-toggle" data-toggle="dropdown">Articles<b class="caret"></b></a>
                                <ul class="dropdown-menu" >
                                    <li><a href="#">Sport</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Science</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">All news</a></li>
                                </ul>
                            </li>
                            <li><a href="chat.php">Chat</a></li>
                        </ul>
                    </div>
                    
                    <div class="collapse navbar-collapse" id="contain-button">
                        <ul id="list_xs" class="nav navbar-nav list visible-xs">
                            <li><a href="index.php">Main</a></li>
                            <? if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])) {?>
                            <li><a href="registr.php">Registration</a></li>
                            <li><a href="login.php">Log In</a></li>
                            <? } else {?>
                            <li><a href="profile.php">Your profile</a></li>
                            <? } ?>
                            <li class="dropdown"><a href="#" class=" dropdown-toggle" data-toggle="dropdown">Articles<b class="caret"></b></a>
                                <ul class="dropdown-menu" >
                                    <li><a href="#">Sport</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Science</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">All news</a></li>
                                </ul>
                            </li>
                            <li><a href="chat.php">Chat</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
        </section>
        <? if(isset($_SESSION["login"]) && isset($_SESSION["password"])) { ?>
        <section id="profile">
            <div id="page" class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
					<img src="img/<?echo $avatar?>.jpg" alt="Avatar">
                <p class="login">Hello <? echo $_SESSION["login"]?>!</p>
                <form name="cha" action="" method="post" enctype="multipart/form-data">
					<p class="login">Change Avatar:</p>
					<input type="file" name="avatar">
					<input type="submit" name="change">
				</form>
                <a href="blocks/logout.php" class="button">Log Out</a>
            </div>
            
        </section>
        <?} else {?>
		
			<div class="AcceptBlock col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
				<p>You can't see your profile. Please, at first Log In on website</p>
				<a href="login.php">Page for Log In</a>
			</div>
		
		<?} ?>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script src="js/js.js" type="text/javascript"></script>
    </body>
</html>