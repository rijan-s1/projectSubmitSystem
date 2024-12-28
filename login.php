<?php
include 'includes/dbConnection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $uname = $_POST['username'];
  $pass = $_POST['password'];
  // one way encryption of password 
  $pass = md5($pass);

  if (empty($uname) || empty($pass)) {
    echo "Username and password are required.";
    exit;
  }

  if (isset($_POST['login'])) {
    // Get username and password 
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $pass = md5($pass);

    // Check admin login
    $query = "SELECT * FROM admins WHERE username = '$uname' AND password = '$pass'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin) {
      $_SESSION['username'] = $admin['username'];
      header("Location: admin/index.php");  // Admin redirection to admin dashboard
      exit;
    } else {
      // Check user login
      $query = "SELECT * FROM registration WHERE username = '$uname' AND password = '$pass' AND status = 'Approved'";
      $result = mysqli_query($conn, $query);
      $user = mysqli_fetch_assoc($result);

      if ($user) {
        $_SESSION['student'] = $user['username'];
        header("Location: students/index.php");  // Student redirection to user page
        exit;
      } else {
        echo "<script>alert('Invalid username or password.');</script>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php include 'header.php' ?>
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

<body class=" pt-16  flex flex-col min-h-screen">
<main class="flex-grow ">
  <div class="pt-6">
    <div class="font-bold text-4xl  text-blue-500 mt-2 p-6 rounded-md flex justify-center shadow-md">Login To Ready Proj</div>

    <div class="flex justify-center mt-10 ">
      <form action="login.php" method="post" onsubmit="return validate()" class="bg-gray-100 p-10 rounded-lg shadow-2xl">
        <div class="mb-4">
          <input type="text" name="username" id="username" class="mt-1 p-2 rounded-lg w-full" placeholder="Username" required>
        </div>
        <div class="mb-4">
          <input type="password" name="password" id="password" class="mt-1 p-2 rounded-lg w-full" placeholder="Password" required>
        </div>
        <button type="submit" class="bg-red-500 text-white p-2 rounded-lg w-full" name="login">Login</button>
        <p class="text-center text-sm mt-4">Don't have an account?
          <a href="register.php" class="text-blue-500">Register Now</a>
        </p>
      </form>
    </div>
  </div>
  <?php include 'footer.php' ?>
</main>
</body>

</html>