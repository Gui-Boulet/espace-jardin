<!-- Modale pour modifier une intervention / Modal to update a intervention -->

<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title" id="serviceName">
          <!-- Nom du service -->
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center fw-bold">
        <input type="hidden" name="fileNameUpdate" id="fileNameUpdate">
        <span class="fs-5">Prochaine intervention</span>

        <div class="form-floating mx-3 my-2">
          <input class="form-control" type="week" name="week" id="weekUpdate">
          <label for="weekUpdate">Sélectionner une période</label>
        </div>

        <span>( Renouvelée tous les <span id="frequency"><!-- Fréquence intervention --></span> )</span>
      </div>

      <div class="modal-footer">
        <button class="btn bt-default" type="button" data-bs-dismiss="modal" id="buttonUpdate">
          VALIDER
        </button>
        <button class="btn bt-default-bis" type="button" data-bs-dismiss="modal">
          ANNULER
        </button>
      </div>
      
    </div>
  </div>
</div>