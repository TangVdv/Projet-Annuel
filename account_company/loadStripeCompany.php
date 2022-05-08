<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <?php
    include("stripeSetupCompany.php");
    ?>
  </body>
  <script type="text/javascript">
  //Redirect to Stripe API
    let stripe = Stripe('pk_test_51KkUMrEAVKGv2IR8nSGCaofWHp39rz8HpyLpVDZww9MRMmYDzROT7q2XjqURjygjVKF3zTmm53SdsrucbwY5XoRQ00L3pUicbq');

    stripe.redirectToCheckout({
      sessionId: "<?php echo $session->id; ?>"
    });
  </script>
</html>
