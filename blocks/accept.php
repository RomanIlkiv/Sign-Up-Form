<?php
	
	require_once "../lib/database_class.php";
	require_once "../lib/user_class.php";
	require_once "../lib/message_class.php";
	
	$shufr = $_GET["code"];
	$email = base64_decode(substr($shufr, 5).substr($shufr, 0, 5));//розкодовую те шо отримав в посиланні	
	if ($user->isExists("email", $email)) {
		$db->update('users', "confirm", 1,  "`email` = '$email'");
		$str = $mess->messageSend(3, "Your email is confirm");
		echo $str;?>
		
		<div class="AcceptBlock col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
			<p>Now, you can Log In on your profile! Want you?</p>
			<a href="#">Page for Log In</a>
		</div>
		
<?		
	}
	else {
		$str = $mess->messageSend(1, "Your email isn't confirm");
		echo $str;
	}
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
        <link href="../bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/main_page.css">

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
                        <a class="navbar-brand brand hidden-xs hidden-sm" href="#">Site for Portfolio with PHP and Bootstrap</a>
                    </div>
                    <div class="collapse navbar-collapse hidden-xs">
                        <ul class="nav navbar-nav list">
                            <li><a href="../index.php">Main</a></li>
                            <li><a href="../registr.php">Registration</a></li>
                            <li><a href="#">Log In</a></li>
                            <li><a href="#">Your profile</a></li>
                            <li class="dropdown"><a href="#" class=" dropdown-toggle" data-toggle="dropdown">Articles<b class="caret"></b></a>
                                <ul class="dropdown-menu" >
                                    <li><a href="#">Sport</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Science</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">All news</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Chat</a></li>
                        </ul>
                    </div>
                    
                    <div class="collapse navbar-collapse" id="contain-button">
                        <ul id="list_xs" class="nav navbar-nav list visible-xs">
                            <li><a href="index.php">Main</a></li>
                            <li><a href="registr.php">Registration</a></li>
                            <li><a href="#">Log In</a></li>
                            <li><a href="#">Your profile</a></li>
                            <li class="dropdown"><a href="#" class=" dropdown-toggle" data-toggle="dropdown">Articles<b class="caret"></b></a>
                                <ul class="dropdown-menu" >
                                    <li><a href="#">Sport</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#">Science</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">All news</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Chat</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
        </section>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap-3.3.5-dist/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
        <script src="../js/js.js" type="text/javascript"></script>
    </body>
</html>