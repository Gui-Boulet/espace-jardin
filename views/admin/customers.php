<?php

use App\Authentification;
use App\Connection;
use App\Method;
use App\Table\{CustomerTable, InterventionTable, MessageTable, ServiceTable};

if (!Authentification::check('admin')) {
  header('Location: ' . $router->url('login'));
  exit();
}

$cssFile = 'admin';
$jsFile = 'admin/customers';

$pdo = Connection::getPDO();

require 'modals/cust-mod.php';

// Prochaines interventions prévues groupées par service et client ordonnées par semaine
// Next scheduled interventions grouped by service and client ordered by week
$nextInterventions = (new InterventionTable($pdo))->findNextInterventions();

// Dernières interventions effectuées groupées par service et client ordonnées par semaine
// Last interventions carried out grouped by service and customer ordered by week
$lastInterventions = (new InterventionTable($pdo))->findLastInterventions();

// Liste des clients ordonnés par nom de famille - List of customers ordered by last name
$customers = (new CustomerTable($pdo))->findCustomers();

// Liste des messages - List of messages
$messages = (new MessageTable($pdo))->findMessages();

$serviceTable = new ServiceTable($pdo);
// Liste des services - List of services
$services = $serviceTable->findServices();

// Liste des services actifs par ordre alphabétique - List of active services in alphabetical order
$servicesActive = $serviceTable->findActiveServices();

?>


<!-- Page clients / Customers page -->

