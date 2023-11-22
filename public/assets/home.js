/* ******************************************************* */
/* Déclaration de constante - Declaration of constant */
/* ******************************************************* */

// Ciblage des différentes fenêtres modales - Targeting the different modal
const registrationModal = document.getElementById('registrationModal')

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
    }, 20000)
  } else {
    field[key].classList.remove('is-invalid')
    message[key].classList.remove('d-block')
    message[key].classList.add('d-none')
  }
}



registrationModal.addEventListener('show.bs.modal', event => {
  
  // Ciblage des champs à remplir dans registrationModal - Targeting fillable fields in registrationModal
  const areaRegistrationModal = {
    "lastName" : registrationModal.querySelector('#customer-last_name'),
    "firstName" : registrationModal.querySelector('#customer-first_name'),
    "email" : registrationModal.querySelector('#user-email'),
    "phone" : registrationModal.querySelector('#customer-phone'),
    "streetNumber" : registrationModal.querySelector('#customer-street_number'),
    "street" : registrationModal.querySelector('#customer-street'),
    "zipCode" : registrationModal.querySelector('#customer-zip_code'),
    "city" : registrationModal.querySelector('#customer-city'),
    "country" : registrationModal.querySelector('#customer-country'),
    "comment" : registrationModal.querySelector('#message-comment')
  }

  // Ciblage des messages d'erreurs dans registrationModal - Targeting error messages in registrationModal
  const errorMessage = {
    "lastName" : registrationModal.querySelector('#customer-last_name-error'),
    "firstName" : registrationModal.querySelector('#customer-first_name-error'),
    "email" : registrationModal.querySelector('#user-email-error'),
    "phone" : registrationModal.querySelector('#customer-phone-error'),
    "streetNumber" : registrationModal.querySelector('#customer-street_number-error'),
    "street" : registrationModal.querySelector('#customer-street-error'),
    "zipCode" : registrationModal.querySelector('#customer-zip_code-error'),
    "city" : registrationModal.querySelector('#customer-city-error'),
    "country" : registrationModal.querySelector('#customer-country-error'),
    "comment" : registrationModal.querySelector('#message-comment-error')
  }

  // Ciblage du bouton pour envoyer les données du formulaire de registrationModal
  // Targeting the button to send form data from registrationModal
  const buttonSubmit = registrationModal.querySelector('#customer-submit')

  // Contrôle de la validité des champs du formulaire après avoir cliqué sur le bouton
  // Checking the validity of the form fields after clicking the button
  buttonSubmit.addEventListener('click', function() {
    const isFieldValid = {
      "lastName" : validateField(areaRegistrationModal.lastName,
        /^[a-zA-ZàâäéèêëïîôöùûüÿçÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ'-\s]{3,30}$/),
      "firstName" : validateField(areaRegistrationModal.firstName,
        /^[a-zA-ZàâäéèêëïîôöùûüÿçÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ'-\s]{3,30}$/),
      "email" : validateField(areaRegistrationModal.email,
        /^(?=.{6,100}$)[a-z0-9._%+-]{1,64}@[a-z0-9.-]{1,63}\.[a-z]{2,}$/),
      "phone" : validateField(areaRegistrationModal.phone,
        /^0033[0-9]{9}$/),
      "streetNumber" : validateField(areaRegistrationModal.streetNumber,
        /^[1-9][0-9]{0,3}[a-z]?$/),
      "street" : validateField(areaRegistrationModal.street,
        /^[a-zA-Z0-9àâäéèêëîïôöùûüçÀÂÄÉÈÊËÎÏÔÖÙÛÜÇ'-\s+]{5,200}$/),
      "zipCode" : validateField(areaRegistrationModal.zipCode,
        /^[1-9][0-9]{4}$/),
      "city" : validateField(areaRegistrationModal.city,
        /^[a-zA-ZàâäéèêëïîôöùûüÿçÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ'-\s]{3,30}$/),
      "country" : validateField(areaRegistrationModal.country,
        /^[a-zA-ZàâäéèêëïîôöùûüÿçÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ'-\s]{3,30}$/),
      "comment" : validateField(areaRegistrationModal.comment,
        /^[^<>";&/\\]{0,250}$/)
    }

    // Affichage des messages pour chaque champs si erreurs - Display messages for each field if errors
    displayErrorMessage(isFieldValid, errorMessage, 'lastName', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'firstName', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'email', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'phone', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'streetNumber', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'street', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'zipCode', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'city', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'country', areaRegistrationModal)
    displayErrorMessage(isFieldValid, errorMessage, 'comment', areaRegistrationModal)

    // Si erreur, l'attribut 'type' du bouton vaut 'button', sinon 'submit'
    // If error, the 'type' attribute of the button is set to 'button', else 'submit'
    if (!(isFieldValid.lastName && isFieldValid.firstName && isFieldValid.email && isFieldValid.phone &&
        isFieldValid.streetNumber && isFieldValid.street && isFieldValid.zipCode && isFieldValid.city &&
        isFieldValid.country && isFieldValid.comment)) {
      buttonSubmit.setAttribute('type', 'button')
    } else {
      buttonSubmit.setAttribute('type', 'submit')
    }
  })
})