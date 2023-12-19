const scriptURL = 'https://script.google.com/macros/s/AKfycbyo57Tu1BY1sFEcs-FGpsI_c3L5-fi7ikunf9n5hDE37LoX-5L7v6RUHsVtLyswjaKT/exec'

const form = document.forms['contact-form']

form.addEventListener('submit', e => {
  e.preventDefault()
  fetch(scriptURL, { method: 'POST', body: new FormData(form)})
  .then(response => alert("Pesan Berhasil dikirim" ))
  .then(() => { window.location.reload(); })
  .catch(error => console.error('Error!', error.message))
})