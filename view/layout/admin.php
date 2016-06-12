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
  <!-- TinyMCE integration -->
  <script src="<?php echo BASE_URL.'/webroot/js/tinymce/tinymce.min.js'?>"></script>
  <script>
  tinymce.init({
    selector: ".wysiwyg",
  });
  </script>
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
              <li><a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts'?>" class="nav-link">Les news</a></li>
              <li><a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/index/blog'?>" class="nav-link">Le blog</a></li>
              <li><a href="<?php echo BASE_URL.'/posts'?>" class="nav-link">Le site</a></li>
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
              <li><a href = "http://www.ffkama.fr/" class="blue-link">La FFKAMA</a></li>
              <li><a href = "http://www.ffkarate.fr/seineetmarne/" class="blue-link">La ligue 77</a></li>
              <li><a href = "http://http://www.aspsavigny.fr/" class="blue-link">L'ASPS</a></li>
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
</html>
