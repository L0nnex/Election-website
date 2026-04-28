<?php

namespace database;

class database{
  
  private $dbHandle = false;
    
  public function __construct() {

        // parse the configuration file for databases
        $config = parse_ini_file('dbconfig.ini');

        $driver = $config['driver'];
        $host = $config['host'];
        $dbname = $config['schema'];
        $username = $config['username'];
        $password = $config['password'];

        try{
        // open a database connection and make sure it is working
		    $pdo = new \PDO("$driver:host=$host;dbname=$dbname", $username, $password);

        }
        
        catch(\PDOExeption $e){

        die("Connection failed: " . $e->getMessage());

        }

        // store the database handle instance so it can be used in child models
		$this->dbHandle = $pdo;
	}

  // Return PDO connection
    public function getConnection()
    {
        return $this->dbHandle;
    }
}

?>

