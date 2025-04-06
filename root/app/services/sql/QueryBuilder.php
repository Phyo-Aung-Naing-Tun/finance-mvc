<?php

namespace Root\App\Services\SQL;

use PDO;
use Root\App\Services\MainService;

class QueryBuilder extends MainService  implements QueryBuilderInterface
{

    private $database;
    private $table;
    private $fillables;
    private $keyValueCollection;
    private $columns;
    private $parameters;
    private $sql;

    public function __construct($database, $table, $fillables = null)
    {
        $this->database = $database;
        $this->table = $table;
        $this->fillables = $fillables;
    }


    public function create($value)
    {

        if (!$this->fillables || empty($value)) {
            $this->error(messages: ['No fillable fields or values provided.']);
        }

        try {
            $filterValue = array_intersect_key($value, array_flip($this->fillables));
            $filterValue = [...$filterValue, ...["created_at" => date("Y-m-d H:i:s"), "updated_at" => date("Y-m-d H:i:s")]];
            $columns = implode(",", array_keys($filterValue));
            $placeholders = implode(",", array_map(fn($field) => ":$field", array_keys($filterValue)));

            $sql = "INSERT INTO $this->table ({$columns}) VALUES ({$placeholders})";

            // Prepare the statement
            $query = $this->database->prepare($sql);

            // Bind values using bindParam (by reference)
            foreach ($filterValue as $key => $value) {
                $query->bindParam(":$key", $filterValue[$key]);
            }
            $query->execute();

            // Get last inserted ID
            $lastId = $this->database->lastInsertId();

            return $this->find($lastId);
        } catch (\PDOException $e) {
            $this->error(messages: [$e->getMessage()]);
        }
    }

    public function find($id)
    {
        try {
            $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $this->error(messages: [$e->getMessage()]);
        }
    }

    public function where($key, $operator = null, $value = null)
    {
        try {
            if (is_null($value)) {
                $value = $operator;
                $operator = "=";

                if (is_null($value)) {
                    return $this->error(messages: ["Compare value is required!"]);
                }
            }

            $this->keyValueCollection[$key] = ["sqlSample" => $key . " " . $operator . " " . ":$key", "value" => $value];

            $transformedPlaceholer = implode(" AND ", array_map(fn($data) => $data["sqlSample"], $this->keyValueCollection));

            $this->sql = "SELECT * FROM {$this->table} WHERE {$transformedPlaceholer}";

            return $this;
        } catch (\Exception $e) {
            return $this->error(messages: [$e->getMessage()]);
        }
    }

    public function get()
    {
        try {

            $this->sql = $this->sql ? $this->sql : "SELECT * FROM {$this->table}";

            $query = $this->execute();

            $data =  $query->fetchALL(PDO::FETCH_ASSOC);
            return $data ? $data : [];
        } catch (\PDOException $e) {
            $this->error(messages: [$e->getMessage()]);
        }
    }

    public function latest()
    {
        $sql = $this->sql ? $this->sql : "SELECT * FROM {$this->table}";

        $this->sql = $sql . " " . "ORDER BY updated_at DESC";
        dump($this->sql);

        return $this;
    }

    public function first()
    {
        $this->sql = $this->sql ? $this->sql . " " . "LIMIT 1" : "SELECT * FROM {$this->table} LIMIT 1";

        $query = $this->execute();

        $data =  $query->fetchALL(PDO::FETCH_ASSOC);

        return $data ? $data : null;
    }

    public function exist()
    {
        $data = $this->get();
        return count($data) > 0;
    }

    private function execute()
    {
        try {
            $query = $this->database->prepare($this->sql);

            if (!is_null($this->keyValueCollection)) {
                foreach ($this->keyValueCollection as $key => $value) {
                    $value = $value["value"] ? $value["value"] : $value;

                    $query->bindValue(":$key", $value);
                }
            }

            $query->execute();

            return $query;
        } catch (\PDOException $e) {
            $this->error(messages: [$e->getMessage()]);
        }
    }
}
