<?php

require_once 'modals/serv-mod.php';

use App\Authentification;
use App\Connection;
use App\Table\ServiceTable;

Authentification::check();

$cssFile = $jsFile = 'admin';
$pdo = Connection::getPDO();

// Liste des services - List of services
$services = (new ServiceTable($pdo))->findServices();
?>


<!-- Page services / Services page ------------------------------------------------------------------------------------>

<main class="admin">
  <div class="text-center pt-5" id="div-services">

    <div class="my-2">
      <h2>Services</h2>
    </div>

    <div class="row justify-content-center px-5">
      <div class="col-3 cd-space">
        <div class="card shadow">
          <div class="card-body">
            <ul class="list-group list-group-flush">

              <?php foreach($services as $service): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="#imageModal" data-bs-toggle="modal"
                      data-service-name="<?= $service->getName() ?>"
                      data-service-fileName="<?= $service->getFileName() ?>">
                    <img class="" src="./images/<?= $service->getFileName() ?>.jpg" width="50px"
                      alt="<?= $service->getName() ?>">
                  </a>
                  <span class="mx-2"><?= $service->getName() ?></span>
                  <button class="btn-close" type="submit" aria-label="Delete" data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    data-service-name="<?= $service->getName() ?>" data-service-id="<?= $service->getId() ?>">
                  </button>
                </li>
              <?php endforeach ?>

            </ul>
          </div>
          <div class="card-footer d-flex justify-content-center">
            <button type="button" class="btn px-5 py-2 bt-default-bis" data-bs-toggle="modal"
              data-bs-target="#createServiceModal">
              Créer un service
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>