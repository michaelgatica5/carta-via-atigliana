<?php
// URL de la API con HTTPS
$api_url = "https://via-atigliana.up.railway.app/api/contenido";

// Realizar la solicitud a la API
$response = file_get_contents($api_url);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Obtener la descripción del array
$descripcion = $data['data']['attributes']['descripcion'][0]['children'][0]['text'];

// Mostrar el HTML con la descripción
?>

<!DOCTYPE html>

<html lang="es">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="UTF-8">
  <title>Carta Digital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="HandheldFriendly" content="True">
  <link rel="icon" href="img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="css/materialize.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="lib/Magnific-Popup-master/dist/magnific-popup.css">
  <link rel="stylesheet" href="css/style_solo_carta9ca5.css?t=20220303124507">
  <link rel="stylesheet" href="css_personalizado/118.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://tympanus.net/Development/Arctext/js/jquery.arctext.js"></script>
</head>

<body id="homepage" class="as118">
  <header id="header">
    <div class="nav-wrapper container">
      <div class="header-logo">
        <img class="verencarta logonew carta" src="img/logo.png">
        <a href="" class="nav-logo">
          <i class="fa fa-address-card solocarta logasos"></i>
        </a>
      </div>
      <p class="text-description-header"><?php echo $descripcion; ?></p>
    </div>
  </header>
  <div class="section home-category">
    <div class="container">
      <div class="row icon-service">
          <?php
              // Consumir la API y mostrar las categorías
              $api_url = 'https://via-atigliana.up.railway.app/api/categorias';
              $response = file_get_contents($api_url);
              $data = json_decode($response, true);

              foreach ($data['data'] as $category) {
                  $attributes = $category['attributes'];
                  $nombre = $attributes['nombre'];
          ?>
                  <div class="col s6 m6 l2">
                      <a href="carta.php?categoria=<?php echo ($category['id']); ?>">
                          <div class="content">
                              <div class="in-content">
                                  <div class="in-in-content">
                                      <h5><?php echo $nombre; ?></h5>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>
          <?php
              }
          ?>
      </div>
    </div>
    <div class="row copyright nomodesto"
        style="position: inherit; bottom: 0; width: 100%; text-align: center; margin-bottom: 10px;margin-top: 10px;margin-bottom: 0px;">
        <a href="">Creado por <img class="ipage"
            src="img/ipage.png"></a>
    </div>
  </div>

  <script>
      $(document).ready(function () {
        $('.in-content .in-in-content h5').arctext({radius: 500});
      });
  </script>
</body>

</html>