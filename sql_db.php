<?php 

$pdo = new PDO("mysql:host=localhost; dbname=misstais_shop" , "mikael" , "elkin");
$huruf= $pdo->query("SET NAMES 'utf8'");
$huruf2= $pdo->query("SET CHARACTER SET 'utf8'");
$huruf3= $pdo->query("SET SESSION collation_connection = 'utf8_general_ci'");