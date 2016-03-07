<?php include(ROOT.DS."view/common/header.php"); ?>

<?php $page_title = $news_post->title; ?>

<h1><?php echo $news_post->title; ?></h1>

<?php echo $news_post->content; ?>
