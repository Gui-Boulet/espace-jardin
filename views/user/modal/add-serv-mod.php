<!-- Add Service Modal -->

<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content text-center mdl-background">
      <div class="modal-header">
        <h2 class="ms-2">Ajouter un service</h2>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="p-3">
          <button class="btn p-3 bt-big" type="button" data-bs-toggle="collapse" data-bs-target="#pelouseAddCollapse"
            aria-expanded="false" aria-controls="pelouseCollapse">
            Taille d'arbres fruitiers
          </button>
        </div>
        <div class="collapse" id="pelouseAddCollapse">
          <div class="card card-body intervention">
            <h5>Taille de haie</h5>
            <form action="">

              <!-- Prévoir d'ajouter les boutons radios et la fréquence pour la tonte de pelouse -->

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
          <button class="btn p-3 bt-big" type="button" data-bs-toggle="collapse" data-bs-target="#haieAddCollapse"
            aria-expanded="false" aria-controls="haieCollapse">
            Taille de haies
          </button>
        </div>
        <div class="collapse" id="haieAddCollapse">
          <div class="card card-body intervention">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, ullam.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>