<?php
session_name("UnionMusic");
session_start();

include_once("lib/accionesbbdd.php");

if(isset($_REQUEST["trackname"])){$trackname = $_REQUEST["trackname"];}
if(isset($_REQUEST["trackdesc"])){$trackdesc = $_REQUEST["trackdesc"];}
if(isset($_REQUEST["categoria"])){$categoria = $_REQUEST["categoria"];}
if(isset($_REQUEST["option"])){$option = $_REQUEST["option"];}
if(isset($_REQUEST["cod"])){$cod = $_REQUEST["cod"];}

if($option == "UpTrack"){
	if( !isset($_FILES['trackfile']) ){
	  echo "Error porque no se ha seleccionado ningún sonido";
	}else{
	  $nombre = $_FILES['trackfile']['name'];
	  $nombre_tmp = $_FILES['trackfile']['tmp_name'];
	  $tamano = $_FILES['trackfile']['size'];
	  $ext_permitidas = array('mp3','wav','ogg');
	  $partes_nombre = explode('.', $nombre);
	  $extension = $partes_nombre[1];
	  $nombreSinExt = $partes_nombre[0];
	  $ext_correcta = in_array($extension, $ext_permitidas);
	  $limite = 10000 * 1024;
	  if( $ext_correcta && $tamano <= $limite ){
	    if( $_FILES['trackfile']['error'] > 0 ){
	      echo 'Error: ' . $_FILES['trackfile']['error'] . '<br/>';
	    }else{
		if (!file_exists("user/".$_SESSION["iduser"])) {
			mkdir("user/".$_SESSION["iduser"], 0777);
			mkdir("user/".$_SESSION["iduser"]."/tracks", 0777);
			mkdir("user/".$_SESSION["iduser"]."/mixtapes", 0777);
		}
	      move_uploaded_file($nombre_tmp, "user/".$_SESSION["iduser"]."/tracks/".$nombre);
	      insertarPista($trackname, $trackdesc, $nombre, $tamano, $categoria);
		header("Location:home.php?option=2");
	    }
	  }else{
	    echo 'Archivo inválido';
	  }
	}
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
		

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        
        <!-- codigo para subir archivos-->
        
        <title>Upload File</title>      
        <meta charset="iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="estilosUploadFile.css" />
        <script type="text/javascript">
         
              function selectedFile() {
                var archivoSeleccionado = document.getElementById("myfile");
                var file = archivoSeleccionado.files[0];
                if (file) {
                    var fileSize = 0;
                    if (file.size > 1048576)
                        fileSize = (Math.round(file.size * 100 / 1048576) / 100).toString() + ' MB';
                    else
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + ' Kb';
         
                    var divfileSize = document.getElementById('fileSize');
                    var divfileType = document.getElementById('fileType');
                    divfileSize.innerHTML = 'Tamaño: ' + fileSize;
                    divfileType.innerHTML = 'Tipo: ' + file.type;
                     
                }
              }     
         
            function uploadFile(){
                //var url = "http://localhost/ReadMoveWebServices/WSUploadFile.asmx?op=UploadFile";     
                var url = "http://127.0.0.1/UnionMusic/tracks/";
                var archivoSeleccionado = document.getElementById("myfile");
                var file = archivoSeleccionado.files[0];
                var fd = new FormData();
                fd.append("archivo", file);
                var xmlHTTP= new XMLHttpRequest();              
                //xmlHTTP.upload.addEventListener("loadstart", loadStartFunction, false);
                xmlHTTP.upload.addEventListener("progress", progressFunction, false);
                xmlHTTP.addEventListener("load", transferCompleteFunction, false);
                xmlHTTP.addEventListener("error", uploadFailed, false);
                xmlHTTP.addEventListener("abort", uploadCanceled, false);               
                xmlHTTP.open("POST", url, true);
                //xmlHTTP.setRequestHeader('book_id','10');
                xmlHTTP.send(fd);
            }       
             
            function progressFunction(evt){
                var progressBar = document.getElementById("progressBar");
                var percentageDiv = document.getElementById("percentageCalc");
                if (evt.lengthComputable) {
                    progressBar.max = evt.total;
                    progressBar.value = evt.loaded;
                    percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";
                }
            }
             
            function loadStartFunction(evt){
                alert('Comenzando a subir el archivo');
            }
            function transferCompleteFunction(evt){
                alert('Transferencia completa');            
                var progressBar = document.getElementById("progressBar");
                var percentageDiv = document.getElementById("percentageCalc");
                progressBar.value = 100;
                percentageDiv.innerHTML = "100%";   
            }   
             
            function uploadFailed(evt) {
                alert("Hubo un error al subir el archivo.");
            }
     
            function uploadCanceled(evt) {
                alert("La operación se canceló o la conexión fue interrunpida.");
            }
             
                             
         
        </script>
        <!-- fin codigo para subir archivos-->
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
				<a class="btn btn-lg btn-orange" href="crearmaqueta.php" role="button">
					Create MixTape
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
                                <img  style="width: 80px;" src="images/subir-audio.png" alt="icon" />
                                <span class="templatemo-service-item-header">UPLOAD TRACK</span>
                            </div>
                            <table>
                            <tr>
                              <td>
                              <form class="contact_form" action="subirpista.php" method="post" enctype="multipart/form-data">
                              <div id="wrap"> 
            <div class="field"> 
                
                   
                        <input type="file" id="trackfile" name="trackfile" class="rm-input" onchange="selectedFile();"/>
                   	<input type="hidden" name="option" value="UpTrack" />
                   
                        <div id="fileSize"></div>
                  
                   
                        <div id="fileType"></div>
                   
                                    
               
            </div>
            <progress id="progressBar" value="0" max="100" class="rm-progress"></progress> 
            <div id="percentageCalc"></div>        
        </div>
</body>
                              </td>
                             
                              
                            </tr>       
                             <tr>
                             
   
      
          
           <input type="text" name="trackname"  placeholder="Track name" required />
      
      
          
           <textarea name="trackdesc" cols="40" rows="6" placeholder="Description" required ></textarea>
      
      
           <select name="categoria"> 
		<?php html_generos(); ?>
            </select>
      
         <input type="submit" value="Upload" class="templatemo-btn-read-more btn btn-orange" />
       <!--<input type="button" value="Subir Archivo" onClick="uploadFile()" class="templatemo-btn-read-more btn btn-orange" />-->
   
</form>

                             </tr>   
                             
                           
                           
                            </table>
                            <div class="text-center">
                            	
                            </div>
                            <br class="clearfix"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="col-md-4" style="margin-left: 150px;">
                        <div class="templatemo-service-item" >
                            <div>
                                <img style="width: 80px;" src="images/grabar-audio.png" alt="icon"/>
                                <span class="templatemo-service-item-header">RECORD TRACK</span>
                            </div>
							<table>
                              
                            <tr>
                              <td>
							  <script type="text/javascript" src="js/recorderWorker.js"> </script>
                              	<audio controls autoplay></audio>
		
		
		<input onClick="grabar()" class="templatemo-btn-read-more btn btn-orange" type="button" value="Record now" />
		<input onClick="parar()" class="templatemo-btn-read-more btn btn-orange"
 type="button" value="Stop & play" />

		<script>
			//Función en caso de error
			var error = function(e) {
				console.log('¡No pude grabarte!', e);
			};

			//Función cuando todo tenga exito
			var exito = function(s) {
				var context = new webkitAudioContext(); //Conectamos con nuestra entrada de audio
				var flujo = context.createMediaStreamSource(s); //Obtenemos el flujo de datos desde la fuente
				recorder = new Recorder(flujo); //Todo el flujo de datos lo pasamos a nuestra libreria para procesarlo en esta instancia
				recorder.record(); //Ejecutamos la función para procesarlo
			}

			//Convertirmos el objeto en URL
			window.URL = window.URL || window.webkitURL;
			navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

			var recorder; //Es nuestra variable para usar la libreria Recorder.js
			var audio = document.querySelector('audio'); //Seleccionamos la etiqueta audio para enviarte el audio y escucharla

			//Funcion para iniciar el grabado
			function grabar() {
				if (navigator.getUserMedia) { //Preguntamos si nuestro navegador es compatible con esta función que permite usar microfono o camara web
					navigator.getUserMedia({audio: true}, exito, error); //En caso de que si, habilitamos audio y se ejecutan las funciones, en caso de exito o error.
					document.querySelector('p').innerHTML = "Estamos grabando...";
				} else {
					console.log('¡Tu navegador no es compatible!, ¿No lo vas a acutalizar?'); //Si no es compatible, enviamos este mensaje.
				}
			}

			//Funcion para parar la grabación y escucharla
			function parar() {
				recorder.stop(); //Paramos la grabación
				recorder.exportWAV(function(s) { //Exportamos en formato WAV el audio 
					audio.src = window.URL.createObjectURL(s); //Y convertimos el valor devuelto en URL para pasarlo a nuestro reproductor.
				});
				document.querySelector('p').innerHTML = "Paramos la grabación y ahora escuchala...";
			}
		</script>
                              </td>
                             
                            </tr>
                            
                           
                            	
                            </table>
                            
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
