<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <form method="POST">
            <input type="text" name="new_usr">
            <input type="password" name="new_pass">
            <input type="email" name="email">
            <input type="password" name="pass">
            <input type="password" name="pass_conf">
            <input type="submit">
        </form>
    </body>
</html>
<?php
function Edit_Sh()
{   
    $dbh=new DBProc();
    $data=$dbh->GetRoles($dbh,$_SESSION['role_id']);
    echo "<form method='POST'>";
    echo "<input type='text' name='new_usr'>";
    if($_SESSION['role_id']>2)
    {
        echo "<select name='role'>";
        foreach($data as $row)
        echo "<option value=".$data['id'].">".$data['title']."</option>";
        echo "</select>";
        echo "<select name='app_id'>";
        echo "<option value='0'>Restrict</option>";
        echo "<option value='1'>Approve</option>";
        echo "</select>";
    }
    else
    {
        echo "<input type='password' name='new_pass'>";
        echo "<input type='email' name='mail'>";
        echo "<input type='password' name='pass'";
        echo "<input type='password' name='pass_conf'";
    }
    echo "</form>";
}
?>