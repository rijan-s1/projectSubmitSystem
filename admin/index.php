<?php
include '../includes/dbConnection.php';
include 'header.php';
$qrystd = "SELECT COUNT('id') as total FROM registration WHERE status='approved'";
$resultstd = mysqli_query($conn, $qrystd);
$rowstd = mysqli_fetch_assoc($resultstd);
$qryreg = "SELECT COUNT('id') as total FROM registration WHERE status='pending'";
$resultreg = mysqli_query($conn, $qryreg);
$rowreg = mysqli_fetch_assoc($resultreg);

?>
<div class="m-10 p-10">
    <div class="container mx-auto flex items-center justify-between px-6 py-4">
        <h1 class="font-bold text-4xl">Admin Dashboard</h1>
        <p class=" font-bold  text-4xl text-red-600">
            Hi, <?= $_SESSION['username']; ?></p>
    </div>
    <hr class="bg-blue-600 h-1">
    <div class="grid grid-cols-3 gap-5 mt-5">
        <div class="bg-red-100 shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Students</h2>
            <p class="text-gray-700 text-3xl font-semibold"><?= $rowstd['total']; ?></p>
        </div>
        <div class="bg-blue-100 shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Registrations</h2>
            <p class="text-gray-700 text-3xl font-semibold"><?= $rowreg['total']; ?></p>
        </div>
        <div class="bg-green-100 shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Projects</h2>
            <p class="text-gray-700 text-3xl font-semibold">15</p>
        </div>
    </div>
</div>
<?php include 'footer.php';
?>