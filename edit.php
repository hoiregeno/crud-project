<?php
  include './config.php';
  $id = $_GET["id"];
  $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
  $user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="page">
    <div class="form-card">
      <form action="actions.php?id=<?= $id ?>" method="post">
        <h2>Edit User</h2>

        <?php if(!empty($err_msg)): ?>
         <p><?= htmlspecialchars($err_msg) ?></p> 
        <?php endif; ?>

        <div class="input-box">
          <input type="text" name="name" id="name-input" placeholder=" " value="<?= $user['name'] ?>">
          <label for="name-input">Name</label>
        </div>

        <div class="input-box">
          <input type="email" name="email" id="email-input" placeholder=" " value="<?= $user['email']?>">
          <label for="email-input">Email</label>
        </div>

        <div class="input-box">
          <input type="text" name="phone" id="phone-input" placeholder=" " value="<?= $user['phone']?>">
          <label for="phone-input">Phone</label>
        </div>

        <div class="input-box">
          <textarea name="address" id="address-input" placeholder=" "><?= $user['address'] ?></textarea>
          <label for="address-input">Address</label>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary" name="edit-btn">Submit</button>
          <a href="index.php" class="btn btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>