<?php
namespace OCFram\Blog\Model;

class Singleton {
    private static $instance = null;                    // Hold the class instance
    private $dbConn;

    private $dbHost = DBHOST;
    private $dbPort = DBPORT;
    private $dbUser = DBUSER;
    private $dbPass = DBPASS;
    private $dbName = DBNAME;

    // The db connection is established in the private contructor
    public function __construct() {
        $this->dbConn = new \PDO("mysql:host={$this->dbHost};port={$this->dbPort};dbname={$this->dbName};charset=utf8", 
            $this->dbUser, $this->dbPass,
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->dbConn;
    }
}