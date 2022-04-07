<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title translate-key="market-title"></title>
  </head>
  <body>
    <?php
    include("../includes/header.php");
     ?>
    <main>
      <div class="d-flex justify-content-center m-4">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="product" onclick="GetRadioValue()" autocomplete="off">
          <label class="btn btn-outline-primary" for="btnradio1">Produit</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="service" onclick="GetRadioValue()" autocomplete="off">
          <label class="btn btn-outline-success" for="btnradio2">Prestation</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="both" onclick="GetRadioValue()" autocomplete="off">
          <label class="btn btn-outline-danger" for="btnradio3">Both</label>
        </div>
      </div>
      <div id="products" class="row row-cols-md-4 justify-content-center">


      </div>
    </main>
    <?php
    include("../includes/footer.php");
     ?>

     <script type="text/javascript">

        $(document).ready(function(){
          let id = sessionStorage.getItem('id');
          if (id == null) {
            id = "btnradio3";
          }
          $('#'+id).prop('checked', true);
          LoadProducts($('#'+id));

          $(document).on('click', 'input[name="btnradio"]', function(){
            LoadProducts($(this));
          });
        });

         function GetRadioValue(){
           let valeur;
           jQuery("input[name='btnradio']").each(function(){
             if (this.checked) {
               valeur = this.value;
               sessionStorage.setItem('id', this.id);
             }
           });
         }

         function LoadProducts(radio){
           var value = radio.attr('value');
           $.ajax({
             type:'POST',
             url:'loadProducts.php',
             data:'radioValue='+value,
             success:function(data){
               if (data != '') {
                $('#products').html(data);
               }
             }
           });
         }

     </script>
  </body>
</html>
