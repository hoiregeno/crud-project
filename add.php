<?php
  session_start();
  include './config.php';
  
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
  <title>Add User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="page">
    <div class="form-card">
      <form action="actions.php" method="post">
        <h2>Add User</h2>

        <?php if(!empty($err_msg)): ?>
         <p><?= htmlspecialchars($err_msg) ?></p> 
        <?php endif; ?>

        <div class="input-box">
          <input type="text" name="name" id="name-input" placeholder=" ">
          <label for="name-input">Name</label>
        </div>

        <div class="input-box">
          <input type="email" name="email" id="email-input" placeholder=" ">
          <label for="email-input">Email</label>
        </div>

        <div class="input-box">
          <input type="text" name="phone" id="phone-input" placeholder=" ">
          <label for="phone-input">Phone</label>
        </div>

        <div class="input-box">
          <textarea name="address" id="address-input" placeholder=" "></textarea>
          <label for="address-input">Address</label>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary" name="add-btn">Submit</button>
          <a href="index.php" class="btn btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>