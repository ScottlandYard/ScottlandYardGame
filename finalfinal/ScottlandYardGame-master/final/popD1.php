<?php
	
	include 'abstractData.php';
	include 'mrx.php';
	include 'player.php'; 

	session_start();

	if(isset($_POST['skip'])){

		$_SESSION['d1Move'] = false;
		$_SESSION['d1Turn'] = false;

		if($_SESSION['d2Move']){
			$_SESSION['d2Turn'] = true; 
		}
		
		elseif($_SESSION['d3Move']){
			$_SESSION['d3Turn'] = true;
		}
		
		elseif($_SESSION['d4Move']){
			$_SESSION['d4Turn'] = true;
		}

		elseif($_SESSION['d5Move']){
			$_SESSION['d5Turn'] = true;
		}

		else{
			$_SESSION['mrxTurn'] = true;
		}

		header('Location: game.php');

	}

	if (isset($_POST['taxi']) OR isset($_POST['bus']) OR isset($_POST['train'])) {
		
		$_SESSION['stationD1'] = $_SESSION['station']; 
		$_SESSION['linesD1'] = $_SESSION['lines'];
		$_SESSION['nodesD1'] = $_SESSION['nodes'];
		$_SESSION['d1']->setPosition($_SESSION['stationD1']);  

		if (isset($_POST['taxi'])){
			$_SESSION['d1']->taxi --;  
			$_SESSION['mrx']->taxi += 1;
		}
		
		elseif (isset($_POST['bus'])){
			$_SESSION['d1']->bus --;  
			$_SESSION['mrx']->bus += 1;
		}
				
		elseif (isset($_POST['train'])){
			$_SESSION['d1']->train --; 
			$_SESSION['mrx']->train += 1;
		}
		
		$_SESSION['d1Turn'] = false;
		$_SESSION['d2Turn'] = true;

		header('Location: game.php');
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Move</title>
	</head>

	<body style="text-align: center;">
		<h1 style="color: red;">Detective 1</h1>
		<h2>Choose a ticket to move at the station <?php echo $_SESSION['station']; ?></h2>

		<?php 
		 
			$stationD1 = $_SESSION['stationD1'];    
			$nodesNewStation = explode("-", $_SESSION['nodes']);
			$taxi = false;
			$bus = false;
			$train = false; 

			for ($i=0; $i < sizeof($nodesNewStation) ; $i++) {  
				
				if(($nodesNewStation[$i] == ($stationD1.'t')) AND ($_SESSION['d1']->taxi > 0)){
					$taxi = true;
				}

				if(($nodesNewStation[$i] == ($stationD1.'b')) AND ($_SESSION['d1']->bus > 0)){
					$bus = true;
				}

				if(($nodesNewStation[$i] == ($stationD1.'s')) AND ($_SESSION['d1']->train > 0)){
					$train = true;
				}
			}		
			
			if($taxi) {
		?>
			<form method="POST" action="popD1.php">
				<input type="hidden" name="taxi" value="taxi">
				<input type="submit" value="Taxi">
			</form><br>
		<?php } 
			  if($bus) {
		?>
			 <form method="POST" action="popD1.php">
				<input type="hidden" name="bus" value="bus">
				<input type="submit" value="Bus">
			</form><br>
		<?php } 
			  if($train) {
		?>
			<form method="POST" action="popD1.php">
				<input type="hidden" name="train" value="train">
				<input type="submit" value="Train">
			</form><br> 
		<?php 
				}  
			if(!$taxi AND !$bus AND !$train){
			?>
			<p style='font-size: 30px;'>You don't have a ticket to go in that station.</p>  
			<form method="POST" action="popD1.php">
				<input type="hidden" name="skip" value="skip">
				<input type="submit" value="Continue">
			</form><br>
			<form method="POST" action="game.php"> 
				<input type="submit" value="Go Back">
			</form>
		<?php
			}
		?>

	</body>
</html>