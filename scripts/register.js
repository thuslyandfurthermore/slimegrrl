const showButton = document.getElementById('showDialog');
const regDialog = document.getElementById('regDialog');
const confirmButton = document.getElementById('confirmButton');

// "Show the dialog" button opens the <dialog> modally
showButton.addEventListener('click', () => {
  regDialog.showModal();
});

confirmButton.addEventListener('click', () => {
  regDialog.close();
});