<?php
  include './config.php';

  // --- ADD USER ---
  if(isset($_POST["add-btn"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $err_msg = "";

    if(!empty($name) && !empty($email) && !empty($phone) && !empty($address)){
      $query = mysqli_query($conn, "INSERT INTO users (name, email, phone, address)
                                    VALUES ('$name', '$email', '$phone', '$address')");
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