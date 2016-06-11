<div class="body-wrapper">
  <div>
    <h1>Ajouter un article</h1>
  </div>
  <form action="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/add/'.$post_type ?>" method="post" enctype="multipart/form-data">
    <div class="input-wrapper">
      <label for="inputTitle">Titre</label>
      <div class = "input">
        <input type="text" id="inputTitle" name="title" value=""/>
      </div>
      <label for="inputText">Contenu</label>
      <div class = "input">
        <textarea id="inputText" class="wysiwyg" name="content" rows="5" cols="50"></textarea>
      </div>
      <input type="hidden" name="type" value="<?php echo $post_type ?>"/>
      <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s")?>"/>
      <label for"inputImage">Illustration</label>
      <div class ="input">
        <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
        <input id="inputImage" type="file" name="img">
      </div>
      <div class="actions">
        <input type="submit" class="submit-btn" value="Envoyer"/>
      </div>
    </div>
  </form>
</div>

