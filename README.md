# ShoppingCartOOP

# Question 3

Given:
- Item contains the following information (in psuedocode):
```
array (
id,
name,
quantity,
price
)
```

- A tax rate of 7%
- Access to shipping rate api (no need to find a working one, simply assume the methods exist elsewhere in the system and access them as you will)
- A customer item contains:

```php
array (
first_name => 'name',
last_name => 'name',
address => array (
array (
address_1
address_2
city,
state,
zip,
),
),
)
```

- And an instance of a cart can have only one customer and multiple items.

Please write two or more classes that allow for the setting and retrieval of the following information:
- Customer Name
- Customer Addresses
- Items in Cart
- Where Order Ships
- Cost of item in cart, including shipping and tax
- Subtotal and total for all items


### Result screen showing customer info, cart items list, sub total, order total
![result](https://raw.githubusercontent.com/vaishalijagtap/ShoppingCartOOP/master/screens/result.PNG)
