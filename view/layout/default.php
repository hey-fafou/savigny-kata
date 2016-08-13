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
              <li><a href="<?php echo BASE_URL.'/posts/index/news'?>" class="nav-link">Les news</a></li>
              <li><a href="#" class="nav-link">Les photos</a></li>
              <li><a href="<?php echo BASE_URL.'/posts/index/blog'?>" class="nav-link">Le blog</a></li>
              <li><a href="#" class="nav-link">Le club</a></li>
              <li>
                <a href="<?php echo BASE_URL.'/users/login'?>" class="nav-link">
                  <img src="<?php echo BASE_URL.'/webroot/img/icons/unlock.png'?>"
                       class="admin_icon"
                       alt="" 
                       title="Administration du site"/>
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
