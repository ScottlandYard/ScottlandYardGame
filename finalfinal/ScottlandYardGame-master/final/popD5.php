<?php
	
	include 'abstractData.php';
	include 'mrx.php';
	include 'player.php'; 

	session_start();

	if(isset($_POST['skip'])){ 

		$_SESSION['d5Turn'] = false;
		$_SESSION['d5Move'] = false; 
		
		$_SESSION['mrxTurn'] = true;

		header('Location: game.php');

	}

	if (isset($_POST['taxi']) OR isset($_POST['bus']) OR isset($_POST['train'])) {
		
		$_SESSION['stationD5'] = $_SESSION['station']; 
		$_SESSION['linesD5'] = $_SESSION['lines'];
		$_SESSION['nodesD5'] = $_SESSION['nodes'];
		$_SESSION['d5']->setPosition($_SESSION['stationD5']);  

		if (isset($_POST['taxi'])){
			$_SESSION['d5']->taxi --; 
			$_SESSION['mrx']->taxi += 1;
		}
		
		elseif (isset($_POST['bus'])){
			$_SESSION['d5']->bus --; 
			$_SESSION['mrx']->bus += 1;
		}
				
		elseif (isset($_POST['train'])){
			$_SESSION['d5']->train --;
			$_SESSION['mrx']->train += 1;
		}
		
		$_SESSION['d5Turn'] = false;
		$_SESSION['mrxTurn'] = true;
		
		header('Location: game.php');
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Move</title>
	</head>

	<body style="text-align: center;">
		<h1 style="color: red;">Detective 5</h1>
		<h2>Choose a ticket to move at the station <?php echo $_SESSION['station']; ?></h2>

		<?php 

			$stationD5 = $_SESSION['stationD5'];    
			$nodesNewStation = explode("-", $_SESSION['nodes']);
			$taxi = false;
			$bus = false;
			$train = false; 

			for ($i=0; $i < sizeof($nodesNewStation) ; $i++) {  
				
				if(($nodesNewStation[$i] == ($stationD5.'t')) AND ($_SESSION['d5']->taxi > 0)){
					$taxi = true;
				}

				if(($nodesNewStation[$i] == ($stationD5.'b')) AND ($_SESSION['d5']->bus > 0)){
					$bus = true;
				}

				if(($nodesNewStation[$i] == ($stationD5.'s')) AND ($_SESSION['d5']->train > 0)){
					$train = true;
				}
			}	
			
			if($taxi) {
		?>
			<form method="POST" action="popD5.php">
				<input type="hidden" name="taxi" value="taxi">
				<input type="submit" value="Taxi">
			</form><br>
		<?php } 
			  if($bus) {
		?>
			 <form method="POST" action="popD5.php">
				<input type="hidden" name="bus" value="bus">
				<input type="submit" value="Bus">
			</form><br>
		<?php } 
			  if($train) {
		?>
			<form method="POST" action="popD5.php">
				<input type="hidden" name="train" value="train">
				<input type="submit" value="Train">
			</form><br> 
		<?php 
			}  
			if(!$taxi AND !$bus AND !$train){
			?>
				<p style='font-size: 30px;'>You don't have a ticket to go in that station.</p>  
				<form method="POST" action="popD5.php">
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