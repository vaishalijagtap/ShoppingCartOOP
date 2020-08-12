<?php 
// Cart Class
class Cart implements Iterator, Countable {

	// For tracking iterations:
	protected $position = 0;

	// For storing the IDs, as a convenience:
	protected $ids = array();

	private static $customer;
	
	// Set tax to 10%
	private $tax = 10;
	
    // Constructor just sets the object up for usage
    function __construct(Customer $customerObj) {
		$this->items = array();
		$this->ids = array();
		
		// Assign only one customer for one cart
		if (null === self::$customer) {
            self::$customer = $customerObj;
        }
    }

	/**
	  * Get Customer name
	  * @access public
	  * @return string
	  *
	  */
	function getCustomerName() {
		$obj = self::$customer;
		return $obj->getCustomerName();
	}
	
	/**
	  * Get tax value
	  * @access public
	  * @return integer
	  *
	  */
	function getTax() {
		return $this->tax;
	}
	
	/**
	  * Returns a Boolean indicating if the cart is empty
	  * @access public
	  * @return boolean
	  *
	  */
	public function isEmpty() {
		return (empty($this->items));
	}

	/**
	  * Adds a new item to the cart
	  * @access public
	  * @param object 
	  * @return void
	  *
	  */
	public function addItem(Item $item) {
	
		// Need the item id
		$id = $item->getId();
	
		// Throw an exception if there's no id
		if (!$id) throw new Exception('The cart requires items with unique ID values.');

		// Add or update
		if (isset($this->items[$id])) {
			$this->updateItem($item, $this->items[$item]['qty'] + 1);
		} else {
			$this->items[$id] = array('item' => $item, 'qty' => 1);
			$this->ids[] = $id; // Store the id, too!
		}
	
	} 

	/**
	  * Changes an item already in the cart
	  * @access public
	  * @param object 
	  * @param $qty integer
	  * @return void
	  *
	  */
	public function updateItem(Item $item, $qty) {

		// Need the unique item id
		$id = $item->getId();

		// Delete or update accordingly
		if ($qty === 0) {
			$this->deleteItem($item);
		} elseif ( ($qty > 0) && ($qty != $this->items[$id]['qty'])) {
			$this->items[$id]['qty'] = $qty;
		}

	} 

	/**
	  * Removes an item from the cart
	  * @access public
	  * @param object 
	  * @return void
	  *
	  */
	public function deleteItem(Item $item) {

		// Need the unique item id
		$id = $item->getId();

		// Remove it
		if (isset($this->items[$id])) {
			unset($this->items[$id]);
	
			// Remove the stored id, too
			$index = array_search($id, $this->ids);
			unset($this->ids[$index]);

			// Recreate that array to prevent holes
			$this->ids = array_values($this->ids);
	
		}
		
	} 
	
	/**
	  * Display cart items
	  * @access public
	  * @return void
	  *
	  */
	public function displayItems() {
		if (!$this->isEmpty()) {
			foreach ($this as $arr) {
				// Get the item object
				$item = $arr['item'];
				// Print the item
				printf('<p><strong>%s</strong>: %d @ $%0.2f each.<p>', $item->getName(), $arr['qty'], $item->getPrice());
			} 
		} 
	}
	
	/**
	  * Required by Iterator; returns the current value
	  * @access public
	  * @return string
	  *
	  */
	public function current() {
	
		// Get the index for the current position
		$index = $this->ids[$this->position];
	
		// Return the item:
	    return $this->items[$index];

	} 

	/**
	  * Required by Iterator; returns the current key
	  * @access public
	  * @return string
	  *
	  */
	public function key() {
	    return $this->position;
	}

	/**
	  * Required by Iterator; increments the position
	  * @access public
	  * @return string
	  *
	  */
	public function next() {
	    $this->position++;
	}

	/**
	  * Required by Iterator; returns the position to the first spot
	  * @access public
	  * @return void
	  *
	  */
	public function rewind() {
	    $this->position = 0;
	}

	/**
	  * Required by Iterator; returns a Boolean indiating if a value is indexed at this position
	  * @access public
	  * @return string
	  *
	  */
	public function valid() {
		return (isset($this->ids[$this->position]));
	}
	
	/**
	  * Required by Countable
	  * @access public
	  * @return integer
	  *
	  */
	public function count() {
		return count($this->items);
	}
	
	 /**
	  * Calculate the sub total of all items in the cart
	  * @access public
	  * @return float
	  *
	  */
	 public function getOrderSubTotal() 
	 {
	 	$cost = 0.00;
		if (!$this->isEmpty()) {
			foreach ($this as $arr) {
				// Get the item object
				$item = $arr['item'];
				$cost = $cost + ($item->getPrice() * $arr['qty']);
			} 
		} 
		
	 	return number_format($cost, 2);
	 	
	 }
	 
	  /**
	  * Calculate the total (including shipping and tax) of all items in the cart
	  * @access public
	  * @return float
	  *
	  */
	 public function getOrderTotal($shipping) {
		 $subTotal = $this->getOrderSubTotal();
		 $subTotal += $shipping; // sub total without tax
		 $subTotal += ($subTotal * $this->getTax()) / 100; // sub total including tax
		 return $subTotal;
	 }
}