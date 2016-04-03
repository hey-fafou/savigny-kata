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
        <p class="read-more"><a href="<?php echo BASE_URL.'/home/view/'.$v->id;?>">Lire la suite &rarr;</a></p>
      </div> 
    <?php } ?>
    <div class="pagination">
      <ul>
        <?php for($i = 1; $i <= $page; $i++) { ?>
          <li>
            <a href="?page=<?php echo $i?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
</div>
