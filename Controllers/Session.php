<?php

/*
 * Handles everything about sessions.
*/

if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");

Class Session
{
    static function Check()
    {
    if(session_status()==2)
        {
            return 1;
        }
    elseif(session_status()==1)
        {
            return 0;
        }
    elseif(session_status()==0)
        {
            return -1;
        }
    }

    //Check n Turn ON session if not started.
    static function CnTON()
    {
        if(self::Check()==0)
        session_start();
    }
    //Checking does session exist for provided id
    static function IsThere($index)
    {
        if(isset($_SESSION[$index]))
            return 1;
        else return 0;
    }
    static function Role_Check($role)
    {
        if($_SESSION['role_id']<=$role)
        header("Location: localhost/Forum/");
    }
}


?>