<?php
require 'modal/registration-mod.php';

use App\Connection;
use App\Table\ServiceTable;

$pdo = Connection::getPDO();

$services = (new ServiceTable($pdo))->findServices();
?>

<!-- Header ----------------------------------------------------------------------------------------------------------->

<header class="p-5 text-center position-relative bg-image header">
  <div>
    <h1 class="fw-bold mb-5">Espace Jardins</h1>
    <h4 class="my-3">
      Nous vous proposons différents services d'entretien.
    </h4>
    <br>
    <p class="fst-italic">
      Remplissez le formulaire via ce bouton.<br>
      Nous prendrons contact avec vous pour définir un rendez-vous à votre domicile.<br>
      Nous déterminerons ensemble les services qui vous conviennent en fonction des paramètres de votre jardin.
    </p>
    <button class="btn bt-default position-absolute bottom-25 translate-middle-x mt-5" type="button"
        data-bs-toggle="modal" data-bs-target="#registrationModal">
      CONTACTEZ-NOUS
    </button>
  </div>
</header>


<!-- Services --------------------------------------------------------------------------------------------------------->

<main class="container-fluid text-center px-3 px-lg-5 py-1">
  <h2 class="py-3">Services</h2>
  <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 gx-sm-5">

    <!-- Affichage des nom et image des services / Displaying the name and image of services -->
    <?php foreach($services as $service): ?>
      <div class="col cd-service">
        <figure class="figure">
          <img class="figure-img img-fluid rounded shadow" src="./images/<?= $service->getFileName() ?>.jpg"
              alt="<?= $service->getName() ?>">
          <figcaption class="figure-caption fs-6">
            <?= $service->getName() ?>
          </figcaption>
        </figure>
      </div>
    <?php endforeach ?>

  </div>
</main>