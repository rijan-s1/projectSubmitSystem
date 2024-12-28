<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $status = $_POST['status'];  
    $filename = $_POST['oldpath'];

    // Handle file upload
    if ($_FILES['image']['name'] != '') {
        $photopath = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = $photopath;

        // Move the uploaded file to the target directory
        move_uploaded_file($tmp_name, "../uploads/" . $photopath);

        // Delete the old file
        unlink("../uploads/" . $_POST['oldpath']);
    }

    // Update query
    $qry = "UPDATE registration 
            SET name = '$name', address = '$address', phone = '$phone', email = '$email', image = '$filename', status = '$status' 
            WHERE id = '$id'";

    // Execute query
    include '../includes/dbconnection.php';
    if (mysqli_query($conn, $qry)) {
        echo '<script>alert("Student updated successfully"); window.location.href = "students.php";</script>';
    } else {
        echo "Error updating student: " . mysqli_error($conn);
    }

    include '../includes/closeconnection.php';
}
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    include '../includes/dbconnection.php';
    $qry = "select image from registration where id=$id";
    $result= mysqli_query($conn,$qry);
    $row = mysqli_fetch_assoc($result);
    unlink("../uploads/".$row['image']);
    $qry = "DELETE FROM registration WHERE id=$id";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo '<script>alert("Student Record deleted successfully");
            window.location.href = "students.php";
        </script>';
    } else {
        echo "Cannot Delete Record";
    }
    include '../includes/closeconnection.php';
}
?>

