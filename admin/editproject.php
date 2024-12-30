<?php
include 'header.php';
include '../includes/dbConnection.php';

$id = $_GET['id'];
$qry = "SELECT * FROM projects WHERE project_id = '$id'"; //  query to fetch specific project data
$result = mysqli_query($conn, $qry);

if (!$result) {
    die("Error fetching project data: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
?>

<div class="m-10 p-10">
    <h1 class="font-bold text-4xl">Edit Project</h1>
    <hr class="h-1 bg-blue-600">

    <form action="actionproject.php" method="POST" class="mt-5" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['project_id']; ?>">

        <p class="font-bold">Title:</p>
        <input type="text" class="w-full border p-3 my-2 rounded-lg" name="title" value="<?php echo $row['title']; ?>">

        <p class="font-bold">Subject:</p>
        <input type="text" class="w-full border p-3 my-2 rounded-lg" name="subject" value="<?php echo $row['subject']; ?>">

        <p class="font-bold">Description:</p>
        <textarea class="w-full border p-3 my-2 rounded-lg" name="description"><?php echo $row['description']; ?></textarea>

        <p class="font-bold">Image:</p>
        <img src="../uploads/<?php echo $row['image']; ?>" alt="Project Image" class="w-32 h-32 object-cover">
        <input type="file" class="w-full border p-3 my-2 rounded-lg" name="image">
        <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">

        <p class="font-bold">Remarks:</p>
        <textarea class="w-full border p-3 my-2 rounded-lg" name="remarks"><?php echo $row['remarks']; ?></textarea>

        <p class="font-bold">Status:</p>
        <select class="w-full border p-3 my-2 rounded-lg" name="status">
            <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="Approved" <?php echo $row['status'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
            <option value="Rejected" <?php echo $row['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
        </select>

        <div class="flex justify-center mt-2">
            <button class="bg-blue-600 text-white px-4 py-3 rounded-lg" name="update">Update</button>
            <a href="viewproject.php" class="bg-red-600 text-white px-4 py-3 rounded-lg ml-3">Cancel</a>
        </div>
    </form>
</div>

<?php
include 'footer.php';
?>
