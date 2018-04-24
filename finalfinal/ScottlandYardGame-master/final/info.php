<?php

    include 'abstractData.php';
	include 'mrx.php';
	include 'player.php'; 

	session_start();

   $pos = $_SESSION['mrx']->station;  
   $transport = $_SESSION['mrx']->transport;
    echo "<h3>Travel log of Mr. X</h3>";   
    for ($i=0; $i < sizeof($transport); $i++) {  
		
			
			
        if($i+1 == 3 OR $i+1 == 8 OR $i+1 == 13 OR $i+1 == 18 OR $i+1 == 24){
			$b = $i+1;
			echo " Turn $b: ";
            echo "<strong style='color: blue;'>Station ".$pos[$i]." : ".$transport[$i]."</strong><br>";
        } 
        else{
			 
			echo "<strong style='color: red;'>".$transport[$i]."</strong><br>";  
		}
        
        if($_SESSION['doubleMove'] >= 1 AND $_SESSION['doubleMove'] <= 2){
			
            if($i == 4 OR $i == 9)
                echo "<strong style='color: blue;'>Double move</strong><br>";
        }
    } 
    
    //echo "<br><strong>Current position :".$_SESSION['stationMrx']."</strong><br>";
    echo "<br>Taxi tickets: ".$_SESSION['mrx']->taxi."<br>";
    echo "Bus tickets: ".$_SESSION['mrx']->bus."<br>";
    echo "Train tickets: ".$_SESSION['mrx']->train."<br>";
    echo "Black Tickets: ".$_SESSION['mrx']->blackTicket."<br>";
    echo "Double: ".$_SESSION['mrx']->double."<br><br>";

    
    echo "<h3 style='color: green'>Detective 1</h3>";
    echo "<strong>Current position :".$_SESSION['d1']->getPosition()."</strong><br>";
    echo "Taxi tickets: ".$_SESSION['d1']->taxi."<br>";
    echo "Bus tickets: ".$_SESSION['d1']->bus."<br>";
    echo "Train tickets: ".$_SESSION['d1']->train."<br><br>";

    echo "<h3 style='color: green'>Detective 2</h3>";
    echo "<strong>Current position :".$_SESSION['d2']->getPosition()."</strong><br>";
    echo "Taxi tickets: ".$_SESSION['d2']->taxi."<br>";
    echo "Bus tickets: ".$_SESSION['d2']->bus."<br>";
    echo "train tickets: ".$_SESSION['d2']->train."<br><br>";

    echo "<h3 style='color: green'>Detective 3</h3>";
    echo "<strong>Current position :".$_SESSION['d3']->getPosition()."</strong><br>";
    echo "Taxi tickets: ".$_SESSION['d3']->taxi."<br>";
    echo "Bus tickets: ".$_SESSION['d3']->bus."<br>";
    echo "Train tickets: ".$_SESSION['d3']->train."<br><br>";

    echo "<h3 style='color: green'>Detective 4</h3>";
    echo "<strong>Current position :".$_SESSION['d4']->getPosition()."</strong><br>";
    echo "Taxi tickets: ".$_SESSION['d4']->taxi."<br>";
    echo "Bus tickets: ".$_SESSION['d4']->bus."<br>";
    echo "Train tickets: ".$_SESSION['d4']->train."<br><br>";

    echo "<h3 style='color: green'>Detective 5</h3>";
    echo "<strong>Current position :".$_SESSION['d5']->getPosition()."</strong><br>";
    echo "Taxi tickets: ".$_SESSION['d5']->taxi."<br>";
    echo "Bus tickets: ".$_SESSION['d5']->bus."<br>";
    echo "Train tickets: ".$_SESSION['d5']->train."<br><br>"; 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="3"> 
</head>
<body style="text-align: center;">

</body>
</html>

 
