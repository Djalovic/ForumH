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
    private $hostname,$prep_sql,$dbn,$host,$usr,$pass,$conn_str,$data=NULL;  

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
    private function Log_SQL_Inject_Esc($dbh,$user,$password)
    {
        $this->prep_sql="SELECT * FROM user WHERE username=? AND pass=?";
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($user,$password));
        return $this->stmt->fetch(PDO::FETCH_BOTH);
    }

    // Log in handler, starts Session if not started and sets it.
    private function Log_in_Handler($dbh,$user,$password)
    {
        $this->data=$this->Log_SQL_Inject_Esc($dbh,$user,$password);
        Session::CnTON();
        $_SESSION['logged']=1;
        $_SESSION['user']=$this->data['username'];
        $_SESSION['role_id']=$this->data['role_id'];
    }

    public function LogIn($dbh,$user,$password)
    {
        $this->Log_in_Handler($dbh,$user,$password);
    }

    public function Register($dbh,$user,$password,$email)
    {
        $this->prep_sql="INSERT INTO user(username, pass, email, role_id, approve_id, reg_date, lastseen) VALUES (?,?,?,?,?,?,?)";
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($user,$password,$email,1,0,date("Y-m-d"),date("Y-m-d H:i:s")));
        return 1;
    }
    public function SelectUser($dbh,$usr)
    {
        $this->prep_sql="SELECT user.username,user.email,user.reg_date,user.lastseen,user.post_num,roles.title,approve.title FROM user LEFT JOIN roles ON user.role_id=roles.id LEFT JOIN approve ON user.approve_id=approve.id WHERE user.username=?";      
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($usr));
        return $this->stmt->fetch(PDO::FETCH_BOTH);
    }
    private function GetID($dbh,$user)
    {
        $this->prep_sql="SELECT id FROM user WHERE username=?";
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($user));
        return $this->stmt->fetch(PDO::FETCH_BOTH);
    }
    public function Update_User($dbh,$old_usr,$new_usr,$new_pass,$email,$new_role=0,$app_id=1)
    {
        if($new_role!=0)
            $this->prep_sql="UPDATE user SET username=?,pass=?,email=? WHERE id=?";
        else
            $this->prep_sql="UPDATE user SET username=?,pass=?,email=?,role_id=?,approve_id=? WHERE id=?";
        $this->stmt=$dbh->prepare($this->prep_sql);
        if($new_role==0)
            return $this->stmt->exec(array($new_usr,$new_pass,$email,$this->GetID($dbh,$old_usr)));
        else
            return $this->stmt->exec(array($new_usr,$new_pass,$email,$new_role,$app_id,$this->GetID($dbh,$old_usr)));
    }
    public function GetRoles($dbh,$role)//requested var role is role of caller
    {
        $this->prep_sql="SELECT id,title FROM roles WHERE id<?";
        $this->stmt=$dbh->prepare($this->prep_sql);
        $this->stmt->execute(array($role));
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>