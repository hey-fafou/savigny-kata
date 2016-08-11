<div class="body-wrapper">
  <!-- [DOCUMENTS] -->
  <div>
    <h1>Documents</h1>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nom du document</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/add/documents' ?>" class="blue-link">
              Ajouter
            </a>
          </td>
        </tr>
      <?php foreach($documents as $k => $v) { ?>
        <tr>
          <td><?php echo $v->title;?></td>
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
  <!-- [DOCUMENTS] -->

  <!-- [EXTERNAL LINKS] -->
  <div>
    <h1>Liens externes</h1>
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
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/add/websites' ?>" class="blue-link">
              Ajouter
            </a>
          </td>
        </tr>
      <?php foreach($websites as $k => $v) { ?>
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
  <!-- [EXTERNAL LINKS] -->

  <!-- [SOCIAL NETWORK] -->
  <div>
    <h1>Reseaux sociaux</h1>
  </div>
  
  <table>
    <thead>
      <tr>
        <th>Réseau social</th>
        <th>Adresse du site</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($networks as $k => $v) { ?>
        <tr>
          <td><?php echo $v->title;?></td>
          <td><?php echo $v->link;?></td>
          <td>
            <a href="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/edit/'.$v->type.'/'.$v->id; ?>" class="blue-link">
              Editer
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <!-- [SOCIAL NETWORK] -->
</div>
