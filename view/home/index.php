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
          <li>
            <a href="<?php echo BASE_URL.'/home?page='.max(($page-1), 1); ?>">
            <img src="<?php echo BASE_URL.'/webroot/img/icons/left_arrow.png' ?>" alt="" title="Précédent" />
            </a>
          </li>
        <?php for($i = 1; $i <= $pages; $i++) { ?>
          <li>
            <a href="<?php echo BASE_URL.'/home?page='.$i; ?>">
              <?php echo $i; ?>
            </a>
          </li>
        <?php } ?>
        <li>
          <a href="<?php echo BASE_URL.'/home?page='.min(($page+1), $pages); ?>">
          <img src="<?php echo BASE_URL.'/webroot/img/icons/right_arrow.png' ?>" alt="" title="Suivant" />
          </a>
        </li>
      </ul>
    </div>
</div>
