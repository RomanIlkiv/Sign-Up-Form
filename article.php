<?php 
    session_start();
	require_once "lib/database_class.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>My WebSite</title>

        <!-- Bootstrap -->
        <link href="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/main_page.css">
		<link rel="stylesheet" href="css/article.css">
		<link rel="stylesheet" href="css/chat.css">

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
		
		<section>
			<div id="article" class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
				
				
				<?php 
					
					$query = $db->query("SELECT `id`, `read`, `title`, `text`, `time` FROM `test_articles` WHERE `id` = ".$_GET["id"]);
					$row = $query->fetch_assoc();
					if (!$row["title"]) {
						echo "No such article";
					}
					$db->query("UPDATE `test_articles` SET `read` = `read` + 1 WHERE `id` = ".$_GET["id"]);
				?>
				<div id="mess">
					<span class="data"><?php echo $row["id"]." || "; ?></span>
					<span  class="data"><?php echo $row["time"] ?></span><br>
					<span class="title"><?php echo $row["title"]."<br>";?></span>
					<span><?echo $row["text"];?></span>
				
				<br>
				<br>
				<p class="read">Read: <? echo $row["read"] + 1;?></p>
				</div>
				
				<div id="comments">
					<div id="show">
						<p class="title">Comments: </p>
						<?
							if ($_POST["add"] && $_POST["textarea"]) {
								$db->query("INSERT INTO `test_commnets` VALUES ('', '".$_GET["id"]."', '".$_SESSION["login"]."', '".$_POST["textarea"]."', NOW())");
							}
							
							$data = $db->query("SELECT * FROM `test_commnets` WHERE `article` = '".$_GET["id"]."' ORDER By `id` DESC LIMIT 50");
							
							while($row = mysqli_fetch_assoc($data)) { ?>
								<div class="comm">
									<span class="data"><? echo $row["login"]." || ".$row["time"]; ?></span><br>
									<span class="text"><? echo $row["text"] ?></span>
								</div>
						<?	}
						?>
					</div>
					<? if ($_SESSION["login"]) { ?>
					<form name="com" method="post" action="">
						<textarea name="textarea" placeholder="Write your comment" cols="50" rows="4" id="textarea"></textarea><br>
						<input type="submit" name="add" class="button send" value="Send">
					</form>
					<? }  else {?>
						<br><p class="warning">Only authorized users can leave comments.</p>
					<? } ?>
				</div>
			</div>
		</section>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script src="js/js.js" type="text/javascript"></script>
    </body>
</html>