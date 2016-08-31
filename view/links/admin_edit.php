<div class="body-wrapper">
  <div>
    <h1>Modifier un <?php echo $title; ?></h1>
  </div>
  <form action="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/edit/'.$link->type.'/'.$link->id ?>" method="post" enctype="multipart/form-data">
    <div class="input-wrapper">
      <input type="hidden" name="id" value="<?php echo $link->id; ?>"/>
      <?php 
            if ($link->type == "websites" || $link->type == "documents") {
              echo "<label for=\"inputTitle\">Nom du ".$title."</label>
                    <div class = \"input\">
                      <input type=\"text\" id=\"inputTitle\" name=\"title\" value=\"".$link->title."\"/>
                    </div>";
            } else {
              echo "<input type=\"hidden\" id=\"inputTitle\" name=\"title\" value=\"".$link->title."\"/>";
            }
      ?>
      <input type="hidden" name="type" value="<?php echo $link->type; ?>"/>
      <?php if ($link->type == "documents") {
              echo "<label for\"inputDocument\">Document</label>
                    <div class =\"input\">
                      <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\" />
                      <input type=\"hidden\" name=\"link\" value=\"".BASE_URL."/webroot/doc/\"/>
                      <input id=\"inputDocument\" type=\"file\" name=\"doc\">
                    </div>";
            } else {
              echo "<label for=\"inputLink\">Adresse du site</label>
                    <div class = \"input\">
                      <input type=\"text\" id=\"inputLink\" name=\"link\" value=\"\"/>
                    </div>";
            } ?>
      <div class="actions">
        <input type="submit" class="submit-btn" value="Envoyer"/>
      </div>
    </div>
  </form>
</div>
