<?php
require_once("PanierModel.php");

if(PanierModel::tryWithLocalMoney($_SESSION["id_utilisateur"]) == 0){
  //echo "oui";
  header("location:./");
}

$products = [];

$req = PanierModel::SelectProducts($_SESSION["id_utilisateur"]);
while ($row = $req->fetch(PDO::FETCH_OBJ)){
  $array = array(
    [
      'price_data' => [
        'currency' => 'eur',
        'unit_amount' => $row->prix*100,
        'product_data' => [
          'name' => $row->nom,
        ],
      ],
      'quantity' => $row->quantite,
    ]
  );

  $products = array_merge($products, $array);
}

$Infos = array(
  'payment_method_types' => ['card'],
  'line_items' => $products,
  'mode' => 'payment',
  'success_url' => 'http://localhost/panier/finishPayment.php',
  'cancel_url' => 'http://localhost/panier/CancelPayment.php'
);

require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey('sk_test_51KkUMrEAVKGv2IR8Kj3e4q9RhsfjzvtU64ItPz4ueVZx5w1nYW27VWQJUhD8OinIQ6gJgvKQhZ80znlYObeQBk2600H38MDqf5');

$session = \Stripe\Checkout\Session::create($Infos);

 ?>
