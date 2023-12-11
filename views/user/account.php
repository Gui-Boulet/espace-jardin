<?php
require_once 'modal/add-serv-mod.php';

use App\Authentification;
use App\Connection;
use App\HTML\Form;

if (!Authentification::check('user')) {
  header('Location: ' . $router->url('home'));
  exit();
}

$jsFile = 'user';
$form = new Form();
$pdo = Connection::getPDO();
?>

<!-- Account Section -------------------------------------------------------------------------------------------------->

<div class="container-fluid account">
  <div class="row justify-content-evenly text-center">
    <div class="col-5 p-5 my-5 mx-3 rounded-3 shadow acc-column">
      <h2 class="fs-1 mb-5">Votre compte</h2>
      <h5 class="mb-3">Coordonnées</h5>
      <p>DUPONT Jean</p>
      <p>jean.dupont@exemple.com</p>
      <p>03 00 00 00 00</p>
      <hr>
      <h5 class="mb-3">Adresse</h5>
      <p>75 rue de la clairière</p>
      <p>58888 GREENVILLAGE</p>
      <p>FRANCE</p>
      <hr>
      <h5 class="mb-3">Caractéristiques du jardin</h5>
      <ul>
        <li>Surface : 500m2</li>
        <li>Surface : 500m2</li>
        <li>Surface : 500m2</li>
        <li>Surface : 500m2</li>
        <li>Surface : 500m2</li>
        <li>Surface : 500m2</li>
      </ul>
    </div>
    <div class="col-5 py-5 px-3 my-5 mx-3 rounded-3 shadow acc-column">
      <h2 class="fs-1 mb-4">Interventions prévues</h2>
      <div class="p-3">
        <button class="btn p-3 bt-big" type="button" data-bs-toggle="collapse" data-bs-target="#pelouseMdfCollapse"
            aria-expanded="false" aria-controls="pelouseCollapse">
          Taille d'arbres fruitiers
        </button>
      </div>
      <div class="collapse" id="pelouseMdfCollapse">
        <div class="card card-body intervention">
          <h5>Taille de haie</h5>
          <form action="">

            <!-- Prévoir d'ajouter la fréquence pour la tonte de pelouse -->

            <p>Prochaine intervention prévue</p>
            <div class="slc-week mb-2">
              <label for="weekSelect" class="visually-hidden"></label>
              <select class="form-select slc-weekField" id="weekSelect">
                <option selected>Semaine...</option>
                <option value="1">Semaine 1</option>
                <option value="2">Semaine 2</option>
                <option value="3">Semaine 2</option>
                <option value="4">Semaine 2</option>
                <option value="5">Semaine 2</option>
                <option value="6">Semaine 2</option>
                <option value="7">Semaine 2</option>
                <option value="8">Semaine 2</option>
              </select>
            </div>
            <p>Entre le 1 et le 8 février 2023</p>
            <button class="btn bt-default-bis" type="submit">Valider modification</button>
          </form>
        </div>
      </div>
      <div class="p-3">
        <button class="btn p-3 bt-big" type="button" data-bs-toggle="collapse" data-bs-target="#haieMdfCollapse"
          aria-expanded="false" aria-controls="haieCollapse">
          Taille de haies
        </button>
      </div>
      <div class="collapse" id="haieMdfCollapse">
        <div class="card card-body intervention">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, ullam.
        </div>
      </div>
      <button type="button" class="btn bt-default-bis my-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        Ajouter un service
      </button>
      <hr>
      <form class="pt-3" action="">
        <h5>Message complémentaire</h5>
        <?= $form->createTextarea('comment', 'message', '', 'my-3') ?>
        <button class="btn bt-default-bis" type="submit">ENVOYER</button>
      </form>
    </div>
  </div>
</div>