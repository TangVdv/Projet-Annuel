<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <script src="/lib/bootstrap.min.js" charset="utf-8"></script>
    <script type="module" src="/lib/languageScript.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
          <img src="/img/logo_loyaltycard.png" width="40%">
        </a>
        <ul class="nav">
          <?php
          session_start();

          if (isset($_SESSION['email'])) {
              echo "<li class='nav-item'><a href='/signIn-Up/logOut.php' class='nav-link text-white px-2' translate-key='logout-title'></a> </li>";
      				echo "<li class='nav-item'><a href='/account/' class='nav-link text-white px-2' translate-key='account-title'>Compte</a> </li>";
              echo "<li class='nav-item'><a href='/panier/' class='nav-link text-white px-2' translate-key='cart-title'>Panier</a> </li>";
      			}
            elseif (isset($_SESSION['nom'])) {
              require_once("productModelCompany.php");
              $req = productModelCompany::checkPaymentStatus();
              while ($row = $req->fetch(PDO::FETCH_OBJ)){
                $status = $row->statut_cotisation;
                echo "<li class='nav-item'><a href='/signIn-Up/logOut.php' class='nav-link text-white px-2' translate-key='logout-title'></a> </li>";
                echo "<li class='nav-item'><a href='/account_company/account.php' class='nav-link text-white px-2'>Compte</a> </li>";
                if($status == 0 || $status == 1){
                  echo "<li class='nav-item'><a href='/account_company/products.php' class='nav-link text-white px-2'>Produits</a> </li>";
                }
              }
            }
      		else{
      				echo "<li class='nav-item'><a href='/signIn-Up/sign_in.php' class='nav-link text-white px-2' translate-key='login-title'></a> </li>";
      				echo "<li class='nav-item'><a href='/SignIn-Up/sign_up.php' class='nav-link text-white px-2' translate-key='register-title'></a> </li>";
      			}
            ?>
        </ul>
        <div class="navbar-right">
          <select id="select-language" switch-key translate-switcher class="form-select-sm">
          </select>
        </div>
        <form class="w-100 me-3">
          <input type="search" class="form-control" translate-key="search-bar" aria-label="Search">
        </form>
      </div>
    </header>

    <nav class="py-2 bg-light border-bottom">
      <div class="container d-flex flex-wrap justify-content-center">
        <ul class="nav">
          <li class="nav-item"><a href="/" class="nav-link link-dark px-2 active" aria-current="page" translate-key="home-title"></a></li>
          <li class="nav-item"><a href="/market/" class="nav-link link-dark px-2" translate-key="market-title"></a></li>
          <li class="nav-item"><a href="/WebGL/" class="nav-link link-dark px-2">Magasin 3D</a></li>
        </ul>

      </div>
    </nav>

  </body>
</html>
