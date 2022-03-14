<?php
namespace App\Facades;

use App\Routing\Router;

class Route
{
    public static function __callStatic($name, $arguments)
    {
        $name = ucfirst($name);
        $target = $arguments[1];
        $router = '\\App\\Routing\\'.$name;
        $request = '\\App\\Requests\\'.$name;
        $request = new $request();
        return (new $router(
            $arguments[0],
            $target,
            $request
        ))->evaluate($request);
    }
}