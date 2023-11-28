<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/lib/config.php';     
class Usuario extends ActiveRecord\Model{
    public static $primary_key="id_usr";
    public static $has_many=array(array("gastos"));
}