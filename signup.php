<!DOCTYPE html>
<html>
<head>
<title> `E`C`H`O`</title>  
<link rel="stylesheet" type="text/css" href="style1.css">  
</head>

<body>
    <h1> `E`C`H`O` </h1>
    
    <form id="signup_form" action="signup_backend.php" method="post">
        
        <h2> SIGN UP </h2>
        <input type="text" name="first_n" placeholder=" Your Name" >
        <br>
        <input type="text" name="user_name" placeholder="User name(must be unique)" id='uname' >
        <span id='status'></span>
        <br>
        <input type="email" name="email_id" placeholder="Email ID" >
        <br>
        <input type="password" name="pass_word" placeholder="Password">
        <br>
        <input type="password" name="con_pass_word" placeholder="Confirm password">
        <br>
        
        <button type="submit" name="sign_submit"> SIGN UP </button>
        
    </form>
    
    <a id="login_button" type="button" href="login.php" > LOG IN </a>
    
    
    <script type="text/javascript">
        document.getElementById("uname").onblur = function() 
        {
            var xmlhttp;
            var uname=document.getElementById("uname");
            if (uname.value != "")
                {
                    xmlhttp=new XMLHttpRequest();
                    xmlhttp.onreadystatechange=function()
                        {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200)
                            {
                                document.getElementById("status").innerHTML=xmlhttp.responseText;
                            }
                        };
        console.log(uname.value);
                    xmlhttp.open("GET","avail_username.php?uname="+encodeURIComponent(uname.value),true);
                    xmlhttp.send();
                }
        };
    </script>
     
</body>
</html>