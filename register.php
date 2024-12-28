<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/dbConnection.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);
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
        echo  "Error!" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <?php include 'header.php' ?>

    <script type="text/javascript">
        function validate() {
    var name = document.getElementById("name").value.trim();
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value;
    var repassword = document.getElementById("repassword").value;
    var phone = document.getElementById("phone").value.trim();
    var email = document.getElementById("email").value.trim();
    var address = document.getElementById("address").value.trim();

    var nameVal = /^[A-Za-z ]+$/;
    var usernameVal = /^.{1,}$/;
    var passwordVal = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    var phoneVal = /^\d{10}$/;
    var emailVal = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var addressVal = /^(?!\d+$).+/;

    if (!nameVal.test(name)) {
        alert("Name must contain only letters and spaces.");
        return false;
    }

    if (!usernameVal.test(username)) {
        alert("Username is required.");
        return false;
    }

    if (!passwordVal.test(password)) {
        alert("Password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
        return false;
    }

    if (password !== repassword) {
        alert("Passwords must match.");
        return false;
    }

    if (!phoneVal.test(phone)) {
        alert("Phone number must be exactly 10 digits.");
        return false;
    }

    if (!emailVal.test(email)) {
        alert("Email format is not correct.");
        return false;
    }

    if (!addressVal.test(address)) {
        alert("Address must not contain only numbers and cannot be empty.");
        return false;
    }

    alert("Form submitted successfully!");
    return true;
}

    </script>
</head>

<body>
<div class="pt-16">
<div class="font-bold text-4xl  text-blue-500 mt-2 p-6 rounded-md flex justify-center shadow-md">Register To Ready Proj</div>
    <div class="flex justify-center mt-10 ">
        
        <form action="register.php" method="post" onsubmit="return validate()" enctype="multipart/form-data" class="bg-[#fbe0e0] p-10 rounded-lg shadow">
            <div class="grid  grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="block text-sm font-medium text-slate-700">Name</span>
                    <input type="text" name="name" id="name" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Name" required>
                </div>
                <div class="mb-4">
                    <span class="block text-sm font-medium text-slate-700">Username</span>
                    <input type="text" name="username" id="username" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Username" required>
                </div>
            </div>
            <div class="grid  grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="block text-sm font-medium text-slate-700">Password</span>
                    <input type="password" name="password" id="password" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Password" required>
                </div>
                <div class="mb-4">
                    <span class="block text-sm font-medium text-slate-700">Re-Enter Password</span>
                    <input type="password" name="repassword" id="repassword" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Password Again" required>
                </div>
            </div>
            <div class="grid  grid-cols-2 gap-4">
                <div class="mb-4">
                    <span class="block text-sm font-medium text-slate-700">Address</span>
                    <input type="text" name="address" id="address" placeholder="Enter Your Address" class="mt-1 p-2 rounded-lg w-full" required>
                </div>
                <div class="mb-4">
                    <span class="block text-sm font-medium text-slate-700">Email</span>
                    <input type="text" name="email" id="email" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your E-mail" required>
                </div>
            </div>
            <div class="mb-4">
                <span class="block text-sm font-medium text-slate-700">Phone</span>
                <input type="text" name="phone" id="phone" class="mt-1 p-2 rounded-lg w-full" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="mb-4">
                <span class="block text-sm font-medium text-slate-700">Upload Image</span>
                <input type="file" name="image" id="image" class="mt-1 p-2 rounded-lg w-full" required>
            </div>
            <button type="submit" class="bg-red-500 text-white p-2 rounded-lg w-full" name="submit">Register</button>
            <p class="text-center text-sm mt-4">Already have an account?
                <a href="login.php" class="text-blue-500">Login Now</a>
            </p>

        </form>
    </div>
    </div>
</body>
<?=include 'footer.php';?>

</html>