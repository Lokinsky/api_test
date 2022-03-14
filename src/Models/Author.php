<?php


namespace App\Models;


class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = [
        'surname' => [
            'validate' => [
                'length' => '>3',
            ],
            'empty' => false,
            'length' => 30,
        ],
        'name' => [
            'empty' => false,
            'length' => 30,
        ],
        'last_name' => [
            'empty' => true,
            'length' => 30,
        ],
    ];

    public function add($data){
        $this->fill($data);
        $this->save();
    }
}