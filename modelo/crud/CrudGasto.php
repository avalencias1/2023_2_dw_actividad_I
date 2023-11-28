<?php
class CrudGasto{
    /**
    *Permite guardar enla base de datos un registro de gasto
    *@param $g un objeto de la clase Gasto que contiene la informacion del usuario
    *@return
    *@throw Exception  Error al guardar el usuario + Detalles de error
    */
    public static function guardar($g){
        try {
            $g->save();
        } catch (exception $error) {
            throw new Exception("Error al guardar el gasto <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite buscar enla base de datos un registro de usuarios por id
    *@param $id_gst una cadena de texto conteniendo el id del registro a buscar
    *@return un objeto de la clase Usuario
    *@throw Exception  Error usuario no encontrado + Detalles
    */
    public static function buscar($id_gst){
        try {
                //$g =Gasto::find($id_gst);
                $g =Gasto::find_by_id_gst($id_gst);
                
                return $g;
        } catch (exception $error) {
            throw new Exception("Error gasto no encontrado <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite modificar enla base de datos un registro de usuarios
    *@param $g un objeto de la clase Usuario que contiene la informacion del usuario
    *@return Un objeto de la clase Usuario que contiene la informacion del usuario
    *@throw Exception  Error al editar el usuario + Detalles
    */
    public static function editar($g){
        try {
            $g->save();
        } catch (exception $error) {
            throw new Exception("Error al editar el gasto <br>Detalles : " . $error->getMessage());
        }
    }
    /**
    *Permite Eliminar un registro de la base de datos usuarios
    *@param $g un objeto de la clase Usuario que contiene la informacion del usuario
    *@return
    *@throw Exception  Error al eliminar el usuario + Detalles
    */
    public static function eliminar($g){
        try {
            $g->delete();
        } catch (exception $error) {
            throw new Exception("Error al eliminar el gasto <br>Detalles : " . $error->getMessage());
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
            return Gasto::count();
        } catch (exception $error) {
            throw new Exception("Error al contar los gastos <br>Detalles : " . $error->getMessage());
        }
    }

    /**
    *Permite Obtener todos los usurios qu existen en la base de datos
    *@param void
    *@return Devuelve un arreglo /lista de objetos tipo Usuario
    *        conteniendo todos los usuarios almacenados en la BD
    *@throw Exception  Error al contar los usuario + Detalles
    */
    public static function obtener_todos_gst(){
        try {
            return Gasto::all();
        } catch (exception $error) {
            throw new Exception("Error al obtener todos los gastos <br>Detalles : " . $error->getMessage());
        }
    }
    public static function get_all_gst_by_id($id_usr_gst){
        try {
            return Gasto::all(array('conditions' => array('id_usr_gst = ?', $id_usr_gst)));

        } catch (exception $error) {
            throw new Exception("Error al obtener todos los gastos <br>Detalles : " . $error->getMessage());
        }
    }    
}