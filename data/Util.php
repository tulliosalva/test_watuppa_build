<?php
include_once __DIR__.'/DbConnection.php';
class Util {

    private $prefix = "tullio_test_";
    private $dbConn;

    public function __construct() {
        $this->dbConn = DbConnection::getDbConn();
    }
    public function init () {
        //controllo se sono già state create te tabelle necessarie
        if(empty($this->dbConn->rawQuery("SHOW TABLES LIKE '{$this->prefix}users'"))) {
            //se non lo sono, le genero
            include __DIR__."/data_generator.php";
        }
    }
    public function getUsersEmails() {
        return $this->dbConn->get($this->prefix."users", null, ['email']);
    }

    public function getOrdersByUserEmail($email) {

        $this->dbConn->join("{$this->prefix}users u", "o.userId = u.id", "INNER");
        $this->dbConn->join("{$this->prefix}products p", "o.productId = p.id", "INNER");
        $this->dbConn->where('u.email', $email);
        $this->dbConn->where('o.createdAt >= NOW() - INTERVAL 30 DAY');
        $this->dbConn->orderBy("o.createdAt", "DESC");
        $rows = $this->dbConn->get("{$this->prefix}orders o", null, "u.nome, u.cognome, p.productName, o.createdAt");

        return $rows;
    }

}