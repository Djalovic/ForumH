<?php

if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");
if (!defined("location"))
    define("location",explode('/',$_SERVER['REQUEST_URI'])); 

/*

*/
function RestrictAccess($id)
{
    if($_SESSION['role_id']<$id)
        {
            header("Location:http://localhost/Forum/");
            exit();
        }
}
?>