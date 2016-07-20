<?php
namespace Oak\Router;

class Dispatch{
    public static function handler( $package, $controller, $action ){
        $className = '\Library\\' . self::normalizePackage($package) . '\Controller\\' . self::normalizePackage($controller) . 'Controller';
        if( !class_exists( $className ) ){
            throw new Exception( "Controller not founded at: '$className'!" );
        }

        $controller = new $className();
        $methodName = self::normalizePackage( $action ) .'Action';

        if( !method_exists( $controller, $methodName ) ) {
            throw new Exception("Action '$methodName' not founded!");
        }
        return $controller->$methodName();
    }

    public static function normalizePackage( $package ){
        $package = str_replace( ' ', '', ucwords( str_replace( '_',' ',$package ) ) );
        return $package;
    }
}