<?php
include 'header.php';
include '../includes/dbConnection.php';


// Fetch student projects from the database
$query = "SELECT * FROM projects";
$result = mysqli_query($conn, $query);
?>


<body class="bg-gray-100 mt-4 pt-16 flex flex-col min-h-screen">
<div class="m-10 p-10">
   
    <table class="w-full" border="1">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Image</th>
                <th class="py-2 px-4 border">Title</th>
                <th class="py-2 px-4 border">Subject</th>
                <th class="py-2 px-4 border">Description</th>
                <th class="py-2 px-4 border">Date & Time</th>
                <th class="py-2 px-4 border">Remarks</th>
                <th class="py-2 px-4 border">Status</th>
                <th class="py-2 px-4 border">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr class="text-center">
                    <td class="border p-2 ">
                        <img src="../uploads/<?= $row['image'] ?>" alt="Project Image" class="w-20 h-20 object-cover">
                    </td>
                    <td class="border p-2"><?= $row['title'] ?></td>
                    <td class="border p-2"><?= $row['subject']; ?></td>
                    <td class="border p-2"><?= $row['description']; ?></td>
                    <td class="border p-2 "><?= $row['date']; ?></td>
                    <td class="border p-2"><?= $row['remarks']; ?></td>
                    <td class="border p-2"><?= $row['status']; ?></td>
                    <td class="border p-2">
                    <div class="flex gap-2">
                        <a href="editproject.php?id=<?= $row['project_id']; ?>" class="bg-blue-600 text-white px-4 py-1 rounded-lg">Edit</a>
                        <a href="actionproject.php?delete_id=<?= $row['project_id'] ?>" class="bg-red-600 text-white px-4 py-1 rounded-lg" onclick="return confirm('Are you sure to Delete?');">Delete</a>

                    </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>