<div class="body-wrapper">
  <div class="description">
    <h1>Les dernières actualités</h1>
  </div>
    <?php foreach ($news_posts as $k => $v) { ?>
      <div class="home-news-post">
        <h2 class="post-title">
          <?php echo $v->title; ?>
          <span class="date"><?php echo $v->date_fr;?></span>
        </h2>
        <p class="post-content"><?php echo $v->content; ?></p>
        <p class="read-more"><a href="<?php echo BASE_URL.'/home/view/'.$v->id;?>">Lire la suite &rarr;</a></p>
      </div> 
    <?php } ?>
    <?php pagination($page, $pages, "home") ?>
</div>
