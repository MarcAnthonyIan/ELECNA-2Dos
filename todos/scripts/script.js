

// Get the button and the form container
const button = document.querySelector('#open-form-button');
const form_Container = document.querySelector('#form-container');

// Add a click event listener to the button
button.addEventListener('click', () => {
  // Show the form container
  form_Container.style.display = 'block';
});

// Add a submit event listener to the form
const form = document.querySelector('#input');
form.addEventListener('submit', (event) => {
  // Prevent the form from being submitted
  event.preventDefault();

  // Get the value of the input field
  const inputField = document.querySelector('title');
  const value = inputField.value;


  // Do something with the value (e.g. save it to a server)
  console.log(value);

  // Hide the form container
  form_Container.style.display = 'none';
});

// Add a focus event listener to the input field
const inputField = document.querySelector('title');
inputField.addEventListener('focus', () => {
  // Show the form container
  form_Container.style.display = 'block';
});