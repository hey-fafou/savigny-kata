<div class="no-admin body-wrapper">
  <?php $page_title = $post->post_title; ?>
  
  <h2>
    <?php echo $post->post_title; ?>
    <span class="date"><?php echo date('d/m/Y à H\hi', strtotime($post->post_date));?></span>
  </h2>
  
  <?php if (($post->media_title != '') && ($post->media_file != '')) { ?>
    <img src="<?php echo $post->media_file.'/'.$post->media_title; ?>" alt = "" title="<?php echo $post->media_title; ?>"/>
  <?php } ?>
  <?php echo nl2br($post->post_content); ?>
</div>
