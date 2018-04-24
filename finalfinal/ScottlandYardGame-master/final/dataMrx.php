<?php 

    function checkMove($station, $vehicle){ 
        
        $move = false;
        if(($station != $_SESSION['stationD1']) AND ($station != $_SESSION['stationD2']) AND ($station != $_SESSION['stationD3']) AND 
           ($station != $_SESSION['stationD4']) AND ($station != $_SESSION['stationD5'])){

                if($vehicle == 't'){

                    if($_SESSION['mrx']->taxi > 0)
                        $_SESSION['mrx']->move($station, 'taxi');

                    elseif($_SESSION['mrx']->blackTicket > 0)
                        $_SESSION['mrx']->move($station, 'blackTicket');
                } 

                if($vehicle == 'b'){

                    if($_SESSION['mrx']->bus > 0)
                        $_SESSION['mrx']->move($station, 'bus');
                        
                    elseif($_SESSION['mrx']->blackTicket > 0)
                        $_SESSION['mrx']->move($station, 'blackTicket');
                }

                if($vehicle == 's'){

                    if($_SESSION['mrx']->train > 0)
                        $_SESSION['mrx']->move($station, 'train');
                        
                    elseif($_SESSION['mrx']->blackTicket > 0)
                        $_SESSION['mrx']->move($station, 'blackTicket');
                } 

                if($vehicle == 'w' AND $_SESSION['mrx']->blackTicket > 0){
                    $_SESSION['mrx']->move($station, 'blackTicket'); 
                }  
                
                $move = true;
        } 
        return $move;
    }   

    function getData(){
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
                    $_SESSION['linesMrx'] = $area->getAttribute('target');
                    $_SESSION['nodesMrx'] = $area->getAttribute('alt'); 
                    break;
                }
            }
                            
        } 
    }

    
    
    function move(){ 
        $nodes = explode("-", $_SESSION['nodesMrx']);
        shuffle($nodes);  
        $sizeNodes = sizeof($nodes);  

        foreach ($nodes as $node) { 
            
            $node = trim($node);    
            $vehicle = substr($node, -1);
            $station = substr($node, 0, -1);

            if(is_numeric($station)){

                $_SESSION['stationMrx'] = $station;

                $checkMove = checkMove($station, $vehicle); 
                
                if($checkMove){
                    getData(); 
                    $size = sizeof($_SESSION['mrx']->station); 
                    if($size == 4 OR $size == 9){
                        move();
                        $_SESSION['mrx']->double --;
                        $_SESSION['doubleMove'] ++;
                    } 
                    return True;
                }
            }
        }

        return False;
    }

    if(!isset($_SESSION['doubleMove']))
        $_SESSION['doubleMove'] = 0;

    $mrxMove = move(); 

    if($mrxMove){

        $_SESSION['mrxTurn'] = false; 
 
        if($_SESSION['d1Move'])
            $_SESSION['d1Turn'] = true;

        elseif($_SESSION['d2Move'])
            $_SESSION['d2Turn'] = true; 

        elseif($_SESSION['d3Move'])
            $_SESSION['d3Turn'] = true; 

        elseif($_SESSION['d4Move'])
            $_SESSION['d4Turn'] = true; 

        elseif($_SESSION['d5Move'])
            $_SESSION['d5Turn'] = true;

        else 
            $_SESSION['mrxTurn'] = true;
    }
    else{
        echo "You won.<br>Mr. X can not move anymore.<br>He is stuck at the position ".$_SESSION['stationMrx'];
       
        exit();  
    }

    

     
