<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Gastos - Login</title>
    <link  href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <center>
        <h2>INGRESO USUARIO</h2>
        <hr style="width: 40%;">
        <form action="../../controlador/ControladorUsuario.php" method="POST">
            <fieldset>
                <legend>Login usuario</legend>
                <table>
                    <tr>
                        <th class="etiqueta">CEDULA:</th>
                        <td><input type="number" required name="usr_cc" placeholder="Numero de cedula"></td>
                    </tr>
                    <tr>
                        <th class="etiqueta">PASSWORD:</th>
                        <td><input type="password" required name="usr_pass" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="2">
                            <input type="reset" value="LIMPIAR" class="button" >&nbsp;&nbsp;&nbsp;                        
                            <input type="submit" value="INGRESAR" name="accion" class="button">
                        </td>
                    </tr>
                    
                </table>
            </fieldset>
            <input name="msj" value="" type="hidden"> 
        </form> 
        <p class="text destacar"><?= @($_REQUEST["msj"]) ?  $_REQUEST["msj"] : "" ?></p>

        <p>Si aún no tienes cuenta ,puedes </p>
        <p><a href="registrar.php">Registrarte acá</a></p>
        <p><a href="../../index.php">Salir</a></p>

    </center>
</body>
</html>

