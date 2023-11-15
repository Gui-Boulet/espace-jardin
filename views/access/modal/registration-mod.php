<?php

use App\HTML\Form;

$form = new Form();
?>

<!-- Modal Registration ----------------------------------------------------------------------------------------------->

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <h1 class="modal-title fs-4 px-2" id="registrationModalLabel">
          Remplissez vos informations ci-dessous pour être contacté
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <form action="">
          <h5>Vos Informations</h5>
          <?= $form->createInput('text', 'lastName', 'customer', 'Nom', 'mb-2') ?>
          <?= $form->createInput('text', 'firstName', 'customer', 'Prénom', 'mb-2') ?>
          <?= $form->createInput('email', 'email', 'user', 'Email', 'mb-2') ?>
          <?= $form->createInput('tel', 'phone', 'customer', 'Téléphone', 'mb-2') ?>

          <h5>Votre Adresse</h5>
          <?= $form->createInput('text', 'streetNumer', 'customer', 'Numéro de rue', 'mb-2') ?>
          <?= $form->createInput('text', 'street', 'customer', 'Rue', 'mb-2') ?>
          <?= $form->createInput('text', 'zipCode', 'customer', 'Code postal', 'mb-2') ?>
          <?= $form->createInput('text', 'city', 'customer', 'Ville', 'mb-2') ?>
          <?= $form->createInput('text', 'country', 'customer', 'Pays', 'mb-2') ?>

          <h5>Votre Message</h5>
          <?= $form->createTextarea('comment', 'message', 'Message', 'mb-2') ?>
          
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn px-5 py-2 bt-default-bis">VALIDER</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>