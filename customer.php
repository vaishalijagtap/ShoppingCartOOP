<?php

// This is a sample Customer class. 
class Customer {
	
	// Customer attributes are all protected
	protected $first_name;
	protected $last_name;
	protected $address_1;
	protected $address_2;
	protected $city;
	protected $state;
	protected $zip;
	
	// Constructor populates the attributes
	public function __construct($customerInfo) {
		$this->first_name = $customerInfo['first_name'];
		$this->last_name = $customerInfo['last_name'];
		$this->address_1 = $customerInfo['address']['address_1'];
		$this->address_2 = $customerInfo['address']['address_2'];
		$this->city = $customerInfo['address']['city'];
		$this->state = $customerInfo['address']['state'];
		$this->zip = $customerInfo['address']['zip'];
	}
	
	/**
	  * Function to retrieve customer name
	  * @access public
	  * @return string
	  *
	  */
	function getCustomerName() {
		return $this->first_name . " " . $this->last_name;
	}
	
	 /**
	  * Function to retrieve customer address
	  * @access public
	  * @return string
	  *
	  */
	function getCustomerAddress() {
		return $this->address_1 . ", " . $this->address_2 . "\n" . $this->city . ", " . $this->state ." , ". $this->zip;
	}
	

}