<?php

use App\Authentification;

if (session_status() === PHP_SESSION_NONE) {
  session_start();
  if (empty($_SESSION)) {
    $connection = ['url' => 'login', 'button' => 'SE CONNECTER'];
  } else {
    $connection = ['url' => 'logout', 'button' => 'DÉCONNEXION'];
  }
}
?>

<nav class="navbar sticky-top navbar-expand-md">
  <div class="container-fluid">
    <a class="navbar-brand ms-2"  href="<?= $router->url('home') ?>">
      <img src="./images/logo-espace-jardins.png" alt="logo" width="80">
    </a>
    <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
        aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-md-0 mt-4 ms-2" id="navbarToggler">
      <ul class="nav ms-auto me-2 list-group list-group-horizontal-md">
        
        <?php
          if (!empty($_SESSION)):
            if (Authentification::check('admin')):
        ?>

          <li class="nav-item my-md-auto me-2 mb-2">
            <a class="nav-link bt-nav" href="" role="button">
              <i class="bi bi-envelope fs-3"></i>
            </a>
          </li>
          <li class="nav-item my-md-auto me-2 mb-2">
            <a class="nav-link bt-nav" href="<?= $router->url('admin_interventions') ?>" role="button">
              INTERVENTIONS
            </a>
          </li>
          <li class="nav-item my-md-auto me-2 mb-2">
            <a class="nav-link bt-nav" href="<?= $router->url('admin_customers') ?>" role="button">
              CLIENTS
            </a>
          </li>
          <li class="nav-item my-md-auto me-2 mb-3">
            <a class="nav-link bt-nav" href="<?= $router->url('admin_services') ?>" role="button">
              SERVICES
            </a>
          </li>

        <?php elseif (Authentification::check('user')): ?>

          <li class="nav-item my-md-auto me-2 mb-3">
            <a class="nav-link bt-nav" href="<?= $router->url('account') ?>" role="button">
              MON COMPTE
            </a>
          </li>
        
        <?php endif; endif ?>

          <li class="nav-item my-md-auto mx-md-0 mx-3 mb-2">
            <form action="<?= $router->url($connection['url']) ?>" method="post">
              <button class="btn nav-link bt-default" type="submit">
                <?= $connection['button'] ?>
              </button>
            </form>
          </li>
                
      </ul>
    </div>
  </div>
</nav>