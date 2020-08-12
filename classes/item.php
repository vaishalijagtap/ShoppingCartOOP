<?php # Item.php

// This is a sample Item class. 
class Item {
	
	// Item attributes are all protected:
	protected $id;
	protected $name;
	protected $quantity;
	protected $price;
	
	// Constructor populates the attributes:
	public function __construct($id, $name, $quantity, $price)	{
		$this->id = $id;
		$this->name = $name;
		$this->quantity = $quantity;
		$this->price = $price;
	}
	
	/**
	  * Get ID
	  * @access public
	  * @return string
	  *
	  */
	public function getId()	{
		return $this->id;
	}

	/**
	  * Get Name
	  * @access public
	  * @return string
	  *
	  */
	public function getName() {
		return $this->name;
	}
	
	/**
	  * Get Quantity
	  * @access public
	  * @return integer
	  *
	  */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	  * Get Price
	  * @access public
	  * @return float
	  *
	  */
	public function getPrice() {
		return $this->price;
	}

} 