<?php
unset($_SESSION['role_id']);
unset($_SESSION['user']);
$_SESSION['logged']=0;
session_destroy();
header("Location: http://localhost/Forum/");
?>