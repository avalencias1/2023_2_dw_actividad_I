<?php 
    include_once '../modelo/entidades/Usuario.php';      
    session_start();   
    //include_once '../modelo/entidades/Usuario.php';      
    $user_is_logged_in=@$_SESSION['user_is_logged_in'];
    //if no logueado enviarlo a loguearse
    if(!($user_is_logged_in=="OK")){ header('Location: ../index.php'); exit(); }
    $usr=unserialize(@$_SESSION["usuario"]);
    $nombres =@$usr->nombre_usr;
    $apellidos=@$usr->apellido_usr;
    $fullName=@$usr->nombre_usr . ' ' . @$usr->apellido_usr;
    #Traerme los gastos del usuario actual
    if (isset($_SESSION['gsts_lst'])) {
        $gst_lst=unserialize(@$_SESSION["gsts_lst"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Control de Gastos - Panel de Control </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../view/imagenes/icons/favicon.ico"/>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<!--
    <link href="../view/css/util.css"  rel="stylesheet" type="text/css">
	<link href="../view/css/main.css"  rel="stylesheet" type="text/css" >
    -->
    <link href="../view/css/style.css" rel="stylesheet" type="text/css" >

    <link href="../view/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">

          <p class="text destacar"> USUARIO LOGUEADO : <?= @$fullName ?></p>
          <table>                            
            <tr>                                
                <td>
                    <center>
                        <hr style="width: 50%;">
                        <h2>GESTOR DE GASTOS</h2>
                        <hr style="width: 50%;">
                        <div class="col-sm-6">
                            <img class="img_responsive" src="../view/imagenes/gastos_001.png">
                        </div>
                    </center>

                </td>
                <!--===<input type="submit" value="Consultar" /> ===-->
                <td>
                        <table>
                            <tr>
                                <td>
                                    <?php echo "<a href='../view/gastos/agregar.php?no=" . $usr->id_usr .  "'><button type='button' class='btn btn-success'>Agregar</button></a> ";?>
                                </td>
                            </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align:center;"><a href="../view/usuarios/logout.php">Salir</a></p>
                </td>
            </tr>

          </table>
          <p class="text destacar"><?= @($_REQUEST["msj"]) ?  $_REQUEST["msj"] : "" ?></p>

          <table cellSpacing=0 cellPadding=0 width=100% align=center border=1>
            <tr>
                <td>
                    <!--====================================================-->
                    <center>

                    <?php
                    // Include config file
                        if (!(empty($gst_lst))) {
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<th colspan='6' align='center'>Reporte de Gastos </th>";
                                    echo "<tr>";
                                        echo "<th scope='col'>#</th>";
                                        echo "<th scope='col'>Codigo</th>";
                                        echo "<th scope='col'>Fecha</th>";
                                        echo "<th scope='col'>Descripcion</th>";
                                        echo "<th scope='col'>Valor Neto</th>";
                                        echo "<th scope='col'>Lugar</th>";
                                        echo "<th scope='col'>ACCION</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                #Formateando numero                                
                                $nmbrfmt = numfmt_create( 'co_CO', NumberFormatter::CURRENCY );

                                #Formateando Fecha                                
                                $dttfmt = new IntlDateFormatter( "es-ES", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Bogota', 
                                                                 IntlDateFormatter::GREGORIAN, "dd/MM/yyyy");


                                foreach ($gst_lst as $idx => $gst){
                                    $cnt=$idx + 1;                                     
                                    echo "<tr>";
                                        echo "<th scope='row'>" . $cnt . "</th>";
                                        echo "<td>" . $gst->codigo_gst . "</td>";
                                        echo "<td>" . $dttfmt->format($gst->fecha_gst) . "</td>";
                                        echo "<td>" . $gst->descripcion_gst  . "</td>";
                                        echo "<td>" .  $nmbrfmt->format($gst->valortotalconiva_gst) . PHP_EOL  . "</td>";
                                        echo "<td>" . $gst->lugar_gst  . "</td>";
                                        echo "<td>";
                                            echo "<a href='../view/gastos/editar.php?Id_Gst=" . $gst->id_gst . "'><button type='button' class='btn btn-success'  name='EDITAR'>Editar</button> </a> ";
                                            echo "<a href='../view/gastos/eliminar.php?Id_Gst=" . $gst->id_gst ."'><button type='button' class='btn btn-danger' name='ELIMINAR'>Eliminar</button></a> ";

                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Fin recorrido
                        } else{
                            echo "<p class='lead'><em>No se encontraron gastos.</em></p>";
                        }
                    ?>
                    <!--====================================================-->

                    </center>
                </td>
            </tr>
          </table>
          <!--======-->
	</div>
</body>
</html>