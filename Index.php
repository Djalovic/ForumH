<?php
if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");
if (!defined("location"))
    define("location",explode('/',$_SERVER['REQUEST_URI']));  
require_once(abs_path."Controllers/Session/Session.php");
require_once(abs_path."Handlers/DB/DBHandler.php");
require_once(abs_path."Controllers/Auth/Auth.php");
require_once(abs_path."Controllers/Profile/View_Profile.php");
Session::CnTON();
if (!Auth::Logged())
    require_once(abs_path."Pagers/Homepage.php");
else
    require_once(abs_path."Pagers/Home.php");
    
?>
