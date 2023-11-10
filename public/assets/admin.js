// Fill in the content of the modals //
function loadModal(typeModal){
  if (typeModal) {
    typeModal.addEventListener('show.bs.modal',
      event => {
        // Button that triggered the modal
        const button = event.relatedTarget

        switch (typeModal) {

          case customerModal:

            // Extract info from data-customer-id attributes
            const containerCustomerModal = {"id" : button.getAttribute('data-customer-id')}
            
            // Update the customerModal's content
            const areaCustomerModal = {
              "name" : typeModal.querySelector('#customer-name'),
              "email" : typeModal.querySelector('#customer-email'),
              "phone" : typeModal.querySelector('#customer-phone'),
              "streetNumber" : typeModal.querySelector('#customer-streetNumber'),
              "street" : typeModal.querySelector('#customer-street'),
              "zipCode" : typeModal.querySelector('#customer-zipCode'),
              "city" : typeModal.querySelector('#customer-city'),
              "country" : typeModal.querySelector('#customer-country'),
              "gardenSize" : typeModal.querySelector('#customer-gardenSize'),
              "hedgeLength" : typeModal.querySelector('#customer-hedgeLength'),
              "fruitTree" : typeModal.querySelector('#customer-fruitTree'),
              "shrub" : typeModal.querySelector('#customer-shrub'),
              "smallTree" : typeModal.querySelector('#customer-smallTree'),
              "bigTree" : typeModal.querySelector('#customer-bigTree'),
              "note" : typeModal.querySelector('#customer-note'),
            }

            for (let i = 0; i < datasCustomer.length; i++){
              if (datasCustomer[i]['id'] == containerCustomerModal['id']) {
                areaCustomerModal['name'].textContent = datasCustomer[i]['name']
                areaCustomerModal['email'].textContent = datasCustomer[i]['email']
                areaCustomerModal['phone'].textContent = datasCustomer[i]['phone']
                areaCustomerModal['streetNumber'].textContent = datasCustomer[i]['streetNumber']
                areaCustomerModal['street'].textContent = datasCustomer[i]['street']
                areaCustomerModal['zipCode'].textContent = datasCustomer[i]['zipCode']
                areaCustomerModal['city'].textContent = datasCustomer[i]['city']
                areaCustomerModal['country'].textContent = datasCustomer[i]['country']
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
            // Extract info from data-customer-* and data-message-* attributes
            const containerMessageModal = {
              "name" : button.getAttribute('data-customer-name'),
              "date" : button.getAttribute('data-message-date'),
              "comment" : button.getAttribute('data-message-comment')
            }
              
            // Update the messageModal's content
            const areaMessageModal = {
              "name" : typeModal.querySelector('#customer-name'),
              "date" : typeModal.querySelector('#message-date'),
              "comment" : typeModal.querySelector('#message-comment')
            }

            areaMessageModal['name'].textContent = containerMessageModal['name']
            areaMessageModal['date'].textContent = containerMessageModal['date']
            areaMessageModal['comment'].textContent = containerMessageModal['comment']
            break

          
          case imageModal:
            // Extract info from data-service-* attributes
            const containerImageModal = {
              "name" : button.getAttribute('data-service-name'),
              "fileName" : button.getAttribute('data-service-fileName')
            }

            // Update the imageModal's content
            const areaImageModal = typeModal.querySelector('#service-image')
      
            areaImageModal.setAttribute('alt', containerImageModal['name'])
            areaImageModal.setAttribute('src', `./images/${containerImageModal['fileName']}.jpg`)
            break

          
          case deleteModal:
            // Extract info from data-service-name attribute
            const containerDeleteModal = {
              "id" : button.getAttribute('data-service-id'),
              "name" : button.getAttribute('data-service-name')
            }

            // Update the deleteModal's content
            const areaDeleteModal = {
              "id" : typeModal.querySelector('#service-id'),
              "name" : typeModal.querySelector('#service-name')
            }
      
            areaDeleteModal["id"].value = containerDeleteModal["id"]
            areaDeleteModal["name"].textContent = containerDeleteModal["name"]
            break
        }
      }
    )
  }
}

const customerModal = document.getElementById('customerModal')
const messageModal = document.getElementById('messageModal')
const imageModal = document.getElementById('imageModal')
const deleteModal = document.getElementById('deleteModal')

loadModal(customerModal)
loadModal(messageModal)
loadModal(imageModal)
loadModal(deleteModal)