<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body style="background: #EAF9FF">
    <?php
      include("../includes/header_logo.html");

      include("../includes/bdd.php");
    ?>

    <div style="width: 60rem" class="container">
      <div class="bg-light py-5 container text-center border-bottom">
        <form action="checkSign.php" method="post">
          <div class="border-bottom">
            <h1 class="h3 mb-3 font-weight-normal" translate-key="form-id-title"></h1>

            <div class="form-row">
              <div class="form-group col-md-6">
                <br>
                <input type="email" class="form-control" id="inputEmail4" placeholder="" name="email" translate-key="email-input">
              </div>

              <div class="form-group col-md-6">
                <br>
                <input type="password" class="form-control mb-2" id="inputPassword4" placeholder="" name="mot_de_passe" translate-key="password-input">
              </div>
            </div>
          </div>

          <div class="mt-2 form-group">
            <h1 class="h3 mb-3 font-weight-normal" translate-key="form-personalInfo-title"></h1>
            <br>
            <input type="text" class="form-control w-50" id="inputFamName" placeholder="" name="nom" translate-key="lastname-input">
          </div>

          <div class="form-group">
            <br>
            <input type="text" class="form-control w-50" id="inputName" placeholder="" name="prenom" translate-key="firstname-input">
          </div>

          <div class="form-row">
            <div class="form-group w-25">
              <br>
              <input type="text" class="form-control" id="inputNumber" placeholder="" name="numero" translate-key="phone-input">
            </div>

            <div class="form-group w-100">
              <br>
              <input type="text" class="form-control" id="inputAddress" placeholder="" name="adresse" translate-key="address-input">
            </div>
            <div>
              <p class="text-danger">
              <?php
                if(isset($_GET["message"]) || !empty($_GET["message"])){
                    echo $_GET["message"];
                }
              ?>
              </p>
            </div>

          <button class="btn btn-lg btn-primary btn-block my-5" style="background-color: #004579" type="submit" name="sign_up" translate-key="register-title"></button>
        </form>
      </div>
      <div class="bg-light py-1 container text-center border-top">
        <h1 class="h3 mb-3 font-weight-normal" translate-key="alreadyregisted-question"></h1>
        <a style="background-color: #004579" class="btn btn-lg btn-primary btn-block" href="sign_in.php" translate-key="login-title"></a>
      </div>
    </div>

  </body>
</html>
