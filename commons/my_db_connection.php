<?php

class dbconnection{
    public $con;
    private $dbhostname="localhost";
    private $dbusername="root";
    private $dbpassword="";
    private $dbname="FBM-2022";
    
    function __construct(){
        $this->con= new mysqli($this->dbhostname,
                $this->dbusername,
                $this->dbpassword,
                $this->dbname);
        
        if(!$this->con->connect_error)
        {
           $GLOBALS["con"]= $this->con; 
        }
        else
        {
            echo"Connection Error!";
        }
        
    }
    
    
}



