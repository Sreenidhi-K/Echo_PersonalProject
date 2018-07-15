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
        <link rel="stylesheet" type="text/css" href="style3.css">  
    
    </head>
    <body>
        <div id="header">
            <a id='logout' href='logout_backend.php'> Logout </a>
            <a id='my_home' href='your_homepage.php'> My Projects</a>
            <a id='my_act' href='give_fb.php'> Give FeedBack </a>
            <h3 id='poster'> `E`C`H`O` </h3>
        
      
           
           <?php
                
                $username= mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
            
                $some_res=mysqli_query($conn,"SELECT name FROM userlist WHERE username='$username';");
                $rows=mysqli_fetch_row($some_res);
                $firstname=$rows[0]; 
                echo("<br><br><span id='profile'> Welcome $firstname !!</span>");
            ?>
        

            </div>
         <span id='disp_tit'> My projects </span><br><br>
        <div id='disp_my'>
           
            
        <?php 
            
             $username= mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
            
                $some_res=mysqli_query($conn,"SELECT * FROM projectdata WHERE admin='$username';");
                while($avail=mysqli_fetch_assoc($some_res))
                {
                    $code_id=$avail['code'];
                    echo("<span> # ".$avail['code']."-". $avail['title']." --<a id='link_ana' href='view_feedback.php?id=$code_id'>View</a></span><br><br>");  
                }
                
            ?>
        
        </div>
        
            <div id='cre_proj'>
                <h4> Create a new project </h4>
                
                <form id='new_proj' method="post" action="new_title.php">
                <input type='text' name='title_proj' placeholder='Enter title'>
                <button type="submit" name='tit_submit'> Proceed </button>
                </form>
            </div> 
            <div id='instr'>
                <span id='inst_head'>How to use this website?</span>
                <ul>
                <li> Create a project for your event, product etc.</li><br>
                <li> Design the feedback form for the project using the given options </li><br>
                <li> Share your project's unique number code with your audience or customers </li><br>
                <li> They can login, enter the code and give their feedback for your project anonymously </li><br>
                <li> You can then view the responses and analysis for the received feedback </li><br>
                </ul>
            
            </div>
            
     
     
    
    </body>
</html>