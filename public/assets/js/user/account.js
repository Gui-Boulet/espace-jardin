const interventionsDiv = document.querySelector('#interventionsDiv').querySelectorAll('div[id]')

window.addEventListener('load', () => {
  interventionsDiv.forEach((div) => {
    if (div.querySelector('small').textContent === '-') {
      div.querySelectorAll('button')[1].classList.replace('d-inline', 'd-none')
      div.querySelectorAll('button')[2].classList.replace('d-inline', 'd-none')
    } else {
      div.querySelectorAll('button')[0].classList.replace('d-inline', 'd-none')
    }
  })
})

/* ------------------------------------ Gestion des dates / Date management ----------------------------------------- */

function formatWeek(inputValue) {
  const year = inputValue.substring(0, 4)
  const week = inputValue.substring(6)

  const date = new Date(year, 0, (week - 1) * 7 + 1)
  const format = { day: '2-digit', month: '2-digit' }

  const start = date.toLocaleDateString('fr-FR', format)
  const end = new Date(date.setDate(date.getDate() + 6)).toLocaleDateString('fr-FR', format)

  return `Sem ${week} - ${year} (${start} - ${end})`
}

function formatWeekPicker(smallText) {
  const year = smallText.split(' ')[3]
  const week = smallText.split(' ')[1].slice(-2)
  
  return `${year}-W${week}`
}

/* ------------------------------- Chargement des modales / Modals loading ------------------------------------------ */

// Ciblage des différentes fenêtres modales - Targeting the different modal
const createModal = document.getElementById('createModal')
const updateModal = document.getElementById('updateModal')
const deleteModal = document.getElementById('deleteModal')


// Retourne les données à insérer selon la fenêtre modale - Returns the data to be inserted according to the modal
function loadModal(typeModal) {
  if (typeModal) {
    typeModal.addEventListener('show.bs.modal',
      event => {
        // Bouton ou lien qui déclenche la fenêtre modale - Button or link that triggers the modal
        const button = event.relatedTarget

        switch (typeModal) {

          // -----------------------------------------------------------------------------------------------------------
          case createModal:
            
            // Extraction des informations à partir des attributs data-*
            // Extracting information from data-* attributes
            const containerCreateModal = {
              'name' : button.getAttribute('data-service-name'),
              'filename' : button.getAttribute('data-service-filename'),
              'frequency' : button.getAttribute('data-frequency')
            }
              
            // Ciblage des champs à remplir dans la fenêtre modale createModal
            // Targeting fillable fields in the createModal modal
            const areaCreateModal = {
              'name' : typeModal.querySelector('#serviceName'),
              'filename' : typeModal.querySelector('#fileNameCreate'),
              'frequency' : typeModal.querySelector('#frequency'),
              'week' : typeModal.querySelector('#weekCreate')
            }

            // Mis à jour du contenu de la fenêtre modale createModal
            // Updated the contents of the createModal modal
            areaCreateModal.name.textContent = containerCreateModal.name
            areaCreateModal.filename.value = containerCreateModal.filename
            areaCreateModal.frequency.textContent = containerCreateModal.frequency
            areaCreateModal.week.value = ''

            break

          // -----------------------------------------------------------------------------------------------------------
          case updateModal:
            
            // Extraction des informations à partir des attributs data-*
            // Extracting information from data-* attributes
            const containerUpdateModal = {
              "name" : button.getAttribute('data-service-name'),
              'filename' : button.getAttribute('data-service-filename'),
              "date" : button.parentNode.previousElementSibling.querySelector('small').textContent,
              "frequency" : button.getAttribute('data-frequency')
            }
              
            // Ciblage des champs à remplir dans la fenêtre modale updateModal
            // Targeting fillable fields in the updateModal modal
            const areaUpdateModal = {
              "name" : typeModal.querySelector('#serviceName'),
              'filename' : typeModal.querySelector('#fileNameUpdate'),
              "date" : typeModal.querySelector('#weekUpdate'),
              "frequency" : typeModal.querySelector('#frequency')
            }

            // Mis à jour du contenu de la fenêtre modale updateModal
            // Updated the contents of the updateModal modal
            areaUpdateModal.name.textContent = containerUpdateModal.name
            areaUpdateModal.filename.value = containerUpdateModal.filename
            areaUpdateModal.date.value = formatWeekPicker(containerUpdateModal.date)
            areaUpdateModal.frequency.textContent = containerUpdateModal.frequency
            
            break

          // -----------------------------------------------------------------------------------------------------------
          case deleteModal:

            // Extraction des informations à partir des attributs data-*
            // Extracting information from data-* attributes
            const containerDeleteModal = {
              'name' : button.getAttribute('data-service-name'),
              'filename' : button.getAttribute('data-service-filename'),
              'week' : button.parentNode.previousElementSibling.querySelector('small').textContent,
              'frequency' : button.getAttribute('data-frequency')
            }

            // Ciblage des champs à remplir dans la fenêtre modale deleteModal
            // Targeting fillable fields in the deleteModal modal
            const areaDeleteModal = {
              'name' : typeModal.querySelector('#serviceName'),
              'filename' : typeModal.querySelector('#fileNameDelete'),
              'week' : typeModal.querySelector('#interventionWeek'),
              'frequency' : typeModal.querySelector('#frequency')
            }
      
            // Mis à jour du contenu de la fenêtre modale deleteModal
            // Updated the contents of the deleteModal modal
            areaDeleteModal.name.textContent = containerDeleteModal.name
            areaDeleteModal.filename.value = containerDeleteModal.filename
            areaDeleteModal.week.textContent = containerDeleteModal.week
            areaDeleteModal.frequency.textContent = containerDeleteModal.frequency

            break
        }
      }
    )
  }
}

