<?php


namespace App\Controllers;


use App\Models\Author;
use App\Requests\Post;

class AuthorController
{
    public function add()
    {
        $request = new Post();
        $author = new Author(
            [
                'name' => 'Vovad',
                'surname' => 'Kekov'
            ]
        );
        return ['foo' => 'bar'];
    }
}