<div class="body-wrapper">
  <div>
    <h1>Les dernières actualités</h1>
  </div>
    <?php foreach ($news_posts as $k => $v) { ?>
      <div class="home-news-post">
        <h2 class="post-title">
          <?php echo $v->title; ?>
          <span class="date"><?php echo $v->date_fr;?></span>
        </h2>
        <p class="post-content"><?php echo $v->content; ?></p>
        <p class="read-more"><a href="<?php echo BASE_URL.'/home/view/'.$v->id;?>"</a>Lire la suite &rarr;</p>
      </div> 
    <?php } ?>
</div>
