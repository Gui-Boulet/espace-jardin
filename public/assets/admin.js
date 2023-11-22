/* ******************************************************* */
/* Déclarations des constantes - Declarations of constants */
/* ******************************************************* */

// Ciblage des différentes fenêtres modales - Targeting the different modal
const customerModal = document.getElementById('customerModal')
const messageModal = document.getElementById('messageModal')
const imageModal = document.getElementById('imageModal')
const deleteModal = document.getElementById('deleteModal')


/* ****************************************************** */
/* Déclarations des fonctions - Declarations of functions */
/* ****************************************************** */

// Valide les champs d'un formulaire - Validates fields on a form
function validateField(field, regex) {
  const valueField = field.value.trim()

  if (!regex.test(valueField)) {
    field.classList.add('is-invalid')
    return false
  }
  return true
}

// Affiche un message d'erreur sous un champ de formulaire lorsque la saisie est incorrecte
// Displays an error message under a form field when the entry is incorrect
function displayErrorMessage(isValid, message, key, field) {
  if (!isValid[key]) {
    message[key].classList.remove('d-none')
    message[key].classList.add('d-block')
    setTimeout(function() {
      message[key].classList.remove('d-block')
      message[key].classList.add('d-none')
    }, 10000)
  } else {
    field[key].classList.remove('is-invalid')
    message[key].classList.remove('d-block')
    message[key].classList.add('d-none')
  }
}

