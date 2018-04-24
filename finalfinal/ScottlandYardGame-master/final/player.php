<?php
    /**
     * Created by PhpStorm.
     * User: Eric
     * Date: 3/27/2018
     * Time: 3:00 PM
     */ 

/**
* Class Player
* Allow to create a detective. 
*/    
class Player extends AbstractData{  
    
    /**
    * @param number of taxi tickets, bus tickets, train tickets and black tickets for the detective
    */
    public function __construct($name, $taxi, $bus, $train){
        parent::__construct($name, $taxi, $bus, $train); 
    } 
     
}
