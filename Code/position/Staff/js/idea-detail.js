const exampleModal = document.getElementById('replyModal')
exampleModal.addEventListener('show.bs.modal', event => {
    console.log('hello world')
  // Button that triggered the modal
  const button = event.relatedTarget
  // Extract info from data-bs-* attributes
  const recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  const modalTitle = exampleModal.querySelector('.modal-title')

  modalTitle.textContent = `New message to ${recipient}`
})

