<?php
	session_start();
	require_once "lib/user_class.php";
	require_once "lib/message_class.php";
	require_once "blocks/registration.php";
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
        <section id="my_form">
            <div class="container-fluid">
                <div class="row">
                    <form action="" method="post" name="registr" enctype="multipart/form-data" class="col-lg-6 col-md-6 col-sm-8 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
                        <label for="login" class="my_label">Enter your login: </label><br>
                        <input type="text" name="login" id="login" class="my_input" placeholder="Login">
                        
                        <label for="email" class="my_label">Enter your email: </label><br>
                        <input type="email" name="email" id="email" class="my_input" placeholder="Email">
                        
                        <label for="name" class="my_label">Enter your name: </label><br>
                        <input type="text" id="name" name="name" class="my_input" placeholder="Name">
                        
                        <label for="pass" class="my_label">Enter your password: </label><br>
                        <input type="password" name="password_1" id="pass" class="my_input" placeholder="Password">
                        
                        <label for="pass_2" class="my_label">Enter your password again: </label><br>
                        <input type="password" name="password_2" id="pass_2" class="my_input" placeholder="Enter your password again">
                        
                        <span id="block_radio">
                            <p class="my_label">Choose your gender: </p>
                            <label for="man" class="radio">Man: </label>
                            <input id="man" name="gender" type="radio" value="1">
                            <label for="woman" class="radio">Woman: </label>
                            <input id="woman" name="gender" type="radio" value="0">
                        </span>
                        
                        <label for="file" class="my_label">Add your photo: </label><br>
                        <input type="file" name="avatar" id="file">
                        <img src="blocks/capcha.php" alt="Capcha" class="capcha_img hidden-xs">
                        <span class="capcha hidden-xs">
                            
                            <label for="capcha" class="my_label capcha_label">Enter capcha: </label><br>
                            <input type="text" name="capcha" id="capcha" class="my_input input_label">
                        </span>
                        <br>
                        <img src="blocks/capcha.php" alt="Capcha" class="capcha_img_xs visible-xs">
                        <span class="capcha_xs visible-xs">
                            
                            <label for="capcha_xs" class="my_label capcha_label">Enter capcha: </label><br>
                            <input type="text" name="capcha_xs" id="capcha_xs" class="my_input input_label">
                        </span>
                        <input type="submit" name="send" value="Send" class="button">
                    </form>
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