<?php
/**
 * Não permite acesso direto a este arquivo
 */
if (basename($_SERVER["PHP_SELF"]) == "config.php") {
    die("Este arquivo não pode ser acessado diretamente.");
}

/**
 * Inicia sessão
 * Horário de lisboa
 * Contento conteúdo html com utf8
 */
if (!isset($_SESSION)) {session_start();} // Inicia a sessão PHP
date_default_timezone_set('Europe/Lisbon');
@header('Content-Type: text/html; charset=utf-8', true);

/**
 * Identifica on-line ou off-line e seus erros
 */
if (($_SERVER['REMOTE_ADDR'] == '127.0.0.1') or ($_SERVER['REMOTE_ADDR'] == '::1')) {
    error_reporting(E_ALL);
    define("LOCAL", "offline");
} else {
    error_reporting(0);
    define("LOCAL", "online");
}

/**
 * Identificação da conexão segura ou não!
 */
if ($_SERVER['HTTPS']) {
    $http = "https:" . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR;
} else if (!$_SERVER['HTTPS']) {
    $http = "http:" . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR;
} else {
    $http = "";
}
