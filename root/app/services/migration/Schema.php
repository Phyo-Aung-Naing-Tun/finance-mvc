<?php

namespace Root\App\Services\Migration;

use Root\App\Services\Database\DBFactory;

class Schema
{
    public static function create($tableName, $callBack)
    {

        $bluePrint = new Blueprint($tableName);
        call_user_func($callBack, $bluePrint);
        $sqlStatement = $bluePrint->toSql();
        $database =  (new DBFactory())->build();
        $database->exec($sqlStatement);
    }

    public static function hasTable($tableName)
    {
        $database =  (new DBFactory())->build();
        $stmt = $database->prepare("SHOW TABLES LIKE ?");
        $stmt->execute([$tableName]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function dropIfExists($table) {}
}
