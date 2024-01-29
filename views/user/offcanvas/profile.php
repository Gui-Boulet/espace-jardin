<!-- Offcanvas Section  -->

<div class="offcanvas offcanvas-end user-cnv" tabindex="-1" id="offcanvasUser">

  <div class="offcanvas-header">
    <h2 class="offcanvas-title" id="offcanvasUserLabel">
      Votre Compte
    </h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <div class="px-3">

      <h5 class="mb-3">Coordonnées</h5>
      <span class="text-uppercase"><?= $customer->getLastName() ?> </span>
      <span><?= $customer->getFirstName() ?></span><br>
      <span><?= $customer->getEmail() ?></span><br>
      <span><?= $customer->getPhone() ?></span>

      <hr>

      <h5 class="mb-3">Adresse</h5>
      <span><?= $customer->getStreetNumber() . ' ' . $customer->getStreet() ?></span><br>
      <span><?= $customer->getZipCode() ?> </span>
      <span class="text-uppercase"><?= $customer->getCity() ?></span>
      <span class="text-uppercase">(<?= $customer->getCountry() ?>)</span>

      <hr>

      <h5 class="mb-3">Caractéristiques du jardin</h5>
      <span>Pelouse</span>
      <span class="float-end me-3"><?= $customer->getGardenSize() ?> m²</span><br>
      <span>Haies</span>
      <span class="float-end me-3"><?= $customer->getHedgeLength() ?> m</span><br>
      <span>Arbres fruitiers</span>
      <span class="float-end me-3"><?= $customer->getFruitTree() ?></span><br>
      <span>Arbustes</span>
      <span class="float-end me-3"><?= $customer->getShrub() ?></span><br>
      <span>Petits arbres</span>
      <span class="float-end me-3"><?= $customer->getSmallTree() ?></span><br>
      <span>Grands arbres</span>
      <span class="float-end me-3"><?= $customer->getBigTree() ?></span>

      <hr>

      <form action="">
        <h5>Laisser un message</h5>
        <?= $form->createTextarea('comment', 'message', '', 'my-2') ?>
        <button class="btn float-end bt-default-bis" type="button">ENVOYER</button>
      </form>

    </div>
  </div>
</div>