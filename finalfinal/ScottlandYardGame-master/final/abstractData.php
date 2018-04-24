<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 3/27/2018
 * Time: 3:52 PM
 */


    
class AbstractData{
    /**
    * @var String name the detective.
    */ 
    public $name;
    /**
    * @var int number of taxi tickets.
    */
    public $taxi;
    /**
    * @var int number of bus tickets.
    */
    public $bus;
    /**
    * @var int number of underground tickets.
    */
    public $train;  
    /**
    * @var int the current position of the detective.
    */
    protected $position;

    /**
    * @param name, number of taxi tickets, number of bus tickets, number of train tickets of the detective
    */
    public function __construct($name, $taxi, $bus, $train, $position = null){
        $this->name = $name;
        $this->taxi = $taxi;
        $this->bus = $bus;
        $this->train = $train;   
    }

    public function getPosition(){
        return $this->position;
    }

    public function setPosition($newPosition){
        $this->position = $newPosition;
    }
} 