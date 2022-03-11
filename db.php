<?php

class db
{
    private $host;
    private $dbname;
    private $user;
    private $pass;
    
    private $dsn;
    
    private $options;
    
    function __construct()
    {
        $this->host   = 'localhost';
        $this->dbname = 'toornooi';
        $this->user   = 'root';
        $this->pass   = '';
        
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        $this->options = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        );
    }
    
    function connect()
    {
        try
        {
            return new PDO($this->dsn, $this->user, $this->pass, $this->options);
        }
        catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
};

?>
