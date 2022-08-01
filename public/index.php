<?php

include __DIR__ . './../vendor/autoload.php';

use App\Controllers\AuthenticationController;
use App\Controllers\DashboardController;
use App\Controllers\UserController;
use App\Controllers\CustomerController;
use App\Controllers\ProviderController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\TypeController;
use App\Controllers\SalesController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

if ($_ENV['ENVIRONMENT'] != "production") {
    // Show errors
    error_reporting(-1);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
}

ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));

// Start session
session_start();

// Create a server request object form global variables of PHP.
//    $_SERVER
//    $_GET
//    $_POST
//    $_COOKIE
//    $_FILES
$request = Request::createFromGlobals();

// Get a context of request.
$context = new RequestContext();
$context->fromRequest($request);

// Create the router container and get the routing map.
$routes = new RouteCollection();

// Add the routes to the map, and a handler for it.
$routes->add('index', new Route(
    '/',
    [
        'controller' => AuthenticationController::class,
        'method' => 'getLogin',
    ]
));
$routes->add('login', new Route(
    '/login',
    [
        'controller' => AuthenticationController::class,
        'method' => 'postLogin',
    ]
));
$routes->add('logout', new Route(
    '/logout',
    [
        'controller' => AuthenticationController::class,
        'method' => 'getLogout',
    ]
));
$routes->add('home', new Route(
    '/home',
    [
        'controller' => DashboardController::class,
        'method' => 'getIndex',
    ]
));

// Sellers routes
$routes->add('employees', new Route(
    '/employees',
    [
        'controller' => UserController::class,
        'method' => 'getIndex',
    ]
));

$routes->add('api/employees', new Route(
    '/api/employees',
    [
        'controller' => UserController::class,
        'method' => 'get',
    ]
));

$routes->add('api/employees/add', new Route(
    '/api/employees/add',
    [
        'controller' => UserController::class,
        'method' => 'postUser',
    ]
));

$routes->add('api/employees/edit', new Route(
    '/api/employees/edit',
    [
        'controller' => UserController::class,
        'method' => 'editUser',
    ]
));

// Customers Routes
$routes->add('customers', new Route(
    '/customers',
    [
        'controller' => CustomerController::class,
        'method' => 'getIndex',
    ]
));

$routes->add('api/customers', new Route(
    '/api/customers',
    [
        'controller' => CustomerController::class,
        'method' => 'get',
    ]
));

$routes->add('api/customers/add', new Route(
    '/api/customers/add',
    [
        'controller' => CustomerController::class,
        'method' => 'postCustomer',
    ]
));

$routes->add('api/customers/edit', new Route(
    '/api/customers/edit',
    [
        'controller' => CustomerController::class,
        'method' => 'editCustomer',
    ]
));

// Providers Routes
$routes->add('providers', new Route(
    '/providers',
    [
        'controller' => ProviderController::class,
        'method' => 'getIndex',
    ]
));

$routes->add('api/providers', new Route(
    '/api/providers',
    [
        'controller' => ProviderController::class,
        'method' => 'get',
    ]
));

$routes->add('api/providers/add', new Route(
    '/api/providers/add',
    [
        'controller' => ProviderController::class,
        'method' => 'postProvider',
    ]
));

$routes->add('api/providers/edit', new Route(
    '/api/providers/edit',
    [
        'controller' => ProviderController::class,
        'method' => 'editProvider',
    ]
));

// Sales Routes
$routes->add('sale', new Route(
    '/sale',
    [
        'controller' => SalesController::class,
        'method' => 'getSale',
    ]
));
$routes->add('sales', new Route(
    '/sales',
    [
        'controller' => SalesController::class,
        'method' => 'getIndex',
    ]
));
$routes->add('api/sale/add', new Route(
    '/api/sales/add',
    [
        'controller' => SalesController::class,
        'method' => 'postSale',
    ]
));
$routes->add('api/sales', new Route(
    '/api/sales',
    [
        'controller' => SalesController::class,
        'method' => 'get',
    ]
));

// Products Routes
$routes->add('products', new Route(
    '/products',
    [
        'controller' => ProductController::class,
        'method' => 'getIndex',
    ]
));

$routes->add('api/products', new Route(
    '/api/products',
    [
        'controller' => ProductController::class,
        'method' => 'get',
    ]
));

$routes->add('api/products/add', new Route(
    '/api/products/add',
    [
        'controller' => ProductController::class,
        'method' => 'postProduct',
    ]
));

$routes->add('api/products/edit', new Route(
    '/api/products/edit',
    [
        'controller' => ProductController::class,
        'method' => 'editProduct',
    ]
));

// Categories Routes
$routes->add('api/categories', new Route(
    '/api/categories',
    [
        'controller' => CategoryController::class,
        'method' => 'get',
    ]
));
// Types Routes
$routes->add('api/types', new Route(
    '/api/types',
    [
        'controller' => TypeController::class,
        'method' => 'get',
    ]
));

try {
    // Get the route matcher from the container ...
    $matcher = new UrlMatcher($routes, $context);
    $route = $matcher->match($context->getPathInfo());

    // Dispatch the request to the route handler.
    $controller = new $route['controller'];
    $method = $route['method'];
    $response = $controller->$method($request);
} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Throwable $throwable) {
    $response = new Response('An error occurred<br>' . $throwable, 500);
}

// Emit the response
http_response_code($response->getStatusCode());
echo $response->getContent();
