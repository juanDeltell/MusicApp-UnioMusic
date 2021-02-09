<?php
include_once("conexion.php");

function insertarUsuario($firstname, $lastname, $birthday, $sex, $username, $email, $pass){
	conectar();
	$firstname = ucwords(strip_tags($firstname));
	$lastname = ucwords(strip_tags($lastname));
	$sql = "INSERT INTO Usuario(nombre, apellidos, correo, nombre_user, password, fecha_nacimiento, foto, sexo, popularidad, time, baja, baneado, administrador) VALUES ('$firstname','$lastname','$email','$username', '".md5($pass)."', '$birthday', '', '$sex', 0, '".microtime(true)."', 1, 0, 0)";
	mysql_query($sql) or die(mysql_error());
	return mysql_insert_id();
}

function iniciarSesion($user, $pass){
	$sql = "SELECT * FROM Usuario WHERE (nombre_user = '$user' OR correo = '$user') AND password = '".md5($pass)."' LIMIT 1";
	conectar();
	$rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		$row = mysql_fetch_array($rs);
		if($row["baja"] == 0){
			$_SESSION["iduser"] = $row["id_usuario"];
			$_SESSION["nomuser"] = $row["nombre"];
		}else{
			return 2;
		}
	}else{
		return 1;
	}
	mysql_free_result($rs);
	desconectar();
	return 0;
}

function html_generos(){
	$sql = "SELECT id_genero, nombre FROM Genero";
	conectar();
	$rs = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_array($rs)){
		echo '<option value="'.$row["id_genero"].'">'.$row["nombre"].'</option>';
	}
}

function insertarPista($titulo, $descripcion, $sonido, $tamano, $genero){
	conectar();
	$sql = "INSERT INTO Pista(titulo, descripcion, sonido, num_reproducciones, duracion, fk_genero, time, en_uso, fk_propietario) VALUES ('$titulo', '$descripcion', '$sonido', 0, '$tamano', '$genero', '".microtime(true)."', 1, ".$_SESSION["iduser"].")";
	mysql_query($sql) or die(mysql_error());
	return mysql_insert_id();
}

function insertarMaqueta($titulo, $sonido, $tamano, $genero){
	conectar();
	$sql = "INSERT INTO Maqueta(titulo, sonido, num_reproducciones, duracion, fk_genero, time, en_uso, fk_propietario, popularidad) VALUES ('$titulo', '$sonido', 0, '$tamano', '$genero', '".microtime(true)."', 1, ".$_SESSION["iduser"].", 0)";
	mysql_query($sql) or die(mysql_error());
	return mysql_insert_id();
}

function relacionarPistaMaqueta($idPista, $idMaqueta, $tipoPista){
	conectar();
	if($tipoPista == "tracks"){
		$sql = "INSERT INTO Composicion VALUES ($idPista, $idMaqueta)";
		mysql_query($sql);
	}else{
		$sql = "SELECT fk_pista FROM Composicion WHERE fk_maqueta = $idPista";
		$rs = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_array($rs)){
			$sql2 = "INSERT INTO Composicion VALUES (".$row["fk_pista"].", $idMaqueta)";
			mysql_query($sql2);
		}
	}
}
?>
