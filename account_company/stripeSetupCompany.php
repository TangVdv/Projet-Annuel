<?php
require_once("productModelCompany.php");
//require_once("../admin/compagny/compagnyModel.php");

$products = [];

$req = productModelCompany::getChiffreAffaire();
while ($row = $req->fetch(PDO::FETCH_OBJ)){
  $array = array(
    [
      'price_data' => [
        'currency' => 'eur',
        'unit_amount' => productModelCompany::CalculContribution($row->chiffre_affaire) * 100,
        'product_data' => [
          'name' => 'Cotisation annuel',
        ],
      ],
      'quantity' => 1,
    ]
  );

  $products = array_merge($products, $array);
}

$Infos = array(
  'payment_method_types' => ['card'],
  'line_items' => $products,
  'mode' => 'payment',
  'success_url' => 'http://localhost/account_company/finishPayment.php',
  'cancel_url' => 'http://localhost/account_company/account.php'
);

require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey('sk_test_51KkUMrEAVKGv2IR8Kj3e4q9RhsfjzvtU64ItPz4ueVZx5w1nYW27VWQJUhD8OinIQ6gJgvKQhZ80znlYObeQBk2600H38MDqf5');

$session = \Stripe\Checkout\Session::create($Infos);

 ?>
