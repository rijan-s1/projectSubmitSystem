<?php
include 'header.php';
include '../includes/dbConnection.php';
$qry = "select * from registration where status='pending'";
$result = mysqli_query($conn, $qry);
?>
<div class="m-10 p-10">
    <table class="w-full">
        <tr>
            <th class="border p-2 bg-gray-100">Profile</th>
            <th class="border p-2 bg-gray-100">Full Name</th>
            <th class="border p-2 bg-gray-100">Address</th>
            <th class="border p-2 bg-gray-100">Phone</th>
            <th class="border p-2 bg-gray-100">E-mail</th>
            <th class="border p-2 bg-gray-100">Status</th>
            <th class="border p-2 bg-gray-100">Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="text-center">
                <td class="border p-2 ">
                    <img src="../uploads/<?= $row['image'] ?>" alt="" class="w-20 h-20 object-cover">
                </td>
                <td class="border p-2"><?= $row['name'] ?></td>
                <td class="border p-2"><?= $row['address']; ?></td>
                <td class="border p-2"><?= $row['phone']; ?></td>
                <td class="border p-2 "><?= $row['email']; ?></td>
                <td class="border p-2"><?= $row['status']; ?></td>
                <td class="border p-2">
                    <div class="flex gap-2">
                        <a href="editregistration.php?id=<?= $row['id']; ?>" class="bg-blue-600 text-white px-4 py-1 rounded-lg">Edit</a>
                        <a href="actionregistration.php?delete_id=<?= $row['id'] ?>" class="bg-red-600 text-white px-4 py-1 rounded-lg" onclick="return confirm('Are you sure to Delete?');">Delete</a>

                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php

include 'footer.php';
?>