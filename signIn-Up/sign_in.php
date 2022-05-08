<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <style media="screen">
      a {
        text-decoration: none;
      }
      a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body style="background: #EAF9FF">
    <?php
      include("../includes/header_logo.html");
    ?>
    <div style="width: 60rem" class="container">
      <div class="bg-light py-5 container text-center border-bottom">

        <form class="form-signin" action="checkSign.php" method="post">

          <h1 class="h3 mb-3 font-weight-normal" translate-key="loginPage-title"></h1>

          <br>
          <input type="email" id="inputEmail" class="form-control" placeholder="" name="email" translate-key="email-input">

          <br>
          <input type="password" id="inputPassword" class="form-control" placeholder="" name="mot_de_passe" translate-key="password-input">

          <br>
          <button class="btn btn-lg btn-primary btn-block" style="background-color: #004579" type="submit" name="sign_in" translate-key="login-title"></button>


        </form>
      </div>
      <div class="bg-light py-5 container text-center">
        <h1 class="h3 mb-3 font-weight-normal" translate-key="notregisted-question"></h1>
        <a style="background-color: #004579" class="btn btn-lg btn-primary btn-block" href="sign_up.php" translate-key="register-button"></a>
      </div>
      <div class="bg-light py-5 container text-center">
        <h1 class="h3 mb-3 font-weight-normal" translate-key="company-login-side"></h1>
        <a style="background-color: #004579" class="btn btn-lg btn-primary btn-block" href="../SignIn-Up-company/sign_in_company.php" translate-key="login-title"></a>
      </div>
    </div>
  </body>
</html>
