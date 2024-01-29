<?php

use App\HTML\Form;

$form = new Form();
?>

<!-- Fenêtre modale pour enregistrer les coordonnées du client / Modal to save customer details ----------------------->

<div class="modal fade" id="registrationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <h1 class="modal-title fs-4 px-2">
          Remplissez vos informations ci-dessous pour être contacté
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <form action="<?= $router->url('actions_insert') ?>" method="post">
          <h5>Vos Informations</h5>
          <?= $form->createInput('text', 'last_name', 'customer', 'Nom', 'mb-2') ?>
          <?= $form->displayErrorMessage('str30', 'last_name', 'customer') ?>

          <?= $form->createInput('text', 'first_name', 'customer', 'Prénom', 'mb-2') ?>
          <?= $form->displayErrorMessage('str30', 'first_name', 'customer') ?>

          <?= $form->createInput('email', 'email', 'user', 'Email', 'mb-2') ?>
          <?= $form->displayErrorMessage('strEmail', 'email', 'user') ?>

          <?= $form->createInput('tel', 'phone', 'customer', 'Téléphone', 'mb-2') ?>
          <?= $form->displayErrorMessage('int13', 'phone', 'customer') ?>

          <h5>Votre Adresse</h5>
          <?= $form->createInput('text', 'street_number', 'customer', 'Numéro de rue', 'mb-2') ?>
          <?= $form->displayErrorMessage('intstr5', 'street_number', 'customer') ?>

          <?= $form->createInput('text', 'street', 'customer', 'Rue', 'mb-2') ?>
          <?= $form->displayErrorMessage('str200', 'street', 'customer') ?>

          <?= $form->createInput('text', 'zip_code', 'customer', 'Code postal', 'mb-2') ?>
          <?= $form->displayErrorMessage('int5', 'zip_code', 'customer') ?>

          <?= $form->createInput('text', 'city', 'customer', 'Ville', 'mb-2') ?>
          <?= $form->displayErrorMessage('str30', 'city', 'customer') ?>

          <?= $form->createInput('text', 'country', 'customer', 'Pays', 'mb-2') ?>
          <?= $form->displayErrorMessage('str30', 'country', 'customer') ?>

          <h5>Votre Message</h5>
          <?= $form->createTextarea('comment', 'message', 'Message', 'mb-2') ?>
          <?= $form->displayErrorMessage('strNotReq', 'comment', 'message') ?>
          
          <div class="d-flex justify-content-center">
            <button class="btn px-5 py-2 bt-default-bis" id="customer-submit" type="button">VALIDER</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>