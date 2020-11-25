<!DOCTYPE HTML>
<html>
    <head>
        <title>MyForm</title>
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet" type="text/css">
    </head>
    <body onLoad="checkHashTag();">
        <div id="main">
            <span id="status"></span><br>
            
            <!-- Register Section Starts Here -->
            <div id="register" style="display:none">
                <h3>Register</h3>
                Family Name: <input type="text" id="familyname" ><br>
                First Name: <input type="text" id="firstname"><br>
                Email: <input type="email" id="email_reg"><br>
                Password: <input type="password" id="password_reg"><br>
                <button onClick="registerUser('familyname', 'firstname', 'email_reg', 'password_reg', 'status');">Register</button>
                <hr>
                Already registered? <span class="asLink" onClick="showLogin()">Login</apan>            
            </div>
            <!-- Login Section Starts Here -->
            <div id="login" style="display:none">
                <h3>Login</h3>
                Email: <input type="email" id="email_log"><br>
                Password: <input type="password" id="password_log"><br>
                <button onClick="loginUser('email_log', 'password_log', 'status');">Go</button>
                <hr>
                Not yet registered? <span class="asLink" onClick="showRegister()">Register</apan>
            </div>
            
        </div>    
        
        <script src="login_system.js"></script>
        <script>
            function checkHashTag(){
                document.getElementById("status").innerHTML="Loading...";
                let current_section = location.hash;
                current_section = current_section.replace("#","");
                document.getElementById(current_section).style.display="initial";
                document.getElementById("status").innerHTML="";
            }
            
            function showLogin(){
                window.location.replace("#login");
                window.location.reload();
            }
            function showRegister(){
                window.location.replace("#register");
                window.location.reload();
            }
            
        </script>
    </body>    
</html>    