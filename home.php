<?php
session_name("UnionMusic");
session_start();

include_once("lib/accionesbbdd.php");

if(isset($_REQUEST["user"])){$user = $_REQUEST["user"];}
if(isset($_REQUEST["pass"])){$pass = $_REQUEST["pass"];}
if(isset($_REQUEST["option"])){$option = $_REQUEST["option"];}
else {$option = 660;}

if($option == "Sign in"){
	switch(iniciarSesion($user, $pass)){
		case 1: // No existe el usuario.
			header("Location:index.php?cod=1");
			break;
		case 2: // No está dado de alta.
			header("Location:index.php?cod=2");
			break;
	}
}
if(isset($_SESSION["iduser"])){ ?>
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
                     <a class="navbar-brand" href="#" rel="nofollow">
                     <img src="images/logo2_naranja_rojo_vinil.png" alt="logo"  style="margin-top: -20px"/>
                     </a>
                  </div>
		<div class="carousel-indicators" style="margin-bottom: -5px; margin-left: 130px;">	
		<p>
			<a data-target="#templatemo-carousel" class="btn btn-lg btn-green" href="crearmaqueta.php" role="button">
				Create MixTape
			</a> 
			<a data-target="#templatemo-carousel" class="btn btn-lg btn-orange" href="subirpista.php" role="button">
				Add Track
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
            <div class="carousel-inner">
               <div class="item active">
                  <div class="container">
                     <div class="carousel-caption">
			<?php 
			if($option == 1){ ?><p id="success">Your MixTape has been generated successfully.</p><?php }
			else if($option == 2){ ?><p id="success">Your Track has been uploaded successfully.</p><?php } ?>
                        <h1>Welcome <?php echo $_SESSION["nomuser"]; ?>!</h1>
                        <p>This is your home screen, here you can see the activity of your friends, view your tracks and mixtapes... (When implemented)</p>
                     </div>
                  </div>
               </div>
         </div>
         <!-- /#templatemo-carousel -->
      </div>
      <script src="js/jquery.min.js" type="text/javascript"></script>
      <script src="js/bootstrap.min.js"  type="text/javascript"></script>
      <script src="js/stickUp.min.js"  type="text/javascript"></script>
      <script src="js/colorbox/jquery.colorbox-min.js"  type="text/javascript"></script>
      <script src="js/templatemo_script.js"  type="text/javascript"></script>
   </body>
   <script type='text/javascript' src='js/logging.js'></script>
</html>
<?php
}
else{ echo "Error mortal"; } ?>
