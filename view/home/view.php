<div class="body-wrapper">
  <?php $page_title = $news_post->title; ?>
  
  <h2>
    <?php echo $news_post->title; ?>
    <span class="date"><?php echo date('d/m/Y à H\hi', strtotime($news_post->date));?></span>
  </h2>
  
  <?php echo nl2br($news_post->content); ?>
</div>
