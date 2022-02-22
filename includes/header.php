<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet">
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
          <img src="../../img/logo_loyaltycard.png" width="40%">
        </a>
        <ul class="nav">
          <li class="nav-item"><a href="#" class="nav-link text-white px-2">Compte</a></li>
        </ul>
        <form class="w-100 me-3">
          <input type="search" class="form-control" placeholder="Vous cherchez un produit ?" aria-label="Search">
        </form>
      </div>
    </header>

    <nav class="py-2 bg-light border-bottom">
      <div class="container d-flex flex-wrap justify-content-center">
        <ul class="nav">
          <li class="nav-item"><a href="../index.php" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
          <li class="nav-item"><a href="../market/index.php" class="nav-link link-dark px-2">Market</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">About</a></li>
          <li class="nav-item"><a href="../../admin/index.php" class="nav-link link-dark px-2 text-danger">Admin</a></li>
        </ul>

      </div>
    </nav>

  </body>
</html>