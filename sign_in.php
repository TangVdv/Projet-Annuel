<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
      include("includes/header_logo.php");

      include("panier/db_connection.php");
    ?>
    <div style="width: 60rem" class="container">
      <div class="bg-light py-5 container text-center border-bottom">

        <form class="form-signin" action="verif/sign_in_verif.php" method="post">

          <h1 class="h3 mb-3 font-weight-normal">Identifiez-vous :</h1>

          <label for="inputEmail" class="sr-only"></label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Votre adresse mail" name="email">

          <label for="inputPassword" class="sr-only"></label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Votre mot de passe" name="mot_de_passe">

          <div class="checkbox mt-3 mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Rester connecté
            </label>
          </div>

          <button class="btn btn-lg btn-primary btn-block" style="background-color: #004579" type="submit">Connexion</button>
          <div class="py-4">
            <a style="color: #004579;" href="#">Vous avez oublié votre mot de passe ?</a>
          </div>

        </form>
      </div>
      <div class="bg-light py-5 container text-center">
        <h1 class="h3 mb-3 font-weight-normal">Vous n'avez pas de compte ?</h1>
        <a style="background-color: #004579" class="btn btn-lg btn-primary btn-block" href="sign_up.php">Créer un compte</a>
      </div>
    </div>
  </body>
</html>
