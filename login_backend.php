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
?>

<html>

    <head>
        <title> Login page-fb </title>
    </head>
    
    <body>
    
        <?php
        
        if(isset($_POST['login_submit']))
        {
          $name_user=mysqli_real_escape_string($conn,$_POST['user_name']);  
          $pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
          $encrypt_pwd=md5($pwd);
          $res = mysqli_query($conn,"SELECT * FROM userlist WHERE username='$name_user' AND pass='$encrypt_pwd'");
             
            if(mysqli_num_rows($res)==1)
             {
                 
                 $_SESSION["un_ss"] =$_POST['user_name'];
                 $_SESSION["pw_ss"] = md5($_POST['pwd']);
                  
                 $_SESSION['fbcode']="";
                 header("Location: your_homepage.php");
             }
            else
            {
                echo("<h3 style='color:darkmagenta;font-size:40px;position:absolute;top:100px;left:500px;'> Login Unsuccessful ! </h3><br><a id='redirect_b' style='color:plum;background-color:black;padding:10px;text-decoration:none;font-size:20px;position:absolute;top:300px;left:500px;' type='button' href='login.php' > Go back </a>");
            }
        
        }
        
        else
        {
            echo("Wrong way !");
        }
        ?>

    </body>
</html>