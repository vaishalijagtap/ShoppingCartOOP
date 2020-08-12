<?php 
// This is a sample Shipping class. 

class Shipping {

    // Constructor just sets the object up for usage
    function __construct($shipFrom, $shipTo) {
		$this->shipFrom = $shipFrom;
		$this->shipTo = $shipTo;
    }

	/**
	  * Function to calculate shipping amount from 3rd party API
	  * @access public
	  * @return float
	  *
	  */
	function calculateShipping() {
		// Some logic to call 3rd part for calculating shipping cost by passing $this->shipFrom and $this->shipTo 
		// @need to implement this later
		// Code to access shipping rate api by passing shipFromAddress, shipFromZip, shipToAddress, shipToZip, weight in lbs, shipping service to ups shipping api......
		return 45.90; // Returning hardcoded value for now
	}
}