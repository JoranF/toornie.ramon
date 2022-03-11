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
        $this->host   = 'ec2-34-253-116-145.eu-west-1.compute.amazonaws.com';
        $this->dbname = 'd20afrlmsm5k7l';
        $this->user   = 'bpfvfronfwqovn';
        $this->pass   = 'e2f3577183c31cde56f27f88fbb725435cc3d45388fa0bf4fbc4189dfb65c8be';
        $this->port   = '5432';

        
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';port='.$this->port;
        
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
            return new PDO($this->dsn, $this->user, $this->pass,  $this->options);
        }
        catch(PDOException $e)
        {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
};

?>
