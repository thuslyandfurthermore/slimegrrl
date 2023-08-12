const showButton = document.getElementById('showDialog');
const regDialog = document.getElementById('regDialog');

// "Show the dialog" button opens the <dialog> modally
showButton.addEventListener('click', () => {
  regDialog.showModal();
});