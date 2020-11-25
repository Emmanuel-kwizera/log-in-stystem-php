<?php
class DBConnect{
    private $host="localhost";
    private $user="rcaac_student";
    private $db="rcaac_002";
    private $pass="bQ2{nO!7m@ju";
    private $con;
    
    public function __construct(){
        $this->con = new PDO("mysql:host=".$this->host."; dbname=".$this->db, $this->user, $this->pass);
        return $this->con;                            
    } 
}
?>