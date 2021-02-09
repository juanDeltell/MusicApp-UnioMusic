<?php
session_name("UnionMusic");
session_start();

if(isset($_REQUEST["cod"])){$cod = $_REQUEST["cod"];}
else
	$cod=4534;
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>UNIONMUSIC</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--<link rel="shortcut icon" href="PUT YOUR FAVICON HERE">-->
      <!-- Google Web Font Embed -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.css" rel='stylesheet' type='text/css'>
      <!-- Custom styles for this template -->
      <link href="js/colorbox/colorbox.css"  rel='stylesheet' type='text/css'>
      <link href="css/templatemo_style.css"  rel='stylesheet' type='text/css'>
	  <link href="css/register.css"  rel='stylesheet' type='text/css'>
      <script src="js/jquery.html5form-1.5-min.js"></script>
	<script src="js/jquery.form.min.js"></script>
   </head>
   <body>
      <div class="templatemo-top-menu">
         <div class="container">
            <!-- Static navbar -->
            <div class="navbar navbar-default" role="navigation">
               <div class="container">
                  <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                     <a class="navbar-brand" href="index.php" rel="nofollow">
                     <img src="images/logo2_naranja_rojo_vinil.png" alt="logo"  style="margin-top: -20px"/>
                     </a>
                  </div>
                  <div class="carousel-indicators" style="margin-bottom: -5px; margin-left: 130px;">	
			<p>
				<a data-target="#templatemo-carousel" data-slide-to="2" class="btn btn-lg btn-green" href="#" role="button">
					Sign Up
				</a> 
				<a data-target="#templatemo-carousel" data-slide-to="0" class="btn btn-lg btn-orange" href="#" role="button">
					Sign In
				</a>
			</p>
		</div>
                  <!--/.nav-collapse -->
               </div>
               <!--/.container-fluid -->
            </div>
            <!--/.navbar -->
         </div>
         <!-- /container -->
      </div>
      <div>
         <!-- Carousel -->
         <div id="templatemo-carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
               <li data-target="#templatemo-carousel" data-slide-to="0" class="active"></li>
               <li data-target="#templatemo-carousel" data-slide-to="1"></li>
               <li data-target="#templatemo-carousel" data-slide-to="2"></li>
               <li data-target="#templatemo-carousel" data-slide-to="3"></li>
		<li data-target="#templatemo-carousel" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
               <div class="item active">
                  <div class="container">
                     <div class="carousel-caption" style="margin-bottom: -140px;">
                        <h1>Welcome to UnionMusic</h1>
                        <p>SHARE YOUR SOUNDS</p>
			<div id="contact-form">
				<form method="post" action="home.php">
					<table id="tablereg" width="100%" >
						<tr>
							<td>
								<label for="firstname">Username or email: <span class="required">*</span></label><br />
								<input type="text" id="user" name="user" value="" placeholder="Your username or email" required="required" autofocus="autofocus" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="lastname">Password: <span class="required">*</span></label><br /> 
								<input type="password" id="pass" name="pass" value="" placeholder="Your password" required="required" />
							</td>
						</tr>
						<tr>
							<td>
								<input type="hidden" name="option" value="Sign in"> 
								<input type="submit" value="Sign in!" id="submit" />
							</td>
						</tr>
					</table>
					<?php 
					if($cod == 1){ ?><p id="failure">Your username/email or password are incorrect.</p><?php }
					else if($cod == 2){ ?><p id="failure">Your account is not valid yet, please, see your email to confirm your account.</p><?php }
					else if($cod == 3){ ?><p id="success">Your account is activated. You can sign in now!</p><?php } ?>
				</form>
			</div>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="col-sm-6 col-md-6">
                           <h1>LISTEN</h1>
                           <p>Listen to any sound around you</p>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <h1>CAPTURE</h1>
                           <p>Record the sound, and save it.</p>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <h1>SHARE</h1>
                           <p>Share the sound with your followers</p>
                        </div>
                        <div class="col-sm-6 col-md-6">
                           <h1>EDIT</h1>
                           <p>Take sounds from your followers playlist and edit them to make the best song ever.</p>
                        </div>
                     </div>
                  </div>
               </div>
			   <div class="item">
                  <div class="container">
                     <div class="carousel-caption" style="margin-bottom: -140px;">
                        <div id="contact-form">  
						<h2>Sing in! It's free and fun</h2><br /> 
						   <form method="post" action="confirm.php">
								<table id="tablereg" width="100%" >
									<tr>
										<td>
											<label for="firstname">First Name: <span class="required">*</span></label>  
											<input type="text" id="firstname" name="firstname" value="" placeholder="Your first name" required="required" autofocus="autofocus" />
										</td>
										<td>
											<label for="lastname">Last Name: <span class="required">*</span></label>  
											<input type="text" id="lastname" name="lastname" value="" placeholder="Your last name" required="required" />
										</td>
									</tr>

									<tr>
										<td>
											<label for="birthday">Birthday: <span class="required">*</span></label>  
											<input type="date" id="birthday" name="birthday" value="" required="required" />
										</td>
										<td>
											<label for="sex">Sex: </label>  
											  <select id="sex" name="sex">   
												 <option value="male">Male</option>
												 <option value="female">Female</option>  
											  </select>
										</td>
									</tr>

									<tr>
										<td>
											<label for="lastname">User Name: <span class="required">*</span></label>  
											<input type="text" id="username" name="username" value="" placeholder="Choose an user name" required="required" />
										</td>
										<td>
											<label for="email">Email Address: <span class="required">*</span></label>  
											<input type="email" id="email" name="email" value="" placeholder="youremail@email.com" required="required" />  
										</td>
									</tr>

									<tr>
										<td>
											<label for="pass">Password: <span class="required">*</span></label>  
											<input type="password" id="pass" name="pass" value="" required="required" />
										</td>
										<td>
											<label for="pass2">Confirm Password: <span class="required">*</span></label>  
											<input type="password" id="pass2" name="pass2" value="" required="required" /> 
										</td>
									</tr>
								</table>   
								<input type="hidden" name="option" value="Sign up">  
								<input type="submit" value="Send away!" id="submit" />
						   </form>  
						</div>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="container">
                     <div class="carousel-caption">
                        <h1>THINKING OF YOU</h1>
                        <p>Designed for potential artists </p>
                        <p><a class="btn btn-lg btn-orange" href="#" role="button">Read More</a></p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="container">
                     <div class="carousel-caption">
                        <h1>ABOUT</h1>
                        <p>You can find us at the Computer Science Faculty, in the Complutense University of Madrid </p>
                     </div>
                  </div>
               </div>
            </div>
            <a class="left carousel-control" href="#templatemo-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#templatemo-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
         </div>
         <!-- /#templatemo-carousel -->
      </div>
      <div class="templatemo-welcome" id="templatemo-welcome">
         <div class="container">
            <div class="templatemo-slogan text-center">
               <span class="txt_darkgrey">Welcome to </span><span class="txt_orange">The New Idea of Sharing Music</span>
               <p class="txt_slogan"><i>Make songs with your daily life sounds. </i></p>
            </div>
         </div>
      </div>
      <div class="templatemo-service">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="templatemo-service-item">
                     <div>
                        <img src="images/leaf.png" alt="icon" />
                        <span class="templatemo-service-item-header">AWESOME MUSIC</span>
                     </div>
                     <p>Live the new exprience of sharing your own made music.In unionmusic you will be able to record any sound, upload it to your profile and share with your followers.</p>
                     <br class="clearfix"/>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="col-md-4">
                  <div class="templatemo-service-item" >
                     <div>
                        <img src="images/mobile.png" alt="icon"/>
                        <span class="templatemo-service-item-header">SOCIAL LIFE</span>
                     </div>
                     <p>Share your sounds, get your friend's sounds, make amazing songs with them using an incredible music creator. Once you finished your song publish it in your profile so as many music managers and important people of the music panorama  can listen to it and contact with you. </p>
                     <br class="clearfix"/>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="templatemo-service-item">
                     <div>
                        <img src="images/battery.png" alt="icon"/>
                        <span class="templatemo-service-item-header">EDIT</span>
                     </div>
                     <p>UnionMusic provides you the opportunity to edit your music. You can take the sound you've recorded, you can also use your friend's sounds, then using the music creator, you can overlap the sounds making amazing effects. You will be able to extend, make loops, shorten and much more. 
                     </p>
                     <br class="clearfix"/>
                  </div>
                  <br class="clearfix"/>
               </div>
            </div>
         </div>
      </div>
      <div class="templatemo-bot-bar" id="templatemo-bot">
         <div class="container">
            <div class="subheader">
               <div id="email" class="pull-right">
                  <img src="images/email.png" alt="email"/>
                  unionmusic@gmail.com
               </div>
               <div id="centro" class="pull-left">
                  Facultad informatica, Universidad Complutense de Madrid.
               </div>
            </div>
         </div>
      </div>
      <script src="js/jquery.min.js" type="text/javascript"></script>
      <script src="js/bootstrap.min.js"  type="text/javascript"></script>
      <script src="js/stickUp.min.js"  type="text/javascript"></script>
      <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
      <script src="js/templatemo_script.js"  type="text/javascript"></script>
   </body>
   <script type='text/javascript' src='js/logging.js'></script>
</html>
