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
        $this->host   = 'ec2-52-211-158-144.eu-west-1.compute.amazonaws.com';
        $this->dbname = 'd7e1f0hlef1d09';
        $this->user   = 'bhixzczxqlzvfp';
        $this->pass   = 'f693a65b786a7384b0eb8f4ec9f958fff12e3e5a313194571f0753b09c75bbc1';
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
