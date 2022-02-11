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

