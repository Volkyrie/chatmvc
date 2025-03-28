let password1 = document.getElementById("password");
let password2 = document.getElementById("confirmedPassword");
let msg = document.getElementById("msg");
let btn = document.getElementById("validBtn");

function valid() {
    if (password1.value !== password2.value) {
      password2.classList.add('border-danger', 'text-danger');
      msg.classList.replace('d-none', 'd-block');
      btn.classList.add('disabled');
      btn.disabled = true;
      console.log("Les mdp ne correspondent pas");
      return false;
    }
    password2.classList.remove('border-danger', 'text-danger');
    msg.classList.replace('d-block', 'd-none');
    btn.classList.remove('disabled');
    btn.disabled = false;
    return true;
}

password1.addEventListener("blur", valid);
password2.addEventListener("blur", valid);

