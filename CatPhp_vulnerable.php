<?php
  include 'ZachDbtest.php';

  $entry = $_POST['entry'];

  $db = "USE CatData";
  $sql = "SELECT * FROM entries WHERE Name='$entry'";

  $result1 = mysqli_query($conn, $db);

  $result2 = mysqli_query($conn, $sql);

  echo mysqli_error($conn);

  $count = mysqli_num_rows($result2);

  if ($count >= 1) {
    while($row = $result2->fetch_assoc()) {
        echo "Name: " . $row["Name"]. " - Color: " . $row["Color"]. " - Gender: " . $row["Gender"]. "<br>";
    }
  } else {
    echo "The Name you entered doesn't exist!";
  }

?>