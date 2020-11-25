/* Start: KeepThisUnchaged */
var request = false;
if (window.XMLHttpRequest) {
    request = new XMLHttpRequest();
}
else if (window.ActiveXObject) {
    request = new ActiveXObject('Microsoft.XMLHTTP');
}
/* End: KeepThisUnchaged */
function registerUser(id_familyname, id_firstname, id_email, id_password, id_status){
    var familyname = document.getElementById(id_familyname);
    var firstname = document.getElementById(id_firstname);
    var email = document.getElementById(id_email);
    var password = document.getElementById(id_password);
    var status = document.getElementById(id_status);
    
    if(familyname.value===""){
        status.style.color = "red";
        status.innerHTML = "Family Name missing!";
        familyname.focus();
    }else if(firstname.value===""){
        status.style.color = "red";
        status.innerHTML = "First Name missing!";
        firstname.focus();
    }
    else if(email.value===""){
        status.style.color = "red";
        status.innerHTML = "Email missing!";
        email.focus();
    }
    else if(password.value===""){
        status.style.color = "red";
        status.innerHTML = "Password missing!";
        password.focus();
    }        
    else{
        if(request){
            request.open('POST', "implement.php", true);
            
            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200) {
                    status.style.color = "green";
                    status.innerHTML = request.responseText;
                    familyname.value = "";
                    firstname.value = "";
                    email.value = "";
                    password.value = "";
                }
            };
            status.style.color = "blue";
            status.innerHTML = "Registering...";
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("familyname="+familyname.value+
            "&firstname="+firstname.value+
            "&email="+email.value+
            "&password="+password.value+
            "&action=register");
        } 
    }
}
function loginUser(id_email, id_password, id_status){
    var email = document.getElementById(id_email);
    var password = document.getElementById(id_password);
    var status = document.getElementById(id_status);
    
    if(email.value===""){
        status.style.color = "red";
        status.innerHTML = "Email missing!";
        email.focus();
    }
    else if(password.value===""){
        status.style.color = "red";
        status.innerHTML = "Password missing!";
        password.focus();
    }        
    else{
        if(request){
            request.open('POST', "implement.php", true);
            
            request.onreadystatechange = function(){
                
                if (request.readyState == 4 && request.status == 200) {
                    
                    if(request.responseText=="UserLoggedInSuccessfully!"){
                        email.value = "";
                        password.value = "";
                        window.location.href = 'dashboard.php';
                    }
                    else{
                        status.style.color = "red";
                        status.innerHTML = "Login failed!\nPlease try again.";
                    }
                    
                }
                    
            };
            
            status.style.color = "blue";
            status.innerHTML = "Logging In...";
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("email="+email.value+
            "&password="+password.value+
            "&action=login");
        } 
    }
} 
function showExistingRecords(){
    if(request){
        request.open('POST', 'implement.php', true);
        
        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {
                document.getElementById('existing_records').innerHTML = request.responseText;
                document.getElementById('records_show_trigger').innerHTML = "Showing Existing Records";
            }
        };
        document.getElementById('existing_records').innerHTML = "Loading...";
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("action=read");
    } 
    
}
function UpdateNow(data,id_status)
{
    var dataText = data.getAttribute("data-id");
    var newData = prompt('Enter the New Value [1 for user/2 for admin]');
    newData = parseInt(status);
    var status = document.getElementById(id_status);
    
    if(newData == 1 || newData == 2 || newData == 0){
        if(request){
            request.open('POST', "implement.php", true);
                
            request.onreadystatechange = function(){
                    
                if (request.readyState == 4 && request.status == 200) {
                    document.getElementById('existing_records').innerHTML = request.responseText;
                }
                        
            };
            document.getElementById('existing_records').innerHTML = "It is Updating ........";
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("id="+dataText+"&newLevel=" + newData + "&action=update");
        }
    }else{
        status.style.color = "red";
        status.innerHTML = "Make Sure new level is 0 for none 1 for user and 2 for admin";
    }
}