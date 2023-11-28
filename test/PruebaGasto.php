<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Usuario.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Gasto.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudGasto.php';

$accion="ALL";

switch ($accion) {


    case "P":
        echo "\$accion MOSTRANDO VARIABLES DEL SISTEMA";

        var_dump($_SERVER); 

        /*
       *id_gst  INTEGER NOT NULL AUTO_INCREMENT,
       *codigo_gst  VARCHAR(5) NOT NULL,
       *fecha_gst  DATE NOT NULL,
       *valorTotalSinIva_gst FLOAT NOT NULL DEFAULT 0,
       *ivaTotal_gst  FLOAT NOT NULL DEFAULT 0,
       *valorTotalConIva_gst  FLOAT NOT NULL DEFAULT 0,
       *nombreUsuario_gst VARCHAR(100) NOT NULL ,
       *lugar_gst  VARCHAR(50) NOT NULL ,
       *descripcion_gst   VARCHAR(150) NOT NULL,
       *id_usr_gst INTEGER NOT NULL,
        */ 


        break;


    case "C":
        echo "\$accion PROBANDO CREAR GASTO <br>";

        $cc="73134425";   
        $usr = CrudUsuario::buscar_x_cc($cc);

        $today = new Datetime();


        $gst_00 = new Gasto();
        $gst_00->codigo_gst = 'CHSKK';
        $gst_00->fecha_gst = $today;//date("Y-m-d ", $time);
        $gst_00->valortotalsiniva_gst = 9500;
        $gst_00->ivatotal_gst = 95;
        $gst_00->valortotalconiva_gst = $gst_00->valortotalsiniva_gst +  $gst_00->ivatotal_gst;
        $gst_00->nombreusuario_gst = $usr->nombre_usr . ' ' . $usr->apellido_usr;
        $gst_00->lugar_gst = 'Juan Valdez la Castellana';
        $gst_00->descripcion_gst = 'CHESKAKE';
        $gst_00->id_usr_gst = $usr->id_usr;
        
        $gst_01 = new Gasto();
        $gst_01->codigo_gst = 'ALMJB';
        $gst_01->fecha_gst = $today;//date("Y-m-d ", $time);
        $gst_01->valortotalsiniva_gst = 5500;
        $gst_01->ivatotal_gst = 55;
        $gst_01->valortotalconiva_gst = $gst_00->valortotalsiniva_gst +  $gst_00->ivatotal_gst;
        $gst_01->nombreusuario_gst = $usr->nombre_usr . ' ' . $usr->apellido_usr;
        $gst_01->lugar_gst = 'Juan Valdez la Castellana';
        $gst_01->descripcion_gst = 'Almojabana';
        $gst_01->id_usr_gst = $usr->id_usr;




        try {
            CrudGasto::guardar($gst_00);
            CrudGasto::guardar($gst_01);
            echo "Gasto guardado "; 
            echo "Total registros :" . CrudGasto::contar(); 
        } catch (exception $error) {
            echo  "Error al guardar el gasto <br>Detalles : " . $error->getMessage();
        }

        break;
    case "R":
        echo "PROBANDO BUSCAR GASTOS<br>";
     
        
        $id=1;   
        $gst = CrudGasto::buscar($id);
        echo "<b>Gasto No. : </b> #$gst->id_gst <HR><br> "; 
        echo "Codigo : " .  $gst->id_gst  . " <br>";        
        echo "Codigo : " .  $gst->codigo_gst  . " <br>";
        echo "Fecha : " . $gst->fecha_gst . " <br>";
        echo "Descripcion : " . $gst->descripcion_gst ." <br>";
        echo "Valor Neto: " . $gst->valortotalconiva_gst ." <br>";
        echo "Usuario /Lugar : " . $gst->nombreusuario_gst . "/" . $gst->lugar_gst   ." <br>";
        
        $id=2;   
        $gst = CrudGasto::buscar($id);
        echo "<b>Gasto No. : </b> #$gst->id_gst <HR><br> "; 
        echo "Codigo : " .  $gst->id_gst  . " <br>";        
        echo "Codigo : " .  $gst->codigo_gst  . " <br>";
        echo "Fecha : " . $gst->fecha_gst . " <br>";
        echo "Descripcion : " . $gst->descripcion_gst ." <br>";
        echo "Valor Neto: " . $gst->valortotalconiva_gst ." <br>";
        echo "Usuario /Lugar : " . $gst->nombreusuario_gst . "/" .$gst->lugar_gst   ." <br>";

        
        try {
            echo "Fin de Reporte  <br>" ; 
            echo "Total registros encontrados :" . CrudGasto::contar(); 
        } catch (exception $error) {
            throw new Exception("Error al buscar el gastos <br>Detalles : " . $error->getMessage());
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
        echo "***LISTANDO TODOS LOS REGISTROS DE GASTOS*** <br>";        
        try {
            $gst_lsts = CrudGasto::obtener_todos_gst();
            foreach ($gst_lsts as $idx => $gst) {
                $cnt=$idx + 1;
                echo "<b>Gasto No. : </b>" . $cnt . " - ID : " . $gst->id_gst   . "<HR><br> ";
                echo "Codigo : " .  $gst->codigo_gst  . " <br>";
                echo "Fecha : " . $gst->fecha_gst . " <br>";
                echo "Descripcion : " . $gst->descripcion_gst . " <br>";
                echo "Valor Neto: " . $gst->valortotalconiva_gst . " <br>";
                echo "Usuario /Lugar : " . $gst->nombreusuario_gst . "/" . $gst->lugar_gst   . " <br>";
                echo "<HR><br> "; 
            }

            echo "Registros mostrados :" . CrudGasto::contar(); 
        } catch (exception $error) {
            throw new Exception("Error al guardar el usuario <br>Detalles : " . $error->getMessage());
        }

        break;
    
    
}