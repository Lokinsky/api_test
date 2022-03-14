<?php


namespace App\Models;


class Journal extends Model
{
    protected $table = 'journals';
    protected $fillable = [
        'name' => [
            'empty' => false,
            'length' => 45,
        ],
        'shortcut' => [
            'empty' => false,
            'length' => 30,
        ],
        'img' => [
            'empty' => true,
            'length' => 45,
        ],
        'authors_id' => [
            'empty' => false,
            'length' => 45,
        ],
        'created_at' => [
            'empty' => false,
        ],
    ];
    public function createJournal($data){

    }
}