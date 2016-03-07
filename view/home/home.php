<?php include(ROOT.DS."view/common/header.php"); ?>

<div>
  <h1>Les dernières actualités</h1>
</div>
<?php foreach ($posts as $k => $v) { ?>
  <div>
    <h2><?php echo $v->title; ?></h2>
    <p><?php echo $v->content; ?></p>
    <p><a href="<?php echo BASE_URL.'/pages/home/'.$v->id;?>"</a>Lire la suite &rarr;</p>
  </div>  
<?php } ?>
