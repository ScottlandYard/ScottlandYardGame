<?php
	
            $lines = explode(" ", $_SESSION['linesMrx']);
            $nodes = explode("-", $_SESSION['nodesMrx']);
            $emptyStations = array(); 
            for ($i=0; $i < sizeof($nodes) ; $i++) { 
                $node = $nodes[$i];
                $station = substr($node, 0, -1); 
                if(($station != $_SESSION['stationMrx']) AND 
                    ($station != $_SESSION['stationD1']) AND 
                    ($station != $_SESSION['stationD2']) AND 
                    ($station != $_SESSION['stationD3']) AND 
                    ($station != $_SESSION['stationD4']) AND
                    ($station != $_SESSION['stationD5']) AND
                    ($station != $_SESSION['stationD6'])){
                    array_push($emptyStations, $station); 
                } 
            }
            shuffle($emptyStations);
            $_SESSION['stationMrx'] = array_pop($emptyStations);
            
            $doc = new DOMDocument();
            @$doc->loadHTMLFile("map.php"); 
            // gets all AREAs
            $areas = $doc->getElementsByTagName('area');
            // traverse the object with all areas
            foreach($areas as $area){
            // if the current $area has ID attribute, gets and outputs the ID and content
                if($area->hasAttribute('id')) {
                    $station = $area->getAttribute('id'); 
                    //If the station equal to the new station of Mr. X
                    if ($station == $_SESSION['stationMrx']) {
                        foreach ($lines as $line) {
                            if(strpos($line, $station)){
                                $vehicle = $line[strlen($line)-1];
                                $_SESSION['mrx']->setPosition($station);
                                $_SESSION['mrx']->move($station, $vehicle);
                                $_SESSION['stationMrx'] = $station;
                                $_SESSION['linesMrx'] = $area->getAttribute('target');
                                $_SESSION['nodesMrx'] = $area->getAttribute('alt'); 
                                break;
                            }
                        }
                        
                    }
                }
			}
		  
		 
		$_SESSION['mrxTurn'] = false;
		$_SESSION['d1Turn'] = true; 

		header('Location: game.php');