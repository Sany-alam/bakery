<?php
include("../connection.php");

// check name
if (isset($_POST['name_check'])) {
  $name = $_POST['name'];
  $sql = "SELECT * FROM `admin` where `name` = '$name'";
  $res = mysqli_query($conn,$sql);
  if (mysqli_num_rows($res)>0) {
    echo "Found a name";
  }
  else{
    echo "Found no name";
  }
}


// check email
if (isset($_POST['email_check'])) {
  $email = $_POST['email'];
  $sql = "SELECT email FROM `admin` where `email` = '$email'";
  $res = mysqli_query($conn,$sql);
  if (mysqli_num_rows($res)>0)
  {
    echo "found email";
  }
  else
  {
    echo "Found no email";
  }
}



// Registration of admin
if (isset($_POST['signup']))
{
  $name = $_POST['name'];
  $mail = $_POST['email'];
  $pass = $_POST['password'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $language = $_POST['language'];
  $sql = "INSERT INTO `admin`(`name`, `email`, `password`, `phone`, `address`, `city`, `language`) VALUES ('$name','$mail','$pass','$phone','$address','$city','$language')";
  $res = mysqli_query($conn,$sql);
  if ($res) {
    echo "congo";
    $sql1 = "SELECT * FROM `admin` WHERE `name` = '$name' and `password` = '$pass'";
    $res1 = mysqli_query($conn,$sql1);
    $user = mysqli_fetch_assoc($res1);
    $_SESSION['admin'] = $user;
  }
  else {
    echo "not congo";
  }
}


// login
if (isset($_POST['login']))
{
  $name = $_POST['userName'];
  $pass = $_POST['password'];
  // $sql = "SELECT * FROM `admin` WHERE `name` = '$name' and `password` = '$pass'";
  // $res = mysqli_query($conn,$sql);
  // if (mysqli_num_rows($res)==1) {
  if ($name==='admin' && $pass === 'password') {
    // $user = mysqli_fetch_array($res);
    $_SESSION['admin'] = 'admin';
    echo "congo";
  }
  else {
    echo "not congo";
  }
}

 ?>
