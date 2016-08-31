<div class="body-wrapper">
  <div>
    <h1>Ajouter un <?php echo $title; ?></h1>
  </div>
  <form action="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/links/add/'.$link_type ?>" method="post" enctype="multipart/form-data">
    <div class="input-wrapper">
      <label for="inputTitle">Nom du <?php echo $title; ?></label>
      <div class = "input">
        <input type="text" id="inputTitle" name="title" value=""/>
      </div>
      <?php if ($link_type == "websites") {
            echo "<label for=\"inputLink\">Adresse du site</label>
                  <div class = \"input\">
                    <input type=\"text\" id=\"inputLink\" name=\"link\" value=\"\"/>
                  </div>";
          } else if ($link_type == "documents") {
            echo "<input type=\"hidden\" name=\"link\" value=\"".BASE_URL."/webroot/doc/\"/>";
          }?>
      <input type="hidden" name="type" value="<?php echo $link_type ?>"/>
      <?php if ($link_type == "documents") {
              echo "<label for\"inputDocument\">Document</label>
                    <div class =\"input\">
                      <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"4194304\" />
                      <input id=\"inputDocument\" type=\"file\" name=\"doc\">
                    </div>";
      } ?>
      <div class="actions">
        <input type="submit" class="submit-btn" value="Envoyer"/>
      </div>
    </div>
  </form>
</div>
