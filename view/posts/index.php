<div class="body-wrapper">
  <div class="description">
    <h1>Les dernières actualités</h1>
  </div>
    <?php foreach ($posts as $k => $v) { ?>
      <div class="post">
        <h2 class="post-title">
          <?php echo $v->title; ?>
          <span class="date"><?php echo date('d/m/Y à H\hi', strtotime($v->date));?></span>
        </h2>
        <p class="post-content"><?php echo $v->content; ?></p>
        <p class="read-more"><a href="<?php echo BASE_URL.'/posts/view/'.$v->type.'/'.$v->id; ?>" class="blue-link">Lire la suite &rarr;</a></p>
      </div> 
    <?php } ?>
    <?php pagination($page, $pages, "posts") ?>
</div>
