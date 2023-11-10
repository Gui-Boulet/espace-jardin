<?php

use App\Connection;
use App\Table\ServiceTable;

$pdo = Connection::getPDO();

$services = (new ServiceTable($pdo))->findServices();
?>

<!-- Header ----------------------------------------------------------------------------------------------------------->

<header class="p-5 text-center bg-image header">
  <div>
    <h1 class="mb-3">Espace Jardins</h1>
    <h4>Présentation de l'entreprise</h4>
    <button type="button" class="btn bt-default" data-bs-toggle="modal" data-bs-target="#registrationModal">
      CONTACTEZ-NOUS
    </button>
  </div>
</header>


<?php require 'modals/registration-mod.php'; ?>


<!-- Services --------------------------------------------------------------------------------------------------------->

<main class="container-fluid text-center px-3 px-lg-5 py-5">
  <h2 class="py-3">Services</h2>
  <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 gx-sm-5 pb-5">

    <!-- Affichage des nom et image des services / Displaying the name and image of services -->
    <?php foreach($services as $service): ?>
      <div class="col cd-service">
        <div class="card">
          <img class="card-img-top" src="./images/<?= $service->getFileName() ?>.jpg" alt="<?= $service->getName() ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $service->getName() ?></h5>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</main>