<div class="body-wrapper">
  <div>
    <h1>Editer un article</h1>
  </div>
  <form action="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts/edit/'.$post->type.'/'.$post->id ?>" method="post" enctype="multipart/form-data">
    <div class="input-wrapper">
      <input type="hidden" name="id" value="<?php echo $post->id; ?>"/>
      <label for="inputTitle">Titre</label>
      <div class = "input">
        <input type="text" id="inputTitle" name="title" value="<?php echo $post->title; ?>"/>
      </div>
      <label for="inputText">Contenu</label>
      <div class = "input">
        <textarea id="inputText" class="wysiwyg" name="content" rows="5" cols="50"><?php echo $post->content; ?></textarea>
      </div>
      <input type="hidden" name="type" value="<?php echo $post->type; ?>"/>
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
