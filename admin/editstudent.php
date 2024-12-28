<?php include 'header.php';

$id = $_GET['id'];
$qry = "SELECT * FROM registration WHERE id = '$id'"; // Correct query to fetch specific student data
include '../includes/dbconnection.php';
$result = $conn->query($qry);

$row = mysqli_fetch_assoc($result);
?>
<div class="m-10 p-10">
    <h1 class="font-bold text-4xl">Edit Students</h1>
    <hr class="h-1 bg-blue-600">

    <form action="actionstudent.php" method="POST" class="mt-5" enctype="multipart/form-data">
        <p class="font-bold">Full Name:</p>
        <input type="text" class="w-full border p-3 my-2 rounded-lg" name="name" value="<?= $row['name']; ?>">

        <p class="font-bold">Address:</p>
        <input type="text" class="w-full border p-3 my-2 rounded-lg" name="address" value="<?= $row['address']; ?>">

        <p class="font-bold">Phone:</p>
        <input type="text" class="w-full border p-3 my-2 rounded-lg" name="phone" value="<?= $row['phone']; ?>">

        <p class="font-bold">Email:</p>
        <input type="text" class="w-full border p-3 my-2 rounded-lg" name="email" value="<?= $row['email']; ?>">

        <p class="font-bold">Picture:</p>
        <img src="../uploads/<?= $row['image'] ?>" alt="" class="w-32 h-32 object-cover">
        <input type="file" class="w-full border p-3 my-2 rounded-lg" name="image">
        <input type="hidden" name="oldpath" value="<?= $row['image'] ?>">

        <p class="font-bold">Status:</p>
        <select class="w-full border p-3 my-2 rounded-lg" name="status">
            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
            <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
        </select>

        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="flex justify-center mt-2">
            <button class="bg-blue-600 text-white px-4 py-3 rounded-lg" name="update">Update</button>
            <a href="students.php" class="bg-red-600 text-white px-4 py-3 rounded-lg ml-3">Cancel</a>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
