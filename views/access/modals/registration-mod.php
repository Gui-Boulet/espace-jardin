<!-- Modal Registration ----------------------------------------------------------------------------------------------->

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingName" required>
            <label for="floatingName">Nom</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingFirstname" required>
            <label for="floatingFirstname">Prénom</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingEmail" required>
            <label for="floatingEmail">E-mail</label>
          </div>
          <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="floatingPhone" required>
            <label for="floatingPhone">Téléphone</label>
          </div>
          <h5>Votre Adresse</h5>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingStreetNumber" required>
            <label for="floatingStreetNumber">Numéro de rue</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingStreet" required>
            <label for="floatingStreet">Rue</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="floatingZipcode" required>
            <label for="floatingZipcode">Code postal</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingCity" required>
            <label for="floatingCity">Ville</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingCountry" required>
            <label for="floatingCountry">Pays</label>
          </div>
          <h5>Votre Message</h5>
          <div class="form-floating mb-3">
            <textarea class="form-control" id="floatingMessage" style="height: 100px"></textarea>
            <label for="floatingMessage">Message</label>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn px-5 py-2 bt-default-bis">VALIDER</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>