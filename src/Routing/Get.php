<?php


namespace App\Routing;

use App\Requests\Get as Request;

class Get extends Router
{
    const METHOD = 'GET';
    protected $uri;
    protected $target;

    public function __construct($uri, $target, Request $request)
    {
        $this->uri = $uri;
        $this->target = $target;
    }
}