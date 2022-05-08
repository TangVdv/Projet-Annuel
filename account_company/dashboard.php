<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Tableau de bord</title>
  </head>
  <?php
  include("../includes/header.php");
  include("verifCompanyLogin.php");
   ?>
  <body>
    <div style="width: 100rem" class="container bg-light py-4 container">
      <h1>Tableau de bord : </h1>
      <br><br>
      <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Nombre de ventes uniques : </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                              include("dashboard/dashboardModel.php");
                              echo dashboardModel::getNumberOfUniqueSales();
                            ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pourcentage de ventes de LoyaltyCard : </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                              echo dashboardModel::getPourcentageFromTotalSales() . "%";
                            ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Nombre de produits disponibles : </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                              echo dashboardModel::getNumberOfProductsAvailable();
                            ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Nombre de stock total : </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                              echo dashboardModel::getNumberOfTotalStock();
                            ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning h-100 py-2">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                  Nombre de jours avant le prochain paiement : </div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                echo dashboardModel::getDaysBeforeNextPayment();
                              ?></div>
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-comments fa-2x text-gray-300"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>

    </div>

  </body>
  <?php
  include("../includes/footer.php");
  ?>
</html>
