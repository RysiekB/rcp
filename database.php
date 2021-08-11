<?php

$config = require_once 'config.php';


try {  
    $conn = new PDO( "sqlsrv:Server={$config['host']};Database={$config['database']}", $config['user'], $config['password']);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
  
catch( PDOException $e ) {  
   die( "Błąd połączenia z bazą MS SQL Server" );   
}  


?>