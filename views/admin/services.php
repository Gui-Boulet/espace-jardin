<?php

use App\Authentification;
use App\Connection;
use App\Table\ServiceTable;

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('login'));
  exit();
}

require_once 'modals/serv-mod.php';

$cssFile = 'admin';
$jsFile = 'admin/services';

$pdo = Connection::getPDO();

// Liste des services - List of services
$services = (new ServiceTable($pdo))->findServices();
?>


<!-- Page services / Services page ------------------------------------------------------------------------------------>

<main class="admin">
  <div class="text-center pt-3" id="div-services">

    <div class="my-4">
      <h2>Services</h2>
    </div>

    <div class="row justify-content-center px-3">
      <div class="col-3 mb-2 cd-space">
        <div class="card shadow">
          <div class="card-body">
            <ul class="list-group list-group-flush">

              <?php foreach ($services as $service): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="#imageServiceModal" data-bs-toggle="modal"
                      data-service-name="<?= $service->getName() ?>"
                      data-service-fileName="<?= $service->getFileName() ?>">
                    <img class="img-thumbnail" src="./images/<?= $service->getFileName() ?>.jpg" width="55"
                      alt="<?= $service->getName() ?>">
                  </a>
                  <div>
                    <span><?= $service->getName() ?></span>
                    <br>
                    <input class="btn-check" type="radio" name="status-<?= $service->getFileName() ?>"
                      id="<?= $service->getFileName() ?>-active" <?= ($service->getStatus() === 1) ? 'checked' : '' ?>
                      disabled>
                    <label class="btn btn-outline-success fw-bold px-3 py-1 me-3 mt-1 bt-status"
                        for="<?= $service->getFileName() ?>-active">
                      ACTIF
                    </label>
                    <input class="btn-check" type="radio" name="status-<?= $service->getFileName() ?>"
                      id="<?= $service->getFileName() ?>-inactive" <?= ($service->getStatus() === 0) ? 'checked' : '' ?>
                      disabled>
                    <label class="btn btn-outline-danger fw-bold px-3 py-1 mt-1 bt-status"
                        for="<?= $service->getFileName() ?>-inactive">
                      INACTIF
                    </label>
                  </div>
                  <a href="#updateServiceModal" data-bs-toggle="modal" data-service-id="<?= $service->getId() ?>"
                      data-service-name="<?= $service->getName() ?>" data-service-status="<?= $service->getStatus() ?>">
                    <i class="bi bi-pencil-fill"></i>
                  </a>
                </li>
              <?php endforeach ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>