// Chargement des données dans les différentes fenêtres modales - Loading data into different modal
loadModal(createModal)
loadModal(updateModal)
loadModal(deleteModal)

/*------------------------------------------------------- / ----------------------------------------------------------*/

const buttonCreate = document.querySelector('#buttonCreate')

buttonCreate.addEventListener('click', () => {
  const idCreate = createModal.querySelector('#fileNameCreate').value
  const createDiv = document.querySelector(`#${idCreate}`)
  const inputWeekCreate = createModal.querySelector('#weekCreate').value

  createDiv.querySelector('small').textContent = formatWeek(inputWeekCreate)
  createDiv.querySelectorAll('button')[0].classList.replace('d-inline', 'd-none')
  createDiv.querySelectorAll('button')[1].classList.replace('d-none', 'd-inline')
  createDiv.querySelectorAll('button')[2].classList.replace('d-none', 'd-inline')
})

/*------------------------------------------------------- / ----------------------------------------------------------*/

const buttonUpdate = document.querySelector('#buttonUpdate')

buttonUpdate.addEventListener('click', () => {
  const idUpdate = updateModal.querySelector('#fileNameUpdate').value
  const updateDiv = document.querySelector(`#${idUpdate}`)
  const inputWeekUpdate = updateModal.querySelector('#weekUpdate').value
  
  updateDiv.querySelector('small').textContent = formatWeek(inputWeekUpdate)
})

/*------------------------------------------------------- / ----------------------------------------------------------*/

const buttonDelete = document.querySelector('#buttonDelete')


buttonDelete.addEventListener('click', () => {
  const idDelete = deleteModal.querySelector('#fileNameDelete').value
  const deleteDiv = document.querySelector(`#${idDelete}`)

  deleteDiv.querySelector('small').textContent = '-'
  deleteDiv.querySelectorAll('button')[0].classList.replace('d-none', 'd-inline')
  deleteDiv.querySelectorAll('button')[1].classList.replace('d-inline', 'd-none')
  deleteDiv.querySelectorAll('button')[2].classList.replace('d-inline', 'd-none')
})