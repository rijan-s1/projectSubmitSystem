<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $subject = $_POST['subject'];
    $student_id = $_SESSION['student_id'];  //  student ID is stored in the session

    // Check if the student is approved
    include '../db_connection.php';
    $check_status = "SELECT status FROM registration WHERE id = '$student_id'";
    $result = mysqli_query($conn, $check_status);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // File upload logic
        
        // Handle the image file name
    $image = $_FILES['image']['name'];
    $imageTemp = $_FILES['image']['tmp_name'];

    // Only store the image name in the database
    $imagePath = "uploads/" . $image;

    // Move the uploaded image to a directory 
        
        if (move_uploaded_file($imageTemp, $imagePath)){
            // Insert project info into the `projects` table
            $query = "INSERT INTO projects (student_id, subject, title, description, image, date) 
                      VALUES ('$student_id', '$subject', '$title', '$description', '$image', NOW())";
            if (mysqli_query($conn, $query)) {
                $message = "Project uploaded successfully!";
            } else {
                $message = "Error uploading project: " . mysqli_error($conn);
            }
        } else {
            $message = "Failed to upload the project file.";
        }
    }
    else{
        echo "error fetching data";
    }
}
?>

<html>

<head>
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
                <label for="subject" class="block font-bold text-xl">Subject:</label>
                <select name="subject" id="subject" class="border p-2 w-full" required>
                    <option value="Operating System">Operating System</option>
                    <option value="Numerical Methods">Numerical Methods</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Scripting Language">Scripting Language</option>
                    <option value="DBMS">DBMS</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="title" class="block font-bold text-xl">Project Title:</label>
                <input type="text" name="title" id="title" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block font-bold text-xl">Description:</label>
                <textarea name="description" id="description" class="border p-2 w-full" required></textarea>
            </div>
            <div class="mb-4">
                <label for="project_file" class="block font-bold text-xl">Upload File:</label>
                <input type="file" name="project_file" id="project_file" class="border p-2 w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Upload</button>
        </form>
    </main>
</body>

</html>