<?php
//session_start();
require_once("PanierModel.php");
//$UserId = $_SESSION['id_utilisateur'];

$productsInfos = "'payment_method_types' => ['card'],'line_items' => [";
$endInfos = "]'mode' => 'payment',
'success_url' => 'http://localhost:4242/success',
'cancel_url' => 'http://example.com/cancel',";

$req = PanierModel::SelectProducts(2);
while ($row = $req->fetch(PDO::FETCH_OBJ)){
  $productsInfos = $productsInfos .
  "
  [
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => 2000,
      'product_data' => [
        'name' => '$row->nom',
      ],
    ],
    'quantity' => '$row->quantite',
  ],";
}

$productsInfos = $productsInfos . $endInfos;

//echo trim($productsInfos,'"');
//echo prepareArgs($productsInfos);




//require_once('vendor/autoload.php');
require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey('sk_test_51KkUMrEAVKGv2IR8Kj3e4q9RhsfjzvtU64ItPz4ueVZx5w1nYW27VWQJUhD8OinIQ6gJgvKQhZ80znlYObeQBk2600H38MDqf5');

$session = \Stripe\Checkout\Session::create([

  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => 'T-shirt',
      ],
      'unit_amount' => 2000,
    ],
    'quantity' => 1,
  ],
  [
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => 'T-shirt2',
      ],
      'unit_amount' => 2000,
    ],
    'quantity' => 1,
  ]
],
  'mode' => 'payment',
  'success_url' => 'http://localhost:4242/success',
  'cancel_url' => 'http://example.com/cancel',

  //trim($productsInfos,'"');
  //prepareArgs($productsInfos)

]);

function prepareArgs($stringArgs){
  return trim($stringArgs,'"');
  //return preg_replace('/^(\'(.*)\'|"(.*)")$/', '$2$3', $stringArgs);
}


 ?>
