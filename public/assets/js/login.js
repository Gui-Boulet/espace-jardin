/* ******************************************************* */
/* Déclaration de constante - Declaration of constant */
/* ******************************************************* */

// Ciblage du formulaire - Form targeting
const loginForm = document.getElementById('loginForm')

// Ciblage des champs à remplir dans loginForm - Targeting fillable fields in loginForm
const areaLoginForm = {
  "email" : loginForm.querySelector('#user-email'),
  "password" : loginForm.querySelector('#user-password')
}

// Ciblage du bouton pour envoyer les données de loginForm
// Targeting the button to send form data from loginForm
const buttonSubmit = loginForm.querySelector('#user-submit')

/* ****************************************************** */
/* Déclarations des fonctions - Declarations of functions */
/* ****************************************************** */

// Valide les champs d'un formulaire - Validates fields on a form
function validateField(field, regex) {
  const valueField = field.value.trim()

  if (!regex.test(valueField)) {
    field.classList.add('is-invalid')
    return false
  } else {
    field.classList.remove('is-invalid')
    return true
  }
}


// Contrôle de la validité des champs du formulaire après avoir cliqué sur le bouton
// Checking the validity of the form fields after clicking the button
buttonSubmit.addEventListener('click', function() {
  const isFieldValid = {
    "email" : validateField(areaLoginForm.email,
      /^(?=.{6,100}$)[a-z0-9._%+-]{1,64}@[a-z0-9.-]{1,63}\.[a-z]{2,}$/),
    "password" : validateField(areaLoginForm.password,
      /^(?=.*[a-zàâäéèêëïîôöùûüÿç])(?=.*[A-ZÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ])(?=.*\d)(?=.*[@#!%*$€£?§&-])[A-Za-zàâäéèêëïîôöùûüÿçÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ\d@#!%*$€£?§&-]{8,60}$/)
  }

  // Permet de soumettre le formulaire si champs du formulaire corrects
  // Allows you to submit the form if the form fields are correct
  if (!(isFieldValid.email && isFieldValid.password)) {
    buttonSubmit.setAttribute('type', 'button')
  } else {
    buttonSubmit.setAttribute('type', 'submit')
  }
})