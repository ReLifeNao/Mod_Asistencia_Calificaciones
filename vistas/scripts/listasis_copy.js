var tabla;

//funcion que se ejecuta al inicio
function init(){

   listar_calificacionAlumn();
   

   
}

function listar_calificacionAlumn(){
 
	var  alumn_id = $("#alumn_id").val();
	var cursoAlum = $("#idgrupo").val();
	
	$.post("../ajax/loginalumnos.php?op=listar_calificacion",{alumn_id:alumn_id, cursoAlum:cursoAlum},
		function(data,status)
		{
			console.log(data);
			$("#data2").html(data);
		})
}












init();



