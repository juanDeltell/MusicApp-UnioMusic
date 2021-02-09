<?php 
session_name("UnionMusic");
session_start();
	
include_once("lib/accionesbbdd.php");

if(isset($_REQUEST["firstname"])){$firstname = $_REQUEST["firstname"];}
if(isset($_REQUEST["lastname"])){$lastname = $_REQUEST["lastname"];}
if(isset($_REQUEST["birthday"])){$birthday = $_REQUEST["birthday"];}
if(isset($_REQUEST["sex"])){
	if($_REQUEST["sex"]=="male")
		$sex=m;
	else
		$sex=f;
	
	}
if(isset($_REQUEST["username"])){$username = $_REQUEST["username"];}
if(isset($_REQUEST["email"])){$email = $_REQUEST["email"];}
if(isset($_REQUEST["pass"])){$pass = $_REQUEST["pass"];}
if(isset($_REQUEST["cod"])){$cod = $_REQUEST["cod"];}

if($_REQUEST["option"] == "Sign up"){
	$asunto = "$firstname, confirm your suscription on UnionMusic";
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: UnionMusic <noreply@unionmusic.com>\r\n";
	$cuerpo = "Hi $firstname!, how are you? Ok, click the next link to complete your subscription on UnionMusic:
		http://unionmusic.comuf.com/confirm.php?option=confirm&cod=".md5($pass).insertarUsuario($firstname, $lastname, $birthday, $sex, $username, $email, $pass);

	mail($email,$asunto,$cuerpo,$headers);
}
else if($_REQUEST["option"] == "confirm"){
	$md5 = substr($cod, 0, 32);
	$id = substr($cod, (strlen($cod) - 32)-((strlen($cod) - 32)*2));
	$sql = "SELECT * FROM Usuario WHERE id_usuario = '$id'";
	conectar();
	$rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		$row = mysql_fetch_array($rs);
		if($row["baja"] == 0){
			if($row["password"] == $md5){
				$sql = "UPDATE Usuario SET baja = 0 WHERE id_usuario = '$id'";
				mysql_query($sql) or die(mysql_error());
				header("Location:index.php?cod=3");
			}
		}
	}
}
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
                        <h1>Congratulations!</h1>
                        <p>You have one more step to enjoy UnionMusic.<br />We've sent an email to your inbox to confirm your sign up.</p>
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
