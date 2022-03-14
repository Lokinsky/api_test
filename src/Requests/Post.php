<?php


namespace App\Requests;


class Post extends Request
{
    public function __construct()
    {
        parent::__construct();
        parent::getJson();
    }
}