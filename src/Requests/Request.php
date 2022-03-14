<?php

namespace App\Requests;


class Request
{
    protected $method;
    public $params;
    protected $path;
    protected $query;

    public function __construct()
    {
        $parsed = parse_url($_SERVER['REQUEST_URI']);
        $this->path = $parsed['path'];
        $this->query = isset($parsed['query']) ? explode($parsed['query'], '=') : [];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    protected function getJson(){
        $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        if (stripos($content_type, 'application/json') === false) {
            throw new \Exception('Content-Type must be application/json');
        }
        $this->params = (array)json_decode(file_get_contents("php://input"),true);
    }
    public function get($key)
    {
        return array_merge($this->params, $this->query)[$key] ?? null;
    }

    public function method()
    {
        return $this->method;
    }

    public function path()
    {
        return $this->path;
    }


}
