<?php 
include 'header.php';
include '../includes/dbConnection.php';

// Fetch projects from the database
$query = "SELECT * FROM projects ORDER BY date DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    $error_message = "Error fetching projects: " . mysqli_error($conn);
}
?>


<div class="m-10 pt-10">

    <main class="flex-grow p-6">
        <?php if (isset($error_message)): ?>
            <div class="error-wrapper bg-red-100 text-red-500 p-6 rounded-lg shadow-md mb-6">
                <p class="font-bold">Database Error:</p>
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Project Image</th>
                    <th class="py-2 px-4 border">Title</th>
                <th class="py-2 px-4 border">Subject</th>
                <th class="py-2 px-4 border">Description</th>
                <th class="py-2 px-4 border">Date & Time</th>
                <th class="py-2 px-4 border">Remarks</th>
                <th class="py-2 px-4 border">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td class="py-2 px-4 border">
                    <img src="../uploads/<?php echo $row['image']; ?>" alt="Project Image" class="w-20 h-20 object-cover">
                    
                    </td>
                    <td class="py-2 px-4 border"><?php echo $row['title']; ?></td>
                    <td class="py-2 px-4 border"><?php echo $row['subject']; ?></td>
                    <td class="py-2 px-4 border"><?php echo $row['description']; ?></td>
                    <td class="py-2 px-4 border"><?php echo $row['date']; ?></td>
                    <td class="py-2 px-4 border"><?php echo $row['remarks']; ?></td>
                    <td class="py-2 px-4 border"><?php echo $row['status']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
                      
            
        <?php else: ?>
            <p>No projects found. <a href="uploadproject.php" class="text-blue-500 hover:underline">Upload your first project!</a></p>
        <?php endif; ?>
    </main>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>
