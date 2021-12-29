<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Alumnos{


	//implementamos nuestro constructor
public function __construct(){

} 
//metodo insertar regiustro
public function insertar($image,$name,$lastname,$email,$address,$phone,$c1_fullname,$c1_address,$c1_phone,$c1_note,$user_id,$team_id,$dni,$cuenta,$password){
	$sql="INSERT INTO alumno (image,name,lastname,email,address,phone,is_active,user_id,dni,cuenta,password)
	 VALUES ('$image','$name','$lastname','$email','$address','$phone','1','$user_id','$dni','$cuenta','$password')";
	

	 $idalumno_new=ejecutarConsulta_retornarID($sql);
	 $sw=true;
	 	$sql_detalle="INSERT INTO salon_alumno (alumn_id, salon_id) VALUES('$idalumno_new','$team_id')";

	 	ejecutarConsulta($sql_detalle) or $sw=false; 

	 return $sw;

}


public function editar($id,$image,$name,$lastname,$email,$address,$phone,$c1_fullname,$c1_address,$c1_phone,$c1_note,$user_id,$team_id,$dni,$cuenta,$password){
	$sql="UPDATE alumno SET image='$image',name='$name', lastname='$lastname',email='$email',address='$address',phone='$phone' ,user_id='$user_id',dni='$dni',cuenta='$cuenta',password='$password'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}

public function desactivar($id){

	$sql2="DELETE FROM salon_alumno WHERE alumn_id='$id'";
	ejecutarConsulta($sql2);


	$sql="DELETE FROM alumno WHERE id='$id'";
	return ejecutarConsulta($sql);
}



public function activar($id){
	$sql="UPDATE alumno SET condicion='1' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
 
//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM alumno WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar($user_id, $team_id){
	$sql="SELECT a.id,a.image,a.name,a.lastname,a.email,a.address,a.phone,a.is_active, a.user_id, a.dni FROM alumno a INNER JOIN salon_alumno alt ON a.id=alt.alumn_id WHERE a.is_active=1 AND a.user_id='$user_id' AND alt.salon_id='$team_id' ORDER BY a.id DESC ";
	return ejecutarConsulta($sql);
}


public function verficar_alumno($user_id, $team_id){
	$sql="SELECT * FROM alumno a INNER JOIN salon_alumno alt ON a.id=alt.alumn_id WHERE a.is_active=1 AND a.user_id='$user_id' AND alt.salon_id='$team_id' ORDER BY a.id DESC ";
	return ejecutarConsultaSimpleFila($sql);
}

public function verficar_alumno2($alumn_id){

	$sql="SELECT alumno.id, alumno.name, alumno.lastname,salon_alumno.salon_id FROM alumno INNER JOIN salon_alumno ON salon_alumno.alumn_id=alumno.id WHERE alumno.id = '$alumn_id'";
	return ejecutarConsultaSimpleFila($sql);
	
}


public function listar_calif($user_id, $team_id){
	$sql="SELECT a.id AS idalumn,a.image,a.name,a.lastname,a.email,a.address,a.phone, a.is_active, a.user_id FROM alumno a INNER JOIN salon_alumno alt ON a.id=alt.alumn_id WHERE a.is_active=1 AND a.user_id='$user_id' AND alt.salon_id='$team_id' ORDER BY a.id DESC ";
	return ejecutarConsulta($sql); 
}

public function listar_calif2($alumn_id, $idgrupo){

	
	$sql="SELECT alumno.name,alumno.lastname,notas.val FROM alumno INNER JOIN notas ON alumno.id = notas.alumn_id WHERE alumn_id='$alumn_id' AND notas.cursos_id='$idgrupo'";
	return ejecutarConsulta($sql); 
}



public function verificar($login,$clave)
    {
    	$sql="SELECT * FROM alumno WHERE cuenta='$login' AND password='$clave' "; 
    	return ejecutarConsulta($sql);  
    }
//listar asistencia por alumno
public function listar_asistencia2($alumn_id,$team_id,$date_at){
	$sql="SELECT * FROM asistencia a INNER JOIN alumno p ON a.alumn_id=p.id INNER JOIN salones t ON a.salon_id=t.idsalon  WHERE a.alumn_id='$alumn_id' AND a.salon_id='$team_id' AND a.date_at='$date_at'";
	return ejecutarConsulta($sql);
}






public function mostrarAdminAlumnos($idgrupo){
	$sql="SELECT * FROM salones WHERE idsalon='$idgrupo'";
	return ejecutarConsultaSimpleFila($sql);
}



//implementar un metodo para listar los activos, su ultimo precio y el stock(vamos unir con el ultimo registro de la tabla detalle_ingreso)

}
 ?>
