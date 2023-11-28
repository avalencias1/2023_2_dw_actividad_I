<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/lib/config.php';     
class Gasto extends ActiveRecord\Model{
    public static $primary_key="id_gst";

    public static $belongs_to=array(array("usuario"));
}