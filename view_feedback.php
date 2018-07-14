<html>
<head>
      <title> My Project Home </title>
        <link rel="stylesheet" type="text/css" href="style6.css"> 
</head>
<body>

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
 <?php
       if(!$_SESSION["un_ss"])  
       {
           header("Location: login.php");
       }
     ?>
 <div id="header">
            <a id='logout' href='logout_backend.php'> Logout </a>
            <a id='my_home' href='your_homepage.php'> My Projects</a>
            <a id='my_act' href='give_fb.php'> Give FeedBack </a>
            <h3 id='poster'> `E`C`H`O` </h3>
            
        
      
           
           <?php
                
                $username= $_SESSION["un_ss"];
            
                $some_res=mysqli_query($conn,"SELECT name FROM userlist WHERE username='$username';");
                $rows=mysqli_fetch_row($some_res);
                $firstname=$rows[0]; 
                echo("<br><br><span id='profile'> Welcome $firstname !! </span>");
            ?>
        

            </div>
     
<?php
$user=$_SESSION['un_ss'];
$code=$_GET['id'];
$sql1=mysqli_query($conn,"SELECT admin FROM projectdata WHERE code='$code';");
if(mysqli_num_rows($sql1)==0)
{
    echo("No access:)");
    
}
else
{
    $sql_res=mysqli_query($conn,"SELECT COUNT(*) FROM tab$code;");
    $row2=mysqli_fetch_row($sql_res);
    $iden=$row2[0];
    $iden2=$iden-1;
    if($iden>=2)
    {
     $result1=mysqli_query($conn,"SELECT infodata FROM projectdata WHERE code='$code' ;");
     $rows1=mysqli_fetch_row($result1);
    $some_info=json_decode($rows1[0]);
        
    $res1=mysqli_query($conn,"SELECT title FROM projectdata WHERE code='$code' ;");
     $r1=mysqli_fetch_row($res1);
    $titles=$r1[0];
    
    $num_col=count($some_info);
    echo("<span id='titles'> $titles </span>");
    echo("<span id='title_view'>Responses</span>");
     echo("<span id='title_ques'>Your Questions <br> And <br> Analysis </span>");
       echo("<span id='view_ques'>");  
        for($i=0; $i<$num_col; $i++)
                    {
                        
                        $j=$i+1;
                        $column="col$j";
                        $some_res=mysqli_query($conn,"SELECT * FROM tab$code WHERE id='1' ;");
                         $avail=mysqli_fetch_assoc($some_res);
                        $inf2= json_decode($avail[$column]);
                        echo ( "* ques-$j : ". $inf2[0]."<br><br>");
                    if($some_info[$i]=='q')
                    {
                        echo("<hr>");
                    }
                    if($some_info[$i]=='r')
                    {
                        $scale=(int)($inf2[1]);
                            for($l=1;$l<=$scale;$l++)
                            {
                                    $sql2=mysqli_query($conn,"SELECT * FROM tab$code WHERE $column='$l';");
                                    $per=mysqli_num_rows($sql2);
                                    $cent=($per/$iden2)*100;
                                if($l%2)
                                {
                                
                                echo('<div id="cc" style="font-size:20px;color:plum;"><span> '.$l.' </span><br><div class="container">
                              <div class="skills html" style="text-align: right; 
                                padding-right: 20px; 
                                line-height: 30px; 
                                color: white; width: '.$cent.'%; background-color: darkmagenta;">'.$per.'</div></div></div>'); 
                                }
                                else
                                {
                                     echo('<div id="cc" style="font-size:20px;color:plum;"><span> '.$l.' </span><br><div class="container">
                                      <div class="skills html" style="text-align: right; 
                                        padding-right: 20px; 
                                        line-height: 30px; 
                                        color: white; width: '.$cent.'%; background-color: plum;">'.$per.'</div></div></div>'); 
                                    
                                }
                            }
                        echo("<br><hr>");
                    }
            
                    if($some_info[$i]!='r' && $some_info[$i]!='q' )
                    {
                        for($m=1; $m<count($inf2); $m++)
                        {
                         $some_res=mysqli_query($conn,"SELECT * FROM tab$code WHERE $column='$inf2[$m]' ;");
                            $per=mysqli_num_rows($some_res);
                            $cent=($per/$iden2)*100;
                        if($m%2)
                        {
                        echo('<div id="cc" style="font-size:20px;color:plum;"><span> '.$inf2[$m].' </span><br><div class="container">
                          <div class="skills html" style="text-align: right; 
                            padding-right: 20px; 
                            line-height: 30px; 
                            color: white; width: '.$cent.'%; background-color: darkmagenta;">'.$per.'</div></div>
                        </div>');
                        }
                            else
                            {
                                echo('<div id="cc" style="font-size:20px;color:plum;"><span> '.$inf2[$m].' </span><br><div class="container">
                          <div class="skills html" style="text-align: right; 
                            padding-right: 20px; 
                            line-height: 30px; 
                            color: white; width: '.$cent.'%; background-color: plum;">'.$per.'</div></div>
                        </div>');
                            }
                        }
                         echo("<br><hr>");


                    }
        }
        echo("</span>");
     echo("<span id='view_myp'>");
    for($i=2; $i<=$iden; $i++)
    {
   
    $sql2=mysqli_query($conn,"SELECT * FROM tab$code WHERE id='$i';");
    $avail=mysqli_fetch_assoc($sql2);
       
    for($j=1; $j<=$num_col; $j++)
    {
        $column="col$j";
        echo("* ques-$j : ".$avail[$column]."<br>");
    }
        echo("<br><hr>");
   
    }
        echo("</span>");
   
}
    else
    {
        echo("<span>No feedback yet</span>");
    }
}

?>
    </body>
    </html>
    