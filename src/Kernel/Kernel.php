<?php


namespace App\Kernel;


use App\Facades\Route;
use App\Requests\Request;
use App\Response\Response;

class Kernel
{
    public function handle(Request $request): Response
    {
        return $this->prepareResponse(
            $request,
            $this->findRoute($request)
        );
    }
    private function detectingRoutes(){
        return require_once 'routes/api.php';
    }
    private function findRoute(Request $request)
    {
        return $this->detectingRoutes()[$request->path()] ?? new Response('no path');
    }
    private function prepareResponse(Request $request, $target){
        if($target instanceof Response){
            return $target;
        }
        if($request->method() == 'POST' && $request->method() == $target[0]){
            return Route::post($request->path(),$target[1]);
        }elseif($request->method() == 'GET' && $request->method() == $target[0]){
            return Route::get($request->path(),$target[1]);
        }
        return new Response('no allowed method');
    }

}