<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Cursos{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($name,$team_id){

	
	$sql="INSERT INTO cursos (name,salon_id) VALUES ('$name','$team_id')";
	
	
	return ejecutarConsulta($sql);
}

public function editar($id,$name,$team_id){
	$sql="UPDATE cursos SET name='$name',salon_id='$team_id' 
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){

	
	$sql="DELETE FROM cursos WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE cursos SET condicion='1' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM cursos WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar($team_id){
	$sql="SELECT id, name,salon_id FROM cursos WHERE salon_id='$team_id'";
	return ejecutarConsulta($sql);
}

public function verficar_curso($team_id){
	$sql="SELECT id,name, team_id FROM cursos  WHERE team_id='$team_id'";
		return ejecutarConsulta($sql);
}

public function listarc_nota(){
	$sql="SELECT * FROM cursos";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM cursos WHERE condicion=1";
	return ejecutarConsulta($sql);
}
}

 ?>
