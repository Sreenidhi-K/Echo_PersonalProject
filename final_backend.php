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
//create table projectdata( iden int PRIMARY KEY AUTO_INCREMENT, code int , title varchar(1000), admin varchar(1000), status varchar(100), formdata varchar(10000), infodata varchar(1000));
if(isset($_POST['fin']))
{   $ar=json_decode($_SESSION['lin']);
    $arlen=count($ar);
    $imp=json_decode($_SESSION['pla']);
    $x=$_SESSION['lin'];
    $y=$_SESSION['pla'];
    if(count($imp))
    {
  
    $code_random=mt_rand(10000,99999);
    $tit=mysqli_real_escape_string($conn,$_SESSION['title_new']);
    $admin_name=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
   

    $sql_res=mysqli_query($conn,"INSERT INTO projectdata(code,title,admin,status,formdata,infodata) VALUES('$code_random','$tit','$admin_name','open','$x','$y');");
        
    $sql_res2=mysqli_query($conn,"CREATE TABLE tab$code_random (id int primary key auto_increment);");
    $implen=count($imp);
    $i=0;
    for( $j=0 ; $j<$implen; $j++)
    {
         $ret=$j+1;
         $sql_res3=mysqli_query($conn,"ALTER TABLE tab$code_random
            ADD col$ret  VARCHAR(10000) DEFAULT 'none';");
        
    }
        $sql_res4=mysqli_query($conn,"INSERT INTO tab$code_random () 
VALUES(); ");
    for( $j=0 ; $j<$implen; $j++)
    {
        $ret=$j+1;
        if($imp[$j]=="q")
        {
            $new_arr=array();
           
             $str=$ar[$i];
            $new_arr[0]=$_POST[$str];
            $i++;
            $inform= json_encode($new_arr);
              $sql_res4=mysqli_query($conn,"UPDATE tab$code_random SET col$ret='$inform' WHERE id='1' ;");
       
        }
        elseif($imp[$j]=="r")
        {
             $new_arr=array();
           
             $str=$ar[$i];
            $new_arr[0]=$_POST[$str];
            $i++;
             $str=$ar[$i];
            $new_arr[1]=$_POST[$str];
            $i++;
           $inform= json_encode($new_arr);
              $sql_res4=mysqli_query($conn,"UPDATE tab$code_random SET col$ret='$inform' WHERE id='1' ;");
       
        }
        else
        {
            $tree=(int)($imp[$j]);
             $new_arr=array();
          
             $str=$ar[$i];
            $new_arr[0]=$_POST[$str];
            $i++;
            for($k=1; $k<=$tree; $k++)
            {
                 $str=$ar[$i];
                $new_arr[$k]=$_POST[$str];
                $i++;
            }
             $inform= json_encode($new_arr);
              $sql_res4=mysqli_query($conn,"UPDATE tab$code_random SET col$ret='$inform' WHERE id='1' ;");
       
        }
    }
    
        
        
 header("Location: your_homepage.php");
   
    
    
    }
 else
 {
     echo("Enter feedback form values");
 }
    
}
else
{
    echo("Wrong way");
}
?>