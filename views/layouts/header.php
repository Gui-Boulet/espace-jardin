<?php switch ($header): case 'admin': ?>

<!-- Barre de navigation admin / Admin navigation bar ----------------------------------------------------------------->

<nav class="navbar sticky-top navbar-expand-md">
  <div class="container-fluid">
    <a class="navbar-brand ms-2" href="#">
      <img src="./images/logo-espace-jardins.png" alt="logo" width="80">
    </a>
    <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
        aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-md-0 mt-4 ms-2" id="navbarToggler">
      <ul class="nav ms-auto me-2 list-group list-group-horizontal-md">

        <li class="nav-item mb-md-0 me-3 mb-3">
          <a class="nav-link py-md-3 bt-nav" href="" role="button">
            <i class="bi bi-envelope fs-3"></i>
          </a>
        </li>
        <li class="nav-item mt-md-2 me-3 mb-3">
          <a class="nav-link py-md-3 bt-nav" href="<?= $router->url('admin_interventions') ?>" role="button">
            INTERVENTIONS
          </a>
        </li>
        <li class="nav-item mt-md-2 me-3 mb-3">
          <a class="nav-link py-md-3 bt-nav" href="<?= $router->url('admin_customers') ?>" role="button">
            CLIENTS
          </a>
        </li>
        <li class="nav-item mt-md-2 mb-3">
          <a class="nav-link py-md-3 bt-nav" href="<?= $router->url('admin_services') ?>" role="button">
            SERVICES
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<?php
    break;
  case 'user':
?>

<!-- Barre de navigation utilisateur / User navigation bar ------------------------------------------------------------>

<nav class="navbar sticky-top navbar-expand-md">
  <div class="container-fluid">
    <a class="navbar-brand ms-2 ms-sm-4" href="#">
      <img src="./images/logo-espace-jardins.png" alt="logo" width="80">
    </a>
    <div class="">
      <a class="btn nav-link px-3 py-2 me-2 me-sm-4 bt-default" href="<?= $router->url('login') ?>" role="button">
        <?= $connection ?? 'SE CONNECTER' ?>
      </a>
    </div>
  </div>
</nav>

<?php 
    break;
  endswitch;
?>