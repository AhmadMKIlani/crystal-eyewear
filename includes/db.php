<?php
$dsn='mysql:host=localhost;dbname=e_commerce';//Data Source Name
$user="root";
$pass="";
$options=[PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'];
try{
    $connection=new PDO($dsn,$user,$pass,$options);
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "failed".$e->getMessage();
}