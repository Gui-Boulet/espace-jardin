<?php

use App\Authentification;
use App\Connection;
use App\Table\{CustomerTable, InterventionTable, MessageTable, ServiceTable};

Authentification::check();

$cssFile = $jsFile = 'admin';
$pdo = Connection::getPDO();

// Prochaines interventions prévues groupées par service et client ordonnées par semaine
// Next scheduled interventions grouped by service and client ordered by week
$nextInterventions = (new InterventionTable($pdo))->findNextInterventions();


// Dernières interventions effectuées groupées par service et client ordonnées par semaine
// Last interventions carried out grouped by service and customer ordered by week
$lastInterventions = (new InterventionTable($pdo))->findLastInterventions();

// Liste des clients ordonnés par nom de famille - List of customers ordered by last name
$customers = (new CustomerTable($pdo))->findCustomers();

// Liste des messages ordonnés du plus récent au plus ancien groupés par id et user_id
// List of messages ordered from newest to oldest grouped by id and user_id
$messages = (new MessageTable($pdo))->findMessages();

// Nombre de messages non lus - Number of unread messages
$nbUnreadMessages = (new MessageTable($pdo))->findNumberUnreadMessages();

// Liste des services - List of services
$services = (new ServiceTable($pdo))->findServices();
?>


<!-- Page clients / Customers page ------------------------------------------------------------------------------------>

