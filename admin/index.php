<?php
session_start();
include 'dbConnection.php';
include 'header.php';?>
<h1 class="font-bold text-4xl">Dashboard</h1>
<hr class="bg-blue-600 h-1">
<div class="grid grid-cols-3 gap-5 mt-5">
    <div class="bg-red-100 shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Students</h2>
        <p class="text-gray-700 text-3xl font-semibold">28</p>
    </div>
    <div class="bg-blue-100 shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Registrations</h2>
        <p class="text-gray-700 text-3xl font-semibold">35</p>
    </div>
    <div class="bg-green-100 shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Projects</h2>
        <p class="text-gray-700 text-3xl font-semibold">15</p>
    </div>
</div>
<?php include 'footer.php';
?>
