<?php
include 'dbConnection.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($uname) || empty($pass)) {
        echo "Username and password are required.";
        exit; 
    }

    if (isset($_POST['login'])) {
        // Check admin login
        $query = "SELECT * FROM admins WHERE username = '$uname' AND password = '$pass'";
        $result = mysqli_query($conn, $query);
        $admin = mysqli_fetch_assoc($result);

        if ($admin) {
            $_SESSION['username'] = $uname;
            header("Location: admin.php");
            exit;
        } else {
            // Check user login
            $query = "SELECT * FROM users WHERE username = '$uname' AND password = '$pass'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                $_SESSION['username'] = $uname;
                header("Location: user.php");
                exit;
            } else {
              echo "<script>alert('Invalid username or password.');</script>";
            }
        }
    } elseif (isset($_POST['register'])) {
        // Redirect to registration page
        header("Location: register.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php include'header.php'?>
   <script src="https://cdn.tailwindcss.com"></script>
  <script type="text/javascript">
    function validate() {
      var uname = document.getElementById("username").value;
      var pass = document.getElementById("password").value;

      if (uname === "" || uname.length < 1) {
        alert("Username is empty");
        return false;
      }
      if (pass.length < 6) {
        alert("Password must contain at least 6 characters");
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
 
  <div class="flex justify-center mt-10 ">
        <form action="login.php" method="post" onsubmit="return validate()" class="bg-gray-100 p-10 rounded-lg shadow-2xl">
            <div class="mb-4">
                <input type="text" name="username" id="username" class="mt-1 p-2 rounded-lg w-full" placeholder="Username" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" id="password" class="mt-1 p-2 rounded-lg w-full" placeholder="Password" required>
            </div>
            <button type="submit" class="bg-red-500 text-white p-2 rounded-lg w-full" name="login">Login</button>
            <a href="register.php" class="bg-red-500 text-white p-2 mt-2 rounded-lg w-full block text-center">Register</a>
        </form>
    </div>
  <?php include'footer.php'?>

</body>

</html>
