<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
session_start();
$user_id=$_SESSION["idalumno"];

?>
</body>
</html>

<?php
//activamos almacenamiento en el buffer

require 'header_copy.php';


  require_once "../modelos/Consultas.php";
  $consulta = new Consultas();

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- PARA CURSOS -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="panel-body">
<?php $rspta=$consulta->cantidadCursos($user_id);
$colores = array("box box-success direct-chat direct-chat-success bg-green", "box box-primary direct-chat direct-chat-primary bg-aqua", "box box-warning direct-chat direct-chat-warning bg-yellow", "box box-danger direct-chat direct-chat-danger bg-red");
      while ($reg=$rspta->fetch_object()) {
        $idgrupo=$reg->id;
        $nombre_grupo=$reg->name;
        ?>


<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <!-- DIRECT CHAT SUCCESS -->
          <div class="<?php echo $colores[array_rand($colores)]; ?> collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $nombre_grupo; ?></h3>

              <div class="box-tools pull-right">
                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">

                    <?php
                    
                    $cursoId=$reg->id;
                    
                    ?>

                    <button class="btnAsistencias" onclick="window.location.href='listasis_copy.php'">VER ASISTENCIAS</button>
                    <button class="btnNotas" onclick="window.location.href='listasis_copy2.php?idgrupo=<?php echo $cursoId; ?>'">VER NOTAS</button>

                    
                  <!-- /.direct-chat-info -->
                  <!-- /.direct-chat-text -->
                </div>
              </div>
              <!--/.direct-chat-messages-->
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>


<?php } ?>


</div>

<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
require 'footer.php';
 ?>

<style>
  .btnAsistencias{
    background-color: green;
    margin-left: 27%;
    margin-top: 10%;
    margin-bottom: 5%;
    height: 50px;
  }
  .btnNotas{
    background-color: green;
    margin-left: 27%;
    margin-top: 10%;
    margin-bottom: 5%;
    height: 50px;
    width: 43%;
  }
</style>