// Retourne les données à insérer selon la fenêtre modale - Returns the data to be inserted according to the modal
function loadModal(typeModal){
  if (typeModal) {
    typeModal.addEventListener('show.bs.modal',
      event => {
        // Bouton ou lien qui déclenche la fenêtre modale - Button or link that triggers the modal
        const button = event.relatedTarget

        switch (typeModal) {

          case customerModal:

            // Extraction des informations à partir des attributs data-customer-id
            // Extracting information from data-customer-id attributes
            const containerCustomerModal = {"id" : button.getAttribute('data-customer-id')}
            
            // Ciblage des champs à remplir dans la fenêtre modale customerModal
            // Targeting fillable fields in the customerModal modal
            const areaCustomerModal = {
              "id" : typeModal.querySelector('#customer-user_id'),
              "name" : typeModal.querySelector('#customer-name'),
              "gardenSize" : typeModal.querySelector('#customer-garden_size'),
              "hedgeLength" : typeModal.querySelector('#customer-hedge_length'),
              "fruitTree" : typeModal.querySelector('#customer-fruit_tree'),
              "shrub" : typeModal.querySelector('#customer-shrub'),
              "smallTree" : typeModal.querySelector('#customer-small_tree'),
              "bigTree" : typeModal.querySelector('#customer-big_tree'),
              "note" : typeModal.querySelector('#customer-note')
            }

            // Mis à jour du contenu de la fenêtre modale customerModal
            // Updated the contents of the customerModal modal
            for (let i = 0; i < datasCustomer.length; i++) {
              if (datasCustomer[i].id == containerCustomerModal.id) {
                areaCustomerModal.id.value = containerCustomerModal.id
                areaCustomerModal.name.textContent = datasCustomer[i].name
                areaCustomerModal.gardenSize.querySelector(`option[value="${datasCustomer[i].gardenSize}"]`).selected = true
                areaCustomerModal.hedgeLength.value = datasCustomer[i].hedgeLength
                areaCustomerModal.fruitTree.value = datasCustomer[i].fruitTree
                areaCustomerModal.shrub.value = datasCustomer[i].shrub
                areaCustomerModal.smallTree.value = datasCustomer[i].smallTree
                areaCustomerModal.bigTree.value = datasCustomer[i].bigTree
                areaCustomerModal.note.value = datasCustomer[i].note
              }
            }
            
            const errorMessage = {
              "hedgeLength" : typeModal.querySelector('#customer-hedge_length-error'),
              "fruitTree" : typeModal.querySelector('#customer-fruit_tree-error'),
              "shrub" : typeModal.querySelector('#customer-shrub-error'),
              "smallTree" : typeModal.querySelector('#customer-small_tree-error'),
              "bigTree" : typeModal.querySelector('#customer-big_tree-error'),
              "note" : typeModal.querySelector('#customer-note-error')
            }

            const buttonSubmit = typeModal.querySelector('#customer-submit')

            buttonSubmit.addEventListener('click', function() {
              const isFieldValid = {
                "hedgeLength" : validateField(areaCustomerModal.hedgeLength,
                  /^(0|[1-9]|[1-9][0-9]|[1-9][0-9]{2}|[1][0-9]{3}|2000)$/),
                "fruitTree" : validateField(areaCustomerModal.fruitTree,
                  /^(0|[1-9]|[1-4][0-9]|50)$/),
                "shrub" : validateField(areaCustomerModal.shrub,
                  /^(0|[1-9]|[1-4][0-9]|50)$/),
                "smallTree" : validateField(areaCustomerModal.smallTree,
                  /^(0|[1-9]|[1-4][0-9]|50)$/),
                "bigTree" : validateField(areaCustomerModal.bigTree,
                  /^(0|[1-9]|[1-4][0-9]|50)$/),
                "note" : validateField(areaCustomerModal.note,
                  /^[^<>"';&/\\]{0,250}$/)
              }

              displayErrorMessage(isFieldValid, errorMessage, 'hedgeLength', areaCustomerModal)
              displayErrorMessage(isFieldValid, errorMessage, 'fruitTree', areaCustomerModal)
              displayErrorMessage(isFieldValid, errorMessage, 'shrub', areaCustomerModal)
              displayErrorMessage(isFieldValid, errorMessage, 'smallTree', areaCustomerModal)
              displayErrorMessage(isFieldValid, errorMessage, 'bigTree', areaCustomerModal)
              displayErrorMessage(isFieldValid, errorMessage, 'note', areaCustomerModal)

              if (!(isFieldValid.hedgeLength && isFieldValid.fruitTree && isFieldValid.shrub && isFieldValid.smallTree
                  && isFieldValid.bigTree && isFieldValid.note)) {
                buttonSubmit.setAttribute('type', 'button')
              } else {
                buttonSubmit.setAttribute('type', 'submit')
              }
            })
            break

          
          case messageModal:
            
            // Extraction des informations à partir des attributs data-customer-* et data-message-*
            // Extracting information from data-customer-* et data-message-* attributes
            const containerMessageModal = {
              "name" : button.getAttribute('data-customer-name'),
              "date" : button.getAttribute('data-message-date'),
              "comment" : button.getAttribute('data-message-comment')
            }
              
            // Ciblage des champs à remplir dans la fenêtre modale messageModal
            // Targeting fillable fields in the messageModal modal
            const areaMessageModal = {
              "name" : typeModal.querySelector('#customer-name'),
              "date" : typeModal.querySelector('#message-date'),
              "comment" : typeModal.querySelector('#message-comment')
            }

            // Mis à jour du contenu de la fenêtre modale messageModal
            // Updated the contents of the messageModal modal
            areaMessageModal.name.textContent = containerMessageModal.name
            areaMessageModal.date.textContent = containerMessageModal.date
            areaMessageModal.comment.textContent = containerMessageModal.comment
            break

          
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

          
          case deleteModal:

            // Extraction des informations à partir de l'attribut data-service-name
            // Extracting information from data-service-name attribute
            const containerDeleteModal = {
              'id' : button.getAttribute('data-service-id'),
              'name' : button.getAttribute('data-service-name')
            }

            // Ciblage des champs à remplir dans la fenêtre modale deleteModal
            // Targeting fillable fields in the deleteModal modal
            const areaDeleteModal = {
              'id' : typeModal.querySelector('#service-id'),
              'name' : typeModal.querySelector('#service-name')
            }
      
            // Mis à jour du contenu de la fenêtre modale deleteModal
            // Updated the contents of the deleteModal modal
            areaDeleteModal.id.value = containerDeleteModal.id
            areaDeleteModal.name.textContent = containerDeleteModal.name
            break
        }
      }
    )
  }
}


/* *************************************** */
/* Appel des fonctions - Calling functions */
/* *************************************** */

// Chargement des données dans les différentes fenêtres modales - Loading data into different modal
loadModal(customerModal)
loadModal(messageModal)
loadModal(imageModal)
loadModal(deleteModal)

// Affichage temporaire d'un icône de validation - Temporary display of a validation icon
setTimeout(function() {
  document.getElementById('checkIcon').classList.remove('d-block')
  document.getElementById('checkIcon').classList.add('d-none')
}, 10000)