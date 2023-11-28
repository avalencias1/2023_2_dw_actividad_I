<?php
class CrudUsuario{
    /**
    *Permite guardar enla base de datos un registro de usuarios
    *@param $u un objeto de la clase Usuario que contiene la informacion del usuario
    *@return 
    *@throw Exception  Error al guardar el usuario + Detalles de error
    */
    public static function guardar($u){
        try {
            $u->save();
        } catch (exception $error) {
            throw new Exception("Error al guardar el usuario <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite buscar enla base de datos un registro de usuarios por numero de cedula 
    *@param $cc_usr una cadena de texto conteniendo el numero de cedula del usuario a buscar
    *@return un objeto de la clase Usuario
    *@throw Exception  Error usuario no encontrado + Detalles
    */
    public static function buscar_x_cc($cc_usr){
        try {
                //$u =Usuario::find($cc_usr);              

                $u =Usuario::find_by_cc_usr($cc_usr);

                return $u;
        } catch (exception $error) {
            throw new Exception("Error usuario no encontrado <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite buscar enla base de datos un registro de usuarios por id 
    *@param $id_usr una cadena de texto conteniendo el id del registro a buscar
    *@return un objeto de la clase Usuario
    *@throw Exception  Error usuario no encontrado + Detalles
    */
    public static function buscar_x_id($id_usr){
        try {
                $u =Usuario::find($id_usr);
                return $u;
        } catch (exception $error) {
            throw new Exception("Error usuario no encontrado <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite modificar enla base de datos un registro de usuarios
    *@param $u un objeto de la clase Usuario que contiene la informacion del usuario
    *@return Un objeto de la clase Usuario que contiene la informacion del usuario
    *@throw Exception  Error al editar el usuario + Detalles
    */
    public static function editar($u){
        try {
            $u->save();
        } catch (exception $error) {
            throw new Exception("Error al editar el usuario <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite Eliminar un registro de la base de datos usuarios
    *@param $u un objeto de la clase Usuario que contiene la informacion del usuario
    *@return 
    *@throw Exception  Error al eliminar el usuario + Detalles
    */
    public static function eliminar($u){
        try {
            $u->delete();
        } catch (exception $error) {
            throw new Exception("Error al eliminar el usuario <br>Detalles : " . $error->getMessage());
        }
    }

    /**
    *Permite contar todos los usurios qu existen en la base de datos
    *@param void
    *@return Devuelve un valor entero que representa el numero de Usuarios registrados en la BD
    *@throw Exception  Error al contar los usuario + Detalles
    */
    public static function contar(){
        try {            
            return Usuario::count();
        } catch (exception $error) {
            throw new Exception("Error al contar los usuarios <br>Detalles : " . $error->getMessage());
        }
    }

    /**
    *Permite Obtener todos los usurios qu existen en la base de datos
    *@param void
    *@return Devuelve un arreglo /lista de objetos tipo Usuario
    *        conteniendo todos los usuarios almacenados en la BD  
    *@throw Exception  Error al contar los usuario + Detalles
    */
    public static function obtener_todos_usr(){
        try {
            return Usuario::all();
        } catch (exception $error) {
            throw new Exception("Error al obtener todos los usuarios <br>Detalles : " . $error->getMessage());
        }
    }

    # @author parzibyte.me/blog
    public  static function gen_token_CSRF($len)
    {
        if ($len < 4) {
            $len = 4;
        }
     
        //return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2)); PHP 5
        return bin2hex(random_bytes(($len - ($len % 2)) / 2));
    }



}