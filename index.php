<?php
  include './config.php';
  $query = mysqli_query($conn, "SELECT * FROM users");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crud Operations</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="page">
      <div class="page__header">
        <h1>User List</h1>
        <a href="add.php" class="btn btn-primary">Add User</a>
      </div>

      <div class="table-card">
        <table>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>

          <?php
            $num = 1;
            while($user = mysqli_fetch_assoc($query)):
          ?>
            <tr>
                <td><?= $num++ ?></td>
                <td><?= $user["name"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["phone"] ?></td>
                <td><?= $user["address"] ?></td>
                <td class="actions">
                  <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline">Edit</a>
                  <a href="actions.php?id=<?= $user['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
    </div>
  </body>
</html>
