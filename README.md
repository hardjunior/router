# Router @hardjunior_g11

### Highlights
- Router class with all RESTful verbs (Classe router com todos os verbos RESTful)
- Optimized dispatch with total decision control (Despacho otimizado com controle total de decisões)
- Requesting Spoofing for Local Verbalization (Falsificador (Spoofing) de requisição para verbalização local)
- It's very simple to create routes for your application or API (É muito simples criar rotas para sua aplicação ou API)
- Trigger and data carrier for the controller (Gatilho e transportador de dados para o controloador)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)

## Installation

Router is available via Composer:

```bash
"hardjunior/router": "1.0.*"
```

or run

```bash
composer require hardjunior/router
```

## Documentation

###### For details on how to use the router, see the sample folder with details in the component directory. To use the router you need to redirect your route routing navigation (index.php) where all traffic must be handled. The example below shows how:

Para mais detalhes sobre como usar o router, veja a pasta de exemplo com detalhes no diretório do componente. Para usar o router é preciso redirecionar sua navegação para o arquivo raiz de rotas (index.php) onde todo o tráfego deve ser tratado. O exemplo abaixo mostra como:

#### apache

```apacheconfig
RewriteEngine On
#Options All -Indexes

## ROUTER WWW Redirect.
#RewriteCond %{HTTP_HOST} !^www\. [NC]
#RewriteRule ^ https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

## ROUTER HTTPS Redirect
#RewriteCond %{HTTP:X-Forwarded-Proto} !https
#RewriteCond %{HTTPS} off
#RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# ROUTER URL Rewrite
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteRule ^(.*)$ index.php?route=/$1 [L,QSA]
```

#### nginx

````nginxconfig
location / {
  if ($script_filename !~ "-f"){
    rewrite ^(.*)$ /index.php?route=/$1 break;
  }
}
````

##### Routes

```php
<?php
require __DIR__ . "/../vendor/autoload.php";

use hardjunior\Router\Router;

$router = new Router("https://www.youdomain.com");

/**
 * routes
 * The controller must be in the namespace Test\Controller
 * this produces routes for route, route/$id, route/{$id}/profile, etc.
 */
$router->namespace("Test");

$router->get("/route", "Controller:method");
$router->post("/route/{id}", "Controller:method");
$router->put("/route/{id}/profile", "Controller:method");
$router->patch("/route/{id}/profile/{photo}", "Controller:method");
$router->delete("/route/{id}", "Controller:method");

/**
 * group by routes and namespace
 * this produces routes for /admin/route and /admin/route/$id
 * The controller must be in the namespace Dash\Controller
 */
$router->group("admin")->namespace("Dash");
$router->get("/route", "Controller:method");
$router->post("/route/{id}", "Controller:method");

/**
 * Group Error
 * This monitors all Router errors. Are they: 400 Bad Request, 404 Not Found, 405 Method Not Allowed and 501 Not Implemented
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Coffee:notFound");

/**
 * This method executes the routes
 */
$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}
```

##### Named

```php
<?php
require __DIR__ . "/../vendor/autoload.php";

use hardjunior\Router\Router;

$router = new Router("https://www.youdomain.com");

/**
 * routes
 * The controller must be in the namespace Test\Controller
 */
$router->namespace("Test")->group("name");

$router->get("/", "Name:home", "name.home");
$router->get("/hello", "Name:hello", "name.hello");
$router->get("/redirect", "Name:redirect", "name.redirect");

/**
 * This method executes the routes
 */
$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    $router->redirect("name.hello");
}
```

###### Named Controller Exemple

```php
class Name
{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function home(): void
    {
        echo "<h1>Home</h1>";
        echo "<p>", $this->router->route("name.home"), "</p>";
        echo "<p>", $this->router->route("name.hello"), "</p>";
        echo "<p>", $this->router->route("name.redirect"), "</p>";
    }

    public function redirect(): void
    {
        $this->router->redirect("name.hello");
    }
}
```

###### Named Params
````php
//route
$router->get("/params/{category}/page/{page}", "Name:params", "name.params");

//$this->route = return URL
//$this->redirect = redirect URL

$this->router->route("name.params", [
    "category" => 22,
    "page" => 2
]);

//result
https://www.{}/name/params/22/page/2

$this->router->route("name.params", [
    "category" => 22,
    "page" => 2,
    "argument1" => "most filter",
    "argument2" => "most search"
]);

//result
https://www.{}/name/params/22/page/2?argument1=most+filter&argument2=most+search
````

##### Callable

```php
/**
 * GET httpMethod
 */
$router->get("/", function ($data) {
    $data = ["realHttp" => $_SERVER["REQUEST_METHOD"]] + $data;
    echo "<h1>GET :: Spoofing</h1>", "<pre>", print_r($data, true), "</pre>";
});

/**
 * POST httpMethod
 */
$router->post("/", function ($data) {
    $data = ["realHttp" => $_SERVER["REQUEST_METHOD"]] + $data;
    echo "<h1>POST :: Spoofing</h1>", "<pre>", print_r($data, true), "</pre>";
});

/**
 * PUT spoofing and httpMethod
 */
$router->put("/", function ($data) {
    $data = ["realHttp" => $_SERVER["REQUEST_METHOD"]] + $data;
    echo "<h1>PUT :: Spoofing</h1>", "<pre>", print_r($data, true), "</pre>";
});

/**
 * PATCH spoofing and httpMethod
 */
$router->patch("/", function ($data) {
    $data = ["realHttp" => $_SERVER["REQUEST_METHOD"]] + $data;
    echo "<h1>PATCH :: Spoofing</h1>", "<pre>", print_r($data, true), "</pre>";
});

/**
 * DELETE spoofing and httpMethod
 */
$router->delete("/", function ($data) {
    $data = ["realHttp" => $_SERVER["REQUEST_METHOD"]] + $data;
    echo "<h1>DELETE :: Spoofing</h1>", "<pre>", print_r($data, true), "</pre>";
});

$router->dispatch();
```

##### Form Spoofing

###### This example shows how to access the routes (PUT, PATCH, DELETE) from the application. You can see more details in the sample folder. From an attention to the _method field, it can be of the hidden type.

Esse exemplo mostra como acessar as rotas (PUT, PATCH, DELETE) a partir da aplicação. Você pode ver mais detalhes na pasta de exemplo. De uma atenção para o campo _method, ele pode ser do tipo hidden.

```html
<form action="" method="POST">
    <select name="_method">
        <option value="POST">POST</option>
        <option value="PUT">PUT</option>
        <option value="PATCH">PATCH</option>
        <option value="DELETE">DELETE</option>
    </select>

    <input type="text" name="first_name" value="Ivamar"/>
    <input type="text" name="last_name" value="Junior"/>
    <input type="text" name="email" value="hardjunior1@gmail.com"/>

    <button>hardjunior</button>
</form>
```

##### PHP cURL exemple

```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://localhost/hardjunior/router/exemple/spoofing/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => "first_name=Ivamar&last_name=Junior&email=cursos%40upinside.com.br",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Content-Type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
```

## Support

###### Security: If you discover any security related issues, please email hardjunior1@gmail.com instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para hardjunior1@gmail.com em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Robson V. Leite](https://github.com/robsonvleite) (Developer)
- [UpInside Treinamentos](https://github.com/upinside) (Team)
- [All Contributors](https://github.com/robsonvleite/router/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/robsonvleite/router/blob/master/LICENSE) for more information.