<!-- [ASIDE]  -->
<aside>
  <div class="address">
    <h3>Adresse</h3>
    Gymnase Les Régalles<br/>
    Rue des oiseaux<br/>
    77176 - Savigny-le-Temple<br/>
  </div>
  <div class="social-networks">
    <h3>Réseaux sociaux</h3>
      <?php foreach ($networks as $k => $v) { 
              if ($v->title == "Facebook") {
                echo "<a href = \"".$v->link."\" target=\"_blank\">
                         <img src=\"".BASE_URL.'/webroot/img/icons/facebook.png'."\" alt=\"\" title=\"Page Facebook\"/>
                      </a> ";
              }
              if ($v->title == "Youtube") {
                echo "<a href = \"".$v->link."\" target=\"_blank\">
                          <img src=\"".BASE_URL.'/webroot/img/icons/youtube.png'."\" alt=\"\" title=\"Chaine Youtube\"/>
                      </a>";
              }
        } ?>
  </div>
  <div class="documents">
    <h3>Documents</h3>
      <ul>
      <?php foreach ($documents as $k => $v) { 
            echo "<li><a href = \"".$v->link."\"  target=\"_blank\" class=\"blue-link\">".$v->title."</a></li>";
        } ?>
      </ul>
  </div>
  <div class="external-links">
    <h3>Liens externes</h3>
      <ul>
      <?php foreach ($websites as $k => $v) { 
        echo "<li><a href = \"".$v->link."\" target=\"_blank\" class=\"blue-link\">".$v->title."</a></li>";
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
