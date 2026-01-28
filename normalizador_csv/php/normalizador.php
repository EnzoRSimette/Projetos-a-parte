<?php
//$caminho = $_FILES["arquivo"]["tmp_name"];
//$caminho = str_replace('\\', '/', $caminho);

//* ======================
//* = CONECTION TO MYSQL =
//* ======================

use sys4soft\Database;

define('MYSQL_CONFIG', [
    'host' => 'localhost',
    'database' => 'udemy_loja_online',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4'
]);

require_once('database.php');

$db = new Database(MYSQL_CONFIG);

//! =====================
//! = SEND CSV TO MYSQL =
//! =====================

//$cabecalho = fgetcsv($caminho, null, ';');

$clientes = $db->execute_query("SELECT DISTINCT cidade FROM clientes;");
print_r($clientes);
