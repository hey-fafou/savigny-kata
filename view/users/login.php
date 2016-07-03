<div class="body-wrapper">
  <div class="description">
    <h1>Zone réservée</h1>
  </div>
  <form action="<?php echo BASE_URL.'/'.array_search('admin', Router::$prefixes).'/posts' ?>" method="post">
    <div class="input-wrapper">
      <label for="inputId">Identifiant</label>
      <div class = "input">
        <input type="text" id="inputId" name="id" value=""/>
      </div>
      <label for="inputPassword">Mot de passe</label>
      <div class = "input">
        <input type="password" id="inputPassword" name="password" value=""/>
      </div>
      <div class="actions">
        <input type="submit" class="submit-btn" value="Se connecter"/>
      </div>
    </div>
  </form>
</div>
