<?php

class Router{

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
private static $_POSTs = [];
private static $_GETs = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */

static private function _process_param_url($action){
    $variable = parse_url($action, PHP_URL_QUERY);
    parse_str($variable, $query);
    foreach($query as $param => $value){
        $_GET[$param] = $value;
    }
}

static function GET($action, Closure $callback){
    $action = trim($action, '/');

    self::$_GETs[$action] = $callback;
}

static function POST($action, Closure $callback){
    $action = trim($action, '/');
    self::$_POSTs[$action] = $callback;
}

/**
 *
 * @param $action string
 *
 */
static function dispatch($action)
{
    global $routes;
    $action = trim($action, '/');

    self::_process_param_url($action);
    
    $action = explode('?', $action)[0];    
    switch(true){
        case $_SERVER['REQUEST_METHOD'] == "GET":
            $callback = self::$_GETs[$action];
            break;
        case $_SERVER['REQUEST_METHOD'] == "POST":
            $callback = self::$_POSTs[$action];
            break;
    }
    call_user_func($callback);
}
}

?>