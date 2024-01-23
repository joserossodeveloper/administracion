<?php
session_start();

require_once "global/variables_globales.php";

if (!isset($_SESSION['user'])) {
    header("Location: /administracion/login.php");
    exit;
}
