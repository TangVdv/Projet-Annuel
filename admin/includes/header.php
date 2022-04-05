<!DOCTYPE html>
<?php
include("checkAdmin.php");
 ?>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet">
    <script src="../../lib/bootstrap.min.js" charset="utf-8"></script>
    <script src="/admin/lib/languageAdminScript.js" charset="utf-8"></script>

    </script>
  </head>
  <body>
    <header class="py-3 border-bottom" style="background : #004579">
      <div class="container d-flex flex-wrap justify-content-center">
        <img src="../../img/logo_loyaltycard.png" width="20%">
      </div>
      <div class="d-flex flex-row-reverse mx-4">
        <select translate-switcher class="form-select-sm">
          <option value="en-US">English</option>
          <option value="fr-FR">Français</option>
        </select>
      </div>
    </header>

    <nav class="py-2 bg-light border-bottom">
      <div class="container d-flex flex-wrap justify-content-center">
        <ul class="nav">
          <li class="nav-item"><a href="/" class="nav-link link-dark px-2 active" aria-current="page" translate-key="public-title"></a></li>
          <li class="nav-item"><a href="/admin/" class="nav-link link-dark px-2 text-danger" translate-key="admin-title"></a></li>
        </ul>
      </div>
    </nav>


  </body>
</html>
