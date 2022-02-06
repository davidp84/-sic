function toggleLogin() {
  let login = document.getElementById("login");
  if (login.hidden == true) {
    login.hidden = false;
    login.style.visibility = "visible";
  } else {
    login.hidden = true;
    login.style.visibility = "hidden";
  }
}

function rememberMe() {
  if (document.getElementById("remember-me").checked) {
    localStorage.name = document.getElementById("name").value;
    localStorage.email = document.getElementById("email").value;
    localStorage.mobile = document.getElementById("mobile").value;
    localStorage.address = document.getElementById("address").value;
    localStorage.remember = true;
  } else {
    localStorage.clear();
  }
  
}

function loadForm() {

  if (localStorage.remember == 'true') {
    document.getElementById('name').value = localStorage.name;
    document.getElementById('email').value = localStorage.email;
    document.getElementById('mobile').value = localStorage.mobile;
    document.getElementById('address').value = localStorage.address;
    document.getElementById('remember-me').checked = true;
   }
}
