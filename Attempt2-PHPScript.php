<?php
mysql_connect("localhost", "root", "password") or die("Could not connect");
mysql_select_db("search_test") or die("can't find db");

//Collect script posting
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]", "", $searchq);

	$query = mysql_query("SELECT * FROM members WHERE Name LIKE '%$searchq%' OR Color LIKE '%$searchq%'") or die("could not serach!");
	$count = mysql_num_rows($query);
	if($count == 0){
		$output = 'No results found....';
	}else{
		while($row = mysql_fetch_array($query)){
			$Name = $row['Name'];
			$Color = $row['Color'];
			$Gender = $row['Gender'];
			$Availability = $row['Availability'];

			$output .= '<div> '.$Name.''.$Color.''.$Gender.''.$Availability.' </div>';
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
 
 <form action="index.php" method="post">
 	<input type="text" name="search" placeholder="Blah blah haha"/>
 	<input type="submit" value=">>" />

 </form>

 <?php.print("$output");?>

</body>
</html>