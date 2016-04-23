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
      <?php include(ROOT.DS."view/common/header.php"); ?>
      <?php include(ROOT.DS."view/common/aside.php"); ?>
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
