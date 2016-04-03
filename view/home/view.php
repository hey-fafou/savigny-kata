<div class="body-wrapper">
  <?php $page_title = $news_post->title; ?>
  
  <h2>
    <?php echo $news_post->title; ?>
    <span class="date"><?php echo $news_post->date_fr;?></span>
  </h2>
  
  <?php echo $news_post->content; ?>
</div>
