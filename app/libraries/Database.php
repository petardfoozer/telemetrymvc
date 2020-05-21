<?php

/**
 * PDO Database class that connects to our database, creates prepared statements, binds values, returns rows and results
 */
 class Database{

    /**
     * database hostname
     * @string
     */
    private $host = DB_HOST;

    /**
     * database user
     * @string
     */
    private $user = DB_USER;

    /**
     * database password
     * @string
     */
    private $pass = DB_PASS;

    /**
     * database db name
     * @sting
     */
    private $dbname = DB_NAME;

    /**
     * Database handler for prepared statements
     */
    private $dbh;

    /**
     * Database statement
     */
    private $stmt;

    /**
     * Property for database errors
     */
    private $error;

    public function __construct(){
        //Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $ex){
            $this->error = $ex->getMessage();
            echo $this->error;
        }
    }

    /**
     * A function to prepare database queries
     * @string
     */
    public function query(string $query){
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * A function to bind values
     */
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * A function to execute the prepared statement
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * Gets a result set as an array of objects
     */
    public function resultsAsObject(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Gets a result as a single record object
     */
    public function singleResult(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Gets a row count
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }

 }