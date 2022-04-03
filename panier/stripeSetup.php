<?php

//require_once('vendor/autoload.php');
require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey('sk_test_51KkUMrEAVKGv2IR8Kj3e4q9RhsfjzvtU64ItPz4ueVZx5w1nYW27VWQJUhD8OinIQ6gJgvKQhZ80znlYObeQBk2600H38MDqf5');

$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'product_data' => [
        'name' => 'T-shirt',
      ],
      'unit_amount' => 2000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost:4242/success',
  'cancel_url' => 'http://example.com/cancel',
]);


 ?>
