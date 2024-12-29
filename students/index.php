<?php
    include 'header.php';

if (isset($_SESSION['student'])) {
    echo "Welcome, " . $_SESSION['student'];// username is stored during login.
} else {
    echo "No student session found.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="../tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="m-10 p-10">
    <div class="container mx-auto flex items-center justify-between px-6 py-4">
        <h1 class="font-bold text-4xl">Your Stats</h1>
        <p class=" font-bold  text-4xl text-red-600">
            Hi, <?= $_SESSION['student']; ?></p>
    </div>
    <hr class="bg-blue-600 h-1">
    <div class="p-6">
       
        <p class="font-bold text-2xl">Total Projects Uploaded: 0 </p>
        <p>(Dynamic count coming soon!)</p>
</div>
</div>
</body>
</html>

