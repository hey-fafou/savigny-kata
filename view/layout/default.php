<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="test/html; charset=utf-8"/>
    <title><?php echo isset($page_title) ? $page_title : "Savigny-kata"; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL.'/webroot/css/default.css' ?>"/>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="<?php echo BASE_URL.'/webroot/js/mine.js'?>"></script>
  </head>
  <body>
    <div>
      <!--  [HEADER]  -->
      <div class="header-wrapper">
        <header class="site-name">
          <h1>Karaté - Tai-Chi</h1>
          <h2>Savigny-le-Temple</h2>
        </header>
        <div class="top-navigation">
          <!--  [MENU]  --> 
          <nav>
            <button type="button" role="button" class="nav-button" aria-hidden="true">
              <span class="nav-lines"></span>
              menu
            </button>
            <ul>
              <li><a href="<?php echo BASE_URL.'/savigny-kata/home'?>" class="nav-link">Les news</a></li>
              <li><a href="#" class="nav-link">Les photos</a></li>
              <li><a href="#" class="nav-link">Les vidéos</a></li>
              <li><a href="#" class="nav-link">Le blog</a></li>
              <li><a href="#" class="nav-link">Les trucs utiles</a></li>
              <li><a href="#" class="nav-link">Le club</a></li>
            </ul>
          </nav>
          <!--  [MENU]  --> 
        </div>
      </div>
      <!-- [HEADER] -->

      <!-- [ASIDE]  -->
      <aside>
        <div class="address">
          <h3>Adresse</h3>
          Gymnase Les Régalles<br/>
          Rue des oiseaux<br/>
          77176 - Savigny-le-Temple<br/>
        </div>
        <div class="external-links">
          <h3>Liens externes</h3>
            <ul>
              <li><a href = "http://www.ffkama.fr/">La FFKAMA</a></li>
              <li><a href = "http://www.ffkarate.fr/seineetmarne/">La ligue 77</a></li>
              <li><a href = "http://http://www.aspsavigny.fr/">L'ASPS</a></li>
            </ul>
        </div>
        <div class="asps-logo">
          <a href="http://www.aspsavigny.fr" target="blank">
            <img src="<?php echo BASE_URL.'/webroot/img/logo/asps.jpg'?>" alt="" title="Lien vers le site de l'ASPS"/>
          </a>
        </div>
      </aside>
      <!-- [ASIDE]  -->

      <?php echo $this->Session->flash(); ?>
      <?php echo $content_for_layout; ?>
    </div>
  </body>
  <footer style="display:none;">
  <div>
    Icons made by 
    <a href="http://www.flaticon.com/authors/designerz-base" title="Designerz Base">Designerz Base</a> 
    from 
    <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> 
    is licensed by 
    <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
  </div>
  </footer>
</html>
