<?php

use App\HTML\Form;
use App\Table\CustomerTable;

$form = new Form();

$typeGardenSizes = (new CustomerTable($pdo))->findGardenSizes();
$gardenSizes = str_replace("'", "", explode(',', substr($typeGardenSizes['Type'], 5, -1)));
?>

<!-- Fenêtre modale pour afficher un message / Modal to display a message --------------------------------------------->

<div class="modal fade" id="messageModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <div>
          <!-- Nom et prénom du client / Customer's first and last name -->
          <h4 class="modal-title fw-bold" id="customer-name"></h4>
          <!-- Date du message / Date of the message -->
          <span id="message-date"></span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Message / Message -->
        <p id="message-comment"></p>
      </div>
    </div>
  </div>
</div>

<!-- Fenêtre modale pour afficher les informations du client / Modal to display customer's informations --------------->

<div class="modal fade" id="customerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <!-- Nom et prénom du client / Customer's first and last name -->
        <h4 class="modal-title fw-bold" id="customer-name"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">

        <form class="mt-1" action="<?= $router->url('admin_actions_update') ?>" method="post">
          <fieldset>
            <legend class="fs-5 mb-2">
              Caractéristiques du jardin
            </legend>
            <div class="input-group mb-2">
              <!-- Taille approximative du jardin / Approximate garden size -->
              <?= $form->createSelect('garden_size', 'customer', 'Surface', '', $gardenSizes) ?>
              <span class="input-group-text">m<sup>2</sup></span>
            </div>
            
            <div class="input-group mb-2">
              <!-- Longueur de haies du jardin / Garden hedge length -->
              <?= $form->createInput('text', 'hedge_length', 'customer', 'Haies', '') ?>
              <span class="input-group-text">m</span>
            </div>
            <?= $form->displayErrorMessage('int2000', 'hedge_length', 'customer') ?>

            <!-- Nombre d'arbres fruitiers / Number of Fruit Trees -->
            <?= $form->createInput('text', 'fruit_tree', 'customer', 'Arbres fruitiers', 'mb-2') ?>
            <?= $form->displayErrorMessage('int50', 'fruit_tree', 'customer') ?>
            
            <!-- Nombre d'arbustes / Number of shrubs -->
            <?= $form->createInput('text', 'shrub', 'customer', 'Arbustes', 'mb-2') ?>
            <?= $form->displayErrorMessage('int50', 'shrub', 'customer') ?>
            
            <!-- Nombre de petits arbres / Number of small trees -->
            <?= $form->createInput('text', 'small_tree', 'customer', 'Petits arbres', 'mb-2') ?>
            <?= $form->displayErrorMessage('int50', 'small_tree', 'customer') ?>
            
            <!-- Nombre de grands arbres / Number of big trees -->
            <?= $form->createInput('text', 'big_tree', 'customer', 'Grands arbres', 'mb-2') ?>
            <?= $form->displayErrorMessage('int50', 'big_tree', 'customer') ?>
            
            <!-- Notes à propos du client / Notes about the customer -->
            <?= $form->createTextarea('note', 'customer', 'Notes', 'mb-3') ?>
            <?= $form->displayErrorMessage('strNotReq', 'note', 'customer') ?>

            <?= $form->createInput('hidden', 'user_id', 'customer', '', '') ?>
            <button class="btn px-5 py-2 bt-default" id="customer-submit" type="button">
              Modifier
            </button>
          </fieldset>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Fenêtre modale pour supprimer une intervention / Modal to delete a intervention ---------------------------------->

<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        
        <div>
          <h4 class="modal-title" id="service-name">
            <!-- Nom du service / Service Name -->
          </h4>
          <span id="intervention-week">
            <!-- Période de l'intervention / Period of intervention -->
          </span>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Voulez-vous vraiment supprimer cette intervention ?</span>
      </div>
      <div class="modal-footer">
        <form action="<?= $router->url('admin_actions_delete') ?>" method="post">
          <input type="hidden" name="id" id="intervention-id">
          <input type="hidden" name="customer_id" id="customer-id">
          <button class="btn bt-default-bis" type="submit">OUI</button>
        </form>
        <button type="button" class="btn bt-default" data-bs-dismiss="modal">NON</button>
      </div>
    </div>
  </div>
</div>