 
        


<?php 

    include 'abstractData.php';
    include 'mrx.php';
    include 'player.php';
    include 'loadData.php';
 
    echo "<marquee style='font-size: 30px; color:red;'>Scotland Yard Game</marquee> ";
    
	echo "<form method= 'post'><input type='submit' value='logout' id='log' name='log'></form>";
	if (isset($_POST["log"])){
		session_destroy();
		header("Location: ../login_system/index.php");
	}
    echo "<iframe id='map' src='game.php' width='84%' height='100%' allow-scripts></iframe>";
    echo "<iframe id='info' src='info.php' width='15%' height='100%'></iframe>";  

    
?>
 