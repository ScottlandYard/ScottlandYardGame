<?php 
    
    include_once 'abstractData.php';
    include_once 'mrx.php';
    include_once 'player.php';

	session_start(); 

	if(($_SESSION['stationD1'] == $_SESSION['stationMrx']) OR ($_SESSION['stationD2'] == $_SESSION['stationMrx']) OR 
       ($_SESSION['stationD3'] == $_SESSION['stationMrx']) OR ($_SESSION['stationD4'] == $_SESSION['stationMrx']) OR 
       ($_SESSION['stationD5'] == $_SESSION['stationMrx'])){

        echo"Congratulation! You found Mr. X at the station ".$_SESSION['stationMrx']; 
		//popEnd();
        //exit(); 
    } 
    if(!$_SESSION['d1Move'] AND !$_SESSION['d2Move'] AND !$_SESSION['d3Move'] AND !$_SESSION['d4Move'] AND !$_SESSION['d5Move']){
    
        echo "All of you cannot move anymore. <br>Mr. X won!<br>";
		//popEnd();
        //exit();
    }
	
	
        function checkStation($linesPlayer, $nodesNewStation){ 
            $lines = explode(" ", $linesPlayer);
            $nodes = explode("-", $nodesNewStation);
            $stop = false;
            for ($i=0; $i < sizeof($lines) ; $i++) { 
                for ($j=0; $j < sizeof($nodes) ; $j++) { 
                    if($lines[$i] == $nodes[$j]){
                        if(($_SESSION['station'] != $_SESSION['stationD1']) AND ($_SESSION['station'] != $_SESSION['stationD2']) AND 
                           ($_SESSION['station'] != $_SESSION['stationD3']) AND ($_SESSION['station'] != $_SESSION['stationD4']) AND
                           ($_SESSION['station'] != $_SESSION['stationD5'])){
                            
                           return true;  
                        }
                        else{ 
                            $stop = true;
                            break; 
                        } 
                    }
                } 
                if($stop)
                    break;
            }
            if($stop)
                header('Location: busy.php');
            else
                header('Location: popMessage.php');
        }
	
    
	if($_SESSION['mrxTurn']){  

        include 'dataMrx.php'; 
    }
    
    if (isset($_POST['station'])) {

        $_SESSION['station'] = $_POST['station'];  
        $_SESSION['lines'] = $_POST['lines']; 
        $_SESSION['nodes'] = $_POST['nodes']; 

        if($_SESSION['d1Turn']){ 
            $checkStation = checkStation($_SESSION['linesD1'], $_SESSION['nodes']);
            if($checkStation) 
                header('Location: popD1.php');
        }

		elseif($_SESSION['d2Turn']){ 
            $checkStation = checkStation($_SESSION['linesD2'], $_SESSION['nodes']);
            if($checkStation) 
                if($checkStation) 
                header('Location: popD2.php');
        }

        elseif($_SESSION['d3Turn']){ 
            $checkStation = checkStation($_SESSION['linesD3'], $_SESSION['nodes']);
            if($checkStation) 
                header('Location: popD3.php');
        }

        elseif($_SESSION['d4Turn']){ 
            $checkStation = checkStation($_SESSION['linesD4'], $_SESSION['nodes']);
            if($checkStation) 
                header('Location: popD4.php');
        }

        elseif($_SESSION['d5Turn']){ 
            $checkStation = checkStation($_SESSION['linesD5'], $_SESSION['nodes']);
            if($checkStation) 
                header('Location: popD5.php');
		} 
		
	}
 
    if($_SESSION['d1Turn'])
        echo "<h2 style='text-align: center; color: green'>Detective 1: current position ".$_SESSION['stationD1']."</h2>";
    elseif($_SESSION['d2Turn'])
        echo "<h2 style='text-align: center; color: green'>Detective 2: current position ".$_SESSION['stationD2']."</h2>";
    elseif($_SESSION['d3Turn'])
        echo "<h2 style='text-align: center; color: green'>Detective 3: current position ".$_SESSION['stationD3']."</h2>";
    elseif($_SESSION['d4Turn'])
        echo "<h2 style='text-align: center; color: green'>Detective 4: current position ".$_SESSION['stationD4']."</h2>";
    elseif($_SESSION['d5Turn'])
        echo "<h2 style='text-align: center; color: green'>Detective 5: current position ".$_SESSION['stationD5']."</h2>";  
	
    
    include 'map.php';

	function popEnd(){
		session_destroy();
		header('Location: '.$_SERVER['PHP_SELF']);
		Exit();
	}
?>
