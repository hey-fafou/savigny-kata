<div class="body-wrapper">
  <div>
    <h1><?php echo $total_posts; ?> Articles</h1>
  </div>
  
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($news_posts as $k => $v) { ?>
        <tr>
          <td><?php echo $v->id;?></td>
          <td><?php echo $v->title;?></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/edit/'.$v->id; ?>">
              Editer
            </a>
            <a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?')"
               href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/delete/'.$v->id; ?>">
              Supprimer
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
