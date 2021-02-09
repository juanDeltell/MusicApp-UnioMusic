<?php
include_once("varConexion.php");

function conectar(){
	global $dbhost, $dbname, $dbuser, $dbpass;
	
	
	$dbconnection = mysql_pconnect( $dbhost, $dbuser, $dbpass) or die( mysql_error() );
	mysql_select_db( $dbname );
	mysql_query("SET NAMES 'utf8'");
}

function desconectar(){
	
	mysql_close();
}
?>
