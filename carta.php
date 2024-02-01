

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
      <div id="header-logo" class="header-logo">
        <a href="index.php">
          <img class="verencarta logonew carta" src="img/logo.png">
        </a>
        <a href="index.php">
          <img class="header-sticky" src="img/logo-sticky.png">
        </a>
      </div>
    </div>
  </header>
  <div class="bg-carta"></div>

  <style type="text/css">
    .as89 {
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }
  </style>
  <div id="page-content">
    <div class="cart-page">
      <div class="container">
        <div class="row">
          <div class="col s12">
            <div class="cart-box">
              <form>
                <?php

                $categoriaId = '';

                if (isset($_GET['categoria'])) {
                    $categoriaId = $_GET['categoria'];
                }

                // URL de la API Local
                // $api_url = "http://via-atigliana-admin.onrender.com/api/productos?populate=*";
                // URL de la API
                $api_url = "https://via-atigliana.up.railway.app/api/productos?populate=*&categoria.id=". $categoriaId ."";

                $json_data = file_get_contents($api_url);

                $data = json_decode($json_data, true);

                // URL de la API Local
                // $api_url2 = "http://via-atigliana-admin.onrender.com/api/categorias/".$categoriaId."";
                // URL de la API
                $api_url2 = "https://via-atigliana.up.railway.app/api/categorias/".$categoriaId."";

                $json_data2 = file_get_contents($api_url2);

                $data2 = json_decode($json_data2, true);

                $categoryName = $data2['data']['attributes']['nombre'];
                echo '<div class="content-category-name">';
                  echo $categoryName;
                echo '</div>';

                if ($data && isset($data['data'])) {

                    foreach ($data['data'] as $producto) {
                        $nombre = $producto['attributes']['nombre'];
                        $precio = $producto['attributes']['precio'];
                        $categoria = '';
                        $subcategoria = '';
                        $descripcion ='';
                        $subcategoriaDesc = '';
                        $categoriaIdArray = '';
                        $imagen_url = ''; 

                        if(!empty($producto['attributes']['descripcion'][0]['children'][0])) {
                          $descripcion = $producto['attributes']['descripcion'][0]['children'][0]['text'];
                        }

                        if (!empty($producto['attributes']['imagen']['data'])) {

                            $imagen_url = $producto['attributes']['imagen']['data']['attributes']['url'];
                        }

                        if(!empty($producto['attributes']['categoria']['data']['attributes'])) {
                            $categoria = $producto['attributes']['categoria']['data']['attributes']['nombre'];
                        }

                        if(!empty($producto['attributes']['categoria']['data'])) {
                          $categoriaIdArray = $producto['attributes']['categoria']['data']['id'];
                        }

                        if(!empty($producto['attributes']['subcategoria']['data']['attributes'])) {
                          $subcategoria = $producto['attributes']['subcategoria']['data']['attributes']['nombre'];
                        }

                        if(!empty($producto['attributes']['subcategoria']['data']['attributes'])) {
                          $subcategoriaDesc = $producto['attributes']['subcategoria']['data']['attributes']['descripcioncorta'];
                        }

                        if($categoriaIdArray == $categoriaId){

                            echo '<div class="cart-item">';
                            echo '<div class="ci-name h">';
                            echo '<div class="cin-top">';
                            echo '<div class="cin-title category">' . $nombre. '</div>';
                            if(!empty($producto['attributes']['subcategoria']['data']['attributes'])) {
                              echo '<br><div class="cin-title subcategory">'. $subcategoria;
                              if(!empty($producto['attributes']['subcategoria']['data']['attributes']['descripcioncorta'])) {
                                echo '<span>'. $subcategoriaDesc .'</span>';
                              }
                              echo '</div>';
                            }
                            echo '</div>';
                            echo '</div>';
                            if($imagen_url){
                              echo '<div class="ci-img">';
                              echo '<div class="ci-img-product" style="background-image: url(' . $imagen_url . ');"></div>';
                              echo '</div>';
                            }
                            // echo '<div class="ci-name h">';
                            // echo '<div class="cin-top">';
                            // echo '<div class="cin-title">' . $nombre;
                            // echo '</div>';
                            // echo '</div>';
                            // echo '</div>';
                            echo '<div class="ci-name dos">';
                            echo '<div class="cin-top">';
                            if(!empty($producto['attributes']['descripcion'][0]['children'][0])) {
                              echo '<div class="item-info">';
                              echo '<i class="fa fa-quote-right" aria-hidden="true" style="color: #ff9800; font-size: 14px; margin-right: 3px;"></i>';
                              echo $descripcion;
                              echo '</div>';
                            }
                            echo '<div class="cin-price preciopesos" style="margin-bottom: 15px;">$ ' . $precio . '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="ci-price solocarta">';
                            echo '<div class="qty-total-price">';
                            echo '<div class="qty-prc">';
                            echo '<div class="quantity">';
                            echo '<input type="number" class="cantidad" name="producto[' . $producto['id'] . ']" min="0" max="9999" step="1" value="0">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div style="clear: both"></div>';
                            echo '</div>';
                        }
                    }
                } else {
                    echo 'Error al obtener datos de la API.';
                }
                ?>
                <a href="index.php" style="display: none;"
                  class="btn button-add-cart checkout-button d240 verencarta">VOLVER <i class="fa fa-undo"
                    aria-hidden="true" style="padding-top: 2px;"></i></a>
              </form>
            </div>
            <div class="row copyright nomodesto"
              style="position: relative; bottom: 0; width: 100%; text-align: center; margin-bottom: 10px;margin-top: 10px;margin-bottom: 0px;">
              <a href="">Creado por <img class="ipage"
                  src="img/ipage.png"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <script>
      $(document).ready(function () {
        $('.cin-title.category').arctext({radius: 500});
      });
    </script> -->

    <script>
      // When the user scrolls the page, execute myFunction
      window.onscroll = function() {myFunction()};

      // Get the header
      var header = document.getElementById("header-logo");

      // Get the offset position of the navbar
      var sticky = 230;

      // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
      function myFunction() {
        if (window.pageYOffset > sticky) {
          header.classList.add("sticky");
        } else {
          header.classList.remove("sticky");
        }
      }
    </script>
  </body>
</html>