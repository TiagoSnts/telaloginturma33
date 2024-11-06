<?php
define ('HOST','localhost');
define ('USER','root');
define ('PASS','');
define ('DBNAME','cadastrousuarioturma33');

$conn = new PDO ('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
?>