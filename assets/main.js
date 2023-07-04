const a = email_redact_profil.innerText;
const b = name_redact_profil.innerText;
const c = phone_redact_profil.innerText;
function replace() {
  if (redact_profil.innerText == 'Редактировать профиль') {
    console.log(email_redact_profil.innerText);
    email_redact_profil.innerHTML = '<input value="'+ a +'" name="input_email_redact" class="input_redact" /><input placeholder="Пароль" name="input_pass_redact" class="input_redact" />';
    name_redact_profil.innerHTML = '<input value="'+ b +'" name="input_name_redact" class="input_redact" />';
    phone_redact_profil.innerHTML = '<input name="input_phone_redact" class="input_redact" value="'+ c +'" data-phone-pattern />';
    div_redact_profil.innerHTML = '<button id="redact_profil" onclick="replace();">Отменить</button><button name="submit_redact_profil" type="submit">Сохранить</button>'
  } else {
    email_redact_profil.innerHTML = a;
    name_redact_profil.innerHTML = b;
    phone_redact_profil.innerHTML = c;
    div_redact_profil.innerHTML = '<button id="redact_profil" onclick="replace();">Редактировать профиль</button>'
  }
}

function addStyle() {
  const params = document.querySelectorAll('.bookings_block');
  for (let i = 0; i < params.length; i++) {
      params[i].classList.toggle("dn");
  }
  if (ss.innerText == 'Показать удаленные брони') {
      ss.innerHTML = 'Скрыть удаленные брони';
  } else {
      ss.innerHTML = 'Показать удаленные брони';
  }
}