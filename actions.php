<?php
  session_start();
  include './config.php';

  // --- ADD USER ---
  if(isset($_POST["add-btn"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


    if(!empty($name) && !empty($email) && !empty($phone) && !empty($address)){
      $sql = "INSERT INTO users (name, email, phone, address)
              VALUES (?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $address);

      try{
        mysqli_stmt_execute($stmt);
      
        header('Location: index.php');
        exit;
      }
      catch(mysqli_sql_exception $e){
        if($e -> getCode() == 1062){
          $_SESSION["err"] = "User already exists. Try again.";
        }
        else{
          $_SESSION["err"] = "Failed to add user. Please try again.";
        }

        header('Location: add.php');
        exit;
      }
    }
    else{
      $_SESSION["err"] = "Please fill in all user details.";
      header('Location: add.php');
      exit;
    }
  }

  // --- EDIT USER ---
  if(isset($_POST["edit-btn"])){
    $id = $_GET["id"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $err_msg = "";

    if(!empty($name) && !empty($email) && !empty($phone) && !empty($address)){
      $query = mysqli_query($conn, "UPDATE users
                                    SET name='$name',
                                        email='$email',
                                        phone='$phone',
                                        address='$address'
                                    WHERE id=$id");
      if($query){
        header('Location: index.php');
        exit;
      }
      else{
        $err_msg = "Something went wrong.";
      }
    }
    else{
      $err_msg = "Please fill in all user details.";
    }
  }

  if(isset($_GET["id"])){
    $id = $_GET["id"];

    $query = mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    if($query){
      header('Location: index.php');
      exit;
    }
    else{
      $err_msg = "Something went wrong.";
    }
  }
?>