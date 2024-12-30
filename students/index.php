<?php
    include 'header.php';
    include '../includes/dbConnection.php';

if (isset($_SESSION['student'])) {
    echo "Welcome, " . $_SESSION['student'];// username is stored during login.
} else {
    echo "No student session found.";
}


?>


<body class="bg-gray-100 pt-16">
    <div class="m-10 p-10">
    <div class="container mx-auto flex items-center justify-between px-6 py-4">
        <h1 class="font-bold text-4xl">Your Stats</h1>
        <p class=" font-bold  text-4xl text-red-600">
            Hi, <?= $_SESSION['student']; ?></p>
    </div>
    <hr class="bg-blue-600 h-1">
    <div class="p-6">
       <?php 
       $qry="SELECT * FROM projects WHERE student_id = " . $_SESSION['student_id'] . " ORDER BY date DESC";
         $result = mysqli_query($conn, $qry);
         $no= mysqli_num_rows($result);

         ?>
        <p class="font-bold text-2xl">Total Projects Uploaded: <?=$no?> </p>
        <?php if ($no > 0){ ?>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)){ ?>
                    <li class="mb-4 bg-white p-4 rounded shadow">
                        <h2 class="text-xl font-bold"><?php echo $row['title']; ?></h2>
                        <p class="text-gray-700"><strong>Subject:</strong> <?php echo $row['subject']; ?></p>
                        <p class="text-gray-700"><strong>Description:</strong> <?php echo $row['description']; ?></p>
                        <p class="text-gray-700"><strong>Date:</strong> <?php echo $row['date']; ?></p>
                        <p class="text-gray-700"><strong>Remarks:</strong> <?php echo $row['remarks']; ?></p>
                        <p class="text-gray-700"><strong>Status:</strong> <?php echo $row['status']; ?></p>
                        <img src="../uploads/<?php echo $row['image']; ?>" alt="Project Image" class="w-20 h-20 object-cover">
                        
                    </li>
                    <?php } ?>
            </ul>
           <?php }; ?>
</div>
</div>

<?php include 'footer.php'; ?>
