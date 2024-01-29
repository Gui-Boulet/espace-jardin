<?php

use App\HTML\Form;

$form = new Form();
?>

<!-- Fenêtre modale pour afficher l'image du service / Modal to display the service image ----------------------------->

<div class="modal fade" id="imageServiceModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content px-4 pb-4 mdl-background">
      <button type="button" class="btn-close m-1" data-bs-dismiss="modal" aria-label="Close"></button>
      <!-- Chemin d'accès à l'image et nom du service / Image path and service name -->
      <img src="" alt="" id="service-image">
    </div>
  </div>
</div>

<!-- Fenêtre modale pour modifier le statut d'un service / Modal to update a status of service ---------------------------------------------->

<div class="modal fade" id="updateServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content mdl-background">
      <div class="modal-header">
        <h4 class="modal-title" id="service-name">
          <!-- Nom du service / Service Name -->
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <span class="fs-5">Modifier le statut</span>
        <form action="<?= $router->url('admin_actions_update') ?>" method="post">
          <input class="btn-check" type="radio" name="status" id="status-active" value="1">
          <label class="btn btn-outline-success fw-bold px-3 py-1 me-3 mt-3 bt-status" for="status-active">
            ACTIF
          </label>
          <input class="btn-check" type="radio" name="status" id="status-inactive" value="0">
          <label class="btn btn-outline-danger fw-bold px-3 py-1 mt-3 bt-status" for="status-inactive">
            INACTIF
          </label>
          <div>
            <input type="hidden" name="service-id" id="service-id">
          </div>
          <button class="btn px-5 mt-4 bt-default-bis" type="submit">VALIDER</button>
        </form>
      </div>
    </div>
  </div>
</div>