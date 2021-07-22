<?php

/*
 * Just doing it shit, when pass params it calls prepared statement register method.
*/
Final Class Register
{
    private $dbh;
    function __construct($user,$pass,$email)
    {
        $this->dbh=new DBProc();
        $this->dbh->Register($this->dbh,$user,$pass,$email);
        //ADD PHP MAILER to $email!
    }
    function __destruct(){}

}
?>