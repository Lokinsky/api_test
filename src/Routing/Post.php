<?php


namespace App\Routing;


use App\Facades\Route;
use App\Requests\Request;

class Post extends Router
{
    const METHOD = 'POST';
    protected $uri;
    protected $target;

    public function __construct($uri, $target, Request $request)
    {
        $this->uri = $uri;
        $this->target = $target;
    }

}