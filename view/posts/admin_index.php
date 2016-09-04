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
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/add/'.$post_type ?>" class="grey-link">
              Ajouter
            </a>
          </td>
        </tr>
      <?php foreach($posts as $k => $v) { ?>
        <tr>
          <td><?php echo date('d/m/Y à H\hi', strtotime($v->post_date));?></td>
          <td><?php echo $v->post_title;?></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/edit/'.$v->post_type.'/'.$v->post_id; ?>" class="blue-link">
              Editer
            </a>
            <a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?')"
               href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/delete/'.$v->post_type.'/'.$v->post_id; ?>" class="red-link">
              Supprimer
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
