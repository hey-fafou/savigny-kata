<div class="no-admin body-wrapper">
  <div class="description">
    <h1>Les derniers posts</h1>
  </div>
    <?php foreach ($posts as $k => $v) { ?>
      <div class="post">
        <h2 class="post-title">
          <?php echo $v->post_title; ?>
          <span class="date"><?php echo date('d/m/Y à H\hi', strtotime($v->post_date)); ?></span>
        </h2>
        <img src="<?php echo $v->media_file.'/'.$v->media_title; ?>" alt = "" title="<?php echo $v->media_title; ?>"/>
        <p class="post-content"><?php echo $v->post_content; ?></p>
        <p class="read-more"><a href="<?php echo BASE_URL.'/posts/view/'.$v->post_type.'/'.$v->post_id; ?>" class="blue-link">Lire la suite &rarr;</a></p>
      </div> 
    <?php } ?>
    <?php pagination($page, $pages, "posts") ?>
</div>
