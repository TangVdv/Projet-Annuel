<?php

require_once("PanierModel.php");
include("stripeSetup.php");


PanierModel::UpdateBuyingStatus($_SESSION["id_utilisateur"]);

 ?>

 <script>
 //Redirect to Stripe API
   var stripe = Stripe('pk_test_51KkUMrEAVKGv2IR8nSGCaofWHp39rz8HpyLpVDZww9MRMmYDzROT7q2XjqURjygjVKF3zTmm53SdsrucbwY5XoRQ00L3pUicbq');
   stripe.redirectToCheckout({
     sessionId: "<?php echo $session->id; ?>"
   });
 </script>
