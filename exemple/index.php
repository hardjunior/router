<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/source/Rotas.php";

if (!isset($_SESSION)) {session_start();} // Inicia a sessão PHP

ob_end_flush();
