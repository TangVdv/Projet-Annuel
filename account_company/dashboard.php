<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Tableau de bord</title>
  </head>
  <?php
  include("../includes/header.php");
   ?>
  <body>
    <?php
      include("dashboard/dashboardModel.php");

      //echo dashboardModel::getNumberOfUniqueSales();
      //echo dashboardModel::getNumberOfUniqueCustomers();
      //echo dashboardModel::getPourcentageFromTotalSales() . "%";
      //echo dashboardModel::getNumberOfProductsAvailable();
      echo dashboardModel::getNumberOfTotalStock();
      //echo dashboardModel::getDaysBeforeNextPayment();
     ?>
  </body>
  <?php
  //include("../includes/footer.php");
  ?>
</html>
