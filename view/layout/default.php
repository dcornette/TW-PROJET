<?php 
/*
  Projet réalisé par Damien Cornette
*/
 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">

  <head>
    <meta charset="UTF-8" />
    <title> <?php echo isset($title_for_layout)?$title_for_layout:"Projet TW de Damien Cornette"; ?> </title>
    <link href="<?php echo BASE_URL.DS; ?>css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo BASE_URL.DS; ?>css/style.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <div id="wrap">

      
  <div class="container" >
      <div class="masthead">
        <h3 class="muted"><?php echo isset($title_for_layout)?$title_for_layout:"Projet TW de Damien Cornette"; ?></h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li <?php if($this->request->action == 'index') echo 'class="active"'; ?> >
                  <a href="<?php echo BASE_URL.DS ?>communes">
                    <i class="icon-home"></i> Home</a></li>
                <li <?php if($this->request->action == 'recherche') echo 'class="active"'; ?>>
                  <a href="<?php echo BASE_URL.DS ?>communes/recherche">
                    <i class="icon-search"></i> Recherche</a></li>
                <li <?php if($this->request->action == 'liste') echo 'class="active"'; ?>>
                  <a href="<?php echo BASE_URL.DS ?>communes/liste">
                    <i class="icon-list"></i> Liste des communes</a></li>
                <li <?php if($this->request->action == 'favoris') echo 'class="active"'; ?>>
                  <a href="<?php echo BASE_URL.DS ?>communes/favoris">
                    <i class="icon-star"></i> Favoris</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div><!-- /.masthead -->
  </div>

      <div class="container" >
        <?php echo $content_for_layout; ?>
      </div>


      <div id="push"></div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="text-center">© Copyright Damien Cornette</p> 
      </div>
    </div>

    <script src="<?php echo BASE_URL.DS; ?>js/jquery.js"></script>
    <script src="<?php echo BASE_URL.DS; ?>js/bootstrap.min.js"></script>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script src="<?php echo BASE_URL.DS; ?>js/map.js"></script>
  </body>
</html>