<?php 
	if (isset($_COOKIE['canSafe'])) {
		$save = $_COOKIE['canSafe'];
	}
?>
<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<!-- Place favicon.ico in the root directory -->

		<link rel="stylesheet" href="css/main.css">
		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=VT323' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

	</head>
	<body>
		<header>
			<div class="logo">
				<h1>Lucky six</h1>
			</div>
		</header>
		<div class="wrapper">
			<div class="wLeft" id="wLeft">

			</div>
			<div class="wRight">
				<button class="losuj" id="losuj">Random</button>
				<form action="" method="post">
					<input type="submit" name="submit" id="submit" value="Save resut" class="">
				</form>
				<hr>
				<br>
				<div class="last">Last results:</div>
				<div id="results">
					<?php 
						include('db_connect.php');
	
						if ($result = $mysqli->query("SELECT * FROM results")) // query zapytanie
						{
							if($result->num_rows > 0) //sprawdza liczbę rekordów
							{
								while ($row = $result->fetch_object()) //pojedyńczy rekord
								{
									echo " " . $row->ID . " ";
									echo " " . $row->Date . " ";
									echo " " . $row->Time . " ";
									echo "Liczby: " . $row->n1 . " ";
									echo " " . $row->n2 . " ";
									echo " " . $row->n3 . " ";
									echo " " . $row->n4 . " ";
									echo " " . $row->n5 . " ";
									echo " " . $row->n6 . " <br>";
								}
							}
							else 
							{
								echo "Brak rekordów w bazie";
							}
						}	
						else
						{
							echo "Błąd: " . $mysqli->error;
						}
						$mysqli->close();

					?>
					<?php
						include('db_connect.php');
	

						if(isset($_POST['submit']) && $save == 1 ){
        						$l1 = $_COOKIE['l1'];
        						$l2 = $_COOKIE['l2'];
        						$l3 = $_COOKIE['l3'];
        						$l4 = $_COOKIE['l4'];
        						$l5 = $_COOKIE['l5'];
        						$l6 = $_COOKIE['l6'];
				        		if($stmt = $mysqli->prepare("INSERT INTO `lucky6`.`results` (`ID`, `Date`, `Time`, `n1`, `n2`, `n3`, `n4`, `n5`, `n6`) VALUES (NULL, '".date("Y-m-d")."', '".date("H:i:s")."', '".$l1."', '".$l2."', '".$l3."', '".$l4."', '".$l5."', '".$l6."');")) {
				                $stmt->execute();
				                $stmt->close();
				            } else {
				                echo "Błąd zapytania";
				            }
			            
			            	header("Location: index.php");
			          	}
				        
					?>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		<footer>
			Today is: <span class="date"><?php echo date("Y-m-d"); ?></span>
		</footer>
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
