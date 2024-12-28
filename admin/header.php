<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ready Proj</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-[#e5d4ef] shadow-md fixed top-0 w-full z-50">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <div class="flex items-center">
                <img src="logo.png" alt="logo" object-cover class="h-12">
            </div>
            <ul class="flex space-x-6 text-lg font-bold">
                <li>
                    <a href="index.php" class="hover:bg-red-300 px-4 py-2  rounded-lg hover:text-xl">Dashboard</a>
                </li>
                <li>
                    <a href="students.php" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl">Students</a>
                </li>
                <li>
                    <a href="registration.php" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl">Registrations</a>
                </li>
                <li>
                    <a href="#" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl">View Project</a>
                </li>
                <li>
                    <a href="logout.php" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl" onclick="return confirm('Are you sure, you want to logout?');">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

   
</body>
</html>
