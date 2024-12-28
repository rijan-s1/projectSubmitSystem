<?php 
include 'header.php';
include '../includes/dbConnection.php';

$student_username = $_SESSION['student'];
$query = "SELECT * FROM projects WHERE student_username = '$student_username'";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Database connection error message
    $error_message = "Error executing query: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 pt-16 flex flex-col min-h-screen">
    <header class="p-4 bg-blue-600 text-white">
        <h1 class="text-2xl">Your Projects</h1>
    </header>

    <main class="flex-grow p-6">
        <?php if (isset($error_message)): ?>
            <div class="error-wrapper bg-red-100 text-red-500 p-6 rounded-lg shadow-md mb-6">
                <p class="font-bold">Database Error:</p>
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <li class="mb-4 bg-white p-4 rounded shadow">
                        <h2 class="text-xl font-bold"><?php echo htmlspecialchars($row['title']); ?></h2>
                        <p class="text-gray-700"><?php echo htmlspecialchars($row['description']); ?></p>
                        <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="text-blue-500 hover:underline">
                            Download File
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No projects found. <a href="uploadproject.php" class="text-blue-500 hover:underline">Upload your first project!</a></p>
        <?php endif; ?>
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <p>&copy; 2024 Ready Proj</p>
    </footer>
</body>
</html>
