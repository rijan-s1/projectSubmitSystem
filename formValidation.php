
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>validation</title>
    <script type="text/javascript">
        function validate(){
            var name=document.getElementById("name").value;
            var username=document.getElementById("uname").value;
            var password=document.getElementById("pass").value;
            var repassword=document.getElementById("repass").value;
            var phone=document.getElementById("phone").value;
            var email=document.getElementById("email").value;
            var atpos=email.indexOf("@");
            var dotpos=email.lastIndexOf(".");
            if(name===""||name.length<1){
                alert("Name is empty");
                return false;
            }
            if(username===""||username.length<1){
                alert("Username is empty");
                return false;
            }
            if(password===""||password.length<6){
                alert("Password  must be atleast 6 character");
                return false;
            }

            if(password!==repassword){
                alert("Password must be same");
                return false;
            }
            if(phone===""||isNaN(phone) ){
                alert("Phone must be in number");
                return false;
            }
            if(atpos<2||(dotpos-atpos)<2){
                alert("Email format is not correct");
                return false;
            }
            alert("Success");
            return true;
        }

    </script>
</head>
<body>
    <fieldset>
        <Legend><H1>Rijan</H1></Legend>
        <form method="POST">
            <table>
                <tr><td>Name*:</td><td><input type="text" id="name" ></td></tr>
                <tr><td>Username*:</td><td><input type="text" id="uname" name="uname" ></td></tr>
                <tr><td>Password*:</td><td><input type="password" id="pass" name="pass"></td></tr>
                <tr><td>Enter password again*:</td><td><input type="password" id="repass" name="repass"></td></tr>
                <tr><td>phone*:</td><td><input type="number" id="phone" name="phone"></td></tr>
                <tr><td>Email*:</td><td><input type="text" id="email" name="email"></td></tr>
            <tr><td><input type="submit" value="Submit" id="submit" name="submit" onclick="return validate()"></td>
            <td><input type="reset" value="Clear all" id="reset"></td></tr>
            </table>
        </form>
    </fieldset>
</body>
</html>