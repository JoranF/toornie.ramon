<?php

require_once 'db.php';

class user
{
    private $db;
    private $dbh;
    
    public $first_name;
    public $last_name;
    public $email;
    
    public function __construct()
    {
        $this->db = new db();
        $this->dbh = $this->db->connect();
        
        $this->CreateUserSql = 'INSERT INTO users(email, pw) VALUES(:email, :pw)';
        $this->SelectUserSql = 'SELECT * FROM users WHERE id = :id';
    }
    
    private function Exists($email)
    {
        $user = $this->dbh->prepare('SELECT email FROM users WHERE email = :email');
        $user->execute(array(':email' => $email));
        $user_row = $user->fetch();
        
        return $email == $user_row['email'];
    }
    
    private function Create($first_name, $last_name, $email, $pw)
    {
        $hpw = password_hash($pw, PASSWORD_DEFAULT);
        $CreateUser = $this->dbh->prepare('INSERT INTO users(first_name, last_name, email, pw) VALUES(:first_name, :last_name, :email, :pw)');
        $CreateUser->execute(array('first_name' => $first_name, 'last_name' => $last_name, ':email' => $email, ':pw' => $hpw));
    }
    
    public function Register($first_name, $last_name, $email, $pw)
    {
        if($this->Exists($email)) { return false; }
        else                      { $this->Create($first_name, $last_name, $email, $pw); }
    }
    
    public function Login($email, $pw)
    {
        $user = $this->dbh->prepare('SELECT first_name,last_name,email,pw FROM users WHERE email = :email');
        $user->execute(array(':email' => $email));
        $user_row = $user->fetch();
        
        if(password_verify($pw, $user_row['pw']))
        {
            $this->first_name = $user_row['first_name'];
            $this->last_name  = $user_row['last_name'];
            $this->email      = $user_row['email'];
            
            return true;
        }
        else return false;
    }
};

?>
