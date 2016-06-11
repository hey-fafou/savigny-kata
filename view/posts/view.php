<div class="body-wrapper">
  <?php $page_title = $post->title; ?>
  
  <h2>
    <?php echo $post->title; ?>
    <span class="date"><?php echo date('d/m/Y à H\hi', strtotime($post->date));?></span>
  </h2>
  
  <?php echo nl2br($post->content); ?>
</div>