<main class="admin">

  <div class="pt-3" id="div-clients">

    <div class="text-center my-4">
      <h2>Clients</h2>
    </div>

    <div class="row justify-content-center row-cols-1 row-cols-sm-4 g-5 px-5">

      <?php foreach ($customers as $customer):

        if (isset($_SESSION['id'], $_SESSION['success']) && $_SESSION['id'] === $customer->getUserId()) {
          if ($_SESSION['success'] === 1) {
            $success = $_SESSION['success'];
          } elseif ($_SESSION['success'] === 2) {
            $success = $_SESSION['success'];
          } 
        } else {
          $success = 0;
        }

        $datasCustomers[] = [
          "id" => $customer->getUserId(),
          "name" => $customer->getFirstName() . ' ' . $customer->getLastName(),
          "gardenSize" => $customer->getGardenSize(),
          "hedgeLength" => $customer->getHedgeLength(),
          "fruitTree" => $customer->getFruitTree(),
          "shrub" => $customer->getShrub(),
          "smallTree" => $customer->getSmallTree(),
          "bigTree" => $customer->getBigTree(),
          "note" => $customer->getNote()
        ];
        $json_datasCustomer = json_encode($datasCustomers);
        $idCustomer = crc32($customer->getUserId());
      ?>

        <div class="col-3 cd-space">
          <div class="card shadow">

            <div class="card-header d-flex justify-content-between align-items-center cd-title">
              <h5 class="my-auto" id="clientName">
                <?= $customer->getFirstName() . ' ' . $customer->getLastName() ?>
              </h5>
              <div>
                <!-- Si modification réussie, affichage d'un icône de validation pendant 5 sec -->
                <!-- If the change is successful, a commit icon will be displayed for 5 seconds -->
                <?php if ((isset($_SESSION['id'])) && $_SESSION['id'] === $customer->getUserId()): ?>
                  <span class="float-start text-success fs-5 me-3 d-block" id="checkIcon">
                    <i class="bi bi-check-circle-fill"></i>
                  </span>
                <?php endif ?>


                <?php foreach ($messages as $message):
                  if ($customer->getUserId() === $message->getUserId()):
                ?>
                  <a class="fs-5 me-2" data-bs-toggle="modal" href="#messageModal"
                      data-customer-name="<?= $customer->getFirstName() . ' ' . $customer->getLastName() ?>"
                      data-message-date="<?= $message->getDateComment() ?>"
                      data-message-comment="<?= $message->getComment() ?>">
                <?php endif; endforeach ?>
                    <i class="bi bi-envelope"></i>
                  </a>
                

                <a class="fs-5"  data-bs-toggle="modal" href="#customerModal"
                    data-customer-id="<?= $customer->getUserId() ?>" >
                  <i class="bi bi-tree"></i>
                </a>
              </div>
            </div>

            <div class="card-body">

              <ul class="nav nav-pills nav-justified mb-3 nv-pill" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="pill" type="button" role="tab"
                      data-bs-target="#addInter<?= $idCustomer ?>">
                    <i class="bi bi-plus-square fs-5 text-success"></i>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link <?= ($success === 1) ? 'active' : '' ?>" data-bs-toggle="pill" type="button"
                      role="tab" data-bs-target="#interventions<?= $idCustomer ?>">
                    <i class="bi bi-gear fs-5 text-success"></i>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link <?= ($success === 0) ? 'active' : '' ?>" data-bs-toggle="pill" type="button"
                      role="tab" data-bs-target="#profile<?= $idCustomer ?>">
                    <i class="bi bi-person-bounding-box fs-5 text-success"></i>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link <?= ($success === 2) ? 'active' : '' ?>" data-bs-toggle="pill" type="button"
                      role="tab" data-bs-target="#garden<?= $idCustomer ?>">
                    <i class="bi bi-tree-fill fs-5 text-success"></i>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="pill" data-bs-target="#history<?= $idCustomer ?>"
                      type="button" role="tab">
                    <i class="bi bi-clock-history fs-5 text-success"></i>
                  </button>
                </li>
              </ul>

              <div class="tab-content">

                <!-- Création interventions --------------------------------------------------------------------------->

                <div class="tab-pane fade text-center" id="addInter<?= $idCustomer ?>" role="tabpanel">
                  <form action="<?= $router->url('admin_actions_create') ?>" method="post">
                    <div class="form-floating">
                      <select name="service_id" class="form-select mb-3" id="nameService">
                        <?php foreach ($servicesActive as $serviceActive): ?>
                          <option value="<?= $serviceActive->getId() ?>"><?= $serviceActive->getName() ?></option>
                        <?php endforeach ?>
                      </select>
                      <label for="nameService">Sélectionner un service</label>
                    </div>
                    <?= $form->createInput('week', 'week', 'interventions', 'Sélectionner une période','mb-3') ?>
                    <div>
                      <input type="hidden" name="customer_id" value="<?= $customer->getUserId() ?>">
                    </div>
                    <button class="btn px-5 py-2 bt-default-bis" type="submit">
                      Ajouter
                    </button>
                  </form>
                </div>

                <!-- Futures interventions ---------------------------------------------------------------------------->

                <div class="tab-pane fade <?= ($success === 1) ? 'show active' : '' ?>" role="tabpanel"
                    id="interventions<?= $idCustomer ?>">
                  <ul class="list-group list-group-flush">
                    <?php
                      foreach ($nextInterventions as $nextIntervention): 
                        if ($customer->getUserId() === $nextIntervention->getCustomerId()):
                          foreach ($services as $service):
                            if ($service->getId() === $nextIntervention->getServiceId()):
                    ?>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                          <span class="fw-bold">
                            <?= $service->getName() ?>
                          </span>
                          <br>
                          <span>
                            <?= Method::displayDateFormat($nextIntervention->getWeekYear()) ?>
                          <span>
                        </div>
                        <div>

                          <a class="me-2" href="">
                            <i class="bi bi-pencil-fill"></i>
                          </a>

                          <a class="" href="#deleteModal" data-bs-toggle="modal"
                              data-intervention-id="<?= $nextIntervention->getId() ?>"
                              data-service-name="<?= $service->getName() ?>"
                              data-intervention-week="<?= Method::displayDateFormat($nextIntervention->getWeekYear()) ?>"
                              data-customer-id="<?= $customer->getUserId() ?>">
                            <i class="bi bi-trash3"></i>
                          </a>

                        </div>
                      </li>
                    <?php
                            endif;
                          endforeach;
                        endif;
                      endforeach;
                    ?>
                  </ul>
                </div>

                <!-- Données du profile du client --------------------------------------------------------------------->

                <div class="tab-pane fade <?= ($success === 0) ? 'show active' : '' ?>" id="profile<?= $idCustomer ?>"
                    role="tabpanel">
                  <p><?= $customer->getEmail() ?></p>
                  <p><?= $customer->getPhone() ?></p>
                  <p>
                    <span><?= $customer->getStreetNumber() ?></span>
                    <span><?= $customer->getStreet() ?></span><br>
                    <span><?= $customer->getZipCode() ?></span>
                    <span><?= $customer->getCity() ?></span><br>
                    <span><?= $customer->getCountry() ?></span>
                  </p>
                </div>

                <!-- Données du jardin du client ---------------------------------------------------------------------->

                <div class="tab-pane fade <?= ($success === 2) ? 'show active' : '' ?>" id="garden<?= $idCustomer ?>"
                    role="tabpanel">
                  
                  <span class="fw-bold">Surface</span>
                  <span class="float-end"><?= $customer->getGardenSize() ?> m²</span><hr>
                  <span class="fw-bold">Haies</span>
                  <span class="float-end"><?= $customer->getHedgeLength() ?> m</span><hr>
                  <span class="fw-bold">Arbres fruitiers</span>
                  <span class="float-end"><?= $customer->getFruitTree() ?></span><hr>
                  <span class="fw-bold">Arbustes</span>
                  <span class="float-end"><?= $customer->getShrub() ?></span><hr>
                  <span class="fw-bold">Petits arbres</span>
                  <span class="float-end"><?= $customer->getSmallTree() ?></span><hr>
                  <span class="fw-bold">Grands arbres</span>
                  <span class="float-end"><?= $customer->getBigTree() ?></span><hr>
                  <span class="fw-bold">Note</span><br>
                  <span><?= $customer->getNote() ?></span>

                </div>

                <!-- Historique des interventions --------------------------------------------------------------------->

                <div class="tab-pane fade" id="history<?= $idCustomer ?>" role="tabpanel">
                  <ul class="list-group list-group-flush">
                    <?php
                      foreach ($lastInterventions as $lastIntervention): 
                        if ($customer->getUserId() === $lastIntervention->getCustomerId()):
                          foreach ($services as $service):
                            if ($service->getId() === $lastIntervention->getServiceId()):
                    ?>
                      <li class="list-group-item">
                        <div>
                          <span class="text-secondary text-opacity-75 fw-bold">
                            <?= $service->getName() ?>
                          </span>
                          <br>
                          <span class="text-secondary text-opacity-75">
                            <?= Method::displayDateFormat($lastIntervention->getWeekYear()) ?>
                          <span>
                        </div>
                      </li>
                    <?php
                            endif;
                          endforeach;
                        endif;
                      endforeach;
                    ?>
                  </ul>
                </div>

              </div>

            </div>

          </div>
        </div>
      <?php endforeach ?>
      <?php unset($_SESSION['id'], $_SESSION['success']) ?>

    </div>
  </div>

</main>

<script type="text/javascript">let datasCustomer = <?= $json_datasCustomer ?></script>