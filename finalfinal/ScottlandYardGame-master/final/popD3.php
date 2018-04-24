<?php
	
	include 'abstractData.php';
	include 'mrx.php';
	include 'player.php'; 

	session_start();

	if(isset($_POST['skip'])){

		$_SESSION['d3Turn'] = false;
		$_SESSION['d3Move'] = false; 
		
		if($_SESSION['d4Move'])
			$_SESSION['d4Turn'] = true;

		elseif($_SESSION['d5Move'])
			$_SESSION['d5Turn'] = true;

		else
			$_SESSION['mrxTurn'] = true;

		header('Location: game.php');

	}

	if (isset($_POST['taxi']) OR isset($_POST['bus']) OR isset($_POST['train'])) {
		
		$_SESSION['stationD3'] = $_SESSION['station']; 
		$_SESSION['linesD3'] = $_SESSION['lines'];
		$_SESSION['nodesD3'] = $_SESSION['nodes'];
		$_SESSION['d3']->setPosition($_SESSION['stationD3']);  

		if (isset($_POST['taxi'])){
			$_SESSION['d3']->taxi --; 
			$_SESSION['mrx']->taxi += 1;
		}
		
		elseif (isset($_POST['bus'])){
			$_SESSION['d3']->bus --; 
			$_SESSION['mrx']->bus += 1;
		}
				
		elseif (isset($_POST['train'])){
			$_SESSION['d3']->train --;
			$_SESSION['mrx']->train += 1;
		}
		
		$_SESSION['d3Turn'] = false;
		$_SESSION['d4Turn'] = true;
		
		header('Location: game.php');
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Move</title>
	</head>

	<body style="text-align: center;">
		<h1 style="color: red;">Detective 3</h1>
		<h2>Choose a ticket to move at the station <?php echo $_SESSION['station']; ?></h2>

		<?php  

			$stationD3 = $_SESSION['stationD3'];    
			$nodesNewStation = explode("-", $_SESSION['nodes']);
			$taxi = false;
			$bus = false;
			$train = false; 

			for ($i=0; $i < sizeof($nodesNewStation) ; $i++) {  
				
				if(($nodesNewStation[$i] == ($stationD3.'t')) AND ($_SESSION['d3']->taxi > 0)){
					$taxi = true;
				}

				if(($nodesNewStation[$i] == ($stationD3.'b')) AND ($_SESSION['d3']->bus > 0)){
					$bus = true;
				}

				if(($nodesNewStation[$i] == ($stationD3.'s')) AND ($_SESSION['d3']->train > 0)){
					$train = true;
				}
			}	
			
			if($taxi) {
		?>
			<form method="POST" action="popD3.php">
				<input type="hidden" name="taxi" value="taxi">
				<input type="submit" value="Taxi">
			</form><br>
		<?php } 
			  if($bus) {
		?>
			 <form method="POST" action="popD3.php">
				<input type="hidden" name="bus" value="bus">
				<input type="submit" value="Bus">
			</form><br>
		<?php } 
			  if($train) {
		?>
			<form method="POST" action="popD3.php">
				<input type="hidden" name="train" value="train">
				<input type="submit" value="Train">
			</form><br> 
		<?php 
			}  
			if(!$taxi AND !$bus AND !$train){
			?>
				<p style='font-size: 30px;'>You don't have a ticket to go in that station.</p> 
				<form method="POST" action="popD3.php">
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