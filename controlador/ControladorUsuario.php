<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Usuario.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/entidades/Gasto.php';     
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/modelo/crud/CrudGasto.php';

class ControladorUsuario{

    /**
    *Permite capturar la accion enviada desde el formulario de usuarios
    *@param void
    *@return void
    *@throw Exception  Error accion no valida + Detalles
    */
    public static function catch_action(){
        $accion=$_REQUEST["accion"];
        switch ($accion) {
            case 'GUARDAR':
                ControladorUsuario::guardar_usuario();
                break;            
            case 'REGISTRAR':
                ControladorUsuario::registrar_usuario();
                break;            
            case 'INGRESAR':
                ControladorUsuario::login_usuario();
                break;            
            case 'INGRESAR':
                ControladorUsuario::login_usuario();
                break;            

            case 'BUSCAR':
                    ControladorUsuario::buscar_usuario();
                    break;               
            default:
                # code...
                break;
        }

    }


    public static function buscar_usuario(){
        $cc=$_REQUEST["usr_cc"];
        
        try {
            $usr=CrudUsuario::buscar_x_cc($cc);
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



    
    public static function validar_usuario(){
        $cc=$_REQUEST["usr_cc"];
        $pass=$_REQUEST["usr_pass"];
        $nombre=$_REQUEST["usr_nombre"];
        $apellido=$_REQUEST["usr_apellido"];
        $genero=$_REQUEST["usr_genero"];
        $email=$_REQUEST["usr_email"];
        try {

            //Buscando si existe el usuario
            $usr=CrudUsuario::buscar_x_cc($cc);

            if ($usr!=NULL) {
                $msj="El usuario " . $cc . " ya esta registrado." ;
                header("Location: ../index.php?msj=" . $msj);
                exit;    
            } else {
                $usr->cc_usr=$cc;
                $usr->pass_usr=$pass;
                $usr->nombre_usr=$nombre;
                $usr->apellido_usr=$apellido;
                $usr->genero_usr=$genero;
                $usr->email_usr=$email;
                CrudUsuario::guardar($usr);
                $id=CrudUsuario::buscar_x_cc($cc);
                $cnt=CrudUsuario::contar(); 
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

    public static function login_usuario(){
        $cc=$_REQUEST['usr_cc'];
        $pass=$_REQUEST['usr_pass'];
        
        try {
            $usr=new Usuario();

            $usr=CrudUsuario::buscar_x_cc($cc);

            if ($usr!=NULL) {
                if ($usr->pass_usr==$pass) {
                    # Sólo iniciamos la sesión si no la iniciamos antes
                    if(session_status() !== PHP_SESSION_ACTIVE){
                        session_start();
                    }
                    
                    # Generamos un toke para bloquear ataques tipo 
                    $tokenCsrf = CrudUsuario::gen_token_CSRF(30); 
                    $_SESSION["tkn_csrf"] = $tokenCsrf;
                    //Cargamos el usuario Logueado en la sesion

                    $_SESSION['user_is_logged_in']="OK";
                    $_SESSION['user_full_name']= $usr->nombre_usr . " " . $usr->apellido_usr ;
                    $_SESSION['user_cc']= $usr->cc_usr  ;
                    $_SESSION['user_id']= $usr->id_usr  ;

                    $_SESSION['usuario']=serialize($usr);   
                    
                    #Buscar todos los gastos de el usuario actual
                    $gst_lst = CrudGasto::get_all_gst_by_id($usr->id_usr);

                    if (isset($_SESSION['gsts_lst'])) {
                        unset($_SESSION['gsts_lst']);
                    }
                    if (!(empty($gst_lst))) {
                        $_SESSION['gsts_lst']=serialize($gst_lst);   
                    }

                    $msj="***Bienvenido***";
                    #header("Location: ../util/main.php?msj=". $msj);                  
                    header("Location: ../util/panel.php?msj=". $msj);                  

                } else {
                    $msj="Contraseña incorrecta ";
                    header("Location: ../index.php?msj=". $msj);
                    }
                 
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


    public static function registrar_usuario(){
        $cc=$_REQUEST["usr_cc"];
        $pass=$_REQUEST["usr_pass"];
        $nombre=$_REQUEST["usr_nombre"];
        $apellido=$_REQUEST["usr_apellido"];
        $genero=$_REQUEST["usr_genero"];
        $email=$_REQUEST["usr_email"];
        

        try {

            //Creando instancia de USuario
            $usr=CrudUsuario::buscar_x_cc($cc);

            if ($usr!=NULL) {
                $msj="El usuario " . $cc .   " ya esta registrado." ;
                header("Location: ../index.php?msj=" . $msj);
                exit;    
            } else {
                $usr=new Usuario();
                $usr->cc_usr=$cc;
                $usr->pass_usr=$pass;
                $usr->nombre_usr=$nombre;
                $usr->apellido_usr=$apellido;
                $usr->genero_usr=$genero;
                $usr->email_usr=$email;
                CrudUsuario::guardar($usr);
                $id=CrudUsuario::buscar_x_cc($cc);
                $cnt=CrudUsuario::contar(); 
            }


            //$msj="Usuario guardado ID :" .  "$id" . " No. Registros :" .  "$cnt";
            $msj="Usuario registrado correctamente...";
            header("Location: ../view/usuarios/registrar.php?msj=$msj");

            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/usuarios/registrar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }


    public static function guardar_usuario(){
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
            CrudUsuario::guardar($usr);
            $id=CrudUsuario::buscar_x_cc($cc);
            $cnt=CrudUsuario::contar(); 
            $msj="Usuario guardado ID : " . "$id" . " No. Registros : " . "$cnt";
            header("Location: ../view/usuarios/agregar.php?msj=". $msj);
            exit;
        } catch (Exeption $Error) {
            header("Location: ../view/usuarios/agregar.php?msj=" . $Error->getMessage);
            exit;            
        }

    }





}

//Iniciar controlador
ControladorUsuario::catch_action();