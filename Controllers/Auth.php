<?php

/*
 * In this file am doing all auth shi*t
 * TODO:
 * log in func
 * reg func
 * protect file
 * logout func
*/

if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");

require_once("Session.php");

Class Auth
{
    protected $logged;
    static function Logged()
    {
        if(Session::Check() && Session::IsThere('Logged'))
            return 1;
        else 
            return 0;
    }
}
?>