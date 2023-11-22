<?php

use App\HTML\Form;

$jsFile = 'login';
$form = new Form();
?>

<!-- Login form ------------------------------------------------------------------------------------------------------->

<div class="container text-center log">
  <div class="container mb-2 pt-5">
    <a href="<?= $router->url('home') ?>">
      <img class="mx-auto d-block log-logo" src="./images/logo-espace-jardins.png" alt="Logo du site">
    </a>
  </div>
  <form class="container log-form" action="">
    <?= $form->createInput('email', 'email', 'user', 'Email', 'mb-3') ?>
    <?= $form->createInput('password', 'password', 'user', 'Mot de passe', 'mb-3') ?>
    <div class="d-grid">
      <button class="btn bt-default-bis" type="submit">SE CONNECTER</button>
    </div>
  </form>
  <div class="mt-5">
    <p>Vous n'avez pas encore de compte ?</p>
    <a href="<?= $router->url('home') ?>" class="btn bt-default" type="button">CONTACTEZ-NOUS</a>
  </div>
</div>