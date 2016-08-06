<div class="body-wrapper">
  <div>
    <h1>Les liens externes</h1>
  </div>
  
  <table>
    <thead>
      <tr>
        <th>Nom du lien</th>
        <th>Adresse du site</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td></td>
          <td></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/add/externalLink' ?>" class="blue-link">
              Ajouter
            </a>
          </td>
        </tr>
      <?php foreach($links as $k => $v) { ?>
        <tr>
          <td><?php echo $v->title;?></td>
          <td><?php echo $v->link;?></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/edit/'.$v->type.'/'.$v->id; ?>" class="blue-link">
              Editer
            </a>
            <a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu ?')"
               href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/delete/'.$v->type.'/'.$v->id; ?>" class="blue-link">
              Supprimer
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
