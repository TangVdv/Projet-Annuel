<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Header</title>
    <style>
      header {
        background : #004579;
      }
    </style>
  </head>
  <body>

    <header class="py-3 border-bottom">
      <div class="container d-flex flex-wrap justify-content-center">
        <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
          <img src="../img/logo_loyaltycard.png" width="40%">
        </a>
        <ul class="nav">
          <?php
          session_start();
          // Si co ou pas co, affiche les bons trucs
          if (isset($_SESSION['email'])) {
      				echo "<li class='nav-item'><a href='#' class='nav-link text-white px-2'>Compte</a> </li>";
              echo "<li class='nav-item'><a href='../panier/panier.php' class='nav-link text-white px-2'>Panier</a> </li>";
      			}
      		else{
      				echo "<li class='nav-item'><a href='../sign_in.php' class='nav-link text-white px-2'>Connexion</a> </li>";
      				echo "<li class='nav-item'><a href='../sign_up.php' class='nav-link text-white px-2'>Inscription</a> </li>";
      			}
            ?>
        </ul>
        <form class="w-100 me-3">
          <input type="search" class="form-control" placeholder="Vous cherchez un produit ?" aria-label="Search">
        </form>
      </div>
    </header>

    <nav class="py-2 bg-light border-bottom">
      <div class="container d-flex flex-wrap justify-content-center">
        <ul class="nav">
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">About</a></li>
        </ul>

      </div>
    </nav>

  </body>
</html>
