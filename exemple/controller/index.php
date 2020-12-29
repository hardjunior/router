<?php

require dirname(__DIR__, 2) . "/vendor/autoload.php";
require __DIR__ . "/Test/Web.php";
require __DIR__ . "/Test/Name.php";

use HardJunior\Router\Router;

define("BASE", "https://www.localhost/hardjunior/router/exemple/controller");
$router = new Router(BASE);

/**
 * routes
 */
$router->namespace("Test");

$router->get("/", "Web:home");
$router->get("/edit/{id}", "Web:edit");
$router->post("/edit/{id}", "Web:edit");

/**
 * group by routes and namespace
 */
$router->group("admin");

$router->get("/", "Web:admin");
$router->get("/user/{id}", "Web:admin");
$router->get("/user/{id}/profile", "Web:admin");
$router->get("/user/{id}/profile/{photo}", "Web:admin");

/**
 * named routes
 */
$router->group("name");
$router->get("/", "Name:home", "name.home");
$router->get("/hello", "Name:hello", "name.hello");

$router->get("/redirect", "Name:redirect", "name.redirect");
$router->get("/redirect/{category}/{page}", "Name:redirect", "name.redirect");
$router->get("/params/{category}/page/{page}", "Name:params", "name.params");

/**
 * Group Error
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Web:notFound");

/**
 * execute
 */
$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
    //router->redirect("/error/{$router->error()}");
}