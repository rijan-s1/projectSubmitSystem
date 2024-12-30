<?php
include '../includes/dbConnection.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];
    $old_image = $_POST['old_image'];

    // Handle image upload
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_path = "../uploads/" . $image;

        // Move the uploaded image to the uploads directory
        if (move_uploaded_file($image_temp, $image_path)) {
            // Delete the old image if a new one is uploaded
            if ($old_image && file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        } else {
            die("Error uploading image.");
        }
    } else {
        $image = $old_image;
    }

    // Update the project data in the database
    $qry = "UPDATE projects SET title = '$title', subject = '$subject', description = '$description', image = '$image', remarks = '$remarks', status = '$status' WHERE project_id = '$id'";
    if (mysqli_query($conn, $qry)) {
        header("Location: viewproject.php");
        exit;
    } else {
        die("Error updating project: " . mysqli_error($conn));
    }
}

// Handle project deletion
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Fetch the project data to get the image path
    $qry = "SELECT image FROM projects WHERE project_id = '$id'";
    $result = mysqli_query($conn, $qry);
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];

    // Delete the project from the database
    $qry = "DELETE FROM projects WHERE project_id = '$id'";
    if (mysqli_query($conn, $qry)) {
        // Delete the image file
        if ($image && file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        header("Location: viewproject.php");
        exit;
    } else {
        die("Error deleting project: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
?>