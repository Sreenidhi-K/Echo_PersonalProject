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
$rand=mysqli_real_escape_string($conn,$_SESSION['fbcode']);
$sql_res4=mysqli_query($conn,"INSERT INTO tab$rand () 
VALUES(); ");
$sql_res=mysqli_query($conn,"SELECT COUNT(*) FROM tab$rand;");
$row2=mysqli_fetch_row($sql_res);
$iden=$row2[0];
$result1=mysqli_query($conn,"SELECT infodata FROM projectdata WHERE code='$rand' ;");
$rows1=mysqli_fetch_row($result1);
$some_info=json_decode($rows1[0]);
for($i=0; $i<count($some_info); $i++)
{
       $j=$i+1;
       $column="col$j"; 
        $index="a$j";
        $set_value=$_POST[$index];
    
        $ins_sql=mysqli_query($conn,"UPDATE tab$rand SET $column='$set_value' WHERE id='$iden';");
}
                        
$_SESSION['fbcode']="";

 echo("<h3 style='color:darkmagenta;font-size:40px;position:absolute;top:100px;left:500px;'> FeedBack Sent !! </h3><br><a id='goback' style='color:plum;background-color:black;padding:10px;text-decoration:none;font-size:20px;position:absolute;top:300px;left:500px;' type='button' href='your_homepage.php' > Go back to homepage </a>");
                   
                    

?>