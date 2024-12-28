<?php 
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $subject = $_POST['subject'];
    $registration_id = $_SESSION['student'];  

    // Check if student is approved
    include '../db_connection.php';
    $check_status = "SELECT status FROM registration WHERE id = '$registration_id'";
    $result = mysqli_query($conn, $check_status);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['status'] == 'approved') {
        // Simple file upload logic
        $file_name = $_FILES['project_file']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($file_name);

        if (move_uploaded_file($_FILES['project_file']['tmp_name'], $target_file)) {
            // Save project info to database
            $query = "INSERT INTO projects (registration_id, title, description, file_path, subject) 
                      VALUES ('$registration_id', '$title', '$description', '$target_file', '$subject')";
            mysqli_query($conn, $query);
            $message = "Project uploaded successfully!";
        } else {
            $message = "Failed to upload the project file.";
        }
    } else {
        $message = "You must be approved to upload a project.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project</title>
    <link href="../tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="p-4 bg-blue-600 text-white">
        <h1>Upload Your Project</h1>
    </header>
    <main class="p-6">
        <?php if (isset($message)) echo "<p class='text-red-500'>$message</p>"; ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
                <label for="subject" class="block">Select Subject:</label>
                <select name="subject" id="subject" class="border p-2 w-full" required>
                    <option value="Math">Operating System</option>
                    <option value="Science">Numerical Methods</option>
                    <option value="English">Software Engineering</option>
                    <option value="History">Scripting Language</option>
                    <option value="Art">DBMS</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="title" class="block">Project Title:</label>
                <input type="text" name="title" id="title" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block">Description:</label>
                <textarea name="description" id="description" class="border p-2 w-full" required></textarea>
            </div>
            <div class="mb-4">
                <label for="project_file" class="block">Upload File:</label>
                <input type="file" name="project_file" id="project_file" class="border p-2 w-full" required>
            </div>
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Upload</button>
        </form>
    </main>
</body>
</html>
