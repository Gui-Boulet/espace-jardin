const customerModal = document.getElementById('customerModal')
const messageModal = document.getElementById('messageModal')
const imageModal = document.getElementById('imageModal')
const deleteModal = document.getElementById('deleteModal')


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
            
            // Ciblage des champs à modifier dans la fenêtre modale customerModal
            // Targeting fields to edit in the customerModal modal
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
            for (let i = 0; i < datasCustomer.length; i++){
              if (datasCustomer[i]['id'] == containerCustomerModal['id']) {
                areaCustomerModal['id'].value = containerCustomerModal['id']
                areaCustomerModal['name'].textContent = datasCustomer[i]['name']
                areaCustomerModal['gardenSize'].querySelector(`option[value="${datasCustomer[i]['gardenSize']}"]`).selected = true
                areaCustomerModal['hedgeLength'].value = datasCustomer[i]['hedgeLength']
                areaCustomerModal['fruitTree'].value = datasCustomer[i]['fruitTree']
                areaCustomerModal['shrub'].value = datasCustomer[i]['shrub']
                areaCustomerModal['smallTree'].value = datasCustomer[i]['smallTree']
                areaCustomerModal['bigTree'].value = datasCustomer[i]['bigTree']
                areaCustomerModal['note'].value = datasCustomer[i]['note']
              }
            }
            break

          
          case messageModal:
            
            // Extraction des informations à partir des attributs data-customer-* et data-message-*
            // Extracting information from data-customer-* et data-message-* attributes
            const containerMessageModal = {
              "name" : button.getAttribute('data-customer-name'),
              "date" : button.getAttribute('data-message-date'),
              "comment" : button.getAttribute('data-message-comment')
            }
              
            // Ciblage des champs à modifier dans la fenêtre modale messageModal
            // Targeting fields to edit in the messageModal modal
            const areaMessageModal = {
              "name" : typeModal.querySelector('#customer-name'),
              "date" : typeModal.querySelector('#message-date'),
              "comment" : typeModal.querySelector('#message-comment')
            }

            // Mis à jour du contenu de la fenêtre modale messageModal
            // Updated the contents of the messageModal modal
            areaMessageModal['name'].textContent = containerMessageModal['name']
            areaMessageModal['date'].textContent = containerMessageModal['date']
            areaMessageModal['comment'].textContent = containerMessageModal['comment']
            break

          
          case imageModal:

            // Extraction des informations à partir des attributs data-service-*
            // Extracting information from data-service-* attributes
            const containerImageModal = {
              "name" : button.getAttribute('data-service-name'),
              "fileName" : button.getAttribute('data-service-fileName')
            }

            // Ciblage des champs à modifier dans la fenêtre modale imageModal
            // Targeting fields to edit in the imageModal modal
            const areaImageModal = typeModal.querySelector('#service-image')
      
            // Mis à jour du contenu de la fenêtre modale imageModal
            // Updated the contents of the imageModal modal
            areaImageModal.setAttribute('alt', containerImageModal['name'])
            areaImageModal.setAttribute('src', `./images/${containerImageModal['fileName']}.jpg`)
            break

          
          case deleteModal:

            // Extraction des informations à partir de l'attribut data-service-name
            // Extracting information from data-service-name attribute
            const containerDeleteModal = {
              'id' : button.getAttribute('data-service-id'),
              'name' : button.getAttribute('data-service-name')
            }

            // Ciblage des champs à modifier dans la fenêtre modale deleteModal
            // Targeting fields to edit in the deleteModal modal
            const areaDeleteModal = {
              'id' : typeModal.querySelector('#service-id'),
              'name' : typeModal.querySelector('#service-name')
            }
      
            // Mis à jour du contenu de la fenêtre modale deleteModal
            // Updated the contents of the deleteModal modal
            areaDeleteModal['id'].value = containerDeleteModal['id']
            areaDeleteModal['name'].textContent = containerDeleteModal['name']
            break
        }
      }
    )
  }
}

loadModal(customerModal)
loadModal(messageModal)
loadModal(imageModal)
loadModal(deleteModal)

// Affiche un élément pendant 5 sec - Displays an item for 5 sec
function timeOut(element){
  setTimeout(function() {
    document.getElementById(element).style.display = 'none';
  }, 5000)
}

timeOut('checkIcon')