<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add( "basicRoute", new Routing\Route( "/{package}/{controller}/{action}", [
    "package" => null,
    "controller" => "index",
    "action" => "index",
    '_controller' => 'Oak\Router\Dispatch::handler',
]),[
    'package' => '/d+',
    'controller' => '/d+',
    'action' => '/d+',
] );

return $routes;