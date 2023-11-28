<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Usuario.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Gasto.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudGasto.php';

class ControladorGasto{

    /**
    *Permite capturar la accion enviada desde el formulario de usuarios
    *@param void
    *@return void
    *@throw Exception  Error accion no valida + Detalles
    */
    public static function catch_action(){
        $accion=$_REQUEST["accion"];
        switch ($accion) {
            case 'CALL_EDITAR':
                header("Location: ../view/gastos/agregar.php");
            case 'CALL_ELIMINAR':
                header("Location: ../view/gastos/agregar.php");
                break;      
            case 'CALL_LISTAR':
                header("Location: ../view/gastos/agregar.php");
                break;      
            case 'AGREGAR':
                ControladorGasto::agregar_gasto();
                break;            
            case 'EDITAR':
                ControladorGasto::editar_gasto();
                break;            
            case 'ELIMINAR':
                    ControladorGasto::eliminar_gasto();
                    break;            
            case 'BUSCAR':
                    ControladorGasto::buscar_gasto();
                    break;               
            default:
                # code...
                break;
        }

    }
    
    public static function agregar_gasto(){
        $tkn_csrf=$_REQUEST["tkn_csrf"];

        $codigo=$_REQUEST["gst_codigo"];
        $fecha=$_REQUEST["gst_fecha"];
        $totalNoIva=$_REQUEST["gst_valortotalsiniva"];
        $iva=$_REQUEST["gst_ivatotal"];
        $totalConIva=$_REQUEST["gst_valortotalconiva"];        
        $usuarioNombreGasto=$_REQUEST["gst_nombreusuario"];
        $lugar=$_REQUEST["gst_lugar"];
        $descripcioGasto=$_REQUEST["gst_descripcion"];

        $id_usr=$_REQUEST["gst_id_usr"];

        try {

            if(session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }

            #Comparamos tokens...
            if (strcmp($tkn_csrf, $_SESSION["tkn_csrf"])!== 0) {
                $msj="ataque CRFS detectado--SESION NO VALIDA" ;
                session_reset();
                session_destroy();                 
                header("Location: ../view/usuarios/login.php?msj=" . $msj);
                exit;                    
            }

            //Busquemos al usuario por el Id
            $usr=new Usuario();
            $usr=CrudUsuario::buscar_x_id($id_usr);

            if ($usr!=NULL) {
                //Usuario encontrado, busquemos el nombre
                $usuarioNombreGasto=$usr->nombre_usr . " " . $usr->apellido_usr;
            } else {
                $msj="No se encontro el usuario";
                session_reset();
                session_destroy();                 
                header("Location: ../view/usuarios/login.php?msj=" . $msj);
                exit;
            }

            if ($id_usr>0) {
                $gst=new Gasto();
                //$gst->id_gst=;
                $gst->codigo_gst=$codigo;
                $gst->fecha_gst=$fecha;
                $gst->valortotalsiniva_gst=$totalNoIva;
                $gst->ivatotal_gst=$iva;
                $gst->valortotalconiva_gst=$totalConIva;
                $gst->nombreusuario_gst=$usuarioNombreGasto;
                $gst->lugar_gst=$lugar;
                $gst->descripcion_gst=$descripcioGasto;
                $gst->id_usr_gst=$id_usr;
                CrudGasto::guardar($gst);
                //$gst=CrudGasto::buscar_x_id($id_usr);
                $cnt=CrudGasto::contar(); 
            }

            #Buscar todos los gastos de el usuario actual

            $gst_lst = CrudGasto::get_all_gst_by_id($id_usr);

            if (isset($_SESSION['gsts_lst'])) {
                unset($_SESSION['gsts_lst']);
            }
            if (!(empty($gst_lst))) {
                $_SESSION['gsts_lst']=serialize($gst_lst);   
            }


            //$msj="Usuario guardado ID :" .  "$id" . " No. Registros :" .  "$cnt";
            $msj="Gasto registrado correctamente...";
            header("Location: ../view/gastos/agregar.php?msj=$msj");
            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/gastos/agregar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }


    public static function editar_gasto(){
        $tkn_csrf=$_REQUEST["tkn_csrf"];
        $idGst=$_REQUEST["gst_id_gst"];       

        $codigo=$_REQUEST["gst_codigo"];
        $fecha=$_REQUEST["gst_fecha"];
        $totalNoIva=$_REQUEST["gst_valortotalsiniva"];
        $iva=$_REQUEST["gst_ivatotal"];
        $totalConIva=$_REQUEST["gst_valortotalconiva"];        
        $usuarioNombreGasto=$_REQUEST["gst_nombreusuario"];
        $lugar=$_REQUEST["gst_lugar"];
        $descripcioGasto=$_REQUEST["gst_descripcion"];

        $id_usr=$_REQUEST["gst_id_usr"];

        try {

            if(session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }

            #Comparamos tokens...
            if (strcmp($tkn_csrf, $_SESSION["tkn_csrf"])!== 0) {
                $msj="ataque CRFS detectado--SESION NO VALIDA" ;
                session_reset();
                session_destroy();                 
                header("Location: ../view/usuarios/login.php?msj=" . $msj);
                exit;                    
            }

            //Busquemos al usuario por el Id
            $usr=new Usuario();
            $usr=CrudUsuario::buscar_x_id($id_usr);

            if ($usr!=NULL) {
                //Usuario encontrado, busquemos el nombre
                $usuarioNombreGasto=$usr->nombre_usr . " " . $usr->apellido_usr;
            } else {
                $msj="No se encontro el usuario";
                session_reset();
                session_destroy();                 
                header("Location: ../view/usuarios/login.php?msj=" . $msj);
                exit;
            }

            if ($id_usr>0) {
                $gst=new Gasto();
                //Busquemos al gasto por el Id
                $gst=new Usuario();
                $gst=CrudGasto::buscar($idGst);              
                
                if ($gst!=NULL) { 
                
                    #$gst->id_gst=$idGst;
                    $gst->codigo_gst=$codigo;
                    $gst->fecha_gst=$fecha;
                    $gst->valortotalsiniva_gst=$totalNoIva;
                    $gst->ivatotal_gst=$iva;
                    $gst->valortotalconiva_gst=$totalConIva;
                    $gst->nombreusuario_gst=$usuarioNombreGasto;
                    $gst->lugar_gst=$lugar;
                    $gst->descripcion_gst=$descripcioGasto;
                    #$gst->id_usr_gst=$id_usr;
                    CrudGasto::editar($gst);
                    $cnt=CrudGasto::contar();
                }     
            }

            #Buscar todos los gastos de el usuario actual
            $gst_lst = CrudGasto::get_all_gst_by_id($id_usr);

            if (isset($_SESSION['gsts_lst'])) {
                unset($_SESSION['gsts_lst']);
            }
            if (!(empty($gst_lst))) {
                $_SESSION['gsts_lst']=serialize($gst_lst);   
            }

            //$msj="Usuario guardado ID :" .  "$id" . " No. Registros :" .  "$cnt";
            $msj="Gasto modificado correctamente...";
            header("Location: ../util/panel.php?msj=$msj");
            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/gastos/editar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }

    public static function eliminar_gasto(){
        $tkn_csrf=$_REQUEST["tkn_csrf"];
        $idGst=$_REQUEST["gst_id_gst"];       

        $codigo=$_REQUEST["gst_codigo"];
        $fecha=$_REQUEST["gst_fecha"];
        $totalNoIva=$_REQUEST["gst_valortotalsiniva"];
        $iva=$_REQUEST["gst_ivatotal"];
        $totalConIva=$_REQUEST["gst_valortotalconiva"];        
        $usuarioNombreGasto=$_REQUEST["gst_nombreusuario"];
        $lugar=$_REQUEST["gst_lugar"];
        $descripcioGasto=$_REQUEST["gst_descripcion"];

        $id_usr=$_REQUEST["gst_id_usr"];

        try {

            if(session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }

            #Comparamos tokens...
            if (strcmp($tkn_csrf, $_SESSION["tkn_csrf"])!== 0) {
                $msj="ataque CRFS detectado--SESION NO VALIDA" ;
                session_reset();
                session_destroy();                 
                header("Location: ../view/usuarios/login.php?msj=" . $msj);
                exit;                    
            }

            //Busquemos al usuario por el Id
            $usr=new Usuario();
            $usr=CrudUsuario::buscar_x_id($id_usr);

            if ($usr!=NULL) {
                //Usuario encontrado, busquemos el nombre
                $usuarioNombreGasto=$usr->nombre_usr . " " . $usr->apellido_usr;
            } else {
                $msj="No se encontro el usuario";
                session_reset();
                session_destroy();                 
                header("Location: ../view/usuarios/login.php?msj=" . $msj);
                exit;
            }

            if ($id_usr>0) {
                $gst=new Gasto();
                //Busquemos al gasto por el Id
                $gst=new Usuario();
                $gst=CrudGasto::buscar($idGst);              
                
                if ($gst!=NULL) { 
                
                    #$gst->id_gst=$idGst;
                    $gst->codigo_gst=$codigo;
                    $gst->fecha_gst=$fecha;
                    $gst->valortotalsiniva_gst=$totalNoIva;
                    $gst->ivatotal_gst=$iva;
                    $gst->valortotalconiva_gst=$totalConIva;
                    $gst->nombreusuario_gst=$usuarioNombreGasto;
                    $gst->lugar_gst=$lugar;
                    $gst->descripcion_gst=$descripcioGasto;
                    #$gst->id_usr_gst=$id_usr;
                    CrudGasto::eliminar($gst);
                    $cnt=CrudGasto::contar();
                }     
            }

            #Buscar todos los gastos de el usuario actual
            $gst_lst = CrudGasto::get_all_gst_by_id($id_usr);

            if (isset($_SESSION['gsts_lst'])) {
                unset($_SESSION['gsts_lst']);
            }
            if (!(empty($gst_lst))) {
                $_SESSION['gsts_lst']=serialize($gst_lst);   
            }

            //$msj="Usuario guardado ID :" .  "$id" . " No. Registros :" .  "$cnt";
            $msj="Gasto Eliminado correctamente...";
            header("Location: ../util/panel.php?msj=$msj");
            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/gastos/editar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }



    public static function guardar_gasto(){
        $cc=$_REQUEST["usr_cc"];
        $pass=$_REQUEST["usr_pass"];
        $nombre=$_REQUEST["usr_nombre"];
        $apellido=$_REQUEST["usr_apellido"];
        $genero=$_REQUEST["usr_genero"];
        $email=$_REQUEST["usr_email"];

        //Creando instancia de USuario
        $usr=new Usuario();
        $usr->cc_usr=$cc;
        $usr->pass_usr=$pass;
        $usr->nombre_usr=$nombre;
        $usr->apellido_usr=$apellido;
        $usr->genero_usr=$genero;
        $usr->email_usr=$email;
        try {
            CrudGasto::guardar($usr);
            $id=CrudGasto::buscar_x_cc($cc);
            $cnt=CrudGasto::contar();
            $msj="Usuario guardado ID : " . "$id" . " No. Registros : " . "$cnt";
            header("Location: ../view/usuarios/agregar.php?msj=". $msj);
            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/usuarios/agregar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }

    public static function buscar_gasto(){
        $cc=$_REQUEST["usr_cc"];
        
        try {
            $usr=CrudGasto::buscar_x_cc($cc);
            if ($usr!=NULL) {
                $msj="Exito!! " . $usr->nombre_usr . " " . $usr->apellido_usr . " - Usuario Encontrado";
                header("Location: ../index.php?msj=". $msj);                  

                 
            } else {
                $msj="Usuario " . $cc .  " No existe ";
                header("Location: ../index.php?msj=". $msj);
    
            }
            
            exit;
        } catch (Exeption $Error) {
            header("Location: ../index.php?msj=" . $Error->getMessage);
            exit;            
        }

    }    



    
    public static function validar_gasto(){
        $cc=$_REQUEST["usr_cc"];
        $pass=$_REQUEST["usr_pass"];
        $nombre=$_REQUEST["usr_nombre"];
        $apellido=$_REQUEST["usr_apellido"];
        $genero=$_REQUEST["usr_genero"];
        $email=$_REQUEST["usr_email"];
        try {

            //Buscando si existe el usuario
            $usr=CrudGasto::buscar_x_cc($cc);

            if ($usr!=NULL) {
                $msj="El usuario " . $cc .   " ya esta registrado." ;
                header("Location: ../index.php?msj=" . $msj);
                exit;    
            } else {
                $usr->cc_usr=$cc;
                $usr->pass_usr=$pass;
                $usr->nombre_usr=$nombre;
                $usr->apellido_usr=$apellido;
                $usr->genero_usr=$genero;
                $usr->email_usr=$email;
                CrudGasto::guardar($usr);
                $id=CrudGasto::buscar_x_cc($cc);
                $cnt=CrudGasto::contar(); 
            }


            //$str_Id=strval($id);
            //$str_Cnt=strval($cnt);

            //$msj="Usuario guardado ID : " . $str_Id . " No. Registros : " . $str_Cnt;
            header("Location: ../index.php");

            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/usuarios/registrar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }




}

//Iniciar controlador
ControladorGasto::catch_action();