<?php 

$pdo = new PDO('mysql:dbname=upsteckcwwmain;host=upsteckcwwmain.mysql.db','upsteckcwwmain','Pasteka1');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

