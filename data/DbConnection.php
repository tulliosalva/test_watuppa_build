<?php
class DbConnection
{
    public static function getDbConn()
    {
        $libPath = __DIR__ . "/../vendor/thingengineer/mysqli-database-class";
        require_once("$libPath/MysqliDb.php");
        require_once("$libPath/dbObject.php");
        $config = require __DIR__ . "/../data/db_config.php";
        extract($config);
        $db = new MysqliDb ($host, $username, $password, $db);
        return $db;
    }
}
?>