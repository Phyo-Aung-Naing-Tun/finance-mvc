<?php

namespace Root\App\Services\Migration;


class Blueprint
{
    private $table;

    private $columns;

    public function __construct($tableName)
    {
        $this->table = $tableName;
    }

    public function id($name = "id")
    {
        $this->columns[] = "`$name` INT AUTO_INCREMENT PRIMARY KEY UNIQUE NOT NULL";
        return $this;
    }

    public function string($name, $length = 225)
    {
        $this->columns[] = "`$name` VARCHAR($length) NOT NULL";
        return $this;
    }

    public function int($name)
    {
        $this->columns[] = "`$name` INT NOT NULL";
        return $this;
    }

    public function text($name)
    {
        $this->columns[] = "`$name` TEXT NOT NULL";
        return $this;
    }

    public function bool($name)
    {
        $this->columns[] = "`$name` BOOLEAN NOT NULL";
        return $this;
    }

    public function timestamps($name = null)
    {
        if ($name) {
            $this->columns[] = "`$name` TIMESTAMP NOT NULL";
        } else {
            $this->columns[] = "`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL";
            $this->columns[] = "`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL";
        };

        return $this;
    }

    public function nullable()
    {
        $transformData = [];
        foreach ($this->columns as $key => $column) {
            if ($key ==  count($this->columns) - 1) {
                $deleteNotNull = str_ireplace("NOT NULL", " ", $column);
                $column = $deleteNotNull . "NULL";
            }
            $transformData[] = $column;
        };
        $this->columns = $transformData;
        return $this;
    }

    public function default($value)
    {
        $transformData = [];
        foreach ($this->columns as $key => $column) {
            if ($key ==  count($this->columns) - 1) {
                $column = $column . " " . "DEFAULT $value";
            }
            $transformData[] = $column;
        };
        $this->columns = $transformData;
        return $this;
    }

    public function unique()
    {
        $transformData = [];
        foreach ($this->columns as $key => $column) {
            if ($key ==  count($this->columns) - 1) {
                $column = $column . " " . "UNIQUE";
            }
            $transformData[] = $column;
        };
        $this->columns = $transformData;
        return $this;
    }


    public function toSql()
    {
        $transformColumns = implode(",", $this->columns);
        return "CREATE TABLE `$this->table` ($transformColumns)";
    }
}
