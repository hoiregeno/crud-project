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
        if($e -> getCode() === 1062){
          $_SESSION["err"] = "User already exists. Try again.";
        }
        else{
          $_SESSION["err"] = "Oops, something went wrong.";
          error_log($e -> getMessage());
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

    if(!empty($name) && !empty($email) && !empty($phone) && !empty($address)){
      $sql = "UPDATE users
              SET name=?,
                  email=?,
                  phone=?,
                  address=?
              WHERE id=?";
                
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $address, $id);  
    
      try{
        mysqli_stmt_execute($stmt);
        header('Location: index.php');
        exit;
      }
      catch(mysqli_sql_exception $e){
        if($e -> getCode() === 1062){
          $_SESSION["err"] = "User already exists. Try again.";  
        }
        else{
          $_SESSION["err"] = "Failed to update user.";
          error_log($e -> getMessage());
        }

        header("Location: edit.php?id=" . $id);
        exit;
      }
    }
    else{
      $_SESSION["err"] = "Please fill in all user details.";
      header("Location: edit.php?id=" . $id);
      exit;
    }
  }

  // --- DELETE ---
  if(isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    try{
      mysqli_stmt_execute($stmt);
      header("Location: index.php");
      exit;
    }
    catch(mysqli_sql_exception $e){
      $_SESSION["err"] = "Something went wrong.";
      error_log($e -> getMessage());
      header("Location: index.php");
      exit;
    }
  }
?>