<?php
include 'header.php';
include '../includes/dbConnection.php';

if (isset($_POST['upload'])) {
    if (!isset($_SESSION['student_id'])) {
        die("Student ID is not set in the session.");
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $subject = $_POST['subject'];
    $student_id = $_SESSION['student_id'];  //  student ID is stored in the session

    // Check if the student is approved
    
    $check_status = "SELECT status FROM registration WHERE id = '$student_id'";
    $result = mysqli_query($conn, $check_status);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // File upload logic
        
        // Handle the image file name
        $image = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];

        // Only store the image name in the database
        $imagePath = "../uploads/" . $image;

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
            $message = "Error moving uploaded file.";
        }
    } else {
        $message = "Student not approved.";
    }
}
?>

<html>

<head>
    <title>Upload Project</title>
    <link href="../tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100 pt-16 mt-5">
  
    <main class="p-6 mt-32"> <!-- Added margin-top to push content below the fixed header -->
        <?php if (isset($message)) echo "<p class='text-red-500'>$message</p>"; ?>
        <form action="uploadproject.php" method="POST" enctype="multipart/form-data">
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
                <label for="description" class="block font-bold text-xl">Project Description:</label>
                <textarea name="description" id="description" class="border p-2 w-full" required></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block font-bold text-xl">Upload Image:</label>
                <input type="file" name="image" id="image" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <button type="submit" name="upload" class="bg-red-500 hover:bg-blue-500 text-white p-2 w-full">Upload Project</button>
            </div>
        </form>
    </main>
</body>
<?php include 'footer.php'; ?>

</html>