<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inscription</title>
  </head>
  <body style="background: #EAF9FF">
    <?php
      include("includes/header_logo.php");

      include("panier/db_connection.php");
    ?>

    <div style="width: 60rem" class="container">
      <div class="bg-light py-5 container text-center border-bottom">
        <form action="verif/sign_up_verif.php" method="post">
          <div class="border-bottom">
            <h1 class="h3 mb-3 font-weight-normal">Vos identifiants :</h1>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4"></label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
              </div>

              <div class="form-group col-md-6">
                <label for="inputPassword4"></label>
                <input type="password" class="form-control mb-2" id="inputPassword4" placeholder="Password" name="mot_de_passe">
              </div>
            </div>
          </div>

          <div class="mt-2 form-group">
            <h1 class="h3 mb-3 font-weight-normal">Vos informations personnelles :</h1>
            <label for="inputFamName"></label>
            <input type="text" class="form-control w-50" id="inputFamName" placeholder="Nom" name="nom">
          </div>

          <div class="form-group">
            <label for="inputName"></label>
            <input type="text" class="form-control w-50" id="inputName" placeholder="Prénom" name="prenom">
          </div>

          <div class="form-row">
            <div class="form-group w-25">
              <label for="inputNumber"></label>
              <input type="text" class="form-control" id="inputNumber" placeholder="Numéro" name="numero">
            </div>

            <div class="form-group w-100">
              <label for="inputAddress"></label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Adresse" name="adresse">
            </div>

          <button class="btn btn-lg btn-primary btn-block my-5" style="background-color: #004579" type="submit">Inscription</button>
        </form>
      </div>
      <div class="bg-light py-1 container text-center border-top">
        <h1 class="h3 mb-3 font-weight-normal">Vous avez déja un compte ?</h1>
        <a style="background-color: #004579" class="btn btn-lg btn-primary btn-block" href="sign_in.php">Connexion</a>
      </div>
    </div>

  </body>
</html>
