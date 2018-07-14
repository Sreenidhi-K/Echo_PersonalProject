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
      if(!$_SESSION['tit_submit'])
        {
            header("Location: your_homepage.php");
        }
     ?>

    <head>
        <title> Create a project  </title>
        <link rel="stylesheet" type="text/css" href="style4.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                $pr_tit=mysqli_real_escape_string($conn, $_SESSION['title_new']);
                echo("<br><br><span id='profile'> Welcome $firstname !!<br> Project title: $pr_tit</span>");
            ?>
        

            </div>
     
    
        <div id="cr_opt">
        <button id='qa' onclick="qa_form()"> Add Q/A</button>
        <button id='rating' onclick="rate_form()"> Add Rating</button>
        <button id='mcq' onclick="optnum_form()"> Add a MCQ</button>
        
        </div>
        <form id='opt_count'>
    
        </form>
        <br><br>
        <form id='form_disp' method="post" action="final_backend.php">
        <button type='submit' id='finalsubmit' name='fin' > FINISH </button>
        <button type='button' id='discard_but' name='disc' onclick='discard_form()'> DISCARD </button>
        <br><br>
        </form>
    
    </body>
    <script>
        var fdisp= document.getElementById('form_disp');
        var optdisp=document.getElementById('opt_count');
        var c=0;
        var arr=[];
        var num_count=[];
        function discard_form()
        {
            c=0;
            optdisp.innerHTML="";
            arr=[];
            num_count=[];
            $.post("demo_ajax.php",{fir:JSON.stringify(arr)});
            $.post("demo2_ajax.php",{las:JSON.stringify(num_count)});
            fdisp.innerHTML="<button type='submit' id='finalsubmit' name='fin' > FINISH </button><button type='button' id='discard_but' name='disc' onclick='discard_form()'> DISCARD </button><br><br>";
        }
        
        function qa_form()
        {
            
                       optdisp.innerHTML="";
                        c++;
                        console.log(arr.length);
                        var name_str= c.toString()+"qq";
                        arr[arr.length]=name_str;
                        var count=document.createElement('span');
                        count.innerHTML=c.toString()+"--";
                        fdisp.appendChild(count);
                        var node1= document.createElement('input');
                        var bre= document.createElement('br');
                        node1.setAttribute('type','text');
                        node1.setAttribute('name',name_str);
                        node1.setAttribute('placeholder',"Enter the question"); 
                        fdisp.appendChild(node1);
                        fdisp.appendChild(bre);
            
                        var bre= document.createElement('br');
                        fdisp.appendChild(bre);
            var gagastring= "q";
            num_count[num_count.length]=gagastring;
            $.post("demo2_ajax.php",{las:JSON.stringify(num_count)});
           $.post("demo_ajax.php",{fir:JSON.stringify(arr)});
              
                        
                        
        }
        
        function rate_form()
        {
    
                       optdisp.innerHTML="";
                        c++;
                        console.log(arr.length);
                        var name_str= c.toString()+"rt";
                        arr[arr.length]=name_str;
                        var count=document.createElement('span');
                        count.innerHTML=c.toString()+"--";
                        fdisp.appendChild(count);
            
                        var node1= document.createElement('input');
                        node1.setAttribute('type','text');
                        node1.setAttribute('name',name_str);
                        node1.setAttribute('placeholder',"Title for rating"); 
                        fdisp.appendChild(node1);
                        var node1= document.createElement('input');
                        var bre= document.createElement('br');
                        var name_str= c.toString()+"rs";
                        arr[arr.length]=name_str;
                        node1.setAttribute('type','number');
                        node1.setAttribute('name',name_str);
                        node1.setAttribute('placeholder',"Scale for rating"); 
                        fdisp.appendChild(node1);
                        
                        fdisp.appendChild(bre);
            
                        var bre= document.createElement('br');
                        fdisp.appendChild(bre);
             var gagastring= "r";
            num_count[num_count.length]=gagastring;
            $.post("demo2_ajax.php",{las:JSON.stringify(num_count)});
           $.post("demo_ajax.php",{fir:JSON.stringify(arr)});
                        
        }
        function mcq_form(value)
        {
           
                        c++;
                        console.log(arr.length);
                        var count=document.createElement('span');
                        var name_str= c.toString()+"mq";
                        arr[arr.length]=name_str;
                        count.innerHTML=c.toString()+"--";
                        fdisp.appendChild(count);
            
                        var node1= document.createElement('input');
                        var bre= document.createElement('br');
                        node1.setAttribute('type','text');
                        node1.setAttribute('name',name_str);
                        node1.setAttribute('placeholder',"Enter the question"); 
                        fdisp.appendChild(node1);
                        fdisp.appendChild(bre);
           
            var i;                  
       
            for( i=0; i< value ; i++)
                {
                        var node1= document.createElement('input');
                        var j=i+1;
                        var bre= document.createElement('br');
                        var name_str= c.toString()+"mo"+j.toString();
                        arr[arr.length]=name_str;
                        node1.setAttribute('type','text');
                        node1.setAttribute('name',name_str);
                        node1.setAttribute('placeholder',"Enter the option- "+j.toString()); 
                        fdisp.appendChild(node1);
                        fdisp.appendChild(bre);
                }
          
                        var bre= document.createElement('br');
                        fdisp.appendChild(bre);
             var gagastring= value.toString();
            num_count[num_count.length]=gagastring;
            $.post("demo2_ajax.php",{las:JSON.stringify(num_count)});
           $.post("demo_ajax.php",{fir:JSON.stringify(arr)});
                        
        }
        
        function optnum_form()
        {
            
            optdisp.innerHTML="";
            var node1= document.createElement('input');
             node1.setAttribute('type','number');
             node1.setAttribute('id','option_number');
             node1.setAttribute('name','no_opt');
            node1.setAttribute('placeholder',"Enter the number of options"); 
            optdisp.appendChild(node1);
            
            var node1= document.createElement('button');
             node1.setAttribute('type','button');
             node1.setAttribute('id','opt_num');
            node1.innerHTML="Proceed!";
            optdisp.appendChild(node1);
            
            var opt_num= document.getElementById('opt_num');
            opt_num.addEventListener("click",function()
                                     {
                                         var num_val= document.getElementById('option_number').value;
                                        optdisp.innerHTML="";
                                        mcq_form(num_val);
                                     });
               $.post("demo2_ajax.php",{las:JSON.stringify(num_count)});
            $.post("demo_ajax.php",{fir:JSON.stringify(arr)});
                     
            
        }
        
        function disp_arr()
        {
            console.log("haha");
            for(var i=0; i<num_count.length;i++)
                {
                    console.log(num_count[i]);
                }
               $.post("demo2_ajax.php",{las:JSON.stringify(num_count)});
            $.post("demo_ajax.php",{fir:JSON.stringify(arr)});
            
        }
        
        
    
         
        
    </script>
</html>