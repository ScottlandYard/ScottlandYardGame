<?php 
	session_start(); 
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
</head>
	<body style="text-align: center; font-size: 30px;">


		<?php

		if($_SESSION['mrxTurn']){ 
			echo "You are at ".$_SESSION['stationMrx']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesMrx'];
		}
		elseif($_SESSION['d1Turn']){ 
			echo "You are at ".$_SESSION['stationD1']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesD1'];
		}
		elseif($_SESSION['d2Turn']){ 
			echo "You are at ".$_SESSION['stationD2']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesD2'];
		}
		elseif($_SESSION['d3Turn']){ 
			echo "You are at ".$_SESSION['stationD3']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesD3'];
		}
		elseif($_SESSION['d4Turn']){ 
			echo "You are at ".$_SESSION['stationD4']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesD4'];
		}
		elseif($_SESSION['d5Turn']){ 
			echo "You are at ".$_SESSION['stationD5']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesD5'];
		}
		elseif($_SESSION['d6Turn']){ 
			echo "You are at ".$_SESSION['stationD6']." <br> You can only move in an empty station among these:<br> ".$_SESSION['nodesD6'];
		}
		

		?>
		<form method="POST" action="game.php">
			<input type="submit" value="Continue">
		</form> 

	</body>
</html>
