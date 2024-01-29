<?php

use App\Authentification;
use App\Connection;
use App\HTML\Form;
use App\Table\UserTable;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
  if (isset($_SESSION['auth']) && isset($_SESSION['role'])) {
    if (Authentification::check('user')) {
      header("Location: {$router->url('account')}");
      exit();
    } elseif (Authentification::check('admin')) {
      header("Location: {$router->url('admin_interventions')}");
      exit();
    }  
  }
}

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


$jsFile = 'login';
$form = new Form();

if (!empty($_POST)) {

  if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    header("Location: {$router->url('login')}");
    exit();
  }

  $pdo = Connection::getPDO();

  $userTable = new UserTable($pdo);

  $userCalled = $userTable->findUserByEmail($_POST['email']);
  
  if ($userCalled === false) {

    $error = 'Identifiant ou mot de passe incorrect';

  } else {

    $result = password_verify($_POST['password'], $userCalled->getPassword());
    
    if ($result === false) {

      $error = 'Identifiant ou mot de passe incorrect';

    } else {

      if ($userCalled->getRole() == 'user') {

        $_SESSION = [
          'auth' => $userCalled->getId(),
          'role' => $userCalled->getRole()
        ];
        header('Location: ' . $router->url('account'));
        exit();

      } elseif ($userCalled->getRole() == 'admin') {

        $_SESSION = [
          'auth' => $userCalled->getId(),
          'role' => $userCalled->getRole()
        ];
        header('Location: ' . $router->url('admin_interventions'));
        exit();
      }
    }
  }
}
?>

<!-- Login form ------------------------------------------------------------------------------------------------------->

<div class="container text-center log">

  <div class="container mb-2 pt-5">
    <a href="<?= $router->url('home') ?>">
      <img class="mx-auto d-block log-logo" src="./images/logo-espace-jardins.png" alt="Logo du site">
    </a>
  </div>

  <form class="container log-form" action="<?= $router->url('login') ?>" method="post" id="loginForm">

    <?= $form->createInput('email', 'email', 'user', 'Email', 'mb-3') ?>

    <?= $form->createInput('password', 'password', 'user', 'Mot de passe', 'mb-3') ?>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <div class="d-grid">
      <button class="btn bt-default-bis" id="user-submit" type="button">SE CONNECTER</button>
    </div>
    
  </form>

  <?php if (isset($error)): ?>
    <small class='text-danger'><?= $error ?></small>
  <?php endif ?>

  <?php if (isset($_GET['security'])): ?>
    <small class="text-danger">Veuillez-vous connecter pour accéder à cette page !</small>
  <?php endif ?>

  <div class="mt-5">
    <p>Vous n'avez pas encore de compte ?</p>
    <a href="<?= $router->url('home') ?>" class="btn bt-default" type="button">CONTACTEZ-NOUS</a>
  </div>

</div>