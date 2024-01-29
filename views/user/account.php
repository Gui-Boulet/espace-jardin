<?php

use App\Authentification;
use App\Connection;
use App\HTML\Form;
use App\Method;
use App\Table\CustomerTable;
use App\Table\InterventionTable;
use App\Table\ServiceTable;

if (!Authentification::check('user')) {
  header('Location: ' . $router->url('login'));
  exit();
}

$form = new Form();
$jsFile = 'user/account';

$pdo = Connection::getPDO();

// Données du clients - Customer's datas
$customer = (new CustomerTable($pdo))->findCustomer($_SESSION['auth']);

// Liste des services - List of services
$services = (new ServiceTable($pdo))->findServices();

// Liste des prochaines interventions du client - List of the client's next interventions
$futureInterventions = (new InterventionTable($pdo))->findNextInterventionsByCustomer($_SESSION['auth']);

require_once 'offcanvas/profile.php';
require_once 'modal/create.php';
require_once 'modal/update.php';
require_once 'modal/delete.php';
?>

<!-- Account Section -->

<!-- Account icon top page -------------------------------------------------------------------------------------------->

<div class="container d-flex justify-content-end mb-2">
  <div class="d-flex justify-content-center align-items-center user-space-div" id="user-space-icon-div">
    <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasUser" role="button" aria-controls="offcanvasUser">
      <i class="bi bi-person-fill user-space"></i>
    </a>
  </div>
</div>

<div class="container-fluid account">
  <div class="row justify-content-center">

    <!-- Interventions prévues ---------------------------------------------------------------------------------------->

    <div class="col-5 px-3 py-3 mb-4 mx-3 rounded-3 shadow acc-column" id="interventionsDiv">
      
      <h2 class="mb-4 text-center">
        <span class="border-bottom border-success">Interventions</span>
      </h2>

      <?php
      foreach ($services as $service):
        if (($customer->getHedgeLength() > 0 && $service->getName() === 'Taille haies') ||
            ($customer->getFruitTree() > 0 && $service->getName() === 'Taille arbres fruitiers') ||
            ($customer->getShrub() > 0 && $service->getName() === 'Taille arbustes') ||
            ($customer->getSmallTree() > 0 && $service->getName() === 'Elagage petits arbres') ||
            ($customer->getBigTree() > 0 && $service->getName() === 'Elagage grands arbres') ||
            ($service->getName() === 'Tonte pelouse')) {
          foreach ($futureInterventions as $intervention) {
            if ($service->getId() === $intervention->getServiceId()) {
              $dateIntervention = Method::displayDateFormat($intervention->getWeekYear());
              break;
            } elseif ($service->getStatus() === 1) {
              $dateIntervention = '-';
            }
          }
          $serviceName = $service->getName();
          $serviceFileName = $service->getFileName();
        }

        if (isset($dateIntervention)):
      ?>
      
        <div class="d-flex justify-content-between align-items-center rounded-3 shadow p-2 mb-3 active-service"
            id="<?= $serviceFileName ?>">
          <div class="ps-2">
            <span class="fs-5"><?= $serviceName ?></span>
            <br>
            <small><?= $dateIntervention ?></small>
          </div>

          <div>
            <button class="btn btn-light mx-1 d-inline" data-bs-target="#createModal" data-bs-toggle="modal"
                type="button" data-service-name="<?= $serviceName ?>"
                data-service-filename="<?= $serviceFileName ?>"
                data-frequency="<?= Method::displayFrequency($serviceName) ?>">
              <i class="bi bi-plus-circle"></i>
            </button>

            <button class="btn btn-light mx-1 d-inline" data-bs-target="#updateModal" data-bs-toggle="modal"
                type="button" data-service-name="<?= $serviceName ?>"
                data-service-filename="<?= $serviceFileName ?>"
                data-frequency="<?= Method::displayFrequency($serviceName) ?>">
              <i class="bi bi-pencil-fill"></i>
            </button>
            
            <button class="btn btn-light mx-1 d-inline" data-bs-target="#deleteModal" data-bs-toggle="modal"
                type="button" data-service-name="<?= $serviceName ?>"
                data-service-filename="<?= $serviceFileName ?>"
                data-frequency="<?= Method::displayFrequency($serviceName) ?>">
              <i class="bi bi-trash3-fill"></i>
            </button>
          </div>
        </div>

      <?php endif; endforeach ?>

    </div>
  </div>
</div>