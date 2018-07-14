<?php
session_start();
if(isset($_POST['tit_submit']))
{

if(!$_POST['title_proj'])
{
    header("Location:your_homepage.php");
}
else
{
    $_SESSION['title_new']=$_POST['title_proj'];
    $_SESSION['tit_submit']='true';
    header("Location:create_project.php");
}

}
else
echo("Wrong way");


?>