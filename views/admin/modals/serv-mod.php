<?php

use App\HTML\Form;

$form = new Form();
?>

<!-- Fenêtre modale pour afficher l'image du service / Modal to display the service image ----------------------------->

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content px-4 pb-4 mdl-background">
      <button type="button" class="btn-close m-1" data-bs-dismiss="modal" aria-label="Close"></button>
      <!-- Chemin d'accès à l'image et nom du service / Image path and service name -->
      <img src="" alt="" id="service-image">
    </div>
  </div>
</div>

<!-- Fenêtre modale pour créer un service / Modal to create a service ------------------------------------------------->

<div class="modal fade" id="createServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <h1 class="modal-title fs-3">
          Créer un service
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingTitle">
          <label for="floatingTitle">Titre</label>
        </div>
        <div class="mb-3">
          <label for="selectFile" class="form-label"></label>
          <input type="file" class="form-control" id="selectFile">
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn px-5 py-2 bt-default">Valider</button>
      </div>
    </div>
  </div>
</div>

<!-- Fenêtre modale pour supprimer un service / Modal to delete a service --------------------------------------------->

<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <h4 class="modal-title" id="service-name">
          <!-- Nom du service / Service Name -->
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Voulez-vous vraiment supprimer ce service ?</span>
      </div>
      <div class="modal-footer">
        <form action="<?= $router->url('admin_actions_delete') ?>" method="post">
          <?= $form->createInput('hidden', 'id', 'service', '', '') ?>
          <button class="btn bt-default-bis" type="submit">OUI</button>
        </form>
        <button type="button" class="btn bt-default" data-bs-dismiss="modal">NON</button>
      </div>
    </div>
  </div>
</div>