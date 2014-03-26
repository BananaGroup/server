<?php
class Connect
{

    // database and instance
    private $_db;
    static $_instance;

    // database connection details
    private $HOST       =   'localhost';
    private $USERNAME   =   'user';
    private $PASSWORD   =   'password';
    private $DATABASE   =   'theheater';


    /**
     * Connect to Database
     */
    private function __construct() {

        $this->_db = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASE);

    }


    private function __clone() {}


    /**
     * Create or fetch Instance
     * @return  self     calls _construct for db connection
     */
    public static function getInstance() {

        if (! (self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }


    /**
     * Execute Query
     * @param  String $sql SQL Command
     * @return object      Call the query on the connection
     */
    public function query($sql) {

        return $this->_db->query($sql);

    }


}