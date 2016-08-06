<!-- [ASIDE]  -->
<aside>
  <div class="address">
    <h3>Adresse</h3>
    Gymnase Les Régalles<br/>
    Rue des oiseaux<br/>
    77176 - Savigny-le-Temple<br/>
  </div>
  <div class="external-links">
    <h3>Liens externes</h3>
      <ul>
      <?php foreach ($links as $k => $v) { 
          if ($v->type == 'externalLink') {
            echo "<li><a href = \"".$v->link."\" class=\"blue-link\">".$v->title."</a></li>";
          }
        } ?>
      </ul>
  </div>
  <div class="documents">
    <h3>Documents</h3>
      <ul>
      <?php foreach ($links as $k => $v) { 
          if ($v->type == 'documentLink') {
            echo "<li><a href = \"".$v->link."\" class=\"blue-link\">".$v->title."</a></li>";
          }
        } ?>
      </ul>
  </div>
  <div class="asps-logo">
    <a href="http://www.aspsavigny.fr" target="blank">
      <img src="<?php echo BASE_URL.'/webroot/img/logo/asps.jpg'?>" alt="" title="Lien vers le site de l'ASPS"/>
    </a>
  </div>
</aside>
<!-- [ASIDE]  -->
