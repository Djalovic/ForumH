<?php


if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");
if (!defined("location"))
    define("location",explode('/',$_SERVER['REQUEST_URI']));  

require_once(abs_path."Controllers/Log_Cont.php");

$login=new Log_Contoller($_POST['user'],$_POST['pass']);
header("Location:http://localhost/Forum/");
exit();
?>