<?php


namespace App\Routing;


use App\Requests\Request;
use App\Response\Response;

class Router
{
    protected $response;

    protected function execute($class, $method){
        return (new $class())->$method();
    }
    protected function checkPath(Request $request): bool
    {
        return $request->path() == $this->uri;
    }

    protected function validateMethod(Request $request, $method): bool
    {
        return $request->method() == $method;
    }
    protected function makeResponse($data){
        return new Response($data);
    }
    public function evaluate(Request $request)
    {
        if ($this->validateMethod($request, static::METHOD) && $this->checkPath($request)) {
            return $this->makeResponse($this->execute($this->target[0], $this->target[1]));
        }
        return false;
    }
}