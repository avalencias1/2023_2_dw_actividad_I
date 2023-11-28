<?php 
    include_once '../../modelo/entidades/Usuario.php';         
    include_once '../../modelo/entidades/Gasto.php';             
    session_start();       
    $user_is_logged_in=@$_SESSION["user_is_logged_in"];
    //if no logueado enviarlo a loguearse
    if(!($user_is_logged_in=="OK")){ header('Location: ../../index.php'); exit(); }    
    $usr=unserialize(@$_SESSION["usuario"]);      
     
    $idFake=@$usr->id_usr;

    $fullName=@$_SESSION["user_full_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Gastos  <?= " : USUARIO : " . @($fullName) ?> </title>
    <link  href="../css/style.css" rel="stylesheet">
</head>
<body>
    <center>
        <h2>REGISTRAR GASTO</h2>
        <hr style="width: 40%;">
        <p class="text destacar"><?= "USUARIO : " . @$usr->nombre_usr  . " " . $usr->apellido_usr ?></p>
        <hr style="width: 40%;">        
        <form action="../../controlador/ControladorGasto.php" method="POST">
            <fieldset>
                <legend>Datos del Gasto</legend>
                <table>
                    <tr>
                        <th class="etiqueta">CODIGO:</th>
                        <td>
                            <select required name="gst_codigo" id="gst_codigo">
                                <optgroup label="Servicios">
                                    <option value="LUZ">Luz</option>
                                    <option value="GAS">Gas</option>
                                    <option value="CBL">Cable</option>
                                    <option value="TLF">Telefono</option>
                                </optgroup>
                                <optgroup label="Vivienda">
                                    <option value="ALQ">Alquiler</option>
                                    <option value="EXP">expensas</option>
                                    <option value="CRH">crédito hipotecario</option>
                                    <option value="HSP">Hospedaje</option>
                                </optgroup>
                                <optgroup label="Viáticos">
                                    <option value="UBR">Uber</option>
                                    <option value="IND">Indriver</option>
                                    <option value="TAX">Taxi</option>
                                    <option value="CBF">Cabify hipotecario</option>
                                    <option value="TRN">Transporte</option>
                                </optgroup>
                                <optgroup label="Salud">
                                    <option value="UBR">Medicamentos</option>
                                    <option value="IND">Atención médico</option>
                                    <option value="TAX">Psicólogo</option>
                                </optgroup>
                                <optgroup label="Limpieza">
                                    <option value="HGR">Hogar</option>
                                    <option value="LVN">Lavander</option>
                                    <option value="PRD">Productos</option>
                                </optgroup>
                                <optgroup label="Impuestos">
                                    <option value="MNT">Monotributo</option>
                                    <option value="INB">Ingresos Brutos</option>
                                    <option value="ICA">ICA</option>
                                    <option value="IVA">IVA</option>
                                    <option value="RTF">Retefuente</option>
                                </optgroup>
                                <optgroup label="Alimentación">
                                    <option value="SPM">Supermercadoón</option>
                                    <option value="ALM">Almacén</option>
                                    <option value="DSP">Despensas</option>
                                    <option value="VRD">Verdulerías</option>
                                    <option value="CRN">Carnicería</option>
                                    <option value="MRS">Mariscos</option>
                                </optgroup>
                                <optgroup label="Indumentaria">
                                    <option value="ROP">Ropa</option>
                                    <option value="CLZ">Calzado</option>
                                    <option value="ACS">Accesorios</option>
                                </optgroup>
                                <optgroup label="Cuidado Personal">
                                    <option value="CRM">Cremas</option>
                                    <option value="MQL">Maquillaje</option>
                                    <option value="BLZ">Belleza</option>
                                    <option value="TRT">Tratamientos</option>
                                    <option value="PLQ">Peluquería</option>
                                </optgroup>
                                <optgroup label="Entretenimiento">
                                    <option value="CIN">cine</option>
                                    <option value="TTR">teatro</option>
                                    <option value="SLF">salidas en familia</option>
                                    <option value="CMF">COmidad</option>
                                </optgroup>                       
                            </select>                            
                        </td>
                    </tr>
                    <tr>
                        <th class="etiqueta">FECHA:</th>
                        <td><input type="date" required name="gst_fecha" placeholder="Fecha"></td>
                    </tr>

                    <tr>
                        <th class="etiqueta">VALOR:</th>
                        <td><input type="text" inputmode="numeric" required name="gst_valortotalsiniva" placeholder="Valor"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">% IVA:</th>
                        <td><input type="text" inputmode="numeric" required name="gst_ivatotal" placeholder="% Iva" min="0" max="100"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">TOTAL:</th>
                        <td><input type="text" inputmode="numeric" required name="gst_valortotalconiva" placeholder="valor + Iva"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">USUARIO:</th>
                        <td><input type="text" required name="gst_nombreusuario"  id="gst_nombreusuario" value="<?= $fullName ?>" ></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">LUGAR:</th>
                        <td><input type="text" required name="gst_lugar" placeholder="Lugar"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">DESCRIPCION:</th>
                        <td><input type="text" required name="gst_descripcion" placeholder="Descripcion"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="2">
                            <input type="reset" value="LIMPIAR" class="button" >&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="AGREGAR" name="accion" class="button">
                            <input type="hidden" name="gst_id_usr"   value="<?= @$usr->id_usr ?>" >
                            <input type="hidden" name="tkn_csrf"   value="<?= @$_SESSION["tkn_csrf"] ?>" >
                        </td>
                    </tr>
                    
                </table>
            </fieldset>
        
        </form> 
        <p class="text destacar"><?= @($_REQUEST["msj"]) ?  $_REQUEST["msj"] : "" ?></p>        
        <p><a href="../../util/main.php">Regresar</a></p>
        <p><a href="../usuarios/logout.php">Salir</a></p>

    </center>
    <center>

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Listado ded Gastos</h2>
                            <a href="create.php" class="btn btn-primary pull-right">Agregar Gasto</a>
                        </div>
                        <?php
                        // Attempt select query execution
                        $sql = "SELECT * FROM blog";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Head</th>";
                                            echo "<th>Content</th>";
                                            echo "<th>Tags</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['head'] . "</td>";
                                            echo "<td>" . substr($row["content"],0,15) . "</td>";
                                            echo "<td>" . $row['tags'] . "</td>";
                                            echo "<td>";
                                                echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                                echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "<p class='lead'><em>No Record Found.</em></p>";
                            }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                    </div>
                </div>        
            </div>
        </div>


    </center>
    
</body>
</html>

