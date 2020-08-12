<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Testing the Shopping Cart</title>
</head>
<body>
<?php 
// This script uses the Cart, Customer, Shipping and Item classes.

try {
$customerInfo = array (
					'first_name' => 'Alan',
					'last_name' => 'Williams',
					'address' =>
							array (
								'address_1' => '4322 Hunters creek',
								'address_2' => 'Apt. 5678',
								'city' => 'Orlando',
								'state' => 'FL',
								'zip' => '32837',
							),
					);
require('customer.php');
// Create Customer
$customer = new Customer($customerInfo);

require('cart.php');
// Create cart
$cart = new Cart($customer);

require('shipping.php');
// Create Shipping
$ship = new Shipping('Ship from address', 'Ship to address');
$shippingCost = $ship->calculateShipping();

// Create some items
require('Item.php');
$item1 = new Item('IT001', 'Item -- 001', 2, 50.45);
$item2 = new Item('IT002', 'Item -- 002', 1, 76.39);
$item3 = new Item('IT003', 'Item -- 003', 4, 43.00);

// Add the items to the cart
$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);

// Update some quantities
$cart->updateItem($item2, 4);
$cart->updateItem($item3, 1);

// Delete an item
$cart->deleteItem($item3);

// Show customer name
echo '<h2>Customer Name :: </h2>'.$cart->getCustomerName();

// Show the cart contents
echo '<h2>Cart Contents (' . count($cart) . ' items)</h2>';

$cart->displayItems();

// Show subtotal
echo '<h2>Cart Sub Total : $' . $cart->getOrderSubTotal(). '</h2>';

// Show Shipping Amount
echo '<h2>Shipping : $' . $shippingCost. '</h2>';

// Show tax
echo '<h2>Tax : ' . $cart->getTax() . '%</h2>';

// Show cart total
echo '<h2>Cart Total (Including shipping and tax) : $' . $cart->getOrderTotal($shippingCost). '</h2>';

} catch (Exception $e) {
// Handle the exception.
}
?>
</body>
</html>