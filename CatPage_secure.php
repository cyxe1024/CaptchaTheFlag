<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<title>Captcha the Flag - Login</title>

	<link href="css/theCss.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/theResponsiveCss.css" rel="stylesheet" type="text/css" media="screen">
</head>	

<body style="margin: 0px;">
	<script src="js/jquery.js" type="text/javascript"></script>
	<div id="wrapper">

	<!-- start header -->
	<div align="center" id="header">
		<h1 style="font-size:60px;">Cat Database Search</h1>
        <br>
        <br>
        <br>
        <br>
	</div>
	<!-- end header -->
	<!-- start page -->
	<div id="page">
		<!-- start content -->
		<div id="content" style="margin-right: auto; margin-left: auto; width: 80%; max-width: 800px;">
			<div class="post">
				
				<p id="search-caption">Please enter a name to search for your cat! If the cat name is two words, replace the space with an underscore.</p>
				
				<form class = "search" action = "" method="POST">
					<table>
						<tbody><tr><td><p>Name:</p></td><td>   
                            <input type="text" name="entry" value=""
                                   ><p></p></td></tr>
                            
						<tr><td colspan="2" align="center">
							
								<input type="submit" name="submit" value="Submit">
						</td></tr>
						<?php
						//Connecting to Server
						ini_set('display_errors', 1);
$servername = "db-cats-do-user-7278862-0.a.db.ondigitalocean.com:25060";
$username = "Security";
$password = "r3lewksuhj8mc8kf";

$conn = new mysqli($servername, $username, $password);

//Perform SQL
  if(isset($_POST['submit']) && !empty($_POST) ){
  	  $entry = $_POST['entry'];

	  $db = "USE CatData";
	  $result1 = mysqli_query($conn, $db);

	  //$stmt = $result1->prepare('SELECT * FROM entries WHERE Name= ?');
	  //$stmt->bind_param('s',$entry);



  	  //$sql = "SELECT * FROM entries WHERE Name='$entry'";

//PDO Stuff
$dsn = "mysql:host=db-cats-do-user-7278862-0.a.db.ondigitalocean.com:25060;dbname=CatData;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, "Security", "r3lewksuhj8mc8kf", $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->prepare('SELECT * FROM entries WHERE Name= :name');
$stmt->bindParam(':name', $Name); 
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$count = strcmp($result['Name'], $entry);

if ($count == 0) {
			echo "Hello 1";
           echo " " . $result["Name"]. " - Color: " . $result["Color"]. " - Gender: " . $result["Gender"]. " - Availability: " . $result["Availability"]."<br>";
} 


      /*$result2 = mysqli_query($conn, $stmt);

      echo mysqli_error($conn);

      $count = mysqli_num_rows($result2);

  	  if ($count >= 1) {
        while($row = $result2->fetch_assoc()) {
           echo " " . $row["Name"]. " - Color: " . $row["Color"]. " - Gender: " . $row["Gender"]. " - Availability: " . $row["Availability"]."<br>";
        }
      } 
      else {
           echo "The Name you entered doesn't exist!";
      }*/
  }


?>
						</tbody></table>
				</form>
				<br>
				<br>
				
			</div>
		</div>
		<div align="justify">
			
			<div id="aboutDiv" style="display: none;">
			<h2 class="title">About Captcha the Flag</h2>
			<p id="about_shepherd_blurb">Captcha the Flag was devised by 4 software security students to teach others about the risks and precautions concerning information security. However, it was done with minimal sleep and probably while infected with COVID-19 so please excuse the appearance.</p><p>
			</p></div>
		</div>
		<!-- end content -->
		<!-- start sidebar -->
		<!-- end sidebar -->
	</div>
	</div>
	<!-- end page -->
	<script>
		jQuery.fn.center = function () 
		{
			this.css("position","absolute");
			this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
			return this;
		}	
		
		$("#tools").click(function(){
			$("#toolsTable").show("slow");
		});
		
		$("#showAbout").click(function(){
			$("#aboutDiv").show("slow");
		});
	</script></body></html>
