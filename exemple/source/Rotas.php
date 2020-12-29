<?php
/**
 * Não permite acesso direto a este arquivo
 */
if (basename($_SERVER["PHP_SELF"]) == "config.php") {
    die("Este arquivo não pode ser acessado diretamente.");
}

$route = new HardJunior\Router\Router(HOST);

/**
 * APP
 */
$route->namespace("App\Controllers");

/**
 * Login
 */
$route->group(null);
/**
 * web
 */
$route->middleware(['auth']);
$route->get("/", function(){echo "hello world";}, "utilizador.login");
$route->get("/ops",       "UtilizadorController:login", "utilizador.login");
$route->get("/login",  "UtilizadorController:login", "utilizador.login");
$route->post("/login", "UtilizadorController:logar", "utilizador.logar");
$route->get("/logout", "UtilizadorController:logout","utilizador.logout");

/**
 * ERROR
 */
// $route->middleware([]);
// $route->group("ops");
// $route->get("/{errcode}", "BlankController:error","pagina.error");

/**
 * PROCESS
 */
$_ENV['route'] = $route;

$route->dispatch();

if (!empty($route->error())){
    $route->redirect("/ops");
}