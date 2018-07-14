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
    <title> Signup page-fb </title>
    </head>
    
    <body>
    
        <?php
        
        if(isset($_POST['sign_submit']))
        {
            $name_of=mysqli_real_escape_string($conn,$_POST['first_n']);
            $name_user=mysqli_real_escape_string($conn,$_POST['user_name']);
            $email_id=mysqli_real_escape_string($conn,$_POST['email_id']);
            $pwd=mysqli_real_escape_string($conn,$_POST['pass_word']);
            $con_pwd=mysqli_real_escape_string($conn,$_POST['con_pass_word']);
            $hashed_pwd=md5($pwd);
            
            $res = mysqli_query($conn,"SELECT * FROM userlist WHERE username='$name_user'");
            
            
            if(empty($name_of) || empty($name_user) || empty($email_id) || empty($pwd) || empty($con_pwd) )
            {
                echo("<h3 style='color:darkmagenta;font-size:40px;position:absolute;top:100px;left:500px;'>Cannot leave any field blank !</h3><br><a type='button' style='color:plum;background-color:black;padding:10px;text-decoration:none;font-size:20px;position:absolute;top:300px;left:500px;'  id='redirect_b' href='signup.php'> Go Back </a>");
        
            }
            else if($pwd!=$con_pwd)
            {
                echo("<h3 style='color:darkmagenta;font-size:40px;position:absolute;top:100px;left:500px;'>Passwords must match</h3><br><a type='button' style='color:plum;background-color:black;padding:10px;text-decoration:none;font-size:20px;position:absolute;top:300px;left:500px;' id='redirect_b' href='signup.php'> Go Back </a>");
                
            }
            else if(mysqli_num_rows($res)==1)
            {
                echo("<h3 style='color:darkmagenta;font-size:40px;position:absolute;top:100px;left:500px;'>User exists ; Change the username</h3><br><a type='button'  style='color:plum;background-color:black;padding:10px;text-decoration:none;font-size:20px;position:absolute;top:300px;left:500px;' id='redirect_b' href='signup.php'> Go Back </a>");
            }

            else
            {
                $sql="INSERT INTO userlist(name, email, username, pass) VALUES('$name_of', '$email_id', '$name_user', '$hashed_pwd');";
                $result=mysqli_query($conn,$sql); 
                
               /* $some_res=mysqli_query($conn,"SELECT id FROM userlist WHERE username='$name_user';");
                $rows=mysqli_fetch_row($some_res);
                $id_res=$rows[0];*/
                
                
               
                    echo("<h3 style='color:darkmagenta;font-size:40px;position:absolute;top:100px;left:500px;'>Signed up successfully !!</h3><br><a id='redirect_b' type='button' style='color:plum;background-color:black;padding:10px;text-decoration:none;font-size:20px;position:absolute;top:300px;left:500px;' href='login.php' > LOG IN </a>");
                    
                    
               
            }
        }
        else
        {
            echo("hmmm..Wrong way !");
        }
        ?>
    </body>
</html>