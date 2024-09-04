<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbConnection.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Handle the image file name
    $image = $_FILES['image']['name'];
    $imageTemp = $_FILES['image']['tmp_name'];

    // Only store the image name in the database
    $imagePath = "uploads/" . $image;  

    // Move the uploaded image to a directory 
    move_uploaded_file($imageTemp, $imagePath);

    $sql = "INSERT INTO registration (name, username, password, address, phone, email, image) VALUES ('$name', '$username', '$password', '$address', '$phone', '$email', '$image')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo  "Error!". mysqli_error($conn) ;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <?php include'header.php'?>
    
    <script type="text/javascript">
        function validate(){
            var name = document.getElementById("name").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var repassword = document.getElementById("repassword").value;
            var phone = document.getElementById("phone").value;
            var email = document.getElementById("email").value;
            var atpos = email.indexOf("@");
            var dotpos = email.lastIndexOf(".");

            if(name === "" || name.length < 1){
                alert("Name is empty");
                return false;
            }
            if(username === "" || username.length < 1){
                alert("Username is empty");
                return false;
            }
            if(password === "" || password.length < 6){
                alert("Password must be at least 6 characters long");
                return false;
            }
            if(password !== repassword){
                alert("Passwords must match");
                return false;
            }
            if(phone === "" || isNaN(phone)){
                alert("Phone number must be valid");
                return false;
            }
            if(atpos < 2 || (dotpos - atpos) < 2){
                alert("Email format is not correct");
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
   
    <div class="flex justify-center mt-10 ">
        <form action="register.php" method="post" onsubmit="return validate()"  enctype="multipart/form-data" class="bg-[#fbe0e0] p-10 rounded-lg shadow">
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Name</span>
                <input type="text" name="name" id="name" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Name" required>
            </div>
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Username</span>
            <input type="text" name="username" id="username" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Username" required>
            </div>
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Password</span>
            <input type="password" name="password" id="password" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Password" required>
            </div>
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Re-Enter Password</span>
            <input type="password" name="repassword" id="repassword" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Password Again" required>
            </div>
            <div class="mb-4" >
            <span class="block text-sm font-medium text-slate-700">Address</span>
            <input type="text"  name="address" id="address"  placeholder="Enter Your Address" class="mt-1 p-2 rounded-lg w-full" required>
            </div>
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Email</span>
            <input type="text" name="email" id="email" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your E-mail" required>
            </div>
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Phone</span>
            <input type="text" name="phone" id="phone" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="mb-4">
            <span class="block text-sm font-medium text-slate-700">Upload Image</span>
            <input type="file" name="image" id="image" class="mt-1 p-2 rounded-lg w-full"  required>
            </div>
            <button type="submit" class="bg-red-500 text-white p-2 rounded-lg w-full" name="submit">Register</button>

        </form>
    </div>
</body>
</html>
