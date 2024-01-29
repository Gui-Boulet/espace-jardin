/* ******************************************************* */
/* Déclarations des constantes - Declarations of constants */
/* ******************************************************* */

const imageModal = document.getElementById('imageServiceModal')
const updateModal = document.getElementById('updateServiceModal')


/* ****************************************************** */
/* Déclarations des fonctions - Declarations of functions */
/* ****************************************************** */

// Retourne les données à insérer selon la fenêtre modale - Returns the data to be inserted according to the modal
function loadModal(typeModal){
  if (typeModal) {
    typeModal.addEventListener('show.bs.modal',
      event => {
        // Bouton ou lien qui déclenche la fenêtre modale - Button or link that triggers the modal
        const button = event.relatedTarget

        switch (typeModal) {

          case imageModal:

            // Extraction des informations à partir des attributs data-service-*
            // Extracting information from data-service-* attributes
            const containerImageModal = {
              "name" : button.getAttribute('data-service-name'),
              "fileName" : button.getAttribute('data-service-fileName')
            }

            // Ciblage du champ à remplir dans la fenêtre modale imageModal
            // Targeting the field to be filled in the imageModal modal
            const areaImageModal = typeModal.querySelector('#service-image')
      
            // Mis à jour du contenu de la fenêtre modale imageModal
            // Updated the contents of the imageModal modal
            areaImageModal.setAttribute('alt', containerImageModal.name)
            areaImageModal.setAttribute('src', `./images/${containerImageModal.fileName}.jpg`)
            break
          
          case updateModal:

            // Extraction des informations à partir des attributs data-service-*
            // Extracting information from data-service-* attributes
            const containerUpdateModal = {
              'id' : button.getAttribute('data-service-id'),
              'name' : button.getAttribute('data-service-name'),
              'status' : button.getAttribute('data-service-status')
            }

            // Ciblage des champs à remplir dans la fenêtre modale updateModal
            // Targeting fillable fields in the updateModal modal
            const areaUpdateModal = {
              'id' : typeModal.querySelector('#service-id'),
              'name' : typeModal.querySelector('#service-name'),
              'statusActive' : typeModal.querySelector('#status-active'),
              'statusInactive' : typeModal.querySelector('#status-inactive')
            }

            // Mis à jour du contenu de la fenêtre modale imageModal
            // Updated the contents of the imageModal modal
            areaUpdateModal.id.value = containerUpdateModal.id
            areaUpdateModal.name.textContent = containerUpdateModal.name
            if (containerUpdateModal.status == 1) {
              areaUpdateModal.statusActive.checked = true
              areaUpdateModal.statusInactive.checked = false
            } else if (containerUpdateModal.status == 0) {
              areaUpdateModal.statusInactive.checked = true
              areaUpdateModal.statusActive.checked = false
            }

            break
        }
      }
    )
  }
}

/* *************************************** */
/* Appel des fonctions - Calling functions */
/* *************************************** */

loadModal(imageModal)
loadModal(updateModal)