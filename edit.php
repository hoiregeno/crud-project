<?php
  session_start();
  include './config.php';
  
  $id = $_GET["id"];
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if(isset($_SESSION["err"])){
    $err_msg = $_SESSION["err"];
    unset($_SESSION["err"]);
  }
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
          <input type="text" name="name" id="name-input" placeholder=" " value="<?= htmlspecialchars($row['name']) ?>">
          <label for="name-input">Name</label>
        </div>

        <div class="input-box">
          <input type="email" name="email" id="email-input" placeholder=" " value="<?= htmlspecialchars($row['email']) ?>">
          <label for="email-input">Email</label>
        </div>

        <div class="input-box">
          <input type="text" name="phone" id="phone-input" placeholder=" " value="<?= htmlspecialchars($row['phone']) ?>">
          <label for="phone-input">Phone</label>
        </div>

        <div class="input-box">
          <textarea name="address" id="address-input" placeholder=" "><?= htmlspecialchars($row['address']) ?></textarea>
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