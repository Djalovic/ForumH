<?php

/* TODO
 * Add more disallowed locations
 * Improve LogChecker
*/


if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");
if (!defined("location"))
    define("location",explode('/',$_SERVER['REQUEST_URI']));  

require_once(abs_path."Handlers/DB/DBHandler.php");
require_once(abs_path."Controllers/Auth/Auth.php");
Class Log_Contoller
{
    private static $disallowed_locs=array("Panel","Profile","Controllers","Handlers");
    private $dbh;
    //When instancing class, login is done by passing user n pass.

    function __construct($usr,$pass)
    {
        $this->dbh=new DBProc();
        $this->dbh->LogIn($this->dbh,$usr,$pass);
    }
    static function Log()
    {
        if(Auth::Logged() && (in_array("LogIn",location) || in_array("Register",location))) 
        {
            header("Location:http://localhost/Forum/");
            exit();
        }
        if(Auth::Logged()==0 && in_array(location[count(location)-2],self::$disallowed_locs))
        {
            header("Location:http://localhost/Forum/");
            exit();
        }
    }
    function LogOut()
    {
        session_destroy();
    }
}   

Log_Contoller::Log();
?>