<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Usuario.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Gasto.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudUsuario.php';

$accion="ALL";

switch ($accion) {


    case "P":
        echo "\$accion MOSTRANDO VARIABLES DEL SISTEMA";

        var_dump($_SERVER); 

        break;


    case "C":
        echo "\$accion PROBANDO CREAR <br>";

        $usr = new Usuario();
        $usr->cc_usr = '1234567805';
        $usr->pass_usr = 'w28903K6';
        $usr->nombre_usr = 'Nereida';
        $usr->apellido_usr = 'Rivas';
        $usr->genero_usr = 'FEM';
        $usr->email_usr = 'nere@yahoo.es';
        
        try {
            CrudUsuario::guardar($usr);
            echo "Usuario guardado "; 
            echo "Total registros :" . CrudUsuario::contar(); 
        } catch (exception $error) {
            echo  "Error al guardar el usuario <br>Detalles : " . $error->getMessage();
        }

        break;
    case "R":
        echo "\$accion PROBANDO BUSCAR <br>";
     
        echo "\$accion PROBANDO BUSCANDO POR CEDULA <br>";

        $cc="1234567801";   
        $usr = CrudUsuario::buscar_x_cc($cc);
        
        echo "Nombre : " .  $usr->nombre_usr  . " <br>";
        echo "Apellidos : " . $usr->apellido_usr . " <br>";
        echo "Correo : " . $usr->email_usr ." <br>";
        


        echo "\$accion PROBANDO BUSCANDO POR ID <br>";

        $id="1";   


        $usr = CrudUsuario::buscar_x_id(array($id));
        
        echo "Nombre : " .  $usr->nombre_usr  . " <br>";
        echo "Apellidos : " . $usr->apellido_usr . " <br>";
        echo "Correo : " . $usr->email_usr ." <br>";

        
        echo "\$accion PROBANDO BUSCANDO POR ID <br>";

        $id="2";   

        
        $usr = CrudUsuario::buscar_x_id(array($id));
        
        echo "Nombre : " .  $usr->nombre_usr  . " <br>";
        echo "Apellidos : " . $usr->apellido_usr . " <br>";
        echo "Correo : " . $usr->email_usr ." <br>";


        //$usr->cc_usr = '1234567801';
        //$usr->pass_usr = '123abc*';
        //$usr->nombre_usr = 'Maria del Carmen';
        //$usr->apellido_usr = 'Mercado Vanegas';
        //$usr->genero_usr = 'FEM';
        //$usr->email_usr = 'rocio@gmail.es';
        
        try {
            CrudUsuario::editar($usr);
            echo "Registro modificado  <br>" ; 
            echo "Total registros encontrados :" . CrudUsuario::contar(); 
        } catch (exception $error) {
            throw new Exception("Error al guardar el usuario <br>Detalles : " . $error->getMessage());
        }



        break;
    case "U":
        echo "\$accion PROBANDO ACTUALIZAR <br>";

        $usr = CrudUsuario::buscar_x_cc("1234567803");
        //$usr->cc_usr = '1234567801';
        //$usr->pass_usr = '123abc*';
        $usr->nombre_usr = 'Rosa Maria';
        //$usr->apellido_usr = 'Mercado Vanegas';
        //$usr->genero_usr = 'FEM';
        //$usr->email_usr = 'rocio@gmail.es';
        
        try {
            CrudUsuario::editar($usr);
            echo "Registro modificado  <br>" ; 
            echo "Total registros encontrados :" . CrudUsuario::contar(); 
        } catch (exception $error) {
            throw new Exception("Error al guardar el usuario <br>Detalles : " . $error->getMessage());
        }




        break;
    case "D":
        echo "\$accion PROBANDO ELIMINAR <br>";


        $usr = CrudUsuario::buscar_x_cc("1234567801");
        //$usr->cc_usr = '1234567801';
        //$usr->pass_usr = '123abc*';
        //$usr->nombre_usr = 'Rosa Maria';
        //$usr->apellido_usr = 'Mercado Vanegas';
        //$usr->genero_usr = 'FEM';
        //$usr->email_usr = 'rocio@gmail.es';
        
        try {
            CrudUsuario::eliminar($usr);
            echo "Registro eliminado :" . CrudUsuario::contar(); 
        } catch (exception $error) {
            throw new Exception("Error al guardar el usuario <br>Detalles : " . $error->getMessage());
        }

        break;
    case "ALL":
        echo "***LISTANDO TODOS LOS REGISTROS*** <br>";
        //$usr->cc_usr = '1234567801';
        //$usr->pass_usr = '123abc*';
        //$usr->nombre_usr = 'Rosa Maria';
        //$usr->apellido_usr = 'Mercado Vanegas';
        //$usr->genero_usr = 'FEM';
        //$usr->email_usr = 'rocio@gmail.es';
        try {
            $usr_lsts = CrudUsuario::obtener_todos_usr();
            foreach ($usr_lsts as $idx => $usr) {
                $cnt=$idx +1;
                echo "<b>Usuario No. : </b> #$cnt <HR><br> "; 
                echo "<b>Cedula : </b>  $usr->cc_usr <br>" ;
                echo "<b>Nombre : </b>  $usr->nombre_usr <br>" ;
                echo "<b>Apellido : </b>  $usr->apellido_usr <br>" ;
                echo "<b>Genero : </b>  $usr->genero_usr <br>" ;
                echo "<b>Correo : </b>  $usr->email_usr" ;
                echo "<HR><br> "; 
            }

            echo "Registros mostrados :" . CrudUsuario::contar(); 
        } catch (exception $error) {
            throw new Exception("Error al guardar el usuario <br>Detalles : " . $error->getMessage());
        }

        break;
    
    
}