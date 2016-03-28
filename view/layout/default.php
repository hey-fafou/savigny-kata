<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="test/html; charset=utf-8"/>
    <title><?php echo isset($page_title) ? $page_title : "Savigny-kata"; ?></title>
    <link rel="stylesheet" href="/savigny-kata/webroot/css/default.css"/>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="/savigny-kata/webroot/js/mine.js"></script>
  </head>
  <body>
    <div>
      <?php include(ROOT.DS."view/common/header.php"); ?>
      <?php include(ROOT.DS."view/common/note.php"); ?>
      <?php echo $content_for_layout; ?>
    </div>
  </body>
</html>
