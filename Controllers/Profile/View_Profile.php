<?php
/*
    * TODO:
    * URL SHORTENER WITH .HTACS
*/
Class Profile
{
    private $edit_en=0;
    function __construct($user)
    {
        if($_SESSION['user']==$user)
        {
            $this->edit_en=1;
        }
        if($_SESSION['role_id']>2)
        {
            $this->edit_en=2;
        }
    }
    private function Show_Edit_Btn()
    {
        //btns n shit
    }
    public function Show_Edit()
    {
        //req_once() <- HTML Edit Template
    }
    public function Show($user)
    {
        $dbh=new DBProc();
        $data=$dbh->SelectUser($dbh,$user);
        var_dump($data);//TODO: EDIT THIS SHIT
        $this->Show_Edit_Btn();
    }
    public function Edit($old_usr,$new_usr,$pass,$pass_confirm,$new_pass,$email,$new_role,$app_id)
    {
        if($this->edit_en==1 && $pass==$pass_confirm)
        {
            $dbc=new DBProc();
            $dbc->LogIn($dbc,$old_usr,$pass);
            if($dbc->data==NULL)
                return false;
            else
                return $dbc->Update_User($old_usr,$new_usr,$new_pass,$email,$new_role);        
        }
        elseif($this->edit_en==2)
        {
            $dbc=new DBProc();
            return $dbc->Update_User($old_usr,$new_usr,$new_pass,$email,$new_role,$app_id);
        }
    }
}

?>