<!-- Modale pour supprimer une intervention / Modal to delete a intervention -->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h2 class="modal-title" id="serviceName">
          <!-- Nom du service -->
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <input type="hidden" name="fileNameDelete" id="fileNameDelete">
        <p class="fw-bold">
          Prochaine intervention : <span id="interventionWeek"><!-- Période intervention --></span><br>
          <span>( Renouvelée tous les <span id="frequency"><!-- Fréquence intervention --></span> )</span>
        </p>
        <span class="text-danger fst-italic fs-5 border-bottom border-danger">
          Voulez-vous vraiment annuler ce service ?
        </span>
      </div>

      <div class="modal-footer">
        <button class="btn bt-default" type="button" data-bs-dismiss="modal" id="buttonDelete">
          OUI
        </button>
        <button class="btn bt-default-bis" type="button" data-bs-dismiss="modal">
          NON
        </button>
      </div>
      
    </div>
  </div>
</div>