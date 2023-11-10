<?php

use App\Authentification;
use App\Connection;
use App\Method;
use App\Table\InterventionTable;

Authentification::check();

$cssFile = $jsFile = 'admin';
$link = $router->url('admin_interventions');

$pdo = Connection::getPDO();

// Liste des interventions ordonnées par semaine - List of interventions ordered by week
$interventions = (new InterventionTable($pdo))->findInterventions();
?>

<!-- Page interventions / Interventions page -------------------------------------------------------------------------->

<main class="admin">
  <div class="text-center pt-5" id="div-interventions">

    <div class="my-2">
      <h2>Interventions planifiées</h2>
    </div>
    
    <?php for ($i = 0; $i <= 52; $i++):
      $week = Method::displayWeekYear($i)['week'];
      $year = Method::displayWeekYear($i)['year'];
    ?>
      <div class="my-5">
        <div class="my-2 pb-2">
          <h4>
            <?= 'Semaine ' . $week . ' - ' . $year ?>
          </h4>
          <p>
            <?= 'Du ' . Method::displayDaysOfWeek($i)['firstDay'] . ' au ' . Method::displayDaysOfWeek($i)['lastDay'] ?>
          </p>
        </div>

        <div class="row justify-content-center row-cols-1 row-cols-sm-4 g-5 px-5">

          <?php for ($j = 0; $j < count($interventions['inter']); $j++):
            if ($interventions['inter'][$j]->getWeekYear()[1] == $week &&
              $interventions['inter'][$j]->getWeekYear()[0] == $year):
          ?>
            <div class="col-3 cd-space">
              <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="me-3">
                    <button class="btn position-relative fw-bold bt-initials">
                      <?= $interventions['cust'][$j]->getInitials() ?>
                    </button>
                  </div>
                  <div class="flex-grow-1 pt-1">
                    <h5><?= $interventions['serv'][$j]->getName() ?></h5>
                  </div>
                </div>
                <div class="card-body">
                  <p>
                    <?= $interventions['cust'][$j]->getFirstName() . ' ' . $interventions['cust'][$j]->getLastName() ?>
                  </p>
                  <p>
                    <?= $interventions['cust'][$j]->getPhone() ?>
                  </p>
                  <p>
                    <span>
                      <?= $interventions['cust'][$j]->getStreetNumber() ?>
                    </span>
                    <span>
                      <?= $interventions['cust'][$j]->getStreet() ?>
                    </span><br>
                    <span>
                      <?= $interventions['cust'][$j]->getZipCode() ?>
                    </span>
                    <span>
                      <?= $interventions['cust'][$j]->getCity() ?>
                    </span><br>
                    <span>
                      <?= $interventions['cust'][$j]->getCountry() ?>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          <?php endif; endfor; ?>

        </div>
      </div>
      <hr>
    <?php endfor; ?>

  </div>
</main>