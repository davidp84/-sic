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

function incrementQuantity(prices) {
  let qty = document.getElementById("quantity");
  if (qty.value == '' || qty.value < 0) {
      qty.value = 1;
  } else if (qty.value < 100) {
      qty.value++;
  }    
  validateQty(prices);
}

function decrementQuantity(prices) {
  let qty = document.getElementById("quantity");
  if (qty.value <= 1) {
      qty.value = '';
  } else if (qty.value > 100) {
      qty.value = 100;
  } else {
      qty.value--;
  }
  validateQty(prices);
}

function validateQty(prices) {
  let qty = document.getElementById("quantity");
  
  if (isNaN(qty.value)) {
      qty.value = '';
  }

  if (qty.value > 100)
  {
      qty.value = 100;
  } else if (qty.value < 0) {
      qty.value = '';
  }
  // Reference [5]
  var newQuantity = Math.round(qty.value);
  qty.value = Math.round(qty.value);
  priceCalculator(qty.value, prices);
}

function priceCalculator(qty, pricing) {
  let product = document.getElementById("product");
  let variant = document.querySelector('input[name="variant"]:checked').value;
  console.log(variant);
  console.log(pricing);
  let RRP = qty * pricing[product.value]['prices'][variant];
  console.log(RRP);
  document.getElementById("price").innerHTML = RRP.toFixed(2);

}

function validateFirstName() {
  let name = document.getElementById("firstname");
  let pattern = "^[a-zA-Z '\-.]+$";
}

function validateSurname() {
  let name = document.getElementById("surname");
  let pattern = "^[a-zA-Z '\-.]+$";
}

//Refence [3]
function validateEmail() {
  let email = document.getElementById("email");
  let pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!pattern.test(email.value)) {
      email.value = '';
  }
}

function validatePhone() {
  let phone = document.getElementById("phone");
  let pattern = /^(\(04\)|04|\+614)( ?\d){8}$/;
  if (!pattern.test(phone.value)) {
      phone.value = '';
  }
}