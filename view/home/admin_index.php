<div class="body-wrapper">
  <div>
    <h1><?php echo $total_posts; ?> Article(s)</h1>
  </div>
  
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Titre</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td></td>
          <td></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/add/' ?>" class="blue-link">
              Ajouter
            </a>
          </td>
        </tr>
      <?php foreach($news_posts as $k => $v) { ?>
        <tr>
          <td><?php echo $v->date_fr;?></td>
          <td><?php echo $v->title;?></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/edit/'.$v->id; ?>" class="blue-link">
              Editer
            </a>
            <a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?')"
               href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/delete/'.$v->id; ?>" class="blue-link">
              Supprimer
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
