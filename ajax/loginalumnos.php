<?php 
session_start();
require_once "../modelos/Alumnos.php";
$alumnos=new Alumnos();
switch ($_GET["op"]) {



		case 'verificar':

			//validar si el alumno tiene acceso al sistema
			$logina=$_POST['logina'];
			$clavea=$_POST['clavea'];
			//Hash SHA256 en la contraseña
			//$clavehash=hash("SHA256", $clavea);
		
			$rspta=$alumnos->verificar($logina, $clavea);
	
			$fetch=$rspta->fetch_object();
	
			if (isset($fetch)) 
			{
				
				// # Declaramos la variables de sesion
				$_SESSION['idalumno']=$fetch->id;
				$_SESSION['name']=$fetch->name;
				$_SESSION['image']=$fetch->image;
				

				// $_SESSION['nombre']=$fetch->nombre;
				// $_SESSION['imagen']=$fetch->imagen;
				// $_SESSION['login']=$fetch->login;
				// $_SESSION['cargo']=$fetch->cargo;

				// //obtenemos los permisos
				// $marcados = $usuario->listarmarcados($fetch->idusuario);

				// //declaramos el array para almacenar todos los permisos
				// $valores=array();

				// //almacenamos los permisos marcados en al array
				// while ($per = $marcados->fetch_object()) 
				// {
				// 	array_push($valores, $per->idpermiso);
				// }

				// //determinamos lo accesos al usuario
				// in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
				// in_array(2, $valores)?$_SESSION['grupos']=1:$_SESSION['grupos']=0;
				// in_array(3, $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
				
					
			}
			else
			{
				
				// $_SESSION['nombre']="mapy";
	
			}
			header('Content-type: application/json');
		
			echo json_encode($fetch);
	
		break;

		case 'lista_asistencia2':
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
			$alumn_id=$_REQUEST["alumn_id"];
	
			$range = 0;
			if($fecha_inicio<=$fecha_fin){
				$range= ((strtotime($fecha_fin)-strtotime($fecha_inicio))+(24*60*60)) /(24*60*60);
				if($range>31){
					echo "<p class='alert alert-warning'>El Rango Maximo es 31 Dias.</p>";
					exit(0);
				}
			}else{
				echo "<p class='alert alert-danger'>Rango Invalido</p>";
				exit(0);
			}
	
			require_once "../modelos/Alumnos.php";
			$alumnos=new Alumnos();
			$alumn_id=$_REQUEST["alumn_id"];
			$rsptav=$alumnos->verficar_alumno2($alumn_id);
	
	
			if(!empty($rsptav)){
				// si hay usuarios
				?>
	
			<table id="dataw" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<?php for($i=0;$i<$range;$i++){?>
					<th>
					<?php echo date("d-M",strtotime($fecha_inicio)+($i*(24*60*60)));?>
					</th>
					<?php }?>
				</thead>
				<?php         
					?>
					<tr>
						<?php
						//$reg=$rsptav->fetch_object()
						?>
						<td style="width:250px;"><?php print_r($rsptav['name'])." ".print_r($rsptav['lastname']); ?></td>
						<?php 
						for($i=0;$i<$range;$i++){
						$date_at= date("Y-m-d",strtotime($fecha_inicio)+($i*(24*60*60)));
						$idX=$rsptav['id'];
						$team_idX=$rsptav['salon_id'];
						$cual = $rsptav['name']
;						echo '<script>';
						echo 'console.log('. "sddfbhdfsg" .')';
						echo 'console.log('. $cual .')';
						echo 'console.log('. $idX .')';
						echo 'console.log('. $team_idX .')';
						echo '</script>';
						$asist=$alumnos->listar_asistencia2($idX,$team_idX,$date_at);
						
						$regc=$asist->fetch_object();
						
						?> 
						<td >
						<?php
						if($regc!=null){
							if($regc->kind_id==1){ echo "<strong>A</stron>"; }
							else if($regc->kind_id==2){ echo "<strong>T</stron>"; }
							else if($regc->kind_id==3){ echo "<strong>F</stron>"; }
							else if($regc->kind_id==4){ echo "<strong>P</stron>"; }
							
						}   
						?>
	
						</td>
						<?php } ?>
					</tr>
			</table>
			<?php
	
			}else{
				echo "<p class='alert alert-danger'>No hay Alumnos</p>";
			}
			?>
	
			<script type="text/javascript">         
				tabla=$('#dataw').DataTable( {
					dom: 'Bfrtip',
					buttons: [
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdf'
						]
					} );
			</script>
			<?php	
		break;

		case 'listar_calificacion':

			require_once "../modelos/Alumnos.php";
			$alumnos=new Alumnos();
			$alumn_id=$_REQUEST["alumn_id"];
			$idgrupo=$_REQUEST["cursoAlum"];
			$rsptav=$alumnos->verficar_alumno2($alumn_id);


		 //           $rsptacurso=$cursos->verficar_curso($team_id);
	
			if(!empty($rsptav)){
	
				$rspta=$alumnos->listar_calif2($alumn_id,$idgrupo);
				$row=mysqli_fetch_array($rspta);
				
				
				// si hay usuarios
				?>

			<table id="datax" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				<th>Nombre</th>
				<th>Apellidos </th> 
				<th>Nota </th> 	
		
			</thead>
			<tbody>
			<tr>
				<td><?php	echo $row['name'];?></td>
				<td><?php	echo $row['lastname'];?></td>
				<td><?php	echo $row['val'];?></td>
			</tr>

			</tbody>
				<?php

				//OBTENEMOS LOS DATOS DEL ALUMNO
			
				
				while ($reg=$rspta->fetch_object()) {
					
					?>
					<tr>
					<td><?php echo $reg->name." hoa".$reg->lastname; ?></td>
					<td><?php echo $reg->val; ?></td>
				   <?php } ?>
	
	
					</tr>
	
					<?php

				}
			else{
				echo "<p class='alert alert-danger'>No hay Alumnos</p>";
			}?>
			</table>

			<script type="text/javascript">         
				tabla=$('#datax').DataTable( {
					dom: 'Bfrtip',
					buttons: [
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdf'
						]
					} );
			</script>
	<?php
	
	
		break;
		
		}

 ?>