<main class="admin">

  <div class="text-center pt-5" id="div-clients">

    <div class="my-2">
      <h2>Clients</h2>
    </div>

    <div class="row justify-content-center my-5 px-5">
      <form class="d-flex align-content-center justify-content-center flex-wrap" role="search">
        <input class="form-control me-md-2 my-2 inp-search" type="search" placeholder="Filtre AJAX sinon t'es viré"
          aria-label="Search">
        <button class="btn my-2 bt-default-bis" type="submit">
          Rechercher
        </button>
      </form>
    </div>

    <div class="row justify-content-center row-cols-1 row-cols-sm-4 g-5 px-5">

      <?php foreach ($customers as $customer): ?>
        <div class="col-3 cd-space">
          <div class="card shadow">

            <div class="card-header d-flex justify-content-between align-items-center">
              <div class="mt-2 me-4">
                <button class="btn position-relative bt-initials" type="button" data-bs-toggle="collapse"
                    data-bs-target="#<?= $customer->getInitials() . $customer->getUserId() ?>" aria-expanded="false">
                  <?= $customer->getInitials() ?>
                  <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">
                    <?php
                      foreach ($nbUnreadMessages as $nbUnreadMessage) {
                        if ($customer->getUserId() === $nbUnreadMessage->getUserId()) {
                          echo $nbUnreadMessage->getNbUnreadComment();
                        }
                      }
                    ?>
                    <span class="visually-hidden"></span>
                  </span>
                </button>
              </div>

              <div class="flex-grow-1 pt-1">
                <a class="fs-5 a-name" id="clientName" data-bs-toggle="modal" href="#customerModal"
                    data-customer-id="<?= $customer->getUserId() ?>">

                    <?php
                      $datasCustomer[] = [
                        "id" => $customer->getUserId(),
                        "name" => $customer->getFirstName() . ' ' . $customer->getLastName(),
                        "email" => $customer->getEmail(),
                        "phone" => $customer->getPhone(),
                        "streetNumber" => $customer->getStreetNumber(),
                        "street" => $customer->getStreet(),
                        "zipCode" => $customer->getZipCode(),
                        "city" => $customer->getCity(),
                        "country" => $customer->getCountry(),
                        "gardenSize" => $customer->getGardenSize(),
                        "hedgeLength" => $customer->getHedgeLength(),
                        "fruitTree" => $customer->getFruitTree(),
                        "shrub" => $customer->getShrub(),
                        "smallTree" => $customer->getSmallTree(),
                        "bigTree" => $customer->getBigTree(),
                        "note" => $customer->getNote()
                      ];
                      $json_datasCustomer = json_encode($datasCustomer);
                    ?>
                  
                  <?= $customer->getFirstName() . ' ' . $customer->getLastName() ?>
                </a>
              </div>
            </div>

            <div class="card-body">
              <div class="collapse" id="<?= $customer->getInitials() . $customer->getUserId() ?>">
                <p>
                  <?= $customer->getPhone() ?>
                </p>
                <p>
                  <span>
                    <?= $customer->getStreetNumber() ?>
                  </span>
                  <span>
                    <?= $customer->getStreet() ?>
                  </span><br>
                  <span>
                    <?= $customer->getZipCode() ?>
                  </span>
                  <span>
                    <?= $customer->getCity() ?>
                  </span><br>
                  <span>
                    <?= $customer->getCountry() ?>
                  </span>
                </p>
                <h5>Messages</h5>
                <div class="card card-body mx-auto clp-customer">

                  <?php foreach ($messages as $message):
                    if ($customer->getUserId() === $message->getUserId()):
                  ?>
                    <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover
                      fw-bold lnk-message" href="#messageModal" data-bs-toggle="modal"
                        data-customer-name="<?= $customer->getFirstName() . ' ' . $customer->getLastName() ?>"
                        data-message-date="<?= $message->getDateComment() ?>"
                        data-message-comment="<?= $message->getComment() ?>"
                        date-message-seen="<?= $message-> getSeen() ?>">
                      <?= $message->getDateComment() ?>
                    </a>
                  <?php endif; endforeach ?>

                </div>

                <h5 class="mt-2">Interventions</h5>
                <div class="card card-body mx-auto clp-customer">
                  
                  <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover
                      fw-bold lnk-message" data-bs-toggle="collapse" role="button" aria-expanded="false"
                      href="#nextCollapse<?= $customer->getInitials() . $customer->getUserId() ?>">
                    Prochaines
                  </a>
                  <ul class="list-group list-group-flush collapse"
                      id="nextCollapse<?= $customer->getInitials() . $customer->getUserId() ?>">
                    <?php
                      foreach ($nextInterventions as $nextIntervention): 
                        if ($customer->getUserId() === $nextIntervention->getCustomerId()):
                          foreach ($services as $service):
                            if ($service->getId() === $nextIntervention->getServiceId()):
                    ?>
                      <li class="list-group-item">
                        <div>
                          <span class="fw-bold">
                            <?= $service->getName() ?>
                          </span>
                          <br>
                          <span>
                            <?php
                              $weekNumber = $nextIntervention->getWeekYear()[1];
                              if (strlen(strval($weekNumber)) < 2){
                                $weekNumber = 0 . $weekNumber;
                              }
                            ?>
                            Semaine <?= $weekNumber ?> - <?= $nextIntervention->getWeekYear()[0] ?>
                          </span>
                          <br>
                          <span>
                            <?php
                              $firstDay = date('d/m', strtotime(
                                $nextIntervention->getWeekYear()[0] . 'W' . $weekNumber . '1'));
                              $lastDay = date('d/m', strtotime(
                                $nextIntervention->getWeekYear()[0] . 'W' . $weekNumber . '7'));
                            ?>
                            (<?= $firstDay . ' - ' . $lastDay ?>)
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

                  <a class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover
                      fw-bold mt-1 lnk-message" data-bs-toggle="collapse" role="button" aria-expanded="false"
                      href="#lastCollapse<?= $customer->getInitials() . $customer->getUserId() ?>">
                    Passées
                  </a>
                  <ul class="list-group list-group-flush collapse"
                      id="lastCollapse<?= $customer->getInitials() . $customer->getUserId() ?>">
                    <?php
                      foreach ($lastInterventions as $lastIntervention): 
                        if ($customer->getUserId() === $lastIntervention->getCustomerId()):
                          foreach ($services as $service):
                            if ($service->getId() === $lastIntervention->getServiceId()):
                    ?>
                      <li class="list-group-item">
                        <div>
                          <span class="fw-bold">
                            <?= $service->getName() ?>
                          </span>
                          <br>
                          <span>
                            <?php
                              $weekNumber = $lastIntervention->getWeekYear()[1];
                              if (strlen(strval($weekNumber)) < 2){
                                $weekNumber = 0 . $weekNumber;
                              }
                            ?>
                            Semaine <?= $weekNumber ?> - <?= $lastIntervention->getWeekYear()[0] ?>
                          </span>
                          <br>
                          <span>
                            <?php
                              $firstDay = date('d/m', strtotime(
                                $lastIntervention->getWeekYear()[0] . 'W' . $weekNumber . '1'));
                              $lastDay = date('d/m', strtotime(
                                $lastIntervention->getWeekYear()[0] . 'W' . $weekNumber . '7'));
                            ?>
                            (<?= $firstDay . ' - ' . $lastDay ?>)
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
      <?php endforeach; ?>

    </div>
  </div>
  <?php require 'modals/cust-mod.php'; ?>

</main>

<script type="text/javascript">let datasCustomer = <?= $json_datasCustomer ?></script>