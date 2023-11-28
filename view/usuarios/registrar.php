<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Gastos - Agregar Usuarios</title>
    <link  href="../css/style.css" rel="stylesheet">



</head>
<body>
    <center>
        <h2>REGISTRAR USUARIO</h2>
        <hr style="width: 40%;">
        <form action="../../controlador/ControladorUsuario.php" method="POST">
            <fieldset>
                <legend>Datos del usuario</legend>
                <table>
                    <tr>
                        <th class="etiqueta">CEDULA:</th>
                        <td><input type="number" required name="usr_cc" placeholder="Numero de cedula"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">PASSWORD:</th>
                        <td><input type="password" required name="usr_pass" placeholder="Contraseña"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">NOMBRES:</th>
                        <td><input type="text" required name="usr_nombre" placeholder="Nombres"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">APELLIDOS:</th>
                        <td><input type="text" required name="usr_apellido" placeholder="Apellidos"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">SEXO:</th>
                        <td>
                        
                        <select required name="usr_genero" id="usr_genero">
                          <optgroup label="Tradicional">
                            <option value="FEM">Femenino</option>
                            <option value="MAS">Masculino</option>
                          </optgroup>
                          <optgroup label="LGBTIQ+">
                            <option value="LES">LESBIANA</option>
                            <option value="GUE">GAY</option>
                            <option value="BIX">Bisexual</option>
                            <option value="TRA">Transexual</option>
                            <option value="BIX">Que</option>
                            <option value="CPP">Mas van a inventar</option>
                          </optgroup>

                        </select>                            
                        </td>
                    </tr>
                    <tr>
                        <th class="etiqueta">E-MAIL:</th>
                        <td><input type="email" required name="usr_email" placeholder="Correo"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="2">
                            <input type="reset" value="LIMPIAR" class="button" >&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="REGISTRAR" name="accion" class="button">
                        </td>
                    </tr>
                    
                </table>
            </fieldset>
        
        </form> 
        <p class="text destacar"><?= @($_REQUEST["msj"]) ?  $_REQUEST["msj"] : "" ?></p>
        <p><a href="login.php">Ingresa acá</a></p>
        <p><a href="../../index.php">Salir</a></p>

    </center>
    
</body>
</html>

