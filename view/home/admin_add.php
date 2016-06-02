<div class="body-wrapper">
  <div>
    <h1>Ajouter un article</h1>
  </div>
  <form action="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/home/add/' ?>" method="post">
    <div class="input-wrapper">
      <label for="inputTitle">Titre</label>
      <div class = "input">
        <input type="text" id="inputTitle" name="title" value=""/>
      </div>
      <label for="inputText">Contenu</label>
      <div class = "input">
        <textarea id="inputText" class="wysiwyg" name="content" rows="5" cols="50"></textarea>
      </div>
      <input type="hidden" name="type" value="news"/>
      <input type="hidden" name="date" value="<?php echo date("Y-m-d H:i:s")?>"/>
      <div class="actions">
        <input type="submit" class="submit-btn" value="Envoyer"/>
      </div>
    </div>
  </form>
</div>

