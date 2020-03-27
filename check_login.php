<?php
  include 'ZachDbtest.php';

  session_start();

  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  $db = "USE defaultdb";
  $sql = "SELECT * FROM users WHERE username='$uid' AND password='$pwd'";

  $result1 = mysqli_query($conn, $db);
  

  $result2 = mysqli_query($conn, $sql);

  echo mysqli_error($conn);

  $count = mysqli_num_rows($result2);

  if ($count == 1) {
    //echo "You are logged in!";
    
    $_SESSION['login'] = true; //comment out for vulnerable
    header("Location: CatPage.php");
  } else {
   // echo "Your username or password is incorrect!";
   $_SESSION['login'] = false;
   header("Location: index.html");
  }

?>