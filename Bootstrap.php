<?php
require_once __DIR__ . '/vendor/autoload.php';

use \Oak\Http\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$request = \Oak\Http\Request::createFromGlobals();
$response = new Response();

$routes = include __DIR__ . '/Router.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);

$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$request->attributes->add($matcher->match($request->getPathInfo()));
$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (\Oak\Router\Exception $e) {
    $response = new Response( $e->getMessage(), 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();