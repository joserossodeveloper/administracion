<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=warehouse;charset=utf8mb4',
   'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>