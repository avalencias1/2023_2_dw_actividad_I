<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/albertovalenciasolis/lib/activerecord/ActiveRecord.php';     
ActiveRecord\Config::initialize(function($cfg)
{
$cfg->set_model_directory('../modelo/entidades');
$cfg->set_connections(
    array(
    'development' => 'mysql://root:@localhost/gastos_db'//,
    //'test' => 'mysql://username:password@localhost/test_database_name',
    //'production' => 'mysql://username:password@localhost/production_database_name'
    )
);
});


