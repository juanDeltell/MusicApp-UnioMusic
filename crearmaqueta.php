<?php
session_name("UnionMusic");
session_start();

include_once("lib/accionesbbdd.php");
$cod="";
if(isset($_REQUEST["nombreMaqueta"])){$nombreMaqueta = $_REQUEST["nombreMaqueta"];}
if(isset($_REQUEST["idPista1"])){$idPista1 = $_REQUEST["idPista1"];}
if(isset($_REQUEST["idPista2"])){$idPista2 = $_REQUEST["idPista2"];}
if(isset($_REQUEST["tipoPista1"])){$tipoPista1 = $_REQUEST["tipoPista1"];}
if(isset($_REQUEST["tipoPista2"])){$tipoPista2 = $_REQUEST["tipoPista2"];}
if(isset($_REQUEST["categoria"])){$categoria = $_REQUEST["categoria"];}
if(isset($_REQUEST["cod"])){$cod = $_REQUEST["cod"];}

if($cod == "crearmaqueta"){
	conectar();
	if($tipoPista1 == "tracks") $sql = "SELECT sonido, fk_propietario FROM Pista WHERE id_pista = ".$idPista1;
	else $sql = "SELECT sonido, fk_propietario FROM Maqueta WHERE id_maqueta = ".$idPista1;
	$rs = mysql_query($sql) or die(mysql_error());
	$row1 = mysql_fetch_array($rs);
	if($tipoPista2 == "tracks") $sql = "SELECT sonido, fk_propietario FROM Pista WHERE id_pista = ".$idPista2;
	else $sql = "SELECT sonido, fk_propietario FROM Maqueta WHERE id_maqueta = ".$idPista2;
	$rs = mysql_query($sql) or die(mysql_error());
	$row2 = mysql_fetch_array($rs);

	if (!file_exists("user/".$_SESSION["iduser"])) {
		mkdir("user/".$_SESSION["iduser"], 0777);
		mkdir("user/".$_SESSION["iduser"]."/tracks", 0777);
		mkdir("user/".$_SESSION["iduser"]."/mixtapes", 0777);
	}

	$basedir = dirname(__DIR__);
 
	$file1 = $basedir."/UnionMusic/user/".$row1['fk_propietario']."/".$tipoPista1."/".$row1['sonido'];
	$file2 = $basedir."/UnionMusic/user/".$row2['fk_propietario']."/".$tipoPista2."/".$row2['sonido'];
	$fileOut = $basedir."/UnionMusic/user/".$_SESSION['iduser']."/mixtapes/".$nombreMaqueta.".mp3";

	shell_exec("./sh/mezclar.sh $file1 $file2 $fileOut");

	$idMaqueta = insertarMaqueta($nombreMaqueta, $nombreMaqueta.".mp3", 0, $categoria);
	relacionarPistaMaqueta($idPista1, $idMaqueta, $tipoPista1);
	relacionarPistaMaqueta($idPista2, $idMaqueta, $tipoPista2);

	header("Location:home.php?option=1");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UNIONMUSIC</title>
        <meta name="keywords" content="urbanic, responsive, bootstrap, fluid layout, orange, white, free website template, templatemo" />
		<meta name="description" content="Urbanic is free responsive template using Bootstrap which is compatible with mobile devices. This layout is provided by templatemo for free of charge." />
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
	<script type="text/javascript">
              function anadirPista(id, titulo, tipo) {
			if(document.getElementById("nombrePista1").innerHTML.indexOf("Select track or mixtape") >= 0){
				document.getElementById("nombrePista1").innerHTML = titulo;
				document.getElementById("idPista1").value = id;
				document.getElementById("tipoPista1").value = tipo;
			}else if(document.getElementById("nombrePista2").innerHTML.indexOf("Select track or mixtape") >= 0){
				document.getElementById("nombrePista2").innerHTML = titulo;
				document.getElementById("idPista2").value = id;
				document.getElementById("tipoPista2").value = tipo;
				document.getElementById("reprMaqueta").style.display = "block";
			}else{
				document.getElementById("nombrePista1").innerHTML = titulo;
				document.getElementById("idPista1").value = id;
				document.getElementById("tipoPista2").value = tipo;
				document.getElementById("nombrePista2").innerHTML = "Select track or mixtape";
				document.getElementById("idPista2").value = "0";
				document.getElementById("tipoPista1").value = "";
				document.getElementById("reprMaqueta").style.display = "none";
			}
			
              }    

	      function reproducirMaqueta(){
			if(document.getElementById("reprMaqueta").innerHTML.indexOf("Play") >= 0){
				if(document.getElementById("tipoPista1").value.indexOf("tracks") >= 0)
					document.getElementById("pista" + document.getElementById("idPista1").value).play();
				else
					document.getElementById("maqueta" + document.getElementById("idPista1").value).play();
				if(document.getElementById("tipoPista2").value.indexOf("mixtapes") >= 0)
					document.getElementById("maqueta" + document.getElementById("idPista2").value).play();
				else
					document.getElementById("pista" + document.getElementById("idPista2").value).play();
				document.getElementById("reprMaqueta").innerHTML = "Stop";
			}else{
				if(document.getElementById("tipoPista1").value.indexOf("tracks") >= 0)
					document.getElementById("pista" + document.getElementById("idPista1").value).load();
				else
					document.getElementById("maqueta" + document.getElementById("idPista1").value).load();
				if(document.getElementById("tipoPista2").value.indexOf("tracks") >= 0)
					document.getElementById("pista" + document.getElementById("idPista2").value).load();
				else
					document.getElementById("maqueta" + document.getElementById("idPista2").value).load();
				document.getElementById("reprMaqueta").innerHTML = "Play";
			}
	      } 
	</script>
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
                                <a class="navbar-brand" href="http://unionmusic.comuf.com/" rel="nofollow">
                                <img src="images/logo2_naranja_rojo_vinil.png" alt="logo"/></a>
                        </div>
                        <div class="carousel-indicators" style="margin-bottom: -5px; margin-left: 130px;">	
			<p>
				<a class="btn btn-lg btn-green" href="home.php" role="button">
					Home
				</a> 
				<a class="btn btn-lg btn-orange" href="subirpista.php" role="button">
					Add Track
				</a>
			</p>
		</div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </div><!--/.navbar -->
            </div> <!-- /container -->
        </div>
        
        
        
        <div class="templatemo-service" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="templatemo-service-item">
                            <div>
                                <img  style="width: 80px;" src="images/mis-audios.png" alt="icon" />
                                <span class="templatemo-service-item-header">MY TRACKS</span>
                            </div>
                            <table>
                            <tr>
                              <td><strong>Name</strong></td>
                              <td><strong>Gender</strong></td>
                              <td><strong>Size</strong></td>
                              
                            </tr>
			    <?php
                            $sql = "SELECT id_pista, titulo, duracion, sonido, Genero.nombre AS genero FROM Pista INNER JOIN Genero ON id_genero = fk_genero WHERE fk_propietario = ".$_SESSION["iduser"];
			    conectar();
			    $rs = mysql_query($sql) or die(mysql_error());
			    while($row = mysql_fetch_array($rs)){ ?>
				<tr>
		                      	<td><?php echo $row["titulo"]; ?></td>
		                      	<td><?php echo $row["genero"]; ?></td>
		                      	<td><?php echo $row["duracion"]; ?></td>
		                      	<td><a rel="nofollow" class="templatemo-btn-read-more btn btn-orange" href="#" onclick="anadirPista(<?php echo $row['id_pista']; ?>, '<?php echo $row['titulo']; ?>', 'tracks');">Select</a></td>
		                    
				</tr>      
				<tr>
		                    	<td colspan="3px">
		                      		<audio id="pista<?php echo $row['id_pista']; ?>" controls>
		                      			<source src="user/<?php echo $_SESSION['iduser']; ?>/tracks/<?php echo $row['sonido']; ?>" type="audio/mp3">
						</audio>
					</td>
				</tr>
				<?php
			    }
                            ?>
                            </table>
                            <div class="text-center">
                            	
                            </div>
                            <br class="clearfix"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>

		    <div class="col-md-4">
                        <div class="templatemo-service-item">
                            <div>
                                <img  style="width: 80px;" src="images/mis-audios.png" alt="icon" />
                                <span class="templatemo-service-item-header">MY MIXTAPES</span>
                            </div>
                            <table>
                            <tr>
                              <td><strong>Name</strong></td>
                              <td><strong>Gender</strong></td>
                              <td><strong>Size</strong></td>
                              
                            </tr>
			    <?php
                            $sql = "SELECT id_maqueta, titulo, duracion, sonido, Genero.nombre AS genero FROM Maqueta INNER JOIN Genero ON id_genero = fk_genero WHERE fk_propietario = ".$_SESSION["iduser"];
			    conectar();
			    $rs = mysql_query($sql) or die(mysql_error());
			    while($row = mysql_fetch_array($rs)){ ?>
				<tr>
		                      	<td><?php echo $row["titulo"]; ?></td>
		                      	<td><?php echo $row["genero"]; ?></td>
		                      	<td><?php echo $row["duracion"]; ?></td>
		                      	<td><a rel="nofollow" class="templatemo-btn-read-more btn btn-orange" href="#" onclick="anadirPista(<?php echo $row['id_maqueta']; ?>, '<?php echo $row['titulo']; ?>', 'mixtapes');">Select</a></td>
		                    
				</tr>      
				<tr>
		                    	<td colspan="3px">
		                      		<audio id="maqueta<?php echo $row['id_maqueta']; ?>" controls>
		                      			<source src="user/<?php echo $_SESSION['iduser']; ?>/mixtapes/<?php echo $row['sonido']; ?>" type="audio/mp3">
						</audio>
					</td>
				</tr>
				<?php
			    }
                            ?>
                            </table>
                            <div class="text-center">
                            	
                            </div>
                            <br class="clearfix"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="templatemo-service-item" >
                            <div>
                                <img style="width: 80px;" src="images/mezclar-audios.png" alt="icon"/>
                                <span class="templatemo-service-item-header">MIXER</span>
                            </div>
				<form action="crearmaqueta.php" method="post">	
							<table>
                              
                            <tr>
                              <td><strong>Audio 1:</strong></td>
                             
                            </tr>
                            
                            <tr>
                              <td><span id ="nombrePista1">Select track or mixtape</span></td>
                             
                              
                            </tr>
                             <tr>
                              <td><strong>Audio 2:</strong></td>
                             
                            </tr>
                             <tr>
                              <td><span id ="nombrePista2">Select track or mixtape</span></td>
                              
                             
                            </tr>
			    <tr><td><a id="reprMaqueta" rel="nofollow" href="#" style="display: none;" onclick="reproducirMaqueta();" 
                                	class="templatemo-btn-read-more btn btn-orange">Play</a></td></tr>
				<tr>
                              <td><strong>Mixtape name:</strong></td>
                            </tr>
                              <tr>
                              <td>	
                                <input type="text" name="nombreMaqueta" placeholder="Type name of the mixtape" value="">
				<input type="hidden" id="idPista1" name="idPista1" value="0">
				<input type="hidden" id="idPista2" name="idPista2" value="0">
				<input type="hidden" id="tipoPista1" name="tipoPista1" value="">
				<input type="hidden" id="tipoPista2" name="tipoPista2" value="">
				<input type="hidden" id="cod" name="cod" value="crearmaqueta">                    
                              </td>
                              
                             
                            </tr>
				<tr>
                              <td><strong>Gender:</strong></td>
                            </tr>
				<tr><td><select name="categoria"> 
					<?php html_generos(); ?>
				</select></td></tr>

				<tr><td><br />
                                <input type="submit" class="templatemo-btn-read-more btn btn-orange" style="width: 100%;" value="Mix Audios" />
				</td></tr>
                            	
                            </table>
                            </form> 
                            <br class="clearfix"/>
                        </div>
                        
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
<!-- 
    Free Responsive Template from templatemo
    http://www.templatemo.com
-->
