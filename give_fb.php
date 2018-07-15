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
<! DOCTYPE html>
<html>
    <?php
       if(!$_SESSION["un_ss"])  
       {
           header("Location: login.php");
       }
     ?>

    <head>
        <title> My Project Home </title>
        <link rel="stylesheet" type="text/css" href="style5.css">  
    
    </head>
    <body>
        <div id="header">
            <a id='logout' href='logout_backend.php'> Logout </a>
            <a id='my_home' href='your_homepage.php'> My Projects</a>
            <a id='my_act' href='give_fb.php'> Give FeedBack </a>
            <h3 id='poster'> `E`C`H`O` </h3>
        
      
           
           <?php
                
                $username=mysqli_real_escape_string($conn, $_SESSION["un_ss"]);
            
                $some_res=mysqli_query($conn,"SELECT name FROM userlist WHERE username='$username';");
                $rows=mysqli_fetch_row($some_res);
                $firstname=$rows[0]; 
                echo("<br><br><span id='profile'> Welcome $firstname !!</span>");
            ?>
        

            </div>
            <div id='code_enter'>
                <h4> Give your feedback </h4>
                
                <form id='code_search' method="post" action="givefb_backend.php">
                <input type='text' name='the_code' placeholder='Enter the code'>
                <button type="submit" name='code_submit'> Go </button>
                </form>
            </div> 
            <div id='feed_form'>
            <?php
                   
                   
                    $cd=$_SESSION['fbcode'];
                    $some_res=mysqli_query($conn,"SELECT * FROM projectdata WHERE code='$cd';");
                    $avail=mysqli_fetch_assoc($some_res);
                    $admin_name=$avail['admin'];
                    
                if(mysqli_num_rows($some_res)==0 || $admin_name==$username)
                {
                echo ( "<h4> * Your feedback form comes here *</h4>");
                }
                else
                {     echo ( "<h3> $cd ---- ".$avail['title']."</h3>");
                    $result1=mysqli_query($conn,"SELECT infodata FROM projectdata WHERE code='$cd' ;");
                    $rows1=mysqli_fetch_row($result1);
                    $some_info=json_decode($rows1[0]); 
                    
                    $some_res=mysqli_query($conn,"SELECT * FROM tab$cd WHERE id='1' ;");
                    
                   echo("<form id='feed_us' method='POST' action='storefb_backend.php'>");
                    for($i=0; $i<count($some_info); $i++)
                    {
                        
                   
                        $j=$i+1;
                        $column="col$j";
                        $some_res=mysqli_query($conn,"SELECT * FROM tab$cd WHERE id='1' ;");
                         $avail=mysqli_fetch_assoc($some_res);
                        $inf2= json_decode($avail[$column]);
                        if($some_info[$i]=='q')
                        {
                       
                         echo ( "<span>". $inf2[0]."</span>");
                         echo("<br><br><input type='text' name='a$j'placeholder='Type your answer'><br><br>");
                        }
                        else if($some_info[$i]=='r')
                        {
                       
                         echo ( "<span>". $inf2[0]."</span><br><br><select name='a$j'>");
                        $scale=(int)($inf2[1]);
                            for($l=1;$l<=$scale;$l++)
                            {
                                echo("<option value='$l'>$l</option>");
                            }
                         echo("</select><br><br>");
                        }
                        else
                        {
                          echo ( "<span>". $inf2[0]."</span><br><br><select name='a$j'>");  
                             $option=(int)($some_info[$i]);
                            for($l=1;$l<=$option;$l++)
                            {
                                echo("<option value='".$inf2[$l]."'>$inf2[$l]</option>");
                            }
                            echo("</select><br><br>");
                        }
                        
                    }
                 echo(" <button type='submit' name='sub_fb_form'> DONE </button></form>");
                    
                  
                }
                   
             ?>
            
            </div>
         </body>
</html>