email_or_phone.addEventListener("keyup", function () {
  localStorage.setItem('serch', email_or_phone.value);
  search();
})

function search() {
  email_or_phone.value = localStorage.getItem('serch');
  const elems_email = document.querySelectorAll(".search_email");
  const elems_numb = document.querySelectorAll(".search_numb");
  const elems_block = document.querySelectorAll(".bookings_block");
  for (let i = 0; i < elems_email.length; i++) {
    elems_block[i].style.display = 'none';
    if (localStorage.getItem('serch') == elems_email[i].textContent || localStorage.getItem('serch') == elems_numb[i].textContent.substring(15)) {
      elems_block[i].style.display = 'block';
    }
  }
}

search();