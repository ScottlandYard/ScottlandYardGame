<?php
	 
	 session_start();

	$cards = array(155, 103, 29, 50, 174, 132, 94, 13, 197, 138, 112, 26, 91, 141, 198, 117, 34, 53);
	shuffle($cards);

	$doc = new DOMDocument();
	@$doc->loadHTMLFile("map.php"); 

	// gets all AREAs
	$areas = $doc->getElementsByTagName('area');

	if (!isset($_SESSION['mrx'])) {
		$_SESSION['mrx'] = new Mrx("Mr. X", 4, 3, 3, 5); 
		$_SESSION['mrx']->setPosition(array_pop($cards)); 

		// traverse the object with all areas
		foreach($areas as $area){
		  // if the current $area has ID attribute, gets and outputs the ID and content
		  	if($area->hasAttribute('id')) {
			    $station = $area->getAttribute('id');
			    //$cnt = $area->nodeValue;
			    if ($station == $_SESSION['mrx']->getPosition()) {
			    	$_SESSION['stationMrx'] = $station;
			    	$_SESSION['linesMrx'] = $area->getAttribute('target');
			    	$_SESSION['nodesMrx'] = $area->getAttribute('alt'); 
			    	break;
			    }
		  	}
		}

		$_SESSION['mrxTurn'] = True; 

		$_SESSION['d1Turn'] = False; 
		$_SESSION['d2Turn'] = False; 
		$_SESSION['d3Turn'] = False; 
		$_SESSION['d4Turn'] = False; 
		$_SESSION['d5Turn'] = False;  

		$_SESSION['d1Move'] = True; 
		$_SESSION['d2Move'] = True; 
		$_SESSION['d3Move'] = True; 
		$_SESSION['d4Move'] = True; 
		$_SESSION['d5Move']	= True;

		$_SESSION['d1'] = new Player("Detective 1", 10, 8, 4); 
		$_SESSION['d1']->setPosition(array_pop($cards)); 
		$_SESSION['d2'] = new Player("Detective 2", 10, 8, 4);
		$_SESSION['d2']->setPosition(array_pop($cards)); 
		$_SESSION['d3'] = new Player("Detective 3", 10, 8, 4);
		$_SESSION['d3']->setPosition(array_pop($cards)); 
		$_SESSION['d4'] = new Player("Detective 4", 10, 8, 4);
		$_SESSION['d4']->setPosition(array_pop($cards)); 
		$_SESSION['d5'] = new Player("Detective 5", 10, 8, 4);
		$_SESSION['d5']->setPosition(array_pop($cards));  
		// traverse the object with all areas

		foreach($areas as $area) {
		  // if the current $area has ID attribute, gets and outputs the ID and content
		  	if($area->hasAttribute('id')) {
			    $station = $area->getAttribute('id');
			    //$cnt = $area->nodeValue;
			    if ($station == $_SESSION['d1']->getPosition()) { 
					$_SESSION['stationD1'] = $station;
			    	$_SESSION['linesD1'] = $area->getAttribute('target');
			    	$_SESSION['nodesD1'] = $area->getAttribute('alt'); 
			    }

			    if ($station == $_SESSION['d2']->getPosition()) { 
					$_SESSION['stationD2'] = $station;
			    	$_SESSION['linesD2'] = $area->getAttribute('target');
			    	$_SESSION['nodesD2'] = $area->getAttribute('alt'); 
			    }

			    if ($station == $_SESSION['d3']->getPosition()) { 
					$_SESSION['stationD3'] = $station;
			    	$_SESSION['linesD3'] = $area->getAttribute('target');
			    	$_SESSION['nodesD3'] = $area->getAttribute('alt'); 
			    }

			    if ($station == $_SESSION['d4']->getPosition()) { 
					$_SESSION['stationD4'] = $station;
			    	$_SESSION['linesD4'] = $area->getAttribute('target');
			    	$_SESSION['nodesD4'] = $area->getAttribute('alt'); 
			    }

			    if ($station == $_SESSION['d5']->getPosition()) { 
					$_SESSION['stationD5'] = $station;
			    	$_SESSION['linesD5'] = $area->getAttribute('target');
			    	$_SESSION['nodesD5'] = $area->getAttribute('alt'); 
			    } 

			    if (isset($_SESSION['stationD1']) AND isset($_SESSION['stationD2']) AND isset($_SESSION['stationD3']) AND isset($_SESSION['stationD4']) AND isset($_SESSION['stationD5'])) {
			    	break;
			    }
		  	}
		} 
	}	
	 
