const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

const formContainer = document.querySelector('.form-container');
const alert = document.querySelector('.alert');

// Hide the alert when the registration form is not active
formContainer.addEventListener('click', function() {
  if (formContainer.classList.contains('sign-up')) {
    alert.style.display = 'none';
  }
});

// Hide the error messages when the sign-in form is not active
const signInForm = document.querySelector('.sign-in');
signInForm.addEventListener('click', function() {
  if (signInForm.classList.contains('sign-in')) {
    const errors = document.querySelectorAll('.alert-danger');
    errors.forEach(function(error) {
      error.style.display = 'none';
    });
  }
});


// Show the alert when the sign-up form is active and there are errors
const signUpForm = document.querySelector('.sign-up');
signUpForm.addEventListener('click', function() {
  if (signUpForm.classList.contains('sign-up')) {
    const errors = document.querySelectorAll('.alert-danger');
    errors.forEach(function(error) {
      error.style.display = 'block'; // Show the errors
      error.style.right = '-150%'; // Position the errors next to the sign-up form
    });
  }
});