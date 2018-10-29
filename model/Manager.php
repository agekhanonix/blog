<?php
namespace OCFram\Blog\Model;
require_once('model/Instance.php');
class Manager extends Instance {
    private static $instance = null;                    // Hold the class instance

    private $dbType = "mysql";                          // SGBD type
    private $dbHost = DBHOST;                           // HostName
    private $dbPort = DBPORT;                           // N° Port
    private $dbUser = DBUSER;                           // SQL User
    private $dbPass = DBPASS;                           // SQL Password
    private $dbName = DBNAME;                           // Database Name
    private $dbConn;

    // The db connection is established in the private contructor
    public function __construct() {
        $this->dbConn = new \PDO(
            $this->dbType.":host=".$this->dbHost."; port=".$this->dbPort."; dbname=".$this->dbName."; charset=utf8",
            $this->dbUser,
            $this->dbPass,
            array(\PDO::ATTR_PERSISTENT => true, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    public function getConnexion() {
        return $this->dbConn;
    }
    public function dbConnect() {
        $conn = Manager::getInstance();
        return $conn->getConnexion(); 
    }
}