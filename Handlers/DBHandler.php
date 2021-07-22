<?php

/*
 * As named.
 ! TODO:
 ! info getting methods
*/

if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");

Final Class DBProc extends PDO
{
    private $hostname,$prep_sql,$dbn,$host,$usr,$pass,$conn_str,$data;  

    //Constructor creates connections without passing any arguments.

    function __construct($host_name='localhost',$db_name='forum',$user='root',$password='')
    {
        $this->hostname=$host_name;
        $this->dbn=$db_name;
        $this->usr=$user;
        $this->pass=$password;
        $this->conn_str="mysql:host=".$this->hostname.";dbname=".$this->dbn;
        parent::__construct($this->conn_str,$this->usr,$this->pass);
    }

    // Login Statement Preparation method
    function Log_SQL_Inject_Esc($dbh,$user,$password)
    {
        $this->prep_sql="SELECT * FROM user WHERE username=? AND pass=?";
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($user,$password));
        return $this->stmt->fetch_ALL(PDO::FETCH_BOTH);
    }

    // Log in handler, starts Session if not started and sets it.
    function Log_in_Handler($dbh,$user,$password)
    {
        $this->data=$this->Log_SQL_Inject_Esc($dbh,$user,$password);
        Session::CnTON();
        $_SESSION['logged']=1;
        $_SESSION['user']=$this->data['username'];
        $_SESSION['role_id']=$this->data['role_id'];
    }

    function LogIn($dbh,$user,$password)
    {
        $this->Log_in_Handler($dbh,$user,$password);
    }

    function Register($dbh,$user,$password,$email)
    {
        $this->prep_sql="INSERT INTO user(username, pass, email, role_id, approve_id, reg_date, lastseen) VALUES (?,?,?,?,?,?,?)";
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($user,$password,$email,1,0,date("Y-m-d"),date("Y-m-d H:i:s")));
        return 1;
    }
}
?>