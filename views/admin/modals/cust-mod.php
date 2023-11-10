<!-- Fenêtre modale pour afficher un message / Modal to display a message --------------------------------------------->

<div class="modal fade" id="messageModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h4 class="modal-title fw-bold" id="customer-name">
            <!-- Nom et prénom du client / Customer's first and last name -->
          </h4>
          <span id="message-date">
            <!-- Date du message / Date of the message -->
          </span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="message-comment">
          <!-- Message / Message -->
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Fenêtre modale pour afficher les informations du client / Modal to display customer's informations --------------->

<div class="modal fade" id="customerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customer-name">
          <!-- Nom et prénom du client / Customer's first and last name -->
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div>
          <p id="customer-email">
            <!-- Email du client / Customer's email -->
          </p>
          <p id="customer-phone">
            <!-- Numéro de téléphone du client / Customer's phone number -->
          </p>
          <p>
            <span id="customer-streetNumber">
              <!-- Numéro de la rue du client / Customer's street number -->
            </span>
            <span id="customer-street">
              <!-- Rue du client / Customer's street -->
            </span><br>
            <span id="customer-zipCode">
              <!-- Code postal du client / Customer's zip code -->
            </span>
            <span id="customer-city">
              <!-- Ville du client / Customer's city -->
            </span><br>
            <span id="customer-country">
              <!-- Pays du client / Customer's country -->
            </span>
          </p>
        </div>

        <form class="my-1" action="">
          <fieldset disabled>
            <legend class="mb-2">
              Caractéristiques du jardin
            </legend>
            <div class="input-group mb-2">
              <label for="customer-gardenSize" class="input-group-text lbl-garden">Surface</label>
              <!-- Taille approximative du jardin / Approximate garden size -->
              <select name="" id="customer-gardenSize" class="form-select">
                <option selected></option>
                <option value="moins de 1000">moins de 1000</option>
                <option value="entre 1000 et 2000">entre 1000 et 2000</option>
                <option value="entre 2000 et 3000">entre 2000 et 3000</option>
                <option value="entre 3000 et 4000">entre 3000 et 4000</option>
                <option value="entre 4000 et 5000">entre 4000 et 5000</option>
              </select>
              <span class="input-group-text">m<sup>2</sup></span>
            </div>
            <div class="input-group mb-2">
              <label for="customer-hedgeLength" class="input-group-text lbl-garden">Haies</label>
              <!-- Longueur de haies du jardin / Garden hedge length -->
              <input type="text" class="form-control" id="customer-hedgeLength">
              <span class="input-group-text">m</span>
            </div>
            <div class="input-group mb-2">
              <label for="customer-fruitTree" class="input-group-text lbl-garden">Arbres Fruitiers</label>
              <!-- Nombre d'arbres fruitiers / Number of Fruit Trees -->
              <input type="text" class="form-control" id="customer-fruitTree">
            </div>
            <div class="input-group mb-2">
              <label for="customer-shrub" class="input-group-text lbl-garden">Arbustes</label>
              <!-- Nombre d'arbustes / Number of shrubs -->
              <input type="text" class="form-control" id="customer-shrub">
            </div>
            <div class="input-group mb-2">
              <label for="customer-smallTree" class="input-group-text lbl-garden">Petits arbres</label>
              <!-- Nombre de petits arbres / Number of small trees -->
              <input type="text" class="form-control" id="customer-smallTree">
            </div>
            <div class="input-group mb-2">
              <label for="customer-bigTree" class="input-group-text lbl-garden">Grands arbres</label>
              <!-- Nombre de grands arbres / Number of big trees -->
              <input type="text" class="form-control" id="customer-bigTree">
            </div>
            <div class="input-group">
              <label for="customer-note" class="input-group-text lbl-garden">Notes</label>
              <!-- Notes à propos du client / Notes about the customer -->
              <textarea class="form-control" name="" id="customer-note" rows="5"></textarea>
            </div>
          </fieldset>
        </form>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn px-5 py-2 bt-default">Modifier</button>
      </div>
    </div>
  </div>
</div>