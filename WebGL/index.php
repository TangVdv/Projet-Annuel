<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Magasin 3D</title>
  </head>
  <body>
    <?php
      //include("../includes/header.php");
    ?>
    <!-- Import maps polyfill -->
		<!-- Remove this when import maps will be widely supported -->
		<script async src="https://unpkg.com/es-module-shims@1.3.6/dist/es-module-shims.js"></script>

		<script type="importmap">
			{
				"imports": {
					"three": "./three.js-master/build/three.module.js"
				}
			}
		</script>
    <video id="video" width="1600" style="display:none" muted>
      <source src="video/Coin_rain.mp4" type="video/mp4">
    </video>
    <div id="container">
      <script type="module" src="3d_market.js"></script>
    </div>

  </body>
</html>
