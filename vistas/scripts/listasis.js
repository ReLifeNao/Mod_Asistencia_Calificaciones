var tabla;

//funcion que se ejecuta al inicio
function init(){

   listar();
   listarAlumn();
   listarc();
   listar_calificacion();
   listar_calificacionAlumn();
   $("#fecha_inicio").change(listar);
   $("#fecha_fin").change(listar);

   $("#fecha_inicioc").change(listarc);
   $("#fecha_finc").change(listarc);

   $("#fecha_inicioA").change(listarAlumn);
   $("#fecha_finA").change(listarAlumn);

   $("#fecha_inicioB").change(listar_calificacionAlumn);
   $("#fecha_finB").change(listar_calificacionAlumn);

}

//funcion listar asistencia
function listar(){
	var  fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
	var  team_id = $("#idgrupo").val();
	$.post("../ajax/consultas.php?op=lista_asistencia",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, idgrupo:team_id},
		function(data,status)
		{
			console.log(data);
			$("#data").html(data);
		})
}
//funcion listar asistencia por alumno
function listarAlumn(){
	var  fecha_inicio = $("#fecha_inicioA").val();
    var fecha_fin = $("#fecha_finA").val();
	var  alumn_id = $("#alumn_id").val();
	$.post("../ajax/loginalumnos.php?op=lista_asistencia2",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, alumn_id:alumn_id},
		function(data,status)
		{
			
			console.log(data);
			$("#data2").html(data);
		})
}

//funcion listar comportamiento
function listarc(){
	var  fecha_inicio = $("#fecha_inicioc").val();
    var fecha_fin = $("#fecha_finc").val();
	var  team_id = $("#idgrupo").val();
	$.post("../ajax/consultas.php?op=lista_comportamiento",{fecha_inicioc:fecha_inicio, fecha_finc:fecha_fin, idgrupo:team_id},
		function(data,status)
		{
			console.log(data);
			$("#datac").html(data);
		})
}

//funcion listar comportamiento
function listar_calificacion(){
 
	var  team_id = $("#idgrupo").val();
	$.post("../ajax/consultas.php?op=listar_calificacion",{idgrupo:team_id},
		function(data,status)
		{
			console.log(data);
			$("#datacalif").html(data);
		})
}

function listar_calificacionAlumn(){
 
	var  alumn_id = $("#idgrupo").val();
	$.post("../ajax/loginalumnos.php?op=listar_calificacion",{idgrupo:alumn_id},
		function(data,status)
		{
			
			console.log(data);
			$("#datacalifA").html(data);
		})
}


init();



