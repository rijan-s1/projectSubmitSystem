<?php 
session_start();
if((!isset($_SESSION['student']))&&(!isset($_SESSION['student_id']))){
    header('location: ../login.php');
}
?>

<html >
<head>
    
    <title>Ready Proj</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 pb-64">
    <!-- Navbar -->
    <nav class="bg-[#e5d4ef] shadow-md fixed top-0 w-full z-50 ">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <div class="flex items-center">
                <img src="../img/logo.png" alt="logo" object-cover class="h-12">

                
            </div>
            <ul class="flex space-x-6 text-lg font-bold">
                <li>
                    <a href="index.php" class="hover:bg-red-300 px-4 py-2  rounded-lg hover:text-xl">Home</a>
                </li>
                <li>
                    <a href="uploadproject.php" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl">Upload Project</a>
                </li>
                
                <li>
                    <a href="viewproject.php" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl">View Project</a>
                </li>
                <li>
                    <a href="logout.php" class="hover:bg-red-300 px-4 py-2 rounded-lg hover:text-xl" onclick="return confirm('Are you sure, you want to logout?');">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

   
</body>
</html>
