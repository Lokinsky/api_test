<?php

namespace App\Models;

use App\Database\DB;

class Model
{
    /**
     * Базовый клас моделей,
     * который предоставляет минимальный набор общих инструментов
     */
    protected $id;
    protected $db;
    private $where;
    private $lastBool;

    public function __construct($data = [])
    {
        $this->db = new DB();
        $this->fill($data);
    }

    protected function fill($data)
    {
        foreach ($data as $key => $field) {
            $this->$key = $field;
        }
    }

    public function db()
    {
        return $this->db;
    }

    public function validate()
    {
        foreach ($this->fillable as $key => $filled) {
            if ($info = $this->validator($key, $filled)) {
                return 'Property ' . $info . ' ' . $key . ' is validate failed';
            }
        }
        return true;
    }

    private function validator($property, $validationParams)
    {
        foreach ($validationParams as $name => $condition) {
            switch ($name) {
                case 'validate':
                    if (!boolval(strlen($this->$property) . $condition['length'])) {
                        return false;
                    }
                    break;
                case 'length':
                    if (isset($this->$property) && strlen($this->$property) > $condition) {
                        return false;
                    }
                    break;
                case 'empty':
                    if (!$condition && empty($this->$property) === true) {
                        return false;
                    }
                    break;
                default:
                    return true;
            }
        }
        return false;
    }

    public function save()
    {
        if (($info = $this->validate()) !== true) {
            throw new \Exception($info);
        }
        $data = [];
        foreach (array_keys($this->fillable) as $field) {
            if (!empty($this->$field)) {
                $data[$field] = $this->$field;
            }
        }
        return $this->db()->insert($this->table, $data);
    }

    public static function find($id)
    {
        $instance = new static();
        $fetched = $instance
            ->db()
            ->row('select * from ' . $instance->table . ' where `id`=' . $id . ';');
        if(empty($fetched)){
            return [];
        }
        $instance->fill($fetched);
        return $instance;
    }

    public static function all($collumns = '*')
    {
        if (is_array($collumns)) {
            $collumns = implode(',', $collumns);
        }
        $instance = new static();
        $fetched = $instance
            ->db()
            ->query('select ' . $collumns . ' from ' . $instance->table . ';');
        $returned = [];
        foreach ($fetched as $item) {
            $returned[] = new static($item);
        }
        return $returned;
    }

    public function update($data)
    {
        $parameters = [];
        foreach ($data as $key => $item) {
            $parameters[] = '`' . $key . '`=:' . $key . '';
        }
        return $this
            ->db()
            ->query(
                'update ' . $this->table . ' set '
                . implode(',', $parameters) . ' where id=' . $this->id,
                $data
            );
    }

    public function delete(){
        return $this->db()->query('delete from '.$this->table.' where id='.$this->id);
    }

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }
}