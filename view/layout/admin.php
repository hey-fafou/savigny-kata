<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="test/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width" />
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
              <li><a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/index/news'?>" class="nav-link">Les news</a></li>
              <li><a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/index/blog'?>" class="nav-link">Le blog</a></li>
              <li><a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/index'?>" class="nav-link">Les liens</a></li>
              <li><a href="<?php echo BASE_URL.'/posts'?>" class="nav-link">Le site</a></li>
              <li>
                <a href="<?php echo BASE_URL.'/users/logout'?>" class="nav-link">
                  <img src="<?php echo BASE_URL.'/webroot/img/icons/lock.png'?>"
                       class="admin_icon" 
                       alt="" 
                       title="Déconnexion"/>
                </a>
              </li>
            </ul>
          </nav>
          <!--  [MENU]  --> 
        </div>
      </div>
      <!-- [HEADER] -->

      <?php echo $content_for_layout; ?>
    </div>
  </body>
</html>
