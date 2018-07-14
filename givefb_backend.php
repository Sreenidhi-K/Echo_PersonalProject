<?php
session_start();
$host="localhost";
$dbuser="root";
$pass="";
$dbname="feedback";
$conn=mysqli_connect($host,$dbuser,$pass,$dbname);
if(mysqli_connect_errno())
{
    echo("Connection failed");

}
if(isset($_POST['code_submit']))
{
$_SESSION['fbcode']=$_POST['the_code'];
header("Location: give_fb.php");
}
else
{
    echo('Na na');
}

?>