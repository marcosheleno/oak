<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello', array(
    '_controller' => '\Library\Employee\Controller\IndexController::indexAction',
)));

return $routes;