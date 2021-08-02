Constants defined below are being used for routing files.
if(!defined("abs_path"))
    define("abs_path",$_SERVER['DOCUMENT_ROOT']."/Forum/");
if (!defined("location"))
    define("location",explode('/',$_SERVER['REQUEST_URI'])); 