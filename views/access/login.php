<!-- Login form ------------------------------------------------------------------------------------------------------->

<div class="container text-center log">
  <div class="container mb-2 pt-5">
    <img src="./images/logo-espace-jardins.png" alt="Logo du site" class="mx-auto d-block log-logo">
  </div>
  <form class="container log-form" action="">
    <div class="form-floating mb-3">
      <input class="form-control" type="email" name="email" id="floatingInput" placeholder="Login" required>
      <label for="floatingInput">E-mail</label>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="password" name="password" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Mot de passe</label>
    </div>
    <div class="d-grid">
      <button class="btn bt-default-bis" type="submit">SE CONNECTER</button>
    </div>
  </form>
  <div class="mt-5">
    <p>Vous n'avez pas encore de compte ?</p>
    <a href="<?= $router->url('home') ?>" class="btn bt-default" type="button">CONTACTEZ-NOUS</a>
  </div>
</